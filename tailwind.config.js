/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        // ⬅️ مهم: لتضمين قوالب Filament المخصصة
        './resources/views/filament/**/*.blade.php',

        // ⬅️ كمان مفيد أحيانًا
        './vendor/filament/**/*.blade.php',
        './vendor/jaocero/filachat/resources/views/**/**/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}

//
// import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms';
//
// /** @type {import('tailwindcss').Config} */
// export default {
//     content: [
//         './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
//         './storage/framework/views/*.php',
//         './resources/views/**/*.blade.php',
//         './app/Filament/**/*.php',
//         './resources/views/filament/**/*.blade.php',
//         './vendor/filament/**/*.blade.php',
//     ],
//
//     theme: {
//         extend: {
//             fontFamily: {
//                 sans: ['Figtree', ...defaultTheme.fontFamily.sans],
//             },
//         },
//     },
//
//     plugins: [forms],
// };
