const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "./app/Http/Livewire/**/*.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                Graphik: ["Graphik", "sans-serif"],
                GraphikLight: ["GraphikLight"],
                GraphikMedium: ["GraphikMedium"],
                GraphikSemibold: ["GraphikSemibold"],
                GraphikBold: ["GraphikBold"],
                Adelia: ["Adelia", "sans-serif"],
                SecularOne: ["SecuralOneRegular"],
                GloriaHallelujah: ["GloriaHallelujahRegular"],
            },
        },

        backgroundImage: {
            clouds: "url('/resources/images/clouds.png')",
        },

        colors: {
            "piss-yellow": "#e8c811",
            primary: "#979797",
            secondary: "#e6e6e6",
            darker: "#CCCED0",
            "darker-2": "#686868",
            "darker-3": "#4c4d47",
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require('flowbite/plugin'),
    ],

    screens: {
        '3xl': '1920px',
    }
};
