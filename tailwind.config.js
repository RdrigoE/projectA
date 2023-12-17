import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            // all the colors
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            indigo: colors.indigo,
            red: colors.red,
            yellow: colors.amber,
            blue: colors.blue,
            green: colors.green,
            purple: colors.purple,
            pink: colors.pink,
            teal: colors.teal,
            orange: colors.orange,
            cyan: colors.cyan,
            lime: colors.lime,
            emerald: colors.emerald,
            rose: colors.rose,
            fuchsia: colors.fuchsia,
            violet: colors.violet,
            amber: colors.amber,
        },
    },

    plugins: [forms],
};
