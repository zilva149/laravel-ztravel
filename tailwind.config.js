const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    darkMode: "class",

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],

    theme: {
        extend: {
            keyframes: {
                pulse: {
                    "0%, 100%": { transform: "scale(1)" },
                    "50%": { transform: "scale(0.95)" },
                },
            },
            animation: {
                pulse: "pulse 1.25s ease-in-out infinite",
            },
            screens: {
                sm: "500px",
                md: "668px",
                lg: "992px",
                xl: "1200px",
                "2xl": "1440px",
            },

            fontFamily: {
                sans: ["Montserrat", ...defaultTheme.fontFamily.sans],
            },

            colors: {
                dark: {
                    "eval-0": "#151823",
                    "eval-1": "#222738",
                    "eval-2": "#2A2F42",
                    "eval-3": "#2C3142",
                },
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
