const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./src/**/*.{html,js}",
        './resources/**/*.blade.php',
    ],

    theme: {
        extend: {},
        scale: {
            '0': '0',
           '25': '.25',
            '50': '.5',
            '75': '.75',
            '90': '.9',
           '95': '.95',
            '100': '1',
           '105': '1.05',
           '110': '1.1',
            '125': '1.25',
            '150': '1.5',
           '200': '2',
        },
        container: {
          padding: {
            DEFAULT: '1rem',
            sm: '2rem',
            lg: '4rem',
            xl: '5rem',
            '2xl': '6rem',
          },
        },
      },
    variants: {
        extend: {
          scale: ['active', 'group-hover'],
        },
      },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
