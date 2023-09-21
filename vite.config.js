import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/style.scss',
                'resources/sass/landingpage/landingpage.scss',
                'resources/sass/auth/auth.scss',
                'resources/sass/profile/profile.scss',
                'resources/js/auth/auth.js',
                'resources/js/prequalification/prequalification.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),

    ],
});
