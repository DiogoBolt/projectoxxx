var elixir = require('laravel-elixir');

// import the dependency
var elixirTypscript = require('elixir-typescript');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    mix.copy('node_modules/@angular/common/bundles', 'public/bundles/@angular/common');
    mix.copy('node_modules/@angular/compiler/bundles', 'public/bundles/@angular/compiler');
    mix.copy('node_modules/@angular/core/bundles', 'public/bundles/@angular/core');
    mix.copy('node_modules/@angular/forms/bundles', 'public/bundles/@angular/forms');
    mix.copy('node_modules/@angular/http/bundles', 'public/bundles/@angular/http');
    mix.copy('node_modules/@angular/platform-browser/bundles', 'public/bundles/@angular/platform-browser');
    mix.copy('node_modules/@angular/platform-browser-dynamic/bundles', 'public/bundles/@angular/platform-browser-dynamic');
    mix.copy('node_modules/@angular/router/bundles', 'public/bundles/@angular/router');
    mix.copy('node_modules/@angular/router-deprecated/bundles', 'public/bundles/@angular/router-deprecated');
    mix.copy('node_modules/@angular/upgrade/bundles', 'public/bundles/@angular/upgrade');

    mix.copy('node_modules/rxjs/bundles', 'public/bundles/rxjs');
    //mix.copy('node_modules/systemjs', 'public/bundles/systemjs');
    //mix.copy('node_modules/es6-promise', 'public/bundles/es6-promise');
    //mix.copy('node_modules/es6-shim', 'public/bundles/es6-shim');
    //mix.copy('node_modules/zone.js', 'public/bundles/zone.js');
    //mix.copy('node_modules/satellizer', 'public/bundles/satellizer');
    //mix.copy('node_modules/platform', 'public/bundles/platform');
    //mix.copy('node_modules/reflect-metadata', 'public/bundles/reflect-metadata');

    mix.copy('node_modules/core-js/client/shim.min.js', 'public/bundles/core-js/client/shim.min.js');
    mix.copy('node_modules/zone.js/dist/zone.js', 'public/bundles/zone.js/dist/zone.js');
    mix.copy('node_modules/reflect-metadata/Reflect.js', 'public/bundles/reflect-metadata/Reflect.js');
    mix.copy('node_modules/systemjs/dist/system.src.js', 'public/bundles/systemjs/dist/system.src.js');
    mix.copy('resources/assets/systemjs.config.js', 'public/js/systemjs.config.js');

    mix.typescript(
        '/**/*.ts',
        'public/js',
        {
            "target": "es5",
            "module": "system",
            "moduleResolution": "node",
            "sourceMap": true,
            "emitDecoratorMetadata": true,
            "experimentalDecorators": true,
            "removeComments": false,
            "noImplicitAny": false
        }
    );

});
