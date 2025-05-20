import tailwindcss from "@tailwindcss/vite";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],

    server: {
        host: "0.0.0.0", // Listen on all available network interfaces
        hmr: {
            host: "rolandtech.local", // Use localhost for HMR
        },
    },



});
