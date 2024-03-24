const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        container: {
            padding: "2rem",
            center: true,
        },
        fontFamily: {
            sans: [
                '"Helvetica Neue"',
                "Arial",
                '"Hiragino Kaku Gothic ProN"',
                '"Hiragino Sans"',
                "Meiryo",
                "sans-serif",
            ],
        },
        extend: {
            colors: {
                primary: "#FA9F16",
                secondary: "#1672FA",
                danger: "#EE4C4C",
                dark: "#110C03",
                light: "#FFFDFA",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
