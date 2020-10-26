<?php
/**
* Sidebar Metabox.
*
* @package Blog Prime
*/
 
add_action( 'add_meta_boxes', 'blog_prime_metabox' );

if( ! function_exists( 'blog_prime_metabox' ) ):


    function  blog_prime_metabox() {
        
        add_meta_box(
            'blog_prime_post_metabox',
            esc_html__( 'Single Post/Page Settings', 'blog-prime' ),
            'blog_prime_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'blog_prime_page_metabox',
            esc_html__( 'Single Post/Page Settings', 'blog-prime' ),
            'blog_prime_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;


$blog_prime_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'blog-prime' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'blog-prime' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'blog-prime' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'blog-prime' ),
                ),
);

/**
 * Callback function for post option.
*/
if( ! function_exists( 'blog_prime_post_metafield_callback' ) ):
    function blog_prime_post_metafield_callback() {
        global $post, $blog_prime_post_sidebar_fields, $blog_prime_post_image_fields;
        $post_type = get_post_type( $post->ID );
        wp_nonce_field( basename( __FILE__ ), 'blog_prime_post_meta_nonce' );
        $default = blog_prime_get_default_theme_options();
        $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$default['global_sidebar_layout'] ) );
        $blog_prime_post_sidebar = esc_html( get_post_meta( $post->ID, 'blog_prime_post_sidebar_option', true ) ); 
        if( $blog_prime_post_sidebar == '' ){ $blog_prime_post_sidebar = 'global-sidebar'; }
        ?>

        <div class="prime-tab-main">

            <div class="prime-metabox-tab">
                <ul>
                    <li>
                        <a id="twp-tab-sidebar" class="twp-tab-active" href="javascript:void(0)"><?php esc_html_e('Layout Settings', 'blog-prime'); ?></a>
                    </li>
                </ul>
            </div>

            <div class="prime-tab-content">
                
                <div id="twp-tab-sidebar-content" class="prime-content-wrap prime-tab-content-active">

                    <div class="prime-meta-panels">

                        <div class="prime-opt-wrap prime-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Sidebar Layout','blog-prime' ); ?></b></label>

                            <select name="blog_prime_post_sidebar_option">

                                <?php
                                foreach ( $blog_prime_post_sidebar_fields as $blog_prime_post_sidebar_field) { ?>
                                    
                                    <option value="<?php echo esc_attr( $blog_prime_post_sidebar_field['value'] ); ?>" <?php if( $blog_prime_post_sidebar_field['value'] == $blog_prime_post_sidebar ){ echo "selected";} if( empty( $blog_prime_post_sidebar ) && $blog_prime_post_sidebar_field['value']=='right-sidebar' ){ echo "selected"; } ?> >
                                        <?php echo esc_html( $blog_prime_post_sidebar_field['label'] ); ?> 
                                    </option>

                                <?php } ?>


                            </select>

                        </div>


                    </div>
                </div>

            </div>
        </div>

    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'blog_prime_save_post_meta' );

if( ! function_exists( 'blog_prime_save_post_meta' ) ):

function blog_prime_save_post_meta( $post_id ) {

    global $post;
    $post_type = '';
    if (isset($post->ID)) {
        $post_type = get_post_type($post->ID);
    }
    
    if ( !isset( $_POST[ 'blog_prime_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['blog_prime_post_meta_nonce'] ) ), basename( __FILE__ ) ) )
        return;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
        
    if ( 'page' == wp_unslash( $_POST['post_type'] ) ) {  
        if ( !current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    
    

    $blog_prime_post_sidebar_option_old = esc_html( get_post_meta( $post_id, 'blog_prime_post_sidebar_option', true ) ); 
    $blog_prime_post_sidebar_option_new = blog_prime_sanitize_sidebar_option( wp_unslash( $_POST['blog_prime_post_sidebar_option'] ) );
    if ( $blog_prime_post_sidebar_option_new && $blog_prime_post_sidebar_option_new != $blog_prime_post_sidebar_option_old ) {  
        update_post_meta ( $post_id, 'blog_prime_post_sidebar_option', $blog_prime_post_sidebar_option_new );  
    } elseif ( '' == $blog_prime_post_sidebar_option_new && $blog_prime_post_sidebar_option_old ) {  
        delete_post_meta( $post_id,'blog_prime_post_sidebar_option', $blog_prime_post_sidebar_option_old );  
    }

}
endif;   