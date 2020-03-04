<?php
/**
 * Styles, Scripts
 */

function ntt_styles_scripts() {

    wp_enqueue_style( 'ntt-style', get_template_directory_uri(). '/assets/styles/style.min.css', array(), wp_get_theme()->get( 'Version' ) );

    wp_style_add_data( 'ntt-style', 'rtl', 'replace' );
    
    add_editor_style( array( 'assets/css/editor-style.css', ) );

    wp_enqueue_script( 'ntt-script', get_template_directory_uri(). '/assets/scripts/main.js', array(), wp_get_theme()->get( 'Version' ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt_styles_scripts', 0 );

/**
 * Inline Scripts
 */

function ntt_inline_scripts() {
    ?>
    <script>
        ( function() {
            var html = document.documentElement;
            html.className = html.className.replace( /\bno-js\b/,'js' );
            html.className += ' ' + 'ntt--dom---unloaded';
            html.className += ' ' + 'ntt--window---unloaded';
        } )();
    </script>
    <?php
}
add_action( 'wp_head', 'ntt_inline_scripts', 0 );

/**
 * For NTT Child Themes
 */
if ( is_child_theme() ) {

    function ntt__function__child_theme__styles() {
        wp_enqueue_style( 'ntt-style', get_template_directory_uri(). '/assets/styles/style.min.css' );
    }
    add_action('wp_enqueue_scripts', 'ntt__function__child_theme__styles', 0);

    function ntt__function__child_theme__css( $classes ) {
        $classes[] = 'ntt--'. sanitize_title( $GLOBALS['ntt_child_theme_name'] );
        return $classes;
    }
    add_filter( 'ntt_html_css_filter', 'ntt__function__child_theme__css' );
}