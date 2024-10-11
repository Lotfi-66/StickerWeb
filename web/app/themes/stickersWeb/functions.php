<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

/*
|--------------------------------------------------------------------------
| Enqueue Three.js Scripts and Styles
|--------------------------------------------------------------------------
|
| Here we will enqueue the necessary scripts and styles for Three.js
| integration. We'll also create a shortcode to easily insert the
| Three.js scene into WordPress pages or posts.
|
*/

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', [], null, true);
    wp_enqueue_script('threejs-animate', get_template_directory_uri() . '/threejs-project/src/animate.js', ['three-js'], null, true);
    wp_enqueue_script('threejs-main', get_template_directory_uri() . '/threejs-project/src/main.js', ['three-js', 'threejs-animate'], null, true);
    
    wp_add_inline_script('threejs-main', 'window.themeUrl = "' . get_template_directory_uri() . '";', 'before');
});

add_shortcode('threejs_scene', function () {
    ob_start();
    ?>
    <div id="threejs-container"></div>
    <?php
    return ob_get_clean();
});
