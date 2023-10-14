import defaultTheme from 'tailwindcss/defaultTheme';
import colors from 'tailwindcss/colors';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

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
                sans: ['Figtree', '"M PLUS 2"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                indigo: colors.orange
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        a: {
                            color: theme('colors.indigo.600'),
                            '&:hover': {
                                color: theme('colors.indigo.500'),
                            },
                        },
                    },
                },
            }),
        },
    },

    plugins: [
        forms,
        typography,
    ],
};
