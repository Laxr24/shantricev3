const mix = require('laravel-mix');



mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin/app.js', 'public/js/admin')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss")
    ])
    .postCss('resources/css/admin/app.css', 'public/css/admin', [
        require("tailwindcss")
    ])
