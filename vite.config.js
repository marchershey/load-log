import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };

    return {
        server: {
            cors: true,
            hmr: {
                host: process.env.VITE_DEV_IP,
            },
        },
        plugins: [
            laravel({
                input: ["resources/css/app.css", "resources/js/app.js"],
                refresh: true,
            }),
            tailwindcss(),
        ],
    };
});
