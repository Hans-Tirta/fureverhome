import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                background: {
                    primary: '#f8ece0',
                    secondary: '#f3d1b6',
                },
                text: {
                    primary: '#6f3635',
                    secondary: '#b0a095',
                    muted: '#cac3ba',
                },
                accent: {
                    red: '#fe6d50',
                    yellow: '#f99c44',
                    green: '#92bf5d',
                    blue: '#7ac2e4',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
