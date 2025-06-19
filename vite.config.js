import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/adminlte.scss', 'resources/ts/adminlte.ts', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
