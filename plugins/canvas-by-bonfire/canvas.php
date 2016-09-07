<?php
/*
Plugin Name: Canvas, by Bonfire 
Plugin URI: http://bonfirethemes.com/
Description: Display content in a dedicated, full screen slide-out (please find usage instructions in the included documentation).
Version: 2.0
Author: Bonfire Themes
Author URI: http://bonfirethemes.com/
License: GPL2
*/

//
	// CREATE THE SETTINGS PAGE (for WordPress backend, Settings > Canvas plugin)
	//
	
	/* create "Settings" link on plugins page */
	function bonfire_canvas_settings_link($links) { 
		$settings_link = '<a href="options-general.php?page=canvas-by-bonfire/canvas.php">Settings</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'bonfire_canvas_settings_link' );

	/* create the "Settings > Canvas plugin" menu item */
	function bonfire_canvas_admin_menu() {
		add_submenu_page('options-general.php', 'Canvas Plugin Settings', 'Canvas plugin', 'administrator', __FILE__, 'bonfire_canvas_page');
	}
	
	/* create the actual settings page */
	function bonfire_canvas_page() {
		if ( isset ($_POST['update_bonfire_canvas']) == 'true' ) { bonfire_canvas_update(); }
	?>

		<div class="wrap">
			<h2>Canvas, by Bonfire</h2>
			<strong>Psst!</strong> Canvas's color options can be changed under <strong>Appearance > Customize > Canvas plugin colors</strong><br><br>

			<form method="POST" action="">
				<input type="hidden" name="update_bonfire_canvas" value="true" />

				<hr>
				
				<!-- BEGIN SLIDE-IN DIRECTION -->
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Slide-in direction</th>
					<td>
					<?php $canvas_slidein_direction = get_option('bonfire_canvas_slidein_direction'); ?>
					<label><input value="canvasslideintop" type="radio" name="canvas_slidein_direction" <?php if ($canvas_slidein_direction=='canvasslideintop') { echo 'checked'; } ?>> Top</label><br>
					<label><input value="canvasslideinleft" type="radio" name="canvas_slidein_direction" <?php if ($canvas_slidein_direction=='canvasslideinleft') { echo 'checked'; } ?>> Left</label><br>
					<label><input value="canvasslideinright" type="radio" name="canvas_slidein_direction" <?php if ($canvas_slidein_direction=='canvasslideinright') { echo 'checked'; } ?>> Right</label><br>
					<label><input value="canvasslideinbottom" type="radio" name="canvas_slidein_direction" <?php if ($canvas_slidein_direction=='canvasslideinbottom') { echo 'checked'; } ?>> Bottom</label><br>
					</td>
					</tr>
				</table>
				<!-- END SLIDE-IN DIRECTION -->

				<hr>

				<!-- BEGIN CANVAS BUTTON POSITION -->
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Canvas button align</th>
					<td>
					<?php $canvas_button_position = get_option('bonfire_canvas_button_position'); ?>
					<label><input value="canvastopleft" type="radio" name="canvas_button_position" <?php if ($canvas_button_position=='canvastopleft') { echo 'checked'; } ?>> Top-left</label><br>
					<label><input value="canvastopright" type="radio" name="canvas_button_position" <?php if ($canvas_button_position=='canvastopright') { echo 'checked'; } ?>> Top-right</label><br>
					<label><input value="canvasbottomleft" type="radio" name="canvas_button_position" <?php if ($canvas_button_position=='canvasbottomleft') { echo 'checked'; } ?>> Bottom-left</label><br>
					<label><input value="canvasbottomright" type="radio" name="canvas_button_position" <?php if ($canvas_button_position=='canvasbottomright') { echo 'checked'; } ?>> Bottom-right</label><br>
					</td>
					</tr>
				</table>
				<!-- END CANVAS BUTTON POSITION -->

				<hr>

				<!-- BEGIN CUSTOM ICON -->
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Custom button icon:</th>
					<td>
					<input type="text" name="canvas_custom_icon" id="canvas_custom_icon" value="<?php echo get_option('bonfire_canvas_custom_icon'); ?>"/> If left empty, defaults to <strong>fa-cogs</strong>
					<br><br>To customize the Canvas button icon, enter a new icon name into the field above.
					<br><br>You can pick and choose from over 350 icons here: <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/cheatsheet/">http://fortawesome.github.io/Font-Awesome/cheatsheet/</a> (the icon names are <strong>fa-angle-up</strong>, <strong>fa-anchor</strong> etc.).
					<br><br>If the field is left empty, the default icon will be used.
					</td>
					</tr>
				</table>
				<!-- END CUSTOM ICON -->
					
				<hr>

				<!-- BEGIN CANVAS BUTTON VISIBILITY -->
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Canvas button visibility</th>
					<td><label><input type="checkbox" name="canvas_button_visibility" id="canvas_button_visibility" <?php echo get_option('bonfire_canvas_button_visibility'); ?> /> When the Canvas slide is activated, the Canvas button is hidden behind it (if unchecked, the button will be visible over the slide).</label></td>
					</tr>
				</table>
				<!-- END CANVAS BUTTON VISIBILITY -->

				<hr>
				
				<!-- BEGIN HIDE CANVAS BUTTON -->
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Hide Canvas button</th>
					<td><label><input type="checkbox" name="canvas_button_hide" id="canvas_button_hide" <?php echo get_option('bonfire_canvas_button_hide'); ?> /> Hide Canvas button entirely. Useful in cases where you'd like to activate the slide via another element (just give said element the "canvas-text-trigger" class).</label></td>
					</tr>
				</table>
				<!-- END HIDE CANVAS BUTTON -->

				<hr>

				<!-- BEGIN CLOSE BUTTON TOGGLE -->
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Hide close button?</th>
					<td><label><input type="checkbox" name="canvas_hide_close_button" id="canvas_hide_close_button" <?php echo get_option('bonfire_canvas_hide_close_button'); ?> /> Hide the close button inside the Canvas slide.</label></td>
					</tr>
				</table>
				<!-- END CLOSE BUTTON TOGGLE -->

				<hr>
				
				<!-- BEGIN 'SAVE OPTIONS' BUTTON -->	
				<p><input type="submit" name="search" value="Save Options" class="button button-primary" /></p>
				<!-- BEGIN 'SAVE OPTIONS' BUTTON -->	

			</form>

		</div>
	<?php }
	function bonfire_canvas_update() {

		/* canvas slide-in direction */
		if ( isset ($_POST['canvas_button_position']) == 'true' ) {
			update_option('bonfire_canvas_button_position', $_POST['canvas_button_position']);
		}

		/* canvas button position */
		if ( isset ($_POST['canvas_slidein_direction']) == 'true' ) {
			update_option('bonfire_canvas_slidein_direction', $_POST['canvas_slidein_direction']);
		}
		
		/* custom canvas button menu */
		update_option('bonfire_canvas_custom_icon',   $_POST['canvas_custom_icon']);

		/* canvas button visibility */
		if ( isset ($_POST['canvas_button_visibility'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_canvas_button_visibility', $display);
		
		/* hide canvas button */
		if ( isset ($_POST['canvas_button_hide'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_canvas_button_hide', $display);
		
		/* close button toggle */
		if ( isset ($_POST['canvas_hide_close_button'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_canvas_hide_close_button', $display);

	}
	add_action('admin_menu', 'bonfire_canvas_admin_menu');
	?>
<?php

	//
	// Insert the button + slideout content into the header
	//
	
	function bonfire_canvas_footer() {
	?>
	
		<!-- BEGIN SLIDEOUT BUTTON -->
		<a href="#" class="bonfire-slideout-button<?php if(get_option('bonfire_canvas_button_position') == "canvastopleft") { ?>-top-left<?php } elseif(get_option('bonfire_canvas_button_position') == "canvastopright") { ?>-top-right<?php } elseif(get_option('bonfire_canvas_button_position') == "canvasbottomleft") { ?>-bottom-left<?php } ?>">
			<!-- BEGIN ICON --><i class="fa <?php if( get_option('bonfire_canvas_custom_icon') ) { ?><?php echo get_option('bonfire_canvas_custom_icon'); ?><?php } else { ?>fa-cogs<?php } ?>"></i><!-- END ICON -->
		</a>
		<div class="bonfire-slideout-button-triangle-background<?php if(get_option('bonfire_canvas_button_position') == "canvastopleft") { ?>-top-left<?php } elseif(get_option('bonfire_canvas_button_position') == "canvastopright") { ?>-top-right<?php } elseif(get_option('bonfire_canvas_button_position') == "canvasbottomleft") { ?>-bottom-left<?php } ?>"></div>
		<!-- END SLIDEOUT BUTTON -->
		
		<!-- BEGIN THE SLIDEOUT -->
		<div class="bonfire-slideout
		
<?php if(get_option('bonfire_canvas_slidein_direction') == "canvasslideintop") { ?>
 bonfire-slideout-top
<?php } elseif(get_option('bonfire_canvas_slidein_direction') == "canvasslideinleft") { ?>
 bonfire-slideout-left
<?php } elseif(get_option('bonfire_canvas_slidein_direction') == "canvasslideinright") { ?>
 bonfire-slideout-right
<?php } ?>

">
			<div class="bonfire-slideout-inner">
				<div class="bonfire-slideout-inner-inner">

					<?php if( get_option('bonfire_canvas_hide_close_button') ) { ?><?php } else { ?>
					<div class="bonfire-slideout-close"></div>
					<?php } ?>

					<!-- BEGIN LOADING PAGE -->
					<?php $my_query = new WP_Query('pagename=canvas-by-bonfire'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					<?php global $post; $do_not_duplicate = $post->ID; ?>
						<!-- BEGIN CONTENT -->
						<div class="entry-content bonfire-slideout-content">
							<?php the_content(); ?>
							
								<!-- BEGIN WIDGETS -->
								<div class="canvas-widgets-wrapper">
									<div class="canvas-widgets-wrapper-inner">
										<!-- BEGIN FULL WIDTH WIDGETS --><div class="canvas-widgets-1-column clear"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Canvas Widgets (full width)') ) : ?><?php endif; ?></div><!-- END FULL WIDTH WIDGETS -->
										<!-- BEGIN 2-COLUMN WIDGETS --><div class="canvas-widgets-2-columns clear"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Canvas Widgets (2 columns)') ) : ?><?php endif; ?></div><!-- END 2-COLUMN WIDGETS -->
										<!-- BEGIN 3-COLUMN WIDGETS --><div class="canvas-widgets-3-columns clear"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Canvas Widgets (3 columns)') ) : ?><?php endif; ?></div><!-- END 3-COLUMN WIDGETS -->
									</div>
								</div>
								<!-- END WIDGETS -->
					
						</div>
						<!-- END CONTENT -->
					<?php endwhile; ?>
					<!-- END LOADING PAGE -->

					<!-- BEGIN EDIT POST LINK -->
					<?php edit_post_link('EDIT'); ?>
					<!-- END EDIT POST LINK -->

				</div>
			</div>
		</div>
		<!-- END THE SLIDEOUT -->
	
	<?php
	}
	add_action('wp_footer','bonfire_canvas_footer');


	//
	// ENQUEUE canvas.css
	//

	function bonfire_canvas_css()
	{
		wp_register_style( 'bonfire-canvas-css', plugins_url( '/canvas.css', __FILE__ ) . '', array(), '1', 'all' );
		wp_enqueue_style( 'bonfire-canvas-css' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_canvas_css' );
	
	//
	// ENQUEUE canvas-desktop.css & canvas-mobile.css
	//

	function bonfire_canvas_slide_css() {
		if ( wp_is_mobile() ) {
			wp_register_style( 'bonfire-canvas-slide-css', plugins_url( '/canvas-mobile.css', __FILE__ ) . '', array(), '1', 'all' );
		} else {
			wp_register_style( 'bonfire-canvas-slide-css', plugins_url( '/canvas-desktop.css', __FILE__ ) . '', array(), '1', 'all' );
		}
		wp_enqueue_style( 'bonfire-canvas-slide-css' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_canvas_slide_css' );

	//
	// ENQUEUE canvas.js
	//
	
	function bonfire_canvas_js() {  
		wp_register_script( 'bonfire-canvas-js', plugins_url( '/canvas.js', __FILE__ ) . '', array( 'jquery' ), '1', true );  
		wp_enqueue_script( 'bonfire-canvas-js' );  
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_canvas_js' );


	//
	// ENQUEUE font-awesome.min.css (icons for menu)
	//
	
	function bonfire_canvas_fontawesome() {  
		wp_register_style( 'canvas-fontawesome', plugins_url( '/fonts/font-awesome/css/font-awesome.min.css', __FILE__ ) . '', array(), '1', 'all' );  

		wp_enqueue_style( 'canvas-fontawesome' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_canvas_fontawesome' );


	//
	// Add color options to Appearance > Themes > Customize
	//
	add_action( 'customize_register', 'bonfire_canvas_customize_register' );
	function bonfire_canvas_customize_register($wp_customize)
	{
		$colors = array();
		$colors[] = array( 'slug'=>'bonfire_canvas_button_icon_hover_color', 'default' => '', 'label' => __( 'Canvas button icon hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_canvas_button_icon_color', 'default' => '', 'label' => __( 'Canvas button icon', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_canvas_button_background_color', 'default' => '', 'label' => __( 'Canvas button background (triangle)', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_canvas_slide_background_color', 'default' => '', 'label' => __( 'Canvas full-screen background', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_canvas_text_color', 'default' => '', 'label' => __( 'Canvas text color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_canvas_link_color', 'default' => '', 'label' => __( 'Canvas link color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_canvas_link_hover_color', 'default' => '', 'label' => __( 'Canvas link hover color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_canvas_widget_title_color', 'default' => '', 'label' => __( 'Canvas widget title color', 'bonfire' ) );
	
	foreach($colors as $color)
	{

	/* create custom color customization section */
	$wp_customize->add_section( 'canvas_plugin_colors' , array( 'title' => __('Canvas plugin colors', 'bonfire'), 'priority' => 30 ));
	$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'canvas_plugin_colors', 'settings' => $color['slug'] )));
	}
	}


	//
	// Insert theme customizer options into the header
	//
	
	function bonfire_canvas_header() {
	?>

		<!-- BEGIN CUSTOM COLORS (WP THEME CUSTOMIZER) -->
		<?php $bonfire_canvas_button_icon_color = get_option('bonfire_canvas_button_icon_color'); ?>
		<?php $bonfire_canvas_button_icon_hover_color = get_option('bonfire_canvas_button_icon_hover_color'); ?>
		<?php $bonfire_canvas_button_background_color = get_option('bonfire_canvas_button_background_color'); ?>
		<?php $bonfire_canvas_slide_background_color = get_option('bonfire_canvas_slide_background_color'); ?>
		<?php $bonfire_canvas_text_color = get_option('bonfire_canvas_text_color'); ?>
		<?php $bonfire_canvas_link_color = get_option('bonfire_canvas_link_color'); ?>
		<?php $bonfire_canvas_link_hover_color = get_option('bonfire_canvas_link_hover_color'); ?>
		<?php $bonfire_canvas_widget_title_color = get_option('bonfire_canvas_widget_title_color'); ?>

		<style>
		/* triangle button icon color */
		.bonfire-slideout-button,
		.bonfire-slideout-button-top-left,
		.bonfire-slideout-button-top-right,
		.bonfire-slideout-button-bottom-left { color:<?php echo $bonfire_canvas_button_icon_color; ?>; }
		/* triangle button icon hover color */
		.bonfire-slideout-button:hover,
		.bonfire-slideout-button-top-left:hover,
		.bonfire-slideout-button-top-right:hover,
		.bonfire-slideout-button-bottom-left:hover { color:<?php echo $bonfire_canvas_button_icon_hover_color; ?>; }
		/* triangle button background */
		.bonfire-slideout-button-triangle-background { border-bottom-color:<?php echo $bonfire_canvas_button_background_color; ?>; }
		.bonfire-slideout-button-triangle-background-top-left { border-top-color:<?php echo $bonfire_canvas_button_background_color; ?>; }
		.bonfire-slideout-button-triangle-background-top-right { border-top-color:<?php echo $bonfire_canvas_button_background_color; ?>; }
		.bonfire-slideout-button-triangle-background-bottom-left { border-bottom-color:<?php echo $bonfire_canvas_button_background_color; ?>; }
		/* canvas background color */
		.bonfire-slideout { background-color:<?php echo $bonfire_canvas_slide_background_color; ?>; }
		/* text color */
		.bonfire-slideout-content, .bonfire-slideout-content p, .canvas-widgets-1-column .widget, .canvas-widgets-2-columns .widget, .canvas-widgets-3-columns .widget { color:<?php echo $bonfire_canvas_text_color; ?>; }
		/* link color */
		.bonfire-slideout-content a, .bonfire-slideout-content p a, .canvas-widgets-1-column .widget a, .canvas-widgets-2-columns .widget a, .canvas-widgets-3-columns .widget a { color:<?php echo $bonfire_canvas_link_color; ?>; }
		/* link hover color */
		.bonfire-slideout-content a:hover, .bonfire-slideout-content p a:hover, .canvas-widgets-1-column .widget a:hover, .canvas-widgets-2-columns .widget a:hover, .canvas-widgets-3-columns .widget a:hover { color:<?php echo $bonfire_canvas_link_hover_color; ?>; }
		/* widget title color */
		.canvas-widgets-1-column .widget .widgettitle, .canvas-widgets-2-columns .widget .widgettitle, .canvas-widgets-3-columns .widget  .widgettitle { color:<?php echo $bonfire_canvas_widget_title_color; ?>; }
		/* canvas button visibility */
		<?php if( get_option('bonfire_canvas_button_visibility') ) { ?>
		.bonfire-slideout { z-index:99999999; }
		<?php } ?>
		/* hide canvas button visibility */
		<?php if( get_option('bonfire_canvas_button_hide') ) { ?>
		.bonfire-slideout-button,
		.bonfire-slideout-button-top-left,
		.bonfire-slideout-button-top-right,
		.bonfire-slideout-button-bottom-left,
		.bonfire-slideout-button-triangle-background,
		.bonfire-slideout-button-triangle-background-top-left,
		.bonfire-slideout-button-triangle-background-top-right,
		.bonfire-slideout-button-triangle-background-bottom-left { display:none; }
		<?php } ?>
		</style>
		<!-- END CUSTOM COLORS (WP THEME CUSTOMIZER) -->
	
	<?php
	}
	add_action('wp_head','bonfire_canvas_header');


	//
	// Register Widgets
	//

	if ( function_exists('register_sidebar') ) {
	
		register_sidebar( array(
		'name' => __( 'Canvas Widgets (full width)', 'bonfire' ),
		'id' => 'canvas-widgets-full',
		'description' => __( 'Drag widgets here', 'bonfire' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));
		
		register_sidebar( array(
		'name' => __( 'Canvas Widgets (2 columns)', 'bonfire' ),
		'id' => 'canvas-widgets-2-columns',
		'description' => __( 'Drag widgets here', 'bonfire' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));
		
		register_sidebar( array(
		'name' => __( 'Canvas Widgets (3 columns)', 'bonfire' ),
		'id' => 'canvas-widgets-3-columns',
		'description' => __( 'Drag widgets here', 'bonfire' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));

	}

?>