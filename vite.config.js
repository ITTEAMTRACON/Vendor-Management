import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/auth/auth.js',
                'resources/js/prequalification/prequalification.js',
                'resources/js/profile/profile.js',
                'resources/js/qhse/qhse.js',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/sass/style.scss',
                'resources/sass/landingpage/landingpage.scss',
                'resources/sass/auth/auth.scss',
                'resources/sass/profile/profile.scss',
              
            ],
            refresh: true,
        }),

    ],
});
