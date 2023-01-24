<?php
/**
* Plugin Name: WPMedia Marcos Application Tasks
* Plugin URI: http://example.com/
* Description: This is a helper plugin for job application purposes at WPMedia.
* Author: Marcos Vinicios Barreto
* Author URI: http://mvbarreto.com
* ...
*/

/*
* This is the task 01
* See: https://docs.google.com/document/d/1ZflLn2qAGcCmSTtixKhtsTpgWmtPNPQDl4LR3rcU2jw/edit#
*/

function wpmedia_marcos_purge_superhoster_cache() {
    
    // Exit earlier in case the fictional host cache function doesn't exist.
    if ( ! function_exists( 'purge_superhoster_cache' ) ) {
        return;
    }

    // Clear it
    purge_superhoster_cache();
}

add_action( 'after_rocket_clean_domain' , 'wpmedia_marcos_purge_superhoster_cache' );

/*
* This is the task 02
* See: https://docs.google.com/document/d/1ZflLn2qAGcCmSTtixKhtsTpgWmtPNPQDl4LR3rcU2jw/edit#
*/

function wpmedia_marcos_remove_from_delay_js_exclusions( $exclusions ) {

    // Checks if the desired script is included in the list of default exclusions, if so, remove it.
    if ( isset( $exclusions['recaptcha/api.js'] ) ) {
        unset( $exclusions['recaptcha/api.js'] );
    }

    return $exclusions;
}

add_filter( 'rocket_delay_js_exclusions', 'wpmedia_marcos_remove_from_delay_js_exclusions' );

/*
* This is the task 03
* See: https://docs.google.com/document/d/1ZflLn2qAGcCmSTtixKhtsTpgWmtPNPQDl4LR3rcU2jw/edit#
* 
* QUESTIONS:
*
* Question 01
* Answer:
*       The rocket_clean_post() is calling rocket_get_purge_urls() which accepts a post_id information
*       then, this function returns an array with all the urls to be purged which includes the actual post
*       and all the information associated with it, for example related posts, parent posts, posts in same category, posts page and so on.
*
* Question 02
* Answer:
*       As the rocket_clean_post() function actually works with the return value of rocket_get_purge_urls()
*       for most of it tasks with the exception of rocket_clean_home() I would pass a post id and post object to
*       this function itself and this way I would take the return values in order to inspect
*       which URLs we have returned as this is the actual information rocket_clean_post() will use for its 
*       internal process.
* For example:
*/

$post_id = get_queried_object_id();
$post_object = get_post( $post_id );
$returned_urls = array();

if ( function_exists( 'rocket_get_purge_urls' ) ) {
    $returned_urls = rocket_get_purge_urls( $post_id, $post_object );
}

print_r( $returned_urls );

/*
* Of course this is just a sample implementation taking WPRocket core code
* In a real scenario, I would be more specific and detailed in order to help customers
* and my team members to get the job done effectively.
*/

