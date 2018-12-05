<?php 
/*
 Plugin Name: VW Startup Pro Posttype
 lugin URI: https://www.vwthemes.com/
 Description: Creating new post type for VW Startup Pro Theme.
 Author: VW Themes
 Version: 1.0
 Author URI: https://www.vwthemes.com/
*/

define( 'VW_STARTUP_PRO_POSTTYPE_VERSION', '1.0' );

add_action( 'init', 'vw_startup_pro_posttype_create_post_type' );

function vw_startup_pro_posttype_create_post_type() {
  register_post_type( 'portfolio',
    array(
      'labels' => array(
        'name' => __( 'Portfolio','vw-startup-pro-posttype' ),
        'singular_name' => __( 'Portfolio','vw-startup-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-portfolio',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
  register_post_type( 'services',
    array(
      'labels' => array(
        'name' => __( 'Services','vw-startup-pro-posttype' ),
        'singular_name' => __( 'Services','vw-startup-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-portfolio',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
  register_post_type( 'testimonials',
    array(
  		'labels' => array(
  			'name' => __( 'Testimonials','vw-startup-pro-posttype' ),
  			'singular_name' => __( 'Testimonials','vw-startup-pro-posttype' )
  		),
  		'capability_type' => 'post',
  		'menu_icon'  => 'dashicons-businessman',
  		'public' => true,
  		'supports' => array(
  			'title',
  			'editor',
  			'thumbnail'
  		)
		)
	);
  register_post_type( 'team',
    array(
      'labels' => array(
        'name' => __( 'Our Team','vw-startup-pro-posttype' ),
        'singular_name' => __( 'Our Team','vw-startup-pro-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array( 
          'title',
          'editor',
          'thumbnail'
      )
    )
  );
}

/*--------------------- Services section ----------------------*/
// Serives section
function vw_startup_pro_posttype_images_metabox_enqueue($hook) {
  if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
    wp_enqueue_script('vw_lawyer-pro-posttype-images-metabox', plugin_dir_url( __FILE__ ) . '/js/img-metabox.js', array('jquery', 'jquery-ui-sortable'));

    global $post;
    if ( $post ) {
      wp_enqueue_media( array(
          'post' => $post->ID,
        )
      );
    }

  }
}
add_action('admin_enqueue_scripts', 'vw_startup_pro_posttype_images_metabox_enqueue');
// Services Meta
function vw_startup_pro_posttype_bn_custom_meta_services() {

    add_meta_box( 'bn_meta', esc_html__( 'Icon Image', 'vw-startup-pro-posttype' ), 'vw_startup_pro_posttype_bn_meta_callback_services', 'services', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'vw_startup_pro_posttype_bn_custom_meta_services');
}

function vw_startup_pro_posttype_bn_meta_callback_services( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'vw_startup_pro_posttype_services_bn_nonce' );
    $post_id = get_the_ID();
    $bn_stored_meta = get_post_meta( $post->ID );

    if(!empty($bn_stored_meta['vw-startup-pro-posttype-services-meta-image'][0])){
      $bn_vw_startup_pro_posttype_services_meta_image = $bn_stored_meta['vw-startup-pro-posttype-services-meta-image'][0];
    } else{
      $bn_vw_startup_pro_posttype_services_meta_image = '';
    }

    if(!empty($bn_stored_meta['vw-startup-pro-posttype-services-icon'][0])){
      $bnvw_startup_pro_posttype_services_icon = $bn_stored_meta['vw-startup-pro-posttype-services-icon'][0];
    } else{
      $bnvw_startup_pro_posttype_services_icon = '';
    }

    if(!empty($bn_stored_meta['vw-startup-pro-posttype-services-url'][0])){
      $bn_vw_startup_pro_posttype_services_url = $bn_stored_meta['vw-startup-pro-posttype-services-url'][0];
    } else{
      $bn_vw_startup_pro_posttype_services_url = '';
    }

    ?>
  <div id="property_stuff">
    <table id="list-table">     
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <p>
            <label for="meta-image"><?php echo esc_html('Icon Image'); ?></label><br>
            <input type="text" name="vw-startup-pro-posttype-services-meta-image" id="vw-startup-pro-posttype-services-meta-image" class="services-meta-image regular-text" value="<?php echo esc_attr($bn_vw_startup_pro_posttype_services_meta_image); ?>">
            <input type="button" class="button image-upload" value="Browse">
          </p>
          <div class="image-preview"><img src="<?php echo esc_url($bn_vw_startup_pro_posttype_services_meta_image); ?>"></div>
        </tr>
        <tr id="meta-2">
          <td class="left">
            <?php esc_html_e( 'OR', 'vw-startup-pro-posttype' )?>
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
            <?php esc_html_e( 'Font Awesome Icon', 'vw-startup-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="vw-startup-pro-posttype-services-icon" id="vw-startup-pro-posttype-services-icon" value="<?php echo esc_attr( $bnvw_startup_pro_posttype_services_icon ); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
            <?php esc_html_e( 'Link post to external URL', 'vw-startup-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="url" name="vw-startup-pro-posttype-services-url" id="vw-startup-pro-posttype-services-url" value="<?php echo esc_attr( $bn_vw_startup_pro_posttype_services_url ); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

function vw_startup_pro_posttype_bn_meta_save_services( $post_id ) {

  if (!isset($_POST['vw_startup_pro_posttype_services_bn_nonce']) || !wp_verify_nonce($_POST['vw_startup_pro_posttype_services_bn_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  // Save Image
  if( isset( $_POST[ 'vw-startup-pro-posttype-services-meta-image' ] ) ) {
      update_post_meta( $post_id, 'vw-startup-pro-posttype-services-meta-image', esc_url($_POST[ 'vw-startup-pro-posttype-services-meta-image' ]) );
  }
  if( isset( $_POST[ 'vw-startup-pro-posttype-services-icon' ] ) ) {
      update_post_meta( $post_id, 'vw-startup-pro-posttype-services-icon', sanitize_text_field($_POST[ 'vw-startup-pro-posttype-services-icon' ]) );
  }
  if( isset( $_POST[ 'vw-startup-pro-posttype-services-url' ] ) ) {
      update_post_meta( $post_id, 'vw-startup-pro-posttype-services-url', esc_url($_POST[ 'vw-startup-pro-posttype-services-url' ]) );
  }
}
add_action( 'save_post', 'vw_startup_pro_posttype_bn_meta_save_services' );

/*----------------------Testimonial section ----------------------*/
/* Adds a meta box to the Testimonial editing screen */
function vw_startup_pro_posttype_bn_testimonial_meta_box() {
	add_meta_box( 'vw-startup-pro-posttype-testimonial-meta', __( 'Enter Details', 'vw-startup-pro-posttype' ), 'vw_startup_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_startup_pro_posttype_bn_testimonial_meta_box');
}
/* Adds a meta box for custom post */
function vw_startup_pro_posttype_bn_testimonial_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'vw_startup_pro_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );

  if(!empty($bn_stored_meta['vw_startup_pro_posttype_testimonial_desigstory'][0])){
      $bn_vw_startup_pro_posttype_testimonial_desigstory = $bn_stored_meta['vw_startup_pro_posttype_testimonial_desigstory'][0];
  } else{
    $bn_vw_startup_pro_posttype_testimonial_desigstory = '';
  }

	?>
	<div id="testimonials_custom_stuff">
		<table id="list">
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left">
						<?php esc_html_e( 'Designation', 'vw-startup-pro-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="vw_startup_pro_posttype_testimonial_desigstory" id="vw_startup_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $bn_vw_startup_pro_posttype_testimonial_desigstory ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/* Saves the custom meta input */
function vw_startup_pro_posttype_bn_metadesig_save( $post_id ) {
	if (!isset($_POST['vw_startup_pro_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['vw_startup_pro_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save desig.
	if( isset( $_POST[ 'vw_startup_pro_posttype_testimonial_desigstory' ] ) ) {
		update_post_meta( $post_id, 'vw_startup_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'vw_startup_pro_posttype_testimonial_desigstory']) );
	}
}

add_action( 'save_post', 'vw_startup_pro_posttype_bn_metadesig_save' );

/*------------------------- Team Section-----------------------------*/
/* Adds a meta box for Designation */
function vw_startup_pro_posttype_bn_team_meta() {
    add_meta_box( 'vw_startup_pro_posttype_bn_meta', __( 'Enter Details','vw-startup-pro-posttype' ), 'vw_startup_pro_posttype_ex_bn_meta_callback', 'team', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_startup_pro_posttype_bn_team_meta');
}
/* Adds a meta box for custom post */
function vw_startup_pro_posttype_ex_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'vw_startup_pro_posttype_team_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );

    //Email details
    if(!empty($bn_stored_meta['vw-team-meta-desig'][0]))
      $bn_vw_team_meta_desig = $bn_stored_meta['vw-team-meta-desig'][0];
    else
      $bn_vw_team_meta_desig = '';

    //Phone details
    if(!empty($bn_stored_meta['vw-team-meta-call'][0]))
      $bn_vw_team_meta_call = $bn_stored_meta['vw-team-meta-call'][0];
    else
      $bn_vw_team_meta_call = '';

    //facebook details
    if(!empty($bn_stored_meta['vw-team-meta-facebookurl'][0]))
      $bn_vw_team_meta_facebookurl = $bn_stored_meta['vw-team-meta-facebookurl'][0];
    else
      $bn_vw_team_meta_facebookurl = '';

    //linkdenurl details
    if(!empty($bn_stored_meta['vw-team-meta-linkdenurl'][0]))
      $bn_vw_team_meta_linkdenurl = $bn_stored_meta['vw-team-meta-linkdenurl'][0];
    else
      $bn_vw_team_meta_linkdenurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['vw-team-meta-twitterurl'][0]))
      $bn_vw_team_meta_twitterurl = $bn_stored_meta['vw-team-meta-twitterurl'][0];
    else
      $bn_vw_team_meta_twitterurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['vw-team-meta-googleplusurl'][0]))
      $bn_vw_team_meta_googleplusurl = $bn_stored_meta['vw-team-meta-googleplusurl'][0];
    else
      $bn_vw_team_meta_googleplusurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['vw-team-meta-designation'][0]))
      $bn_vw_team_meta_designation = $bn_stored_meta['vw-team-meta-designation'][0];
    else
      $bn_vw_team_meta_designation = '';

    ?>
    <div id="agent_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                    <td class="left">
                        <?php esc_html_e( 'Email', 'vw-startup-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="vw-team-meta-desig" id="vw-team-meta-desig" value="<?php echo esc_attr($bn_vw_team_meta_desig); ?>" />
                    </td>
                </tr>
                <tr id="meta-2">
                    <td class="left">
                        <?php esc_html_e( 'Phone Number', 'vw-startup-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="vw-team-meta-call" id="vw-team-meta-call" value="<?php echo esc_attr($bn_vw_team_meta_call); ?>" />
                    </td>
                </tr>
                <tr id="meta-3">
                  <td class="left">
                    <?php esc_html_e( 'Facebook Url', 'vw-startup-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="vw-team-meta-facebookurl" id="vw-team-meta-facebookurl" value="<?php echo esc_url($bn_vw_team_meta_facebookurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-4">
                  <td class="left">
                    <?php esc_html_e( 'Linkedin URL', 'vw-startup-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="vw-team-meta-linkdenurl" id="vw-team-meta-linkdenurl" value="<?php echo esc_url($bn_vw_team_meta_linkdenurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-5">
                  <td class="left">
                    <?php esc_html_e( 'Twitter Url', 'vw-startup-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="vw-team-meta-twitterurl" id="vw-team-meta-twitterurl" value="<?php echo esc_url( $bn_vw_team_meta_twitterurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-6">
                  <td class="left">
                    <?php esc_html_e( 'GooglePlus URL', 'vw-startup-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="vw-team-meta-googleplusurl" id="vw-team-meta-googleplusurl" value="<?php echo esc_url($bn_vw_team_meta_googleplusurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-7">
                  <td class="left">
                    <?php esc_html_e( 'Designation', 'vw-startup-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="text" name="vw-team-meta-designation" id="vw-team-meta-designation" value="<?php echo esc_attr($bn_vw_team_meta_designation); ?>" />
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom Designation meta input */
function vw_startup_pro_posttype_ex_bn_metadesig_save( $post_id ) {
    if (!isset($_POST['vw_startup_pro_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['vw_startup_pro_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
      return;
    }

    if (!current_user_can('edit_post', $post_id)) {
      return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
    }
    if( isset( $_POST[ 'vw-team-meta-desig' ] ) ) {
        update_post_meta( $post_id, 'vw-team-meta-desig', sanitize_text_field($_POST[ 'vw-team-meta-desig' ]) );
    }
    if( isset( $_POST[ 'vw-team-meta-call' ] ) ) {
        update_post_meta( $post_id, 'vw-team-meta-call', sanitize_text_field($_POST[ 'vw-team-meta-call' ]) );
    }
    // Save facebookurl
    if( isset( $_POST[ 'vw-team-meta-facebookurl' ] ) ) {
        update_post_meta( $post_id, 'vw-team-meta-facebookurl', esc_url($_POST[ 'vw-team-meta-facebookurl' ]) );
    }
    // Save linkdenurl
    if( isset( $_POST[ 'vw-team-meta-linkdenurl' ] ) ) {
        update_post_meta( $post_id, 'vw-team-meta-linkdenurl', esc_url($_POST[ 'vw-team-meta-linkdenurl' ]) );
    }
    if( isset( $_POST[ 'vw-team-meta-twitterurl' ] ) ) {
        update_post_meta( $post_id, 'vw-team-meta-twitterurl', esc_url($_POST[ 'vw-team-meta-twitterurl' ]) );
    }
    // Save googleplusurl
    if( isset( $_POST[ 'vw-team-meta-googleplusurl' ] ) ) {
        update_post_meta( $post_id, 'vw-team-meta-googleplusurl', esc_url($_POST[ 'vw-team-meta-googleplusurl' ]) );
    }
    // Save designation
    if( isset( $_POST[ 'vw-team-meta-designation' ] ) ) {
        update_post_meta( $post_id, 'vw-team-meta-designation', sanitize_text_field($_POST[ 'vw-team-meta-designation' ]) );
    }
}
add_action( 'save_post', 'vw_startup_pro_posttype_ex_bn_metadesig_save' );

/*------------------------ Team Shortcode --------------------------*/
function vw_startup_pro_posttype_team_func( $atts ) {
    $team = ''; 
    $team = '<div class="row" id="team">';
      $new = new WP_Query( array( 'post_type' => 'team') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = vw_startup_pro_string_limit_words(get_the_excerpt(),15);
          $designation = get_post_meta($post_id,'meta-designation',true);
          $call = get_post_meta($post_id,'meta-call',true);
          $email = get_post_meta($post_id,'meta-desig',true);
          $facebookurl = get_post_meta($post_id,'meta-facebookurl',true);
          $linkedin = get_post_meta($post_id,'meta-linkdenurl',true);
          $twitter = get_post_meta($post_id,'meta-twitterurl',true);
          $googleplus = get_post_meta($post_id,'meta-googleplusurl',true);

          $team .= '<div class="team_shortcodes col-md-3 col-sm-6"> 
              <div class="team_wrap">';
                if (has_post_thumbnail()){
                  $team .= '<div class="teambox">';
                    $team.= '<img src="'.esc_url($url).'">
                    <div class="image-title">
                      <h4 class="teamtitle"><a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">'.get_the_title().'</a></h4>';
                      if(get_post_meta($post_id,'meta-designation',true)){
                      $team .= '<span>'.$designation.'</span>';
                      }
                    $team .= '</div>
                    <div class="teambox-content"> 
                      <h4 class="teamtitle"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
                      if(get_post_meta($post_id,'meta-designation',true)){
                      $team .= '<span>'.$designation.'</span>';
                      }
                      $team .= '<span class="teampost">'.$excerpt.'</span>
                      <div class="socialbox">';                       
                        if($facebookurl != '' || $linkedin != '' || $twitter != '' || $googleplus != ''){
                          if($facebookurl != ''){
                            $team .= '<a href="'.esc_url($facebookurl).'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                           } if($twitter != ''){
                            $team .= '<a href="'.esc_url($twitter).'" target="_blank"><i class="fab fa-twitter"></i></a>';                          
                           } if($linkedin != ''){
                           $team .= ' <a href="'.esc_url($linkedin).'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
                          }if($googleplus != ''){
                            $team .= '<a href="'.esc_url($googleplus).'" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
                          }
                        }
                      $team .= '</div>
                    </div>
                  </div>';    
                }     
              $team .= '</div>
            </div>';
            if($k%4 == 0){
            $team.= '<div class="clearfix"></div>'; 
          } 
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $team.= '</div>';
      else :
        $team = '<div id="team" class="team_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.esc_html__('Not Found','vw-startup-pro-posttype').'</h2></div>';
      endif;
    return $team;
}
add_shortcode( 'vw-startup-pro-team', 'vw_startup_pro_posttype_team_func' );

/*------------------- Testimonial Shortcode -------------------------*/
function vw_startup_pro_posttype_testimonials_func( $atts ) {
    $testimonial = ''; 
    $testimonial = '<div id="testimonials"><div class="row inner-test-bg">';
      $new = new WP_Query( array( 'post_type' => 'testimonials') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = vw_startup_pro_string_limit_words(get_the_excerpt(),20);
          $designation = get_post_meta($post_id,'vw_startup_pro_posttype_testimonial_desigstory',true);

          $testimonial .= '<div class="col-md-6 col-sm-12 ">
                <div class="testimonial_shortcode">
                  <div class="media">';
                    if (has_post_thumbnail()){
                      $testimonial .= '<img class="d-flex align-self-center mr-3" src="'.esc_url($url).'">';
                    }
                    $testimonial .= '<div class="media-body testimonial-box">
                      <h4 class="mt-0 testimonial_name"><a href="' . get_the_permalink(). '" rel="bookmark">'.get_the_title().'</a></h4>
                      <cite>'.esc_html($designation).'</cite>
                    </div>
                  </div>
                  <div class="testimonial_box w-100 mb-3" >
                    <div class="content_box w-100">
                      <div class="short_text pb-3"><blockquote>'.get_the_content().'</blockquote></div>
                    </div>
                  </div>
                </div></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $testimonial.= '</div></div>';
      else :
        $testimonial = '<div id="testimonial" class="testimonial_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','vw-startup-pro-posttype').'</h2></div>';
      endif;
    return $testimonial;
}
add_shortcode( 'vw-startup-pro-testimonials', 'vw_startup_pro_posttype_testimonials_func' );

/*------------------- Services Shortcode -------------------------*/
function vw_startup_pro_posttype_services_func( $atts ) {
    $services = ''; 
    $services = '<div id="services"><div class="row inner-test-bg">';
      $new = new WP_Query( array( 'post_type' => 'services') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = vw_startup_pro_string_limit_words(get_the_excerpt(),20);
          $services .= '<div class="col-md-3 vw_services mt-3 mb-3"> 
          <div class="service-box">';
            if (has_post_thumbnail()){
              $services.= '<div class="services-image">
                <img src="'.esc_url($url).'">
              </div>
              <div class="service-box-content">';

                  $custom_url = ''; $service_img='';
                  $services_icon = get_post_meta($post_id, 'vw-startup-pro-posttype-services-icon', true);

                  if(get_post_meta($post_id, 'vw-startup-pro-posttype-services-meta-image', true) !=''){ 
                    $service_img =  get_post_meta($post_id, 'vw-startup-pro-posttype-services-meta-image', true); 
                  }

                  if(get_post_meta($post_id, 'vw-startup-pro-posttype-services-url', true !='')){
                    $custom_url = get_post_meta($post_id, 'vw-startup-pro-posttype-services-url', true); 
                  }

                if($services_icon != '') {
                 $services.= '<i class="extra-icon '. esc_attr($services_icon).'"></i>';
                } else if($service_img != ''){
                  $services.= '<img class="pt-1" src="'.esc_url($service_img).'">';
                }
                $services.= '<h4 class="sread_more"><a href="' . get_the_permalink() . '" rel="bookmark"><i class="'. esc_html('fas fa-long-arrow-alt-right').'"></i>'.get_the_title().'</a></h4>';
              $services.= '</div>';
            }
          $services.= '</div>
        </div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $services.= '</div>';
      else :
        $services = '<div id="services" class="col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','vw-startup-pro-posttype').'</h2></div></div></div>';
      endif;
    return $services;
}
add_shortcode( 'vw-startup-pro-services', 'vw_startup_pro_posttype_services_func' );

/*---------------- Portfolio Shortcode ---------------------*/
function vw_startup_pro_posttype_portfolio_func( $atts ) {
    $portfolio = ''; 
    $portfolio = '<div class="row inner-test-bg portfolio_shortcode" id="portfolio">';
      $new = new WP_Query( array( 'post_type' => 'portfolio') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = vw_startup_pro_string_limit_words(get_the_excerpt(),10);
          $portfolio .= '<div class="col-md-4 col-sm-6"> 
          <div class="box">';
            if (has_post_thumbnail()){
              $portfolio .= '<div class="portfolio-image">
                <img src="'.esc_url($url).'">
              </div>
              <div class="box-content">
                <div class="box-search-icon"><a href="'.get_the_permalink().'"><i class="fa fa-search"></i></a></div>
                <h3 class="title"><a href="' . get_the_permalink() . '" rel="bookmark">'.get_the_title().'</a></h3>
                <span class="post">'.$excerpt.'</span>
                <ul class="icon">           
                  <li> 
                    <a class="theme_second_button" href="'.get_the_permalink().'">'.esc_html('Read More','vw-startup-pro').'</a>
                  </li>
                </ul>
              </div>';
            }                    
          $portfolio .= '</div>
        </div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $portfolio.= '</div>';
      else :
        $portfolio = '<div id="portfolio" class="col-md-3 mt-3 mb-4"><h2 class="center">'.esc_html__('Not Found','vw-startup-pro-posttype').'</h2></div></div>';
      endif;
    return $portfolio;
}
add_shortcode( 'vw-startup-pro-portfolio', 'vw_startup_pro_posttype_portfolio_func' );