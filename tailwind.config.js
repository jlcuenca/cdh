const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                fucsia: {
                    DEFAULT: '#A1237F',
                    50: '#E894D1',
                    100: '#E483CA',
                    200: '#DD62BC',
                    300: '#D640AD',
                    400: '#C32A99',
                    500: '#A1237F',
                    600: '#73195B',
                    700: '#450F36',
                    800: '#170512',
                    900: '#000000'
                },
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
