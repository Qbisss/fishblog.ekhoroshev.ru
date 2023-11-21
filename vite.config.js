import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/main.css',
			    'resources/css/read.css',
			    'resources/css/login.css',
				'resources/css/personal.css'
            ],
            refresh: true,
        }),
    ],
});
