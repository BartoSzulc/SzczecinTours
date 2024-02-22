<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
    
}, 100);
// Woo script

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {

    add_filter('mce_external_plugins', function ($plugins) {
        // Define the path to your entrypoints.json file
        $entrypointsPath = get_template_directory() . '/public/entrypoints.json';
        
        // Attempt to read and decode the entrypoints.json file
        if (file_exists($entrypointsPath)) {
            $entrypoints = json_decode(file_get_contents($entrypointsPath), true);
            
            // Check if the 'editor' entry exists and has JS files
            if (isset($entrypoints['editor']['js']) && !empty($entrypoints['editor']['js'])) {
                // Assuming you want the first JS file for the editor
                $editorScript = array_shift($entrypoints['editor']['js']);
                
                // Construct the full URL to the script
                $editorScriptUrl = get_template_directory_uri() . '/public/' . $editorScript;
                
                // Add the script to TinyMCE plugins
                $plugins['my_custom_buttons'] = $editorScriptUrl;
            }
        }
        
        return $plugins;
    });

    // Register Custom Buttons
    add_filter('mce_buttons', function($buttons) {
        // Add the new button IDs to the TinyMCE toolbar
        array_push($buttons, 'wrapInDescColor6', 'wrapInBaseColor7'); // Adjust these IDs based on your JavaScript
        return $buttons;
    });
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);
   
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);
    add_image_size('full', false);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

function enqueue_admin_scripts($hook) {
    // Only add to the edit.php admin page.
    // Replace 'post' with your custom post type
    if ('edit.php' !== $hook) {
        return;
    }
    wp_enqueue_script('my-custom-quick-edit', get_template_directory_uri() . '/resources/scripts/admin-quick-edit.js', array('jquery'), '', true);
}
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_admin_scripts');

