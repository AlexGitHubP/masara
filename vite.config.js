import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/validators.js',
                'resources/js/addProduct.js',
                'resources/js/shop.js',
                'resources/js/cart.js',
                'resources/sass/global.scss'
            ],
            refresh: true,
        }),
    ],
});
