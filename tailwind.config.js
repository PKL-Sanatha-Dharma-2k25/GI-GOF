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

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                header : '4rem',
            }
        },
    },
 safelist: [
    'bg-blue-100', 'text-blue-800',
    'bg-yellow-100', 'text-yellow-800',
    'bg-red-100', 'text-red-800',
    'bg-purple-100', 'text-purple-800',
  ],
    plugins: [forms],
};
