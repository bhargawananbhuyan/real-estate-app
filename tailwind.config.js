/** @type {import('tailwindcss').Config} */
export default {
    content: ["resources/views/**/*.blade.php"],
    theme: {
        extend: {
            container: {
                padding: "1rem",
                center: true,
            },
        },
    },
    plugins: [],
};
