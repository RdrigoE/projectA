import './bootstrap';

import Calendar from '@toast-ui/calendar';
import '@toast-ui/calendar/dist/toastui-calendar.min.css';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


var calendar = new Calendar('#calendar', {
    defaultView: 'month',
    taskView: false,
    scheduleView: ['time'],
    // useFormPopup: true,
    useDetailPopup: true,
    usageStatistics: false,
    week: {
        showTimezoneCollapseButton: true,
        timezonesCollapsed: true,
        taskView: false,
        scheduleView: ['time'],
    },


});



getData();
async function getData() {
    let url = new URL('api/appoint', window.location.origin);
    url.searchParams.append('month', calendar.getDateRangeStart().getFullYear() + '-' + calendar.getDateRangeStart().getMonth());
    const response = await fetch(url);
    const data = await response.json();
    let d = data.map(function (value, key) {
        const date1 = value.date;
        const date2 = value.start;
        const date3 = value.end;

        // Extracting date part from the first string
        const formattedDate = date1.split('T')[0];

        // Extracting time part from the second string
        const formattedTimeStart = date2.split('T')[1];

        const formattedTimeEnd = date3.split('T')[1];

        // Combining date and time parts
        const startDateTime = formattedDate + 'T' + formattedTimeStart
        const endDateTime = formattedDate + 'T' + formattedTimeEnd


        return {
            id: value.id,
            title: `${value.job.title} - ${value.client.name}`,
            start: startDateTime,
            end: endDateTime,
            isAllDay: false,
            category: 'time',
            dueDateClass: '',
            calendarId: '1',
            job_id: value.job_id,
            client_id: value.client_id,
        }
    })
    calendar.createEvents(d);

}


calendar.on('selectDateTime', function (event) {

    const { start, end } = event;
    const formattedDate = formatDate(start);
    const formattedTimeStart = formatHourMinutes(start);
    const formattedTimeEnd = formatHourMinutes(end);

    let url = new URL('/appointments/create', window.location.origin)
    url.searchParams.append('date', formattedDate);
    url.searchParams.append('start', formattedTimeStart);
    url.searchParams.append('end', formattedTimeEnd);
    window.location.href = url;


});
// calendar.on('clickEvent', function (event) {
//     console.log(event)
//     let eventId = event.id;

//     let editButton = document.querySelector('.toastui-calendar-edit-button');

//     let deleteButton = document.querySelector('.toastui-calendar-delete-button');

//     let url = new URL(`/appointments/edit/${eventId}`, window.location.origin);


//     editButton.addEventListener('click', function (event) {
//         event.stopPropagation();
//         window.location.href = url;
//     });
// });

calendar.on('afterRenderEvent', function (event) {
    let eventId = event.id;

    let editButton = document.querySelector('.toastui-calendar-edit-button');

    if (editButton) {
        editButton.addEventListener('click', () => {
            // event.stopPropagation();
            let url = new URL(`/appointments/edit/${eventId}`, window.location.origin);
            console.log('url: ', url)
            // window.location.href = url;
        });
    }
});

function formatDate(date) {
    let d = new Date(date);
    let formattedDate = d.toLocaleDateString('pt-PT', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
    }).split('/').reverse().join('-');

    return formattedDate;
}

function formatHourMinutes(date) {
    let d = new Date(date);

    let hours = d.getHours().toString().padStart(2, '0');
    let minutes = d.getMinutes().toString().padStart(2, '0');

    let formattedTime = `${hours}:${minutes}`;

    return formattedTime;

}

calendar.on('beforeUpdateEvent', function ({ event, changes }) {




    const { id, calendarId } = event;

    if (!changes.end && !changes.start) {
        let url = new URL(`/appointments/${id}/edit`, window.location.origin);
        window.location.href = url
    }



    let obj = {
        '_method': 'patch',
        '_token': document.querySelector('meta[name="_csrf_header"]').getAttribute('content'),
        date: (changes.end) ? changes.end.d.d : event.end.d.d,
        start: (changes.start) ? (changes.start.d.d) : (event.start.d.d),
        end: (changes.end) ? (changes.end.d.d) : (event.end.d.d),
    };


    fetch(`/appointments/${id}`, {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(obj),
    })
        .then(response => {
            console.log(response)
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });

    calendar.updateEvent(id, calendarId, changes);

});

calendar.on('beforeDeleteEvent', function (event) {
    const { id, calendarId } = event;

    fetch(`/appointments/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="_csrf_header"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            // Delete the event from the calendar
            calendar.deleteEvent(id, calendarId);
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
});



document.getElementById('month').addEventListener('click', function () {
    calendar.changeView('month', true);
});

document.getElementById('week').addEventListener('click', function () {
    calendar.changeView('week', true);
});

document.getElementById('day').addEventListener('click', function () {
    calendar.changeView('day', true);
});

// Create a set to store the months for which data has been fetched
const fetchedMonths = new Set();
fetchedMonths.add(calendar.getDate().getMonth());


function changeMonth(calendar, direction) {
    // Get the current month
    const currentMonth = calendar.getDate().getMonth();

    // Move to the next or previous month
    calendar[direction]();

    // Get the new month
    const newMonth = calendar.getDate().getMonth();

    // If the month has changed and data has not been fetched for the new month, fetch new data
    if (currentMonth !== newMonth && !fetchedMonths.has(newMonth)) {

        getData();

        // Add the new month to the set of fetched months
        fetchedMonths.add(newMonth);
    }
}

document.getElementById('next').addEventListener('click', function () {
    changeMonth(calendar, 'next');
});

document.getElementById('prev').addEventListener('click', function () {
    changeMonth(calendar, 'prev');
});
changeMonth(calendar, 'next');
changeMonth(calendar, 'prev');
