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


/************* PAGINATOR ******************************/
function custom_posts_per_page()
{
    wp_reset_query();
    if (!is_admin()) {
        set_query_var('posts_per_page', 6);
    }
}


//-------------- get svg ----------------------
function get_svg_content($svg_name) {
    $svg_path = get_theme_file_path('/resources/images/svg/' . $svg_name . '.svg');
    if (file_exists($svg_path)) {
        return file_get_contents($svg_path);
    }
    return '';
}


/////Post type Gîte/////////////
function createPostTypeGite(): void
{
    register_post_type('gites', [
        "labels" => [
            "name" => __("Nos gîtes"),
            "singular_name" => __("Gîte")
        ],
        "supports" => array(
            "title",
            "thumbnail"
        ),
        "public" => true,
        "has_archive" => true,
        "show_in_rest" => true,
        "menu_icon" => "dashicons-admin-home",
        "show_in_nav_menus" => true
    ]);
}

add_action('init', 'createPostTypeGite');

function createPostTypePlaces(): void
{
    register_post_type('Lieux', [
        "labels" => [
            "name" => __("Activités dans la région"),
            "singular_name" => __("Activité")
        ],
        "supports" => array(
            "title",
        ),
        "public" => true,
        "has_archive" => false,
        "publicly_queryable" => false,
        "show_in_rest" => true,
        "menu_icon" => "dashicons-location-alt",
        "show_in_nav_menus" => true
    ]);
}

add_action('init', 'createPostTypePlaces');


