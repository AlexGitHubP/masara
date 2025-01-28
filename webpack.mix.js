let mix = require('laravel-mix');
    mix.js([
            'resources/js/app.js',
            'resources/js/validators.js',
            'resources/js/addProduct.js'
        ], 'public/js/app.js')
       .js('resources/js/shop.js', 'public/js/shop.js')
       .js('resources/js/cart.js', 'public/js/cart.js')
       .sass('resources/sass/global.scss', 'public/css')
       .version();

