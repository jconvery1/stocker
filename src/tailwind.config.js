/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/views/app.blade.php",
        "./resources/views/signIn.blade.php",
        "./resources/js/components/*.vue",
        // "./resources/js/app.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
};
