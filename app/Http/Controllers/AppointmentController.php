<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Date;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();

        return view('appointments.index', ['appointments' => $user->appointments()->latest()->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = request()->user();

        $queryAttr = request()->query;
        $date = $queryAttr->get('date');
        $start = $queryAttr->get('start');
        $end = $queryAttr->get('end');
        return view('appointments.create', [
            'clients' => $user->clients,
            'jobs' => $user->jobs,
            'date' => $date,
            'start' => $start,
            'end' => $end,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $user = request()->user();
        $user->appointments()->create($request->validated());
        $date = new Carbon($request->date);
        $params = array(
            'year' => $date->year,
            'month' => $date->month,
            'day' => $date->day,
        );

        return redirect('?' . http_build_query($params));
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        $user = request()->user();
        return view('appointments.edit', ['appointment' => $appointment, 'clients' => $user->clients, 'jobs' => $user->jobs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $appointment->update($request->validated());


        return redirect()->route('appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);


        $appointment->delete();

        return back();
    }
    public function destroyInCalendar(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);


        $appointment->delete();

        return http_response_code(200);
    }
}
