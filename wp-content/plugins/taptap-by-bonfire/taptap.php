<?php
/*
Plugin Name: TapTap, by Bonfire 
Plugin URI: http://bonfirethemes.com/
Description: A mobile menu for WordPress. Customize under Settings > TapTap plugin. Customize colors under Appearance > Customize > TapTap Plugin Colors.
Version: 1.7
Author: Bonfire Themes
Author URI: http://bonfirethemes.com/
License: GPL2
*/


	//
	// CREATE THE SETTINGS PAGE (for WordPress backend, Settings > TapTap plugin)
	//
	
	/* create "Settings" link on plugins page */
	function bonfire_taptap_settings_link($links) { 
		$settings_link = '<a href="options-general.php?page=taptap-by-bonfire/taptap.php">Settings</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'bonfire_taptap_settings_link' );

	/* create the "Settings > TapTap plugin" menu item */
	function bonfire_taptap_admin_menu() {
		add_submenu_page('options-general.php', 'TapTap Plugin Settings', 'TapTap plugin', 'administrator', __FILE__, 'bonfire_taptap_page');
	}
	
	/* create the actual settings page */
	function bonfire_taptap_page() {
		if ( isset ($_POST['update_bonfire_taptap']) == 'true' ) { bonfire_taptap_update(); }
	?>

		<div class="wrap">
			<br>
			<h2>TapTap, by Bonfire</h2>
			<strong>Psst!</strong> TapTap's color options can be changed under <strong>Appearance > Customize > TapTap Plugin Colors</strong>

			<br>
			<br>
			<strong>Jump to:</strong>
			<a href="#alignment">Alignment</a> | 
			<a href="#animations">Animations</a> | 
			<a href="#menu-button-logo-search">Menu button, logo, search</a> | 
			<a href="#heading">Heading</a> | 
			<a href="#subheading">Subheading</a> | 
			<a href="#image">Image</a> | 
			<a href="#menu-submenu">Menu & submenu</a> | 
			<a href="#menu-description">Menu description</a> | 
			<a href="#menu-icons">Menu icons</a> | 
			<a href="#background">Background</a> | 
			<a href="#hide-at-certain-width-resolution">Hide at certain width/resolution</a>

			<form method="POST" action="">
				<input type="hidden" name="update_bonfire_taptap" value="true" />

				<br><hr><br>

				<!-- BEGIN ALIGNMENT -->
				<div id="alignment"></div>
				<br>
				<br>
				<h2>Alignment</h2>
				<table class="form-table">
					<!-- BEGIN HORIZONTAL ALIGNMENT -->
					<tr valign="top">
					<th scope="row">Horizontal alignment:</th>
					<td>
					<?php $taptap_horizontal_alignment = get_option('bonfire_taptap_horizontal_alignment'); ?>
					<label><input value="taptapalignleft" type="radio" name="taptap_horizontal_alignment" <?php if ($taptap_horizontal_alignment=='taptapalignleft') { echo 'checked'; } ?>> Left</label><br>
					<label><input value="taptapaligncenter" type="radio" name="taptap_horizontal_alignment" <?php if ($taptap_horizontal_alignment=='taptapaligncenter') { echo 'checked'; } ?>> Center</label><br>
					<label><input value="taptapalignright" type="radio" name="taptap_horizontal_alignment" <?php if ($taptap_horizontal_alignment=='taptapalignright') { echo 'checked'; } ?>> Right</label><br>
					</td>
					</tr>
					<!-- END HORIZONTAL ALIGNMENT -->
					
					<!-- BEGIN VERTICAL ALIGNMENT -->
					<tr valign="top">
					<th scope="row">Vertical alignment:</th>
					<td>
					<?php $taptap_vertical_alignment = get_option('bonfire_taptap_vertical_alignment'); ?>
					<label><input value="taptapaligntop" type="radio" name="taptap_vertical_alignment" <?php if ($taptap_vertical_alignment=='taptapaligntop') { echo 'checked'; } ?>> Top</label><br>
					<label><input value="taptapalignmiddle" type="radio" name="taptap_vertical_alignment" <?php if ($taptap_vertical_alignment=='taptapalignmiddle') { echo 'checked'; } ?>> Middle</label><br>
					<label><input value="taptapalignbottom" type="radio" name="taptap_vertical_alignment" <?php if ($taptap_vertical_alignment=='taptapalignbottom') { echo 'checked'; } ?>> Bottom</label><br>
					</td>
					</tr>
					<!-- END VERTICAL ALIGNMENT -->
				</table>
				<!-- END ALIGNMENT -->
				
				<br><hr><br>

				<!-- BEGIN ANIMATIONS -->
				<div id="animations"></div>
				<br>
				<br>
				<h2>Animations</h2>
				<table class="form-table">
					<!-- BEGIN BUTTON ANIMATION -->
					<tr valign="top">

					<th scope="row">Menu button animation:</th>
					<td>
					<?php $taptap_button_animation = get_option('bonfire_taptap_button_animation'); ?>
					<label><input value="taptapnoanimation" type="radio" name="taptap_button_animation" <?php if ($taptap_button_animation=='taptapnoanimation') { echo 'checked'; } ?>> No animation</label><br>
					<label><input value="taptapminusanimation" type="radio" name="taptap_button_animation" <?php if ($taptap_button_animation=='taptapminusanimation') { echo 'checked'; } ?>> Minus sign</label><br>
					<label><input value="taptapxanimation" type="radio" name="taptap_button_animation" <?php if ($taptap_button_animation=='taptapxanimation') { echo 'checked'; } ?>> X sign</label><br>
					</td>
					</tr>
					<!-- END BUTTON ANIMATION -->
					
					<!-- BEGIN BACKGOUND ANIMATION -->
					<tr valign="top">
					<th scope="row">Fade/slide-in direction:</th>
					<td>
					<?php $taptap_menu_animation = get_option('bonfire_taptap_menu_animation'); ?>
					<label><input value="taptaptop" type="radio" name="taptap_menu_animation" <?php if ($taptap_menu_animation=='taptaptop') { echo 'checked'; } ?>> Top</label><br>
					<label><input value="taptapleft" type="radio" name="taptap_menu_animation" <?php if ($taptap_menu_animation=='taptapleft') { echo 'checked'; } ?>> Left</label><br>
					<label><input value="taptapright" type="radio" name="taptap_menu_animation" <?php if ($taptap_menu_animation=='taptapright') { echo 'checked'; } ?>> Right</label><br>
					<label><input value="taptapbottom" type="radio" name="taptap_menu_animation" <?php if ($taptap_menu_animation=='taptapbottom') { echo 'checked'; } ?>> Bottom</label><br>
					<label><input value="taptapfade" type="radio" name="taptap_menu_animation" <?php if ($taptap_menu_animation=='taptapfade') { echo 'checked'; } ?>> Fade</label><br>
					</td>
					</tr>
					<!-- END BACKGOUND ANIMATION -->
				</table>
				<!-- END ANIMATIONS -->

				<br><hr><br>

				<!-- BEGIN POSITIONING OPTIONS -->
				<div id="menu-button-logo-search"></div>
				<br>
				<br>
				<h2>Menu button, logo, search</h2>
				<table class="form-table">
					<!-- BEGIN MENU BUTTON STYLE -->
					<tr valign="top">
					<th scope="row">Menu button style:</th>
					<td>
					<?php $taptap_menu_button_style = get_option('bonfire_taptap_menu_button_style'); ?>
					<label><input value="taptapfourlines" type="radio" name="taptap_menu_button_style" <?php if ($taptap_menu_button_style=='taptapfourlines') { echo 'checked'; } ?>> 4 lines (default)</label><br>
					<label><input value="taptapthreelines" type="radio" name="taptap_menu_button_style" <?php if ($taptap_menu_button_style=='taptapthreelines') { echo 'checked'; } ?>> 3 lines (traditional hamburger menu)</label><br>
					</td>
					</tr>
					<!-- END MENU BUTTON STYLE -->
					
					<!-- BEGIN ABSOLUTE POSITIONING -->
					<tr valign="top">
					<th scope="row">Absolute/fixed positioning:</th>
					<td>
					<label><input type="checkbox" name="taptap_absolute_position" id="taptap_absolute_position" <?php echo get_option('bonfire_taptap_absolute_position'); ?> /> Absolute positioning (menu, search buttons and logo leave the screen when scrolled).
					<br>If unticked, they'll have fixed positioning and will remain at the top at all times.</label><br>
					</td>
					</tr>
					<!-- END ABSOLUTE POSITIONING -->
					
					<!-- BEGIN LEFT/RIGHT POSITIONING -->
					<tr valign="top">
					<th scope="row">Left/right positioning:</th>
					<td>
					<label><input type="checkbox" name="taptap_left_right" id="taptap_left_right" <?php echo get_option('bonfire_taptap_left_right'); ?> /> Swap menu, search buttons/logo locations (logo and search left, menu button right).
					<br>If unchecked, menu and search buttons will appear on left side and logo on the right.</label><br>
					</td>
					</tr>
					<!-- END LEFT/RIGHT POSITIONING -->
					
					<!-- BEGIN MENU BUTTON OPACITY -->
					<tr valign="top">
					<th scope="row">Menu button opacity:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_button_opacity" id="taptap_menu_button_opacity" value="<?php echo get_option('bonfire_taptap_menu_button_opacity'); ?>"/>
					<br> Enter custom menu button opacity. From 0-1 (example: 0.5) If left empty, defaults to 1
					</td>
					</tr>
					<!-- END MENU BUTTON OPACITY -->
					
					<!-- BEGIN HIDE LOGO -->
					<tr valign="top">
					<th scope="row">Hide logo?:</th>
					<td>
					<label><input type="checkbox" name="taptap_hide_logo" id="taptap_hide_logo" <?php echo get_option('bonfire_taptap_hide_logo'); ?> /> Don't show logo.
					<br>If unchecked, logo will be shown (To use an image logo, head to Appearance > Customize > TapTap Plugin Logo).</label><br>
					</td>
					</tr>
					<!-- END HIDE LOGO -->
					
					<!-- BEGIN HIDE SEARCH + SEARCH DIVIDER -->
					<tr valign="top">
					<th scope="row">Hide search?:</th>
					<td>
					<label><input type="checkbox" name="taptap_hide_search" id="taptap_hide_search" <?php echo get_option('bonfire_taptap_hide_search'); ?> /> Don't show search.</label><br>
					</td>
					</tr>
					<!-- END HIDE SEARCH + SEARCH DIVIDER -->
					
					<!-- BEGIN HIDE SEARCH DIVIDER ONLY -->
					<tr valign="top">
					<th scope="row">Hide search button divider?:</th>
					<td>
					<label><input type="checkbox" name="taptap_hide_search_divider" id="taptap_hide_search_divider" <?php echo get_option('bonfire_taptap_hide_search_divider'); ?> /> Don't show the search button divider.</label><br>
					</td>
					</tr>
					<!-- END HIDE SEARCH DIVIDER ONLY -->
					
					<!-- BEGIN SHOW HEADER -->
					<tr valign="top">
					<th scope="row">Show header background?:</th>
					<td>
					<label><input type="checkbox" name="taptap_show_header" id="taptap_show_header" <?php echo get_option('bonfire_taptap_show_header'); ?> /> Show header background behind menu/search buttons and the logo.</label><br>
					</td>
					</tr>
					<!-- END SHOW HEADER -->
					
					<!-- BEGIN HEADER BACKGROUND OPACITY -->
					<tr valign="top">
					<th scope="row">Header background opacity:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_header_background_opacity" id="taptap_header_background_opacity" value="<?php echo get_option('bonfire_taptap_header_background_opacity'); ?>"/>
					<br> Enter custom header background opacity (if header background enabled). From 0-1 (example: 0.5) If left empty, defaults to 1
					</td>
					</tr>
					<!-- END HEADER BACKGROUND OPACITY -->
					
					<!-- BEGIN SHOW HEADER -->
					<tr valign="top">
					<th scope="row">Push down site?:</th>
					<td>
					<label><input type="checkbox" name="taptap_site_top" id="taptap_site_top" <?php echo get_option('bonfire_taptap_site_top'); ?> /> Push down your site by height of TapTap menu.
					<br>If unchecked, the TapTap menu button, logo and header background will overlap your theme.</label><br>
					</td>
					</tr>
					<!-- END SHOW HEADER -->
				</table>
				<!-- END POSITIONING OPTIONS -->
				
				<br><hr><br>
				
				<!-- BEGIN HEADING -->
				<div id="heading"></div>
				<br>
				<br>
				<h2>Heading</h2>
				<table class="form-table">
					<!-- BEGIN HEADING -->
					<tr valign="top">
					<th scope="row">Heading text:</th>
					<td>
					<input style="width:100%;height:35px;" type="text" name="taptap_heading" id="taptap_heading" value="<?php echo stripslashes(get_option('bonfire_taptap_heading')); ?>"/>
					</td>
					</tr>
					<!-- END HEADING -->
					
					<!-- BEGIN HEADING LINK -->
					<tr valign="top">
					<th scope="row">Heading link:</th>
					<td>
					<input style="width:100%;height:35px;" type="text" name="taptap_heading_link" id="taptap_heading_link" value="<?php echo stripslashes(get_option('bonfire_taptap_heading_link')); ?>"/>
					</td>
					</tr>
					<!-- END HEADING LINK -->

					<!-- BEGIN HEADING FONT SIZE -->
					<tr valign="top">
					<th scope="row">Heading font size:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_heading_font_size" id="taptap_heading_font_size" value="<?php echo get_option('bonfire_taptap_heading_font_size'); ?>"/> px. Enter custom font size for heading. If left empty, defaults to 14px
					</td>
					</tr>
					<!-- END HEADING FONT SIZE -->
					
					<!-- BEGIN HEADING LETTER SPACING -->
					<tr valign="top">
					<th scope="row">Heading letter spacing:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_heading_letter_spacing" id="taptap_heading_letter_spacing" value="<?php echo get_option('bonfire_taptap_heading_letter_spacing'); ?>"/> px. Enter custom letter spacing for heading. If left empty, defaults to 0px
					</td>
					</tr>
					<!-- END HEADING LETTER SPACING -->
					
					<!-- BEGIN HEADING LINE HEIGHT -->
					<tr valign="top">
					<th scope="row">Heading line height:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_heading_line_height" id="taptap_heading_line_height" value="<?php echo get_option('bonfire_taptap_heading_line_height'); ?>"/> px. Enter custom line height for heading. Useful if your heading text spans multiple lines.
					</td>
					</tr>
					<!-- END HEADING LINE HEIGHT -->
					
					<!-- BEGIN HEADING FONT -->
					<tr valign="top">
					<th scope="row">Heading font:</th>
					<td>
					<?php $taptap_heading_font = get_option('bonfire_taptap_heading_font'); ?>
					<label><input value="taptapheadingmontserrat" type="radio" name="taptap_heading_font" <?php if ($taptap_heading_font=='taptapheadingmontserrat') { echo 'checked'; } ?>> Montserrat (regular)</label><br>
					<label><input value="taptapheadingmontserratbold" type="radio" name="taptap_heading_font" <?php if ($taptap_heading_font=='taptapheadingmontserratbold') { echo 'checked'; } ?>> Montserrat (bold)</label><br>
					<label><input value="taptapheadingroboto" type="radio" name="taptap_heading_font" <?php if ($taptap_heading_font=='taptapheadingroboto') { echo 'checked'; } ?>> Roboto</label><br>
					<label><input value="taptapheadingrobotocondensedregular" type="radio" name="taptap_heading_font" <?php if ($taptap_heading_font=='taptapheadingrobotocondensedregular') { echo 'checked'; } ?>> Roboto Condensed (regular)</label><br>
					<label><input value="taptapheadingrobotocondensedbold" type="radio" name="taptap_heading_font" <?php if ($taptap_heading_font=='taptapheadingrobotocondensedbold') { echo 'checked'; } ?>> Roboto Condensed (bold)</label><br>
					<label><input value="taptapheadingbreeserif" type="radio" name="taptap_heading_font" <?php if ($taptap_heading_font=='taptapheadingbreeserif') { echo 'checked'; } ?>> Bree Serif</label><br>
					<label><input value="taptapheadingdroidserif" type="radio" name="taptap_heading_font" <?php if ($taptap_heading_font=='taptapheadingdroidserif') { echo 'checked'; } ?>> Droid Serif</label><br>
					<br><strong>Advanced font feature:</strong><br>
					<input style="width:100%;height:35px;" type="text" name="taptap_heading_theme_font" id="taptap_heading_theme_font" value="<?php echo stripslashes(get_option('bonfire_taptap_heading_theme_font')); ?>"/> If you know the name of and would like to use one of your theme's fonts, enter it in the textfield above as it appears in the theme's stylesheet (font selection will be automatically overriden)
					</td>
					</tr>
					<!-- END HEADING FONT -->
				</table>
				<!-- END HEADING -->
				
				<br><hr><br>
				
				<table class="form-table">
					<!-- BEGIN DISTANCE BETWEEN HEADING/SUBHEADING -->
					<tr valign="top">
					<th scope="row">Distance between heading and subheading:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_heading_subheading_distance" id="taptap_heading_subheading_distance" value="<?php echo get_option('bonfire_taptap_heading_subheading_distance'); ?>"/> px. Enter custom spacing for heading/subheading.
					</td>
					</tr>
					<!-- END DISTANCE BETWEEN HEADING/SUBHEADING -->
				</table>
				
				<br><hr><br>
				
				<!-- BEGIN SUBHEADING -->
				<div id="subheading"></div>
				<br>
				<br>
				<h2>Subheading</h2>
				<table class="form-table">
					<!-- BEGIN SUBHEADING -->
					<tr valign="top">
					<th scope="row">Subheading text:</th>
					<td>
					<input style="width:100%;" type="text" name="taptap_subheading" id="taptap_subheading" value="<?php echo stripslashes(get_option('bonfire_taptap_subheading')); ?>"/>
					</td>
					</tr>
					<!-- END SUBHEADING -->
					
					<!-- BEGIN SUBHEADING LINK -->
					<tr valign="top">
					<th scope="row">Subheading link:</th>
					<td>
					<input style="width:100%;" type="text" name="taptap_subheading_link" id="taptap_subheading_link" value="<?php echo stripslashes(get_option('bonfire_taptap_subheading_link')); ?>"/>
					</td>
					</tr>
					<!-- END SUBHEADING LINK -->

					<!-- BEGIN SUBHEADING FONT SIZE -->
					<tr valign="top">
					<th scope="row">Subheading font size:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_subheading_font_size" id="taptap_subheading_font_size" value="<?php echo get_option('bonfire_taptap_subheading_font_size'); ?>"/> px. Enter custom font size for subheading. If left empty, defaults to 10px
					</td>
					</tr>
					<!-- END SUBHEADING FONT SIZE -->
					
					<!-- BEGIN SUBHEADING LETTER SPACING -->
					<tr valign="top">
					<th scope="row">Subheading letter spacing:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_subheading_letter_spacing" id="taptap_subheading_letter_spacing" value="<?php echo get_option('bonfire_taptap_subheading_letter_spacing'); ?>"/> px. Enter custom distance between heading and subheading. If left empty, defaults to 0px
					</td>
					</tr>
					<!-- END SUBHEADING LETTER SPACING -->
					
					<!-- BEGIN SUBHEADING LINE HEIGHT -->
					<tr valign="top">
					<th scope="row">Subheading line height:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_subheading_line_height" id="taptap_subheading_line_height" value="<?php echo get_option('bonfire_taptap_subheading_line_height'); ?>"/> px. Enter custom line height for heading. Useful if your subheading text spans multiple lines.
					</td>
					</tr>
					<!-- END SUBHEADING LINE HEIGHT -->
					
					<!-- BEGIN HEADING FONT -->
					<tr valign="top">
					<th scope="row">Subheading font:</th>
					<td>
					<?php $taptap_subheading_font = get_option('bonfire_taptap_subheading_font'); ?>
					<label><input value="taptapsubheadingmontserrat" type="radio" name="taptap_subheading_font" <?php if ($taptap_subheading_font=='taptapsubheadingmontserrat') { echo 'checked'; } ?>> Montserrat (regular)</label><br>
					<label><input value="taptapsubheadingmontserratbold" type="radio" name="taptap_subheading_font" <?php if ($taptap_subheading_font=='taptapsubheadingmontserratbold') { echo 'checked'; } ?>> Montserrat (bold)</label><br>
					<label><input value="taptapsubheadingroboto" type="radio" name="taptap_subheading_font" <?php if ($taptap_subheading_font=='taptapsubheadingroboto') { echo 'checked'; } ?>> Roboto</label><br>
					<label><input value="taptapsubheadingrobotocondensedregular" type="radio" name="taptap_subheading_font" <?php if ($taptap_subheading_font=='taptapsubheadingrobotocondensedregular') { echo 'checked'; } ?>> Roboto Condensed (regular)</label><br>
					<label><input value="taptapsubheadingrobotocondensedbold" type="radio" name="taptap_subheading_font" <?php if ($taptap_subheading_font=='taptapsubheadingrobotocondensedbold') { echo 'checked'; } ?>> Roboto Condensed (bold)</label><br>
					<label><input value="taptapsubheadingbreeserif" type="radio" name="taptap_subheading_font" <?php if ($taptap_subheading_font=='taptapsubheadingbreeserif') { echo 'checked'; } ?>> Bree Serif</label><br>
					<label><input value="taptapsubheadingdroidserif" type="radio" name="taptap_subheading_font" <?php if ($taptap_subheading_font=='taptapsubheadingdroidserif') { echo 'checked'; } ?>> Droid Serif</label><br>
					<br><strong>Advanced font feature:</strong><br>
					<input style="width:100%;height:35px;" type="text" name="taptap_subheading_theme_font" id="taptap_subheading_theme_font" value="<?php echo stripslashes(get_option('bonfire_taptap_subheading_theme_font')); ?>"/> If you know the name of and would like to use one of your theme's fonts, enter it in the textfield above as it appears in the theme's stylesheet (font selection will be automatically overriden)
					</td>
					</tr>
					<!-- END HEADING FONT -->
				</table>
				<!-- END SUBHEADING -->
				
				<br><hr><br>

				<!-- BEGIN IMAGE -->
				<div id="image"></div>
				<br>
				<br>
				<h2>Image</h2>
				<table class="form-table">
					<!-- BEGIN IMAGE -->
					<tr valign="top">
					<th scope="row">Image URL:</th>
					<td>
					<input style="width:100%;" type="text" name="taptap_image" id="taptap_image" value="<?php echo get_option('bonfire_taptap_image'); ?>"/>
					<br> To display an image between the headings and the menu, enter its URL in the field above.
					</td>
					</tr>
					<!-- END IMAGE -->
				</table>
				<!-- END IMAGE -->
				
				<br><hr><br>
				
				<!-- BEGIN MENU -->
				<div id="menu-submenu"></div>
				<br>
				<br>
				<h2>Menu & submenu</h2>
				<table class="form-table">
					<!-- BEGIN CLOSE ON CLICK -->
					<tr valign="top">
					<th scope="row">Close menu after click?:</th>
					<td>
					<label><input type="checkbox" name="taptap_close_on_click" id="taptap_close_on_click" <?php echo get_option('bonfire_taptap_close_on_click'); ?> /> Close menu when menu item is clicked/tapped (useful on one-page websites where menu links lead to anchors, not new pages).</label>
					</td>
					</tr>
					<!-- END CLOSE ON CLICK -->

					<!-- BEGIN MENU FONT SIZE -->
					<tr valign="top">
					<th scope="row">Menu font size:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_font_size" id="taptap_menu_font_size" value="<?php echo get_option('bonfire_taptap_menu_font_size'); ?>"/> px. Enter custom font size for menu items. If left empty, defaults to 11px
					</td>
					</tr>
					<!-- END MENU FONT SIZE -->
					
					<!-- BEGIN SUBMENU FONT SIZE -->
					<tr valign="top">
					<th scope="row">Sub-menu font size:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_submenu_font_size" id="taptap_submenu_font_size" value="<?php echo get_option('bonfire_taptap_submenu_font_size'); ?>"/> px. Enter custom font size for sub-menu items. If left empty, defaults to 11px
					</td>
					</tr>
					<!-- END SUBMENU FONT SIZE -->
					
					<!-- BEGIN MENU LINE HEIGHT -->
					<tr valign="top">
					<th scope="row">Menu items vertical spacing:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_spacing" id="taptap_menu_spacing" value="<?php echo get_option('bonfire_taptap_menu_spacing'); ?>"/> px. Enter custom value to increase spacing between between menu items. Example: 5
					</td>
					</tr>
					<!-- END MENU LINE HEIGHT -->
					
					<!-- BEGIN SUBMENU LINE HEIGHT -->
					<tr valign="top">
					<th scope="row">Sub-menu items vertical spacing:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_submenu_spacing" id="taptap_submenu_spacing" value="<?php echo get_option('bonfire_taptap_submenu_spacing'); ?>"/> px. Enter custom value to increase spacing between between sub-menu items. Example: 5
					</td>
					</tr>
					<!-- END SUBMENU LINE HEIGHT -->
					
					<!-- BEGIN MENU LETTER SPACING -->
					<tr valign="top">
					<th scope="row">Letter spacing:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_letter_spacing" id="taptap_menu_letter_spacing" value="<?php echo get_option('bonfire_taptap_menu_letter_spacing'); ?>"/> px. Enter custom letter spacing for menus. If left empty, defaults to 0px
					</td>
					</tr>
					<!-- END MENU LETTER SPACING -->
					
					<!-- BEGIN MENU FONT -->
					<tr valign="top">
					<th scope="row">Menu font:</th>
					<td>
					<?php $taptap_menu_font = get_option('bonfire_taptap_menu_font'); ?>
					<label><input value="taptapmenumontserrat" type="radio" name="taptap_menu_font" <?php if ($taptap_menu_font=='taptapmenumontserrat') { echo 'checked'; } ?>> Montserrat (regular)</label><br>
					<label><input value="taptapmenumontserratbold" type="radio" name="taptap_menu_font" <?php if ($taptap_menu_font=='taptapmenumontserratbold') { echo 'checked'; } ?>> Montserrat (bold)</label><br>
					<label><input value="taptapmenuroboto" type="radio" name="taptap_menu_font" <?php if ($taptap_menu_font=='taptapmenuroboto') { echo 'checked'; } ?>> Roboto</label><br>
					<label><input value="taptapmenurobotocondensedregular" type="radio" name="taptap_menu_font" <?php if ($taptap_menu_font=='taptapmenurobotocondensedregular') { echo 'checked'; } ?>> Roboto Condensed (regular)</label><br>
					<label><input value="taptapmenurobotocondensedbold" type="radio" name="taptap_menu_font" <?php if ($taptap_menu_font=='taptapmenurobotocondensedbold') { echo 'checked'; } ?>> Roboto Condensed (bold)</label><br>
					<label><input value="taptapmenubreeserif" type="radio" name="taptap_menu_font" <?php if ($taptap_menu_font=='taptapmenubreeserif') { echo 'checked'; } ?>> Bree Serif</label><br>
					<label><input value="taptapmenudroidserif" type="radio" name="taptap_menu_font" <?php if ($taptap_menu_font=='taptapmenudroidserif') { echo 'checked'; } ?>> Droid Serif</label><br>
					<br><strong>Advanced font feature:</strong><br>
					<input style="width:100%;height:35px;" type="text" name="taptap_menu_theme_font" id="taptap_menu_theme_font" value="<?php echo stripslashes(get_option('bonfire_taptap_menu_theme_font')); ?>"/> If you know the name of and would like to use one of your theme's fonts, enter it in the textfield above as it appears in the theme's stylesheet (font selection will be automatically overriden)
					</td>
					</tr>
					<!-- END MENU FONT -->
					
					<!-- BEGIN HIDE SUBMENU ARROW DIVIDER -->
					<tr valign="top">
					<th scope="row">Hide divider?:</th>
					<td>
					<label><input type="checkbox" name="taptap_hide_submenu_divider" id="taptap_hide_submenu_divider" <?php echo get_option('bonfire_taptap_hide_submenu_divider'); ?> /> Hide the sub-menu indication arrow divider.</label>
					</td>
					</tr>
					<!-- END HIDE SUBMENU ARROW DIVIDER -->
					
					<!-- BEGIN MENU ARROW ALIGNMENT -->
					<tr valign="top">
					<th scope="row">Sub-menu indication arrow position (for main-level items):</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_arrow_alignment" id="taptap_menu_arrow_alignment" value="<?php echo get_option('bonfire_taptap_menu_arrow_alignment'); ?>"/> px. At certain settings, the arrow next to a top-level menu item may need to be vertically re-positioned. If you find the arrow to be misaligned, enter a number here to nudge it into position. Example: 5
					</td>
					</tr>
					<!-- END MENU ARROW ALIGNMENT -->
					
					<!-- BEGIN SUBMENU ARROW ALIGNMENT -->
					<tr valign="top">
					<th scope="row">Sub-menu indication arrow position (for sub-menu items):</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_submenu_arrow_alignment" id="taptap_submenu_arrow_alignment" value="<?php echo get_option('bonfire_taptap_submenu_arrow_alignment'); ?>"/> px. At certain settings, the arrow next to a sub-level menu item may need to be vertically re-positioned. If you find the arrow to be misaligned, enter a number here to nudge it into position. Example: 5
					</td>
					</tr>
					<!-- END SUBMENU ARROW ALIGNMENT -->
				</table>
				<!-- END MENU -->

				<br><hr><br>
				
				<!-- BEGIN MENU DESCRIPTION -->
				<div id="menu-description"></div>
				<br>
				<br>
				<h2>Menu description</h2>
				<table class="form-table">
					<!-- BEGIN MENU DESCRIPTION FONT SIZE -->
					<tr valign="top">
					<th scope="row">Font size:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_description_font_size" id="taptap_menu_description_font_size" value="<?php echo get_option('bonfire_taptap_menu_description_font_size'); ?>"/> px. Enter custom font size for menu descriptions. If left empty, defaults to 11px
					</td>
					</tr>
					<!-- END MENU DESCRIPTION FONT SIZE -->
					
					<!-- BEGIN MENU ITEM DESCRIPTION PADDING -->
					<tr valign="top">
					<th scope="row">Menu item description padding:</th>
					<td>
					Top: <input style="width:45px;height:35px;" type="text" name="taptap_menu_description_top_padding" id="taptap_menu_description_top_padding" value="<?php echo get_option('bonfire_taptap_menu_description_top_padding'); ?>"/> px.
					Bottom: <input style="width:45px;height:35px;" type="text" name="taptap_menu_description_bottom_padding" id="taptap_menu_description_bottom_padding" value="<?php echo get_option('bonfire_taptap_menu_description_bottom_padding'); ?>"/> px.
					<br>Enter custom values to increase spacing around menu item description.
					</td>
					</tr>
					<!-- END MENU ITEM DESCRIPTION PADDING -->
					
					<!-- BEGIN MENU ITEM DESCRIPTION LINE HEIGHT -->
					<tr valign="top">
					<th scope="row">Menu item description line height:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_description_line_height" id="taptap_menu_description_line_height" value="<?php echo get_option('bonfire_taptap_menu_description_line_height'); ?>"/> px. Enter custom value to increase description distance from menu item. If left empty, defaults to 11px
					</td>
					</tr>
					<!-- END MENU ITEM DESCRIPTION LINE HEIGHT -->
					
					<!-- BEGIN MENU ITEM DESCRIPTION FONT -->
					<tr valign="top">
					<th scope="row">Menu item description font:</th>
					<td>
					<?php $taptap_menu_description_font = get_option('bonfire_taptap_menu_description_font'); ?>
					<label><input value="taptapmenudescriptionmontserrat" type="radio" name="taptap_menu_description_font" <?php if ($taptap_menu_description_font=='taptapmenudescriptionmontserrat') { echo 'checked'; } ?>> Montserrat (regular)</label><br>
					<label><input value="taptapmenudescriptionmontserratbold" type="radio" name="taptap_menu_description_font" <?php if ($taptap_menu_description_font=='taptapmenudescriptionmontserratbold') { echo 'checked'; } ?>> Montserrat (bold)</label><br>
					<label><input value="taptapmenudescriptionroboto" type="radio" name="taptap_menu_description_font" <?php if ($taptap_menu_description_font=='taptapmenudescriptionroboto') { echo 'checked'; } ?>> Roboto</label><br>
					<label><input value="taptapmenudescriptionrobotocondensedregular" type="radio" name="taptap_menu_description_font" <?php if ($taptap_menu_description_font=='taptapmenudescriptionrobotocondensedregular') { echo 'checked'; } ?>> Roboto Condensed (regular)</label><br>
					<label><input value="taptapmenudescriptionrobotocondensedbold" type="radio" name="taptap_menu_description_font" <?php if ($taptap_menu_description_font=='taptapmenudescriptionrobotocondensedbold') { echo 'checked'; } ?>> Roboto Condensed (bold)</label><br>
					<label><input value="taptapmenudescriptionbreeserif" type="radio" name="taptap_menu_description_font" <?php if ($taptap_menu_description_font=='taptapmenudescriptionbreeserif') { echo 'checked'; } ?>> Bree Serif</label><br>
					<label><input value="taptapmenudescriptiondroidserif" type="radio" name="taptap_menu_description_font" <?php if ($taptap_menu_description_font=='taptapmenudescriptiondroidserif') { echo 'checked'; } ?>> Droid Serif</label><br>
					</td>
					</tr>
					<!-- END MENU ITEM DESCRIPTION FONT -->
				</table>
				<!-- END MENU DESCRIPTION -->
				
				<br><hr><br>
				
				<!-- BEGIN MENU ICONS -->
				<div id="menu-icons"></div>
				<br>
				<br>
				<h2>Menu icons</h2>
				<table class="form-table">
					<!-- BEGIN ICON SIZE -->
					<tr valign="top">
					<th scope="row">Icon size (for main-level items):</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_icon_size" id="taptap_menu_icon_size" value="<?php echo get_option('bonfire_taptap_menu_icon_size'); ?>"/> px. Enter custom icon size for menu items. If left empty, defaults to menu item size (11px if no custom size set)
					</td>
					</tr>
					<!-- END ICON SIZE -->
					
					<!-- BEGIN ICON SIZE (SUBMENU) -->
					<tr valign="top">
					<th scope="row">Icon size (for sub-menu items):</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_submenu_icon_size" id="taptap_submenu_icon_size" value="<?php echo get_option('bonfire_taptap_submenu_icon_size'); ?>"/> px. Enter custom icon size for sub-menu items. If left empty, defaults to menu item size (11px if no custom size set)
					</td>
					</tr>
					<!-- END ICON SIZE (SUBMENU) -->
					
					<!-- BEGIN ICON ALIGNMENT -->
					<tr valign="top">
					<th scope="row">Icon position (for main-level items):</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_menu_icon_alignment" id="taptap_menu_icon_alignment" value="<?php echo get_option('bonfire_taptap_menu_icon_alignment'); ?>"/> px. If you have set custom icon and text sizes that are radically different from one another, the icon next to a top-level menu item may need to be vertically re-positioned. If you find the icon to be misaligned, enter a number here to nudge it into position. Example: 5
					</td>
					</tr>
					<!-- END ICON ALIGNMENT -->
					
					<!-- BEGIN ICON ALIGNMENT (SUBMENU) -->
					<tr valign="top">
					<th scope="row">Sub-menu icon position (for sub-menu items):</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_submenu_icon_alignment" id="taptap_submenu_icon_alignment" value="<?php echo get_option('bonfire_taptap_submenu_icon_alignment'); ?>"/> px. If you have set custom icon and text sizes that are radically different from one another, the icon next to a sub-level menu item may need to be vertically re-positioned. If you find the icon to be misaligned, enter a number here to nudge it into position. Example: 5
					</td>
					</tr>
					<!-- END ICON ALIGNMENT (SUBMENU) -->
					
					<!-- BEGIN DON'T LOAD FONTAWESOME -->
					<tr valign="top">
					<th scope="row">Don't load FontAwesome:</th>
					<td>
					<label><input type="checkbox" name="taptap_fa_no_load" id="taptap_fa_no_load" <?php echo get_option('bonfire_taptap_fa_no_load'); ?> /> Don't load the FontAwesome icon set.</label><br>
					(useful if you don't use any icons with your menu items, or if your theme already loads FontAwesome).
					</td>
					</tr>
					<!-- END DON'T LOAD FONTAWESOME -->
				</table>
				<!-- END MENU ICONS -->
				
				<br><hr><br>

				<!-- BEGIN BACKGROUND DETAILS -->
				<div id="background"></div>
				<br>
				<br>
				<h2>Background</h2>
				<table class="form-table">
					<!-- BEGIN BACKGROUND IMAGE -->
					<tr valign="top">
					<th scope="row">Image URL:</th>
					<td>
					<input style="width:100%;" type="text" name="taptap_background_image" id="taptap_background_image" value="<?php echo get_option('bonfire_taptap_background_image'); ?>"/>
					<br> To use a background image, enter its URL in the field above.
					</td>
					</tr>
					<!-- END BACKGROUND IMAGE -->

					<!-- BEGIN BACKGROUND IMAGE HORIZONTAL POSITION -->
					<tr valign="top">
					<th scope="row">Background image horizontal position:</th>
					<td>
					<?php $taptap_background_horizontal_alignment = get_option('bonfire_taptap_background_horizontal_alignment'); ?>
					<label><input value="taptapbackgroundleft" type="radio" name="taptap_background_horizontal_alignment" <?php if ($taptap_background_horizontal_alignment=='taptapbackgroundleft') { echo 'checked'; } ?>> Left</label><br>
					<label><input value="taptapbackgroundcenter" type="radio" name="taptap_background_horizontal_alignment" <?php if ($taptap_background_horizontal_alignment=='taptapbackgroundcenter') { echo 'checked'; } ?>> Center</label><br>
					<label><input value="taptapbackgroundright" type="radio" name="taptap_background_horizontal_alignment" <?php if ($taptap_background_horizontal_alignment=='taptapbackgroundright') { echo 'checked'; } ?>> Right</label><br>
					</td>
					</tr>
					<!-- END BACKGROUND IMAGE HORIZONTAL POSITION -->
					
					<!-- BEGIN BACKGROUND IMAGE VERTICAL POSITION -->
					<tr valign="top">
					<th scope="row">Background image vertical position::</th>
					<td>
					<?php $taptap_background_vertical_alignment = get_option('bonfire_taptap_background_vertical_alignment'); ?>
					<label><input value="taptapbackgroundtop" type="radio" name="taptap_background_vertical_alignment" <?php if ($taptap_background_vertical_alignment=='taptapbackgroundtop') { echo 'checked'; } ?>> Top</label><br>
					<label><input value="taptapbackgroundmiddle" type="radio" name="taptap_background_vertical_alignment" <?php if ($taptap_background_vertical_alignment=='taptapbackgroundmiddle') { echo 'checked'; } ?>> Middle</label><br>
					<label><input value="taptapbackgroundbottom" type="radio" name="taptap_background_vertical_alignment" <?php if ($taptap_background_vertical_alignment=='taptapbackgroundbottom') { echo 'checked'; } ?>> Bottom</label><br>
					</td>
					</tr>
					<!-- END BACKGROUND IMAGE VERTICAL POSITION -->
					
					<!-- BEGIN BACKGOUND PATTERN -->
					<tr valign="top">
					<th scope="row">Pattern image:</th>
					<td>
					<label><input type="checkbox" name="taptap_image_pattern" id="taptap_image_pattern" <?php echo get_option('bonfire_taptap_image_pattern'); ?> /> Tick this is if you wish the above image to be shown as a pattern.
					<br>If unchecked, image will be shown in full-size 'cover' style.</label><br>
					</td>
					</tr>
					<!-- END BACKGOUND PATTERN -->
					
					<!-- BEGIN BACKGROUND IMAGE OPACITY -->
					<tr valign="top">
					<th scope="row">Background image opacity:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_background_image_opacity" id="taptap_background_image_opacity" value="<?php echo get_option('bonfire_taptap_background_image_opacity'); ?>"/>
					<br> Enter custom background image opacity. From 0-1 (example: 0.5) If left empty, defaults to 0.1
					</td>
					</tr>
					<!-- END BACKGROUND IMAGE OPACITY -->
					
					<!-- BEGIN BACKGROUND OPACITY -->
					<tr valign="top">
					<th scope="row">Background color opacity:</th>
					<td>
					<input style="width:45px;height:35px;" type="text" name="taptap_background_color_opacity" id="taptap_background_color_opacity" value="<?php echo get_option('bonfire_taptap_background_color_opacity'); ?>"/>
					<br> Enter custom background color opacity. From 0-1 (example: 0.95) If left empty, defaults to 1
					</td>
					</tr>
					<!-- END BACKGROUND OPACITY -->
				</table>
				<!-- END BACKGROUND DETAILS -->
				
				<br><hr><br>

				<!-- BEGIN HIDE BETWEEN RESOLUTIONS -->
				<div id="hide-at-certain-width-resolution"></div>
				<br>
				<br>
				<h2>Hide at certain width/resolution</h2>
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Hide at certain width/resolution:</th>
					<td>
					Hide TapTap menu if browser width or screen resolution is between <input style="width:50px;" type="text" name="taptap_smaller_than" id="taptap_smaller_than" value="<?php echo get_option('bonfire_taptap_smaller_than'); ?>"/> and <input style="width:50px;" type="text" name="taptap_larger_than" id="taptap_larger_than" value="<?php echo get_option('bonfire_taptap_larger_than'); ?>"/> pixels (fill both fields).
					<br><strong>Example:</strong> if you'd like to show TapTap on desktop only, then enter the values as 0 and 500. If fields are empty, TapTap will be visible at all browser widths and resolutions.
					</td>
					</tr>
				</table>
				<!-- END HIDE BETWEEN RESOLUTIONS -->

				<br><hr><br>

				<!-- BEGIN 'SAVE OPTIONS' BUTTON -->	
				<p><input type="submit" name="search" value="Save Options" class="button button-primary" /></p>
				<!-- BEGIN 'SAVE OPTIONS' BUTTON -->	

			</form>

		</div>
	<?php }
	function bonfire_taptap_update() {

		/* horizontal alignment */
		if ( isset ($_POST['taptap_horizontal_alignment']) == 'true' ) {
		update_option('bonfire_taptap_horizontal_alignment', $_POST['taptap_horizontal_alignment']); }
		/* vertical alignment */
		if ( isset ($_POST['taptap_vertical_alignment']) == 'true' ) {
		update_option('bonfire_taptap_vertical_alignment', $_POST['taptap_vertical_alignment']); }
		
		/* menu button style */
		if ( isset ($_POST['taptap_menu_button_style']) == 'true' ) {
		update_option('bonfire_taptap_menu_button_style', $_POST['taptap_menu_button_style']); }
		/* menu button animation */
		if ( isset ($_POST['taptap_button_animation']) == 'true' ) {
		update_option('bonfire_taptap_button_animation', $_POST['taptap_button_animation']); }
		/* menu animation */
		if ( isset ($_POST['taptap_menu_animation']) == 'true' ) {
		update_option('bonfire_taptap_menu_animation', $_POST['taptap_menu_animation']); }
		
		/* absolute/fixed positioning */
		if ( isset ($_POST['taptap_absolute_position'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_absolute_position', $display);
		/* left/right positioning */
		if ( isset ($_POST['taptap_left_right'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_left_right', $display);
		/* menu button opacity */
		update_option('bonfire_taptap_menu_button_opacity', $_POST['taptap_menu_button_opacity']);
		/* hide logo */
		if ( isset ($_POST['taptap_hide_logo'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_hide_logo', $display);
		/* hide search */
		if ( isset ($_POST['taptap_hide_search'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_hide_search', $display);
		/* hide search button divider */
		if ( isset ($_POST['taptap_hide_search_divider'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_hide_search_divider', $display);
		/* show header background */
		if ( isset ($_POST['taptap_show_header'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_show_header', $display);
		/* header background opacity */
		update_option('bonfire_taptap_header_background_opacity', $_POST['taptap_header_background_opacity']);
		/* push down site */
		if ( isset ($_POST['taptap_site_top'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_site_top', $display);
		
		/* heading text */
		update_option('bonfire_taptap_heading', $_POST['taptap_heading']);
		/* heading link */
		update_option('bonfire_taptap_heading_link', $_POST['taptap_heading_link']);
		/* heading font size */
		update_option('bonfire_taptap_heading_font_size', $_POST['taptap_heading_font_size']);
		/* heading letter spacing */
		update_option('bonfire_taptap_heading_letter_spacing', $_POST['taptap_heading_letter_spacing']);
		/* heading line height */
		update_option('bonfire_taptap_heading_line_height', $_POST['taptap_heading_line_height']);
		/* heading font */
		if ( isset ($_POST['taptap_heading_font']) == 'true' ) {
		update_option('bonfire_taptap_heading_font', $_POST['taptap_heading_font']); }
		/* heading theme font */
		update_option('bonfire_taptap_heading_theme_font', $_POST['taptap_heading_theme_font']);
		
		/* distance between heading/subheading */
		update_option('bonfire_taptap_heading_subheading_distance', $_POST['taptap_heading_subheading_distance']);
		
		/* subheading text */
		update_option('bonfire_taptap_subheading', $_POST['taptap_subheading']);
		/* subheading link */
		update_option('bonfire_taptap_subheading_link', $_POST['taptap_subheading_link']);
		/* subheading font size */
		update_option('bonfire_taptap_subheading_font_size', $_POST['taptap_subheading_font_size']);
		/* subheading letter spacing */
		update_option('bonfire_taptap_subheading_letter_spacing', $_POST['taptap_subheading_letter_spacing']);
		/* subheading line height */
		update_option('bonfire_taptap_subheading_line_height', $_POST['taptap_subheading_line_height']);
		/* subheading font */
		if ( isset ($_POST['taptap_subheading_font']) == 'true' ) {
		update_option('bonfire_taptap_subheading_font', $_POST['taptap_subheading_font']); }
		/* subheading theme font */
		update_option('bonfire_taptap_subheading_theme_font', $_POST['taptap_subheading_theme_font']);

		/* image */
		update_option('bonfire_taptap_image', $_POST['taptap_image']);
		
		/* close on click */
		if ( isset ($_POST['taptap_close_on_click'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_close_on_click', $display);
		/* menu font size */
		update_option('bonfire_taptap_menu_font_size', $_POST['taptap_menu_font_size']);
		/* sub-menu font size */
		update_option('bonfire_taptap_submenu_font_size', $_POST['taptap_submenu_font_size']);
		/* menu vertical spacing */
		update_option('bonfire_taptap_menu_spacing', $_POST['taptap_menu_spacing']);
		/* sub-menu vertical spacing */
		update_option('bonfire_taptap_submenu_spacing', $_POST['taptap_submenu_spacing']);
		/* menu letter spacing */
		update_option('bonfire_taptap_menu_letter_spacing', $_POST['taptap_menu_letter_spacing']);
		/* menu font */
		if ( isset ($_POST['taptap_menu_font']) == 'true' ) {
		update_option('bonfire_taptap_menu_font', $_POST['taptap_menu_font']); }
		/* menu theme font */
		update_option('bonfire_taptap_menu_theme_font', $_POST['taptap_menu_theme_font']);
		/* hide submenu divider */
		if ( isset ($_POST['taptap_hide_submenu_divider'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_hide_submenu_divider', $display);
		/* menu arrow alignment (top-level) */
		update_option('bonfire_taptap_menu_arrow_alignment', $_POST['taptap_menu_arrow_alignment']);
		/* menu arrow alignment (sub-level) */
		update_option('bonfire_taptap_submenu_arrow_alignment', $_POST['taptap_submenu_arrow_alignment']);

		/* menu description font size */
		update_option('bonfire_taptap_menu_description_font_size', $_POST['taptap_menu_description_font_size']);
		/* menu description top padding */
		update_option('bonfire_taptap_menu_description_top_padding', $_POST['taptap_menu_description_top_padding']);
		/* menu description bottom padding */
		update_option('bonfire_taptap_menu_description_bottom_padding', $_POST['taptap_menu_description_bottom_padding']);
		/* menu description line height */
		update_option('bonfire_taptap_menu_description_line_height', $_POST['taptap_menu_description_line_height']);
		/* menu description font */
		if ( isset ($_POST['taptap_menu_description_font']) == 'true' ) {
		update_option('bonfire_taptap_menu_description_font', $_POST['taptap_menu_description_font']); }

		/* menu icon size */
		update_option('bonfire_taptap_menu_icon_size', $_POST['taptap_menu_icon_size']);
		/* sub-menu icon size */
		update_option('bonfire_taptap_submenu_icon_size', $_POST['taptap_submenu_icon_size']);
		/* menu icon alignment */
		update_option('bonfire_taptap_menu_icon_alignment', $_POST['taptap_menu_icon_alignment']);
		/* sub-menu icon alignment */
		update_option('bonfire_taptap_submenu_icon_alignment', $_POST['taptap_submenu_icon_alignment']);
		/* don't load FontAwesome */
		if ( isset ($_POST['taptap_fa_no_load'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_fa_no_load', $display);

		/* background image */
		update_option('bonfire_taptap_background_image', $_POST['taptap_background_image']);
		/* background image horizontal alignment */
		if ( isset ($_POST['taptap_background_horizontal_alignment']) == 'true' ) {
		update_option('bonfire_taptap_background_horizontal_alignment', $_POST['taptap_background_horizontal_alignment']); }
		/* background image vertical alignment */
		if ( isset ($_POST['taptap_background_vertical_alignment']) == 'true' ) {
		update_option('bonfire_taptap_background_vertical_alignment', $_POST['taptap_background_vertical_alignment']); }
		/* background pattern */
		if ( isset ($_POST['taptap_image_pattern'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('bonfire_taptap_image_pattern', $display);
		/* background image opacity */
		update_option('bonfire_taptap_background_image_opacity', $_POST['taptap_background_image_opacity']);
		/* background color opacity */
		update_option('bonfire_taptap_background_color_opacity', $_POST['taptap_background_color_opacity']);
		
		/* larger than, lower than */
		update_option('bonfire_taptap_larger_than', $_POST['taptap_larger_than']);
		update_option('bonfire_taptap_smaller_than', $_POST['taptap_smaller_than']);

	}
	add_action('admin_menu', 'bonfire_taptap_admin_menu');
	?>
<?php


	//
	// Add menu to theme
	//
	
	function bonfire_taptap_footer() {
	?>

		<!-- BEGIN MENU BUTTON -->
		<div class="taptap-menu-button-wrapper<?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?><?php if( get_option('bonfire_taptap_absolute_position') ) { ?> taptap-absolute<?php } ?><?php if( get_option('bonfire_taptap_left_right') ) { ?> taptap-right<?php } ?>">
			<?php if(get_option('bonfire_taptap_menu_button_style') == "taptapthreelines") { ?>
				<div class="taptap-menu-button-three">
					<div class="taptap-menu-button-three-middle"></div>
				</div>
			<?php } else { ?>
				<div class="taptap-menu-button">
					<div class="taptap-menu-button-middle"></div>
				</div>
			<?php } ?>
		</div>
		<!-- END MENU BUTTON -->

		<!-- BEGIN SEARCH BUTTON -->
		<?php if( get_option('bonfire_taptap_hide_search') ) { ?>
		<?php } else { ?>
		<div class="taptap-search-button<?php if( get_option('bonfire_taptap_left_right') ) { ?>-right<?php } ?><?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?><?php if( get_option('bonfire_taptap_absolute_position') ) { ?> taptap-absolute<?php } ?>">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
			<path id="magnifier-3-icon" d="M208.464,363.98c-86.564,0-156.989-70.426-156.989-156.99C51.475,120.426,121.899,50,208.464,50
				c86.565,0,156.991,70.426,156.991,156.991C365.455,293.555,295.029,363.98,208.464,363.98z M208.464,103.601
				c-57.01,0-103.389,46.381-103.389,103.39s46.379,103.389,103.389,103.389c57.009,0,103.391-46.38,103.391-103.389
				S265.473,103.601,208.464,103.601z M367.482,317.227c-14.031,20.178-31.797,37.567-52.291,51.166L408.798,462l51.728-51.729
				L367.482,317.227z"/>
			</svg>
		</div>
		<?php } ?>
		<!-- END SEARCH BUTTON -->
		
		<!-- BEGIN SEARCH FORM -->
		<div class="taptap-search-wrapper<?php if( get_option('bonfire_taptap_absolute_position') ) { ?> taptap-absolute<?php } ?><?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?>">
				<!-- BEGIN SEARCH FORM CLOSE ICON -->
				<div class="taptap-search-close-icon">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
					<path d="M9.016,40.837c0.195,0.195,0.451,0.292,0.707,0.292c0.256,0,0.512-0.098,0.708-0.293l14.292-14.309
						l14.292,14.309c0.195,0.196,0.451,0.293,0.708,0.293c0.256,0,0.512-0.098,0.707-0.292c0.391-0.39,0.391-1.023,0.001-1.414
						L26.153,25.129L40.43,10.836c0.39-0.391,0.39-1.024-0.001-1.414c-0.392-0.391-1.024-0.391-1.414,0.001L24.722,23.732L10.43,9.423
						c-0.391-0.391-1.024-0.391-1.414-0.001c-0.391,0.39-0.391,1.023-0.001,1.414l14.276,14.293L9.015,39.423
						C8.625,39.813,8.625,40.447,9.016,40.837z"/>
					</svg>
				</div>
				<!-- END SEARCH FORM CLOSE ICON -->
			
				<form method="get" id="searchform" action="<?php echo esc_url( home_url('') ); ?>/">
					<input type="text" name="s" id="s" placeholder="<?php _e( 'type search term...' , 'bonfire' ) ?>">
				</form>
		</div>
		<!-- END SEARCH FORM -->

		<!-- BEGIN LOGO -->
		<?php if( get_option('bonfire_taptap_hide_logo') ) { ?>
		<?php } else {?>
			<div class="taptap-logo-wrapper<?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?><?php if( get_option('bonfire_taptap_absolute_position') ) { ?> taptap-absolute<?php } ?><?php if( get_option('bonfire_taptap_left_right') ) { ?> taptap-left<?php } ?>">
				<?php if ( get_theme_mod( 'taptap_logo' ) ) : ?>
			
					<!-- BEGIN LOGO IMAGE -->
					<div class="taptap-logo-image">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'taptap_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
					</div>
					<!-- END LOGO IMAGE -->
			
				<?php else : ?>
			
					<!-- BEGIN LOGO -->
					<div class="taptap-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php bloginfo('name'); ?>
						</a>
					</div>
					<!-- END LOGO -->
			
				<?php endif; ?>
			</div>
		<?php } ?>
		<!-- END LOGO -->
		
		<!-- BEGIN HEADER BACKGROUND -->
		<?php if( get_option('bonfire_taptap_show_header') ) { ?>
			<div class="tap-tap-header<?php if ( is_admin_bar_showing() ) { ?> wp-toolbar-active<?php } ?> 	<?php if( get_option('bonfire_taptap_absolute_position') ) { ?> taptap-absolute<?php } ?>">
			</div>
		<?php } ?>
		<!-- END HEADER BACKGROUND -->
		
		<!-- BEGIN MENU BACKGROUND COLOR -->
		<div class="taptap-background-color">
		</div>
		<!-- END MENU BACKGROUND COLOR -->
		
		<!-- BEGIN MENU BACKGROUND IMAGE -->
		<?php if(get_option('bonfire_taptap_background_image')) { ?>
		<div class="taptap-background-image" style="background-image: url(<?php echo get_option('bonfire_taptap_background_image'); ?>);">
		</div>
		<?php } ?>
		<!-- END MENU BACKGROUND IMAGE -->

		<!-- BEGIN MAIN WRAPPER -->
		<div class="taptap-main-wrapper">
			<div class="taptap-main-inner">
				<div class="taptap-main">
					<div class="taptap-main-inner-inner<?php if ( is_admin_bar_showing() ) { ?> taptap-main-inner-inner-toolbar<?php } ?>">
						<!-- BEGIN HEADING -->
						<div class="taptap-heading">
							<?php if(get_option('bonfire_taptap_heading_link')) { ?>
							<a href="<?php echo stripslashes(get_option('bonfire_taptap_heading_link')); ?>">
							<?php } ?>
								<?php echo stripslashes(get_option('bonfire_taptap_heading')); ?>
							<?php if(get_option('bonfire_taptap_heading_link')) { ?>
							</a>
							<?php } ?>
						</div>
						<!-- END HEADING -->
						
						<!-- BEGIN SUBHEADING -->
						<div class="taptap-subheading">
							<?php if(get_option('bonfire_taptap_subheading_link')) { ?>
							<a href="<?php echo stripslashes(get_option('bonfire_taptap_subheading_link')); ?>">
							<?php } ?>
								<?php echo stripslashes(get_option('bonfire_taptap_subheading')); ?>
							<?php if(get_option('bonfire_taptap_subheading_link')) { ?>
							</a>
							<?php } ?>
						</div>
						<!-- END SUBHEADING -->
						
						<!-- BEGIN IMAGE -->
						<?php if(get_option('bonfire_taptap_image')) { ?>
						<div class="taptap-image">
							<img src="<?php echo get_option('bonfire_taptap_image'); ?>">
						</div>
						<?php } ?>
						<!-- END IMAGE -->
						
						<!-- BEGIN MENU -->
						<?php $walker = new TapTap_Menu_Description; ?>
						<?php wp_nav_menu( array( 'container_class' => 'taptap-by-bonfire', 'theme_location' => 'taptap-by-bonfire', 'walker' => $walker, 'fallback_cb' => '' ) ); ?>
						<!-- END MENU -->
					</div>
				</div>
			</div>
		</div>
		<!-- END MAIN WRAPPER -->

	<?php
	}
	add_action('wp_footer','bonfire_taptap_footer');

	//
	// ADD the walker class (for menu descriptions)
	//
	
	class TapTap_Menu_Description extends Walker_Nav_Menu {
		function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			$class_names = $value = '';
	
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';
	
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
	
			$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
	
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '<div class="taptap-menu-item-description">' . $item->description . '</div>';
			$item_output .= '</a>';
			$item_output .= $args->after;
	
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
		}
	}

	//
	// WordPress customizer: Custom logo upload
	//
	function taptap_theme_customizer( $wp_customize ) {
	
	$wp_customize->add_section( 'taptap_logo_section' , array(
		'title'       => __( 'TapTap Plugin Logo', 'taptap' ),
		'priority'    => 31,
		'description' => 'Upload a logo to replace the default site name and description in the header',
	) );
	
	$wp_customize->add_setting( 'taptap_logo',
    array ( 'default' => '',
    'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'taptap_logo', array(
		'label'    => __( 'Logo', 'taptap' ),
		'section'  => 'taptap_logo_section',
		'settings' => 'taptap_logo',
	) ) );
	
	}
	add_action('customize_register', 'taptap_theme_customizer');

	//
	// ENQUEUE taptap.css
	//
	function bonfire_taptap_css() {
		wp_register_style( 'bonfire-taptap-css', plugins_url( '/taptap.css', __FILE__ ) . '', array(), '1', 'all' );
		wp_enqueue_style( 'bonfire-taptap-css' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_taptap_css' );

	//
	// ENQUEUE taptap-accordion.js
	//
	function bonfire_taptap_accordion() {
		wp_register_script( 'bonfire-taptap-accordion', plugins_url( '/taptap-accordion.js', __FILE__ ) . '', array( 'jquery' ), '1' );  
		wp_enqueue_script( 'bonfire-taptap-accordion' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_taptap_accordion' );
	
	//
	// ENQUEUE taptap.js
	//
	function bonfire_taptap_js() {
		wp_register_script( 'bonfire-taptap-js', plugins_url( '/taptap.js', __FILE__ ) . '', array( 'jquery' ), '1', true );  
		wp_enqueue_script( 'bonfire-taptap-js' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_taptap_js' );
	
	//
	// ENQUEUE taptap-close-on-click.js
	//
	if(get_option('bonfire_taptap_close_on_click')) {
		function bonfire_taptap_close_on_click_js() {
			wp_register_script( 'bonfire-taptap-close-on-click-js', plugins_url( '/taptap-close-on-click.js', __FILE__ ) . '', array( 'jquery' ), '1', true );  
			wp_enqueue_script( 'bonfire-taptap-close-on-click-js' );
		}
		add_action( 'wp_enqueue_scripts', 'bonfire_taptap_close_on_click_js' );
	}

	//
	// Enqueue Google WebFonts
	//
	function bonfire_taptap_font() {
	$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'bonfire-taptap-font', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300|Roboto+Condensed:400,700|Bree+Serif|Droid+Serif:400' rel='stylesheet' type='text/css" );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_taptap_font' );

	//
	// Enqueue font-awesome.min.css (icons for menu, if option to hide not enabled)
	//
	if( get_option('bonfire_taptap_fa_no_load') ) {
	} else {
		function bonfire_taptap_fontawesome() {  
			wp_register_style( 'taptap-fontawesome', plugins_url( '/fonts/font-awesome/css/font-awesome.min.css', __FILE__ ) . '', array(), '1', 'all' );  
			wp_enqueue_style( 'taptap-fontawesome' );
		}
		add_action( 'wp_enqueue_scripts', 'bonfire_taptap_fontawesome' );
	}

	//
	// Register Custom Menu Function
	//
	if (function_exists('register_nav_menus')) {
		register_nav_menus( array(
			'taptap-by-bonfire' => ( 'TapTap, by Bonfire' ),
		) );
	}

	//
	// Add color options to Appearance > Customize
	//
	add_action( 'customize_register', 'bonfire_taptap_customize_register' );
	function bonfire_taptap_customize_register($wp_customize)
	{
		$colors = array();
		/* menu button + search + logo + header */
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_button_color', 'default' => '', 'label' => __( 'Menu button', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_button_active_color', 'default' => '', 'label' => __( 'Menu button (when menu opened)', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_button_hover_color', 'default' => '', 'label' => __( 'Menu button hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_button_active_hover_color', 'default' => '', 'label' => __( 'Menu button hover (when menu opened)', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_search_button_color', 'default' => '', 'label' => __( 'Search button', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_search_button_hover_color', 'default' => '', 'label' => __( 'Search button hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_search_button_divider_color', 'default' => '', 'label' => __( 'Search button divider', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_search_field_background_color', 'default' => '', 'label' => __( 'Search field background', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_search_field_placeholder_color', 'default' => '', 'label' => __( 'Search field placeholder', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_search_field_text_color', 'default' => '', 'label' => __( 'Search field text', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_search_close_button_color', 'default' => '', 'label' => __( 'Search field close button', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_search_close_button_hover_color', 'default' => '', 'label' => __( 'Search field close button hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_logo_color', 'default' => '', 'label' => __( 'Logo', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_logo_hover_color', 'default' => '', 'label' => __( 'Logo hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_header_background_color', 'default' => '', 'label' => __( 'Header background', 'bonfire' ) );
		/* headings */
		$colors[] = array( 'slug'=>'bonfire_taptap_heading_color', 'default' => '', 'label' => __( 'Heading', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_subheading_color', 'default' => '', 'label' => __( 'Subheading', 'bonfire' ) );
		/* menu + submenu */
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_color', 'default' => '', 'label' => __( 'Menu item', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_hover_color', 'default' => '', 'label' => __( 'Menu item hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_submenu_color', 'default' => '', 'label' => __( 'Submenu item', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_submenu_hover_color', 'default' => '', 'label' => __( 'Submenu item hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_submenu_arrow_color', 'default' => '', 'label' => __( 'Submenu arrow', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_submenu_arrow_hover_color', 'default' => '', 'label' => __( 'Submenu arrow hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_submenu_arrow_divider_color', 'default' => '', 'label' => __( 'Submenu arrow divider', 'bonfire' ) );
		/* menu icons */
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_icon_color', 'default' => '', 'label' => __( 'Menu icon', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_icon_hover_color', 'default' => '', 'label' => __( 'Menu icon hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_submenu_icon_color', 'default' => '', 'label' => __( 'Submenu icon', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_taptap_submenu_icon_hover_color', 'default' => '', 'label' => __( 'Submenu icon hover', 'bonfire' ) );
		/* menu description */
		$colors[] = array( 'slug'=>'bonfire_taptap_menu_description_color', 'default' => '', 'label' => __( 'Menu item description', 'bonfire' ) );
		/* background */
		$colors[] = array( 'slug'=>'bonfire_taptap_background_color', 'default' => '', 'label' => __( 'Background', 'bonfire' ) );

	foreach($colors as $color)
	{

	/* create custom color customization section */
	$wp_customize->add_section( 'taptap_plugin_colors' , array( 'title' => __('TapTap Plugin Colors', 'bonfire'), 'priority' => 30 ));
	$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'taptap_plugin_colors', 'settings' => $color['slug'] )));
	}
	}

	//
	// Insert theme customizer options into the footer
	//
	function bonfire_taptap_header_customize() {
	?>

		<!-- BEGIN CUSTOM COLORS (WP THEME CUSTOMIZER) -->
		<!-- menu button + logo + header -->
		<?php $bonfire_taptap_menu_button_color = get_option('bonfire_taptap_menu_button_color'); ?>
		<?php $bonfire_taptap_menu_button_active_color = get_option('bonfire_taptap_menu_button_active_color'); ?>
		<?php $bonfire_taptap_menu_button_hover_color = get_option('bonfire_taptap_menu_button_hover_color'); ?>
		<?php $bonfire_taptap_menu_button_active_hover_color = get_option('bonfire_taptap_menu_button_active_hover_color'); ?>
		<?php $bonfire_taptap_search_button_color = get_option('bonfire_taptap_search_button_color'); ?>
		<?php $bonfire_taptap_search_button_hover_color = get_option('bonfire_taptap_search_button_hover_color'); ?>
		<?php $bonfire_taptap_search_button_divider_color = get_option('bonfire_taptap_search_button_divider_color'); ?>
		<?php $bonfire_taptap_search_field_background_color = get_option('bonfire_taptap_search_field_background_color'); ?>
		<?php $bonfire_taptap_search_field_placeholder_color = get_option('bonfire_taptap_search_field_placeholder_color'); ?>
		<?php $bonfire_taptap_search_field_text_color = get_option('bonfire_taptap_search_field_text_color'); ?>
		<?php $bonfire_taptap_search_close_button_color = get_option('bonfire_taptap_search_close_button_color'); ?>
		<?php $bonfire_taptap_search_close_button_hover_color = get_option('bonfire_taptap_search_close_button_hover_color'); ?>
		<?php $bonfire_taptap_logo_color = get_option('bonfire_taptap_logo_color'); ?>
		<?php $bonfire_taptap_logo_hover_color = get_option('bonfire_taptap_logo_hover_color'); ?>
		<?php $bonfire_taptap_header_background_color = get_option('bonfire_taptap_header_background_color'); ?>
		<!-- headings -->
		<?php $bonfire_taptap_heading_color = get_option('bonfire_taptap_heading_color'); ?>
		<?php $bonfire_taptap_subheading_color = get_option('bonfire_taptap_subheading_color'); ?>
		<!-- menu + submenu -->
		<?php $bonfire_taptap_menu_color = get_option('bonfire_taptap_menu_color'); ?>
		<?php $bonfire_taptap_menu_hover_color = get_option('bonfire_taptap_menu_hover_color'); ?>
		<?php $bonfire_taptap_submenu_color = get_option('bonfire_taptap_submenu_color'); ?>
		<?php $bonfire_taptap_submenu_hover_color = get_option('bonfire_taptap_submenu_hover_color'); ?>
		<?php $bonfire_taptap_submenu_arrow_color = get_option('bonfire_taptap_submenu_arrow_color'); ?>
		<?php $bonfire_taptap_submenu_arrow_hover_color = get_option('bonfire_taptap_submenu_arrow_hover_color'); ?>
		<?php $bonfire_taptap_submenu_arrow_divider_color = get_option('bonfire_taptap_submenu_arrow_divider_color'); ?>
		<!-- menu icons -->
		<?php $bonfire_taptap_menu_icon_color = get_option('bonfire_taptap_menu_icon_color'); ?>
		<?php $bonfire_taptap_menu_icon_hover_color = get_option('bonfire_taptap_menu_icon_hover_color'); ?>
		<?php $bonfire_taptap_submenu_icon_color = get_option('bonfire_taptap_submenu_icon_color'); ?>
		<?php $bonfire_taptap_submenu_icon_hover_color = get_option('bonfire_taptap_submenu_icon_hover_color'); ?>
		<!-- menu description -->
		<?php $bonfire_taptap_menu_description_color = get_option('bonfire_taptap_menu_description_color'); ?>
		<!-- background -->
		<?php $bonfire_taptap_background_color = get_option('bonfire_taptap_background_color'); ?>

		<style>
		/**************************************************************
		*** CUSTOM COLORS
		**************************************************************/		
		/* menu button opacity */
		.taptap-menu-button-wrapper { opacity:<?php echo get_option('bonfire_taptap_menu_button_opacity'); ?>; }
		/* menu button */
		.taptap-menu-button:after,
		.taptap-menu-button:before,
		.taptap-menu-button div.taptap-menu-button-middle:before,
		.taptap-menu-button div.taptap-menu-button-middle:after,
		.taptap-menu-button-three:after,
		.taptap-menu-button-three:before,
		.taptap-menu-button-three div.taptap-menu-button-three-middle:before { background-color:<?php echo $bonfire_taptap_menu_button_color; ?>; }
		/* menu button (if menu opened) */
		.taptap-menu-active .taptap-menu-button:after,
		.taptap-menu-active .taptap-menu-button:before,
		.taptap-menu-active .taptap-menu-button div.taptap-menu-button-middle:before,
		.taptap-menu-active .taptap-menu-button div.taptap-menu-button-middle:after,
		.taptap-menu-active .taptap-menu-button-three:after,
		.taptap-menu-active .taptap-menu-button-three:before,
		.taptap-menu-active .taptap-menu-button-three div.taptap-menu-button-three-middle:before { background-color:<?php echo $bonfire_taptap_menu_button_active_color; ?>; }
	
		<?php if ( wp_is_mobile() ) { ?>
		<?php } else { ?>
		/* menu bars hover */
		.taptap-menu-button:hover:before,
		.taptap-menu-button:hover:after,
		.taptap-menu-button:hover div.taptap-menu-button-middle:before,
		.taptap-menu-button:hover div.taptap-menu-button-middle:after,
		.taptap-menu-button-three:hover:after,
		.taptap-menu-button-three:hover:before,
		.taptap-menu-button-three:hover div.taptap-menu-button-three-middle:before {
			background-color:#A3A6A9 !important;
			background-color:<?php echo $bonfire_taptap_menu_button_hover_color; ?> !important;
		}
		/* menu bars hover */
		.taptap-menu-active .taptap-menu-button:hover:before,
		.taptap-menu-active .taptap-menu-button:hover:after,
		.taptap-menu-active .taptap-menu-button:hover div.taptap-menu-button-middle:before,
		.taptap-menu-active .taptap-menu-button:hover div.taptap-menu-button-middle:after,
		.taptap-menu-active .taptap-menu-button-three:hover:after,
		.taptap-menu-active .taptap-menu-button-three:hover:before,
		.taptap-menu-active .taptap-menu-button-three:hover div.taptap-menu-button-three-middle:before {
			background-color:#A3A6A9 !important;
			background-color:<?php echo $bonfire_taptap_menu_button_active_hover_color; ?> !important;
		}
		<?php } ?>
		
		/* search button */
		.taptap-search-button,
		.taptap-search-button-right { border-color:<?php echo $bonfire_taptap_search_button_divider_color; ?>; }
		.taptap-search-button svg,
		.taptap-search-button-right svg { fill:<?php echo $bonfire_taptap_search_button_color; ?>; }
		.taptap-search-button:hover svg,
		.taptap-search-button-right:hover svg { fill:<?php echo $bonfire_taptap_search_button_hover_color; ?>; }
		/* search button divider */
		<?php if( get_option('bonfire_taptap_hide_search_divider') ) { ?>
		.taptap-search-button {
			border-left:none;
			left:61px;
		}
		.taptap-search-button-right {
			border-right:none;
			right:61px;
		}
		<?php } else { ?>
		<?php } ?>
		
		
		
		/* search form background */
		.taptap-search-wrapper { background-color:<?php echo $bonfire_taptap_search_field_background_color; ?>; }
		/* search form placeholder */
		#searchform input::-webkit-input-placeholder { color:<?php echo $bonfire_taptap_search_field_placeholder_color; ?> !important; }
		#searchform input:-moz-placeholder { color:<?php echo $bonfire_taptap_search_field_placeholder_color; ?> !important; }
		#searchform input::-moz-placeholder { color:<?php echo $bonfire_taptap_search_field_placeholder_color; ?> !important; }
		#searchform input:-ms-input-placeholder { color:<?php echo $bonfire_taptap_search_field_placeholder_color; ?> !important; }
		/* search form text */
		.taptap-search-wrapper #searchform input { color:<?php echo $bonfire_taptap_search_field_text_color; ?>; }
		/* search form close icon */
		.taptap-search-close-icon svg { fill:<?php echo $bonfire_taptap_search_close_button_color; ?>; }
		/* search form close icon hover */
		.taptap-search-close-icon:hover svg { fill:<?php echo $bonfire_taptap_search_close_button_hover_color; ?>; }
		/* logo */
		.taptap-logo a { color:<?php echo $bonfire_taptap_logo_color; ?>; }
		.taptap-logo a:hover { color:<?php echo $bonfire_taptap_logo_hover_color; ?>; }
		/* header background */
		.tap-tap-header { background-color:<?php echo $bonfire_taptap_header_background_color; ?>; }
		/* headings */
		.taptap-heading,
		.taptap-heading a,
		.taptap-heading a:hover { color:<?php echo $bonfire_taptap_heading_color; ?>; }
		.taptap-subheading,
		.taptap-subheading a,
		.taptap-subheading a:hover { color:<?php echo $bonfire_taptap_subheading_color; ?>; }
		/* menu + submenu */
		.taptap-by-bonfire ul li a { color:<?php echo $bonfire_taptap_menu_color; ?>; }
		.taptap-by-bonfire ul li a:hover { color:<?php echo $bonfire_taptap_menu_hover_color; ?>; }
		.taptap-by-bonfire .sub-menu a { color:<?php echo $bonfire_taptap_submenu_color; ?>; }
		.taptap-by-bonfire .sub-menu a:hover { color:<?php echo $bonfire_taptap_submenu_hover_color; ?>; }
		.taptap-by-bonfire .menu li span svg { fill:<?php echo $bonfire_taptap_submenu_arrow_color; ?>; }
		.taptap-by-bonfire .menu li span:hover svg { fill:<?php echo $bonfire_taptap_submenu_arrow_hover_color; ?>; }
		.taptap-by-bonfire .menu li span { border-color:<?php echo $bonfire_taptap_submenu_arrow_divider_color; ?>; }
		/* background */
		.taptap-background-color { background-color:<?php echo $bonfire_taptap_background_color; ?>; }
		
		/* push down site by height of menu */
		<?php if(get_option('bonfire_taptap_site_top')) { ?>
			body { margin-top:67px !important; }
		<?php } ?>
		
		/* background image opacity */
		.taptap-background-image { opacity:<?php echo get_option('bonfire_taptap_background_image_opacity'); ?>; }
		/* background color opacity */
		.taptap-background-color { opacity:<?php echo get_option('bonfire_taptap_background_color_opacity'); ?>; }
		/* header background opacity */
		.tap-tap-header { opacity:<?php echo get_option('bonfire_taptap_header_background_opacity'); ?>; }

		/* heading */
		.taptap-heading,
		.taptap-heading a {
			font-size:<?php echo get_option('bonfire_taptap_heading_font_size'); ?>px;
			letter-spacing:<?php echo get_option('bonfire_taptap_heading_letter_spacing'); ?>px;
			line-height:<?php echo get_option('bonfire_taptap_heading_line_height'); ?>px;
		}
		/* subheading */
		.taptap-subheading,
		.taptap-subheading a {
			font-size:<?php echo get_option('bonfire_taptap_subheading_font_size'); ?>px;
			letter-spacing:<?php echo get_option('bonfire_taptap_subheading_letter_spacing'); ?>px;
			line-height:<?php echo get_option('bonfire_taptap_subheading_line_height'); ?>px;
			margin-top:<?php echo get_option('bonfire_taptap_heading_subheading_distance'); ?>px;
		}
		/* heading font */
		<?php if(get_option('bonfire_taptap_heading_theme_font')) { ?>
			.taptap-heading,
			.taptap-heading a {
				font-family:<?php echo stripslashes(get_option('bonfire_taptap_heading_theme_font')); ?>;
			}
		<?php } else { ?>
			<?php if(get_option('bonfire_taptap_heading_font') == "taptapheadingmontserratbold") { ?>
				.taptap-heading,
				.taptap-heading a {
					font-family:'Montserrat';
					font-weight:700;
				}
			<?php } else if(get_option('bonfire_taptap_heading_font') == "taptapheadingroboto") { ?>
				.taptap-heading,
				.taptap-heading a {
					font-family:'Roboto';
				}
			<?php } else if(get_option('bonfire_taptap_heading_font') == "taptapheadingrobotocondensedregular") { ?>
				.taptap-heading,
				.taptap-heading a {
					font-family:'Roboto Condensed';
					font-weight:400;
				}
			<?php } else if(get_option('bonfire_taptap_heading_font') == "taptapheadingrobotocondensedbold") { ?>
				.taptap-heading,
				.taptap-heading a {
					font-family:'Roboto Condensed';
					font-weight:700;
				}
			<?php } else if(get_option('bonfire_taptap_heading_font') == "taptapheadingbreeserif") { ?>
				.taptap-heading,
				.taptap-heading a {
					font-family:'Bree Serif';
				}
			<?php } else if(get_option('bonfire_taptap_heading_font') == "taptapheadingdroidserif") { ?>
				.taptap-heading,
				.taptap-heading a {
					font-family:'Droid Serif';
				}
			<?php } else { ?>
				.taptap-heading,
				.taptap-heading a {
					font-family:'Montserrat';
					font-weight:400;
				}
			<?php } ?>
		<?php } ?>
		
		
		/* subheading font */
		<?php if(get_option('bonfire_taptap_subheading_theme_font')) { ?>
			.taptap-subheading,
			.taptap-subheading a {
				font-family:<?php echo stripslashes(get_option('bonfire_taptap_subheading_theme_font')); ?>;
			}
		<?php } else { ?>
			<?php if(get_option('bonfire_taptap_subheading_font') == "taptapsubheadingmontserratbold") { ?>
				.taptap-subheading,
				.taptap-subheading a {
					font-family:'Montserrat';
					font-weight:700;
				}
			<?php } else if(get_option('bonfire_taptap_subheading_font') == "taptapsubheadingroboto") { ?>
				.taptap-subheading,
				.taptap-subheading a {
					font-family:'Roboto';
				}
			<?php } else if(get_option('bonfire_taptap_subheading_font') == "taptapsubheadingrobotocondensedregular") { ?>
				.taptap-subheading,
				.taptap-subheading a {
					font-family:'Roboto Condensed';
					font-weight:400;
				}
			<?php } else if(get_option('bonfire_taptap_subheading_font') == "taptapsubheadingrobotocondensedbold") { ?>
				.taptap-subheading,
				.taptap-subheading a {
					font-family:'Roboto Condensed';
					font-weight:700;
				}
			<?php } else if(get_option('bonfire_taptap_subheading_font') == "taptapsubheadingbreeserif") { ?>
				.taptap-subheading,
				.taptap-subheading a {
					font-family:'Bree Serif';
				}
			<?php } else if(get_option('bonfire_taptap_subheading_font') == "taptapsubheadingdroidserif") { ?>
				.taptap-subheading,
				.taptap-subheading a {
					font-family:'Droid Serif';
				}
			<?php } else { ?>
				.taptap-subheading,
				.taptap-subheading a {
					font-family:'Montserrat';
					font-weight:400;
				}
			<?php } ?>
		<?php } ?>
		
		
		/* menu font */
		<?php if(get_option('bonfire_taptap_menu_theme_font')) { ?>
			.taptap-by-bonfire ul li a {
				font-family:<?php echo stripslashes(get_option('bonfire_taptap_menu_theme_font')); ?>;
			}
		<?php } else { ?>
			<?php if(get_option('bonfire_taptap_menu_font') == "taptapmenumontserratbold") { ?>
				.taptap-by-bonfire ul li a {
					font-family:'Montserrat';
					font-weight:700;
				}
			<?php } else if(get_option('bonfire_taptap_menu_font') == "taptapmenuroboto") { ?>
				.taptap-by-bonfire ul li a {
					font-family:'Roboto';
				}
			<?php } else if(get_option('bonfire_taptap_menu_font') == "taptapmenurobotocondensedregular") { ?>
				.taptap-by-bonfire ul li a {
					font-family:'Roboto Condensed';
					font-weight:400;
				}
			<?php } else if(get_option('bonfire_taptap_menu_font') == "taptapmenurobotocondensedbold") { ?>
				.taptap-by-bonfire ul li a {
					font-family:'Roboto Condensed';
					font-weight:700;
				}
			<?php } else if(get_option('bonfire_taptap_menu_font') == "taptapmenubreeserif") { ?>
				.taptap-by-bonfire ul li a {
					font-family:'Bree Serif';
				}
			<?php } else if(get_option('bonfire_taptap_menu_font') == "taptapmenudroidserif") { ?>
				.taptap-by-bonfire ul li a {
					font-family:'Droid Serif';
				}
			<?php } else { ?>
				.taptap-by-bonfire ul li a {
					font-family:'Montserrat';
					font-weight:400;
				}
			<?php } ?>
		<?php } ?>
		

		/* menu */
		.taptap-by-bonfire ul li a {
			font-size:<?php echo get_option('bonfire_taptap_menu_font_size'); ?>px;
			letter-spacing:<?php echo get_option('bonfire_taptap_menu_letter_spacing'); ?>px;
		}
		/* submenu */
		.taptap-by-bonfire .sub-menu a {
			font-size:<?php echo get_option('bonfire_taptap_submenu_font_size'); ?>px;
			letter-spacing:<?php echo get_option('bonfire_taptap_menu_letter_spacing'); ?>px;
		}
		/* menu vertical spacing */
		.taptap-by-bonfire ul li a {
			margin-bottom:<?php echo get_option('bonfire_taptap_menu_spacing'); ?>px;
		}
		/* sub-menu vertical spacing */
		.taptap-by-bonfire .sub-menu a {
			margin-top:<?php echo get_option('bonfire_taptap_submenu_spacing'); ?>px;
		}
		/* drop-down arrow position */
		.taptap-by-bonfire .menu li.menu-item-has-children span {
			top:<?php echo get_option('bonfire_taptap_menu_arrow_alignment'); ?>px;
		}
		/* drop-down arrow position (top-level) */
		.taptap-by-bonfire .menu li.menu-item-has-children span {
			top:<?php echo get_option('bonfire_taptap_menu_arrow_alignment'); ?>px;
		}
		/* drop-down arrow position (sub-level) */
		.taptap-by-bonfire .sub-menu li.menu-item-has-children span {
			top:<?php echo get_option('bonfire_taptap_submenu_arrow_alignment'); ?>px;
		}
		
		/* menu description */
		.taptap-menu-item-description {
			font-size:<?php echo get_option('bonfire_taptap_menu_description_font_size'); ?>px;
			padding-top:<?php echo get_option('bonfire_taptap_menu_description_top_padding'); ?>px;
			padding-bottom:<?php echo get_option('bonfire_taptap_menu_description_bottom_padding'); ?>px;
			line-height:<?php echo get_option('bonfire_taptap_menu_description_line_height'); ?>px;
			color:<?php echo $bonfire_taptap_menu_description_color; ?>;
		}
		/* menu description font */
		<?php if(get_option('bonfire_taptap_menu_description_font') == "taptapmenudescriptionmontserratbold") { ?>
			.taptap-menu-item-description {
				font-family:'Montserrat';
				font-weight:700;
			}
		<?php } else if(get_option('bonfire_taptap_menu_description_font') == "taptapmenudescriptionroboto") { ?>
			.taptap-menu-item-description {
				font-family:'Roboto';
			}
		<?php } else if(get_option('bonfire_taptap_menu_description_font') == "taptapmenudescriptionrobotocondensedregular") { ?>
			.taptap-menu-item-description {
				font-family:'Roboto Condensed';
				font-weight:400;
			}
		<?php } else if(get_option('bonfire_taptap_menu_description_font') == "taptapmenudescriptionrobotocondensedbold") { ?>
			.taptap-menu-item-description {
				font-family:'Roboto Condensed';
				font-weight:700;
			}
		<?php } else if(get_option('bonfire_taptap_menu_description_font') == "taptapmenudescriptionbreeserif") { ?>
			.taptap-menu-item-description {
				font-family:'Bree Serif';
			}
		<?php } else if(get_option('bonfire_taptap_menu_description_font') == "taptapmenudescriptiondroidserif") { ?>
			.taptap-menu-item-description {
				font-family:'Droid Serif';
			}
		<?php } else { ?>
			.taptap-menu-item-description {
				font-family:'Montserrat';
				font-weight:400;
			}
		<?php } ?>

		/* menu icons */
		.taptap-by-bonfire ul li a i {
			color:<?php echo $bonfire_taptap_menu_icon_color; ?>;
			font-size:<?php echo get_option('bonfire_taptap_menu_icon_size'); ?>px;
			margin-top:<?php echo get_option('bonfire_taptap_menu_icon_alignment'); ?>px;
		}
		.taptap-by-bonfire ul li a:hover i {
			color:<?php echo $bonfire_taptap_menu_icon_hover_color; ?>;
		}
		.taptap-by-bonfire .sub-menu a i {
			color:<?php echo $bonfire_taptap_submenu_icon_color; ?>;
			font-size:<?php echo get_option('bonfire_taptap_submenu_icon_size'); ?>px;
			margin-top:<?php echo get_option('bonfire_taptap_submenu_icon_alignment'); ?>px;
		}
		.taptap-by-bonfire .sub-menu a:hover i {
			color:<?php echo $bonfire_taptap_submenu_icon_hover_color; ?>;
		}

		/* background pattern */
		<?php if(get_option('bonfire_taptap_image_pattern')) { ?>
			.taptap-background-image {
				background-size:auto;
				background-repeat:repeat;
			}
		<?php } ?>

		/* horizontal alignment */
		<?php if(get_option('bonfire_taptap_horizontal_alignment') == "taptapalignleft") { ?>
			.taptap-heading,
			.taptap-subheading,
			.taptap-image,
			.taptap-by-bonfire ul li { text-align:left; }
		<?php } else if(get_option('bonfire_taptap_horizontal_alignment') == "taptapalignright") { ?>
			.taptap-heading,
			.taptap-subheading,
			.taptap-image,
			.taptap-by-bonfire ul li { text-align:right; clear:both; }
			.taptap-by-bonfire ul li a { float:right; }
			.taptap-by-bonfire .menu li span {
				position:relative;
				top:-1px;
				right:1px;
				border-left:none;
				border-right:1px solid #464D52;
			}
			.taptap-by-bonfire .sub-menu a {
				padding-top:5px;
			}
		<?php } ?>
		
		/* vertical alignment */
		<?php if(get_option('bonfire_taptap_vertical_alignment') == "taptapalignmiddle") { ?>
			.taptap-main-inner-inner { vertical-align:middle; }
		<?php } else if(get_option('bonfire_taptap_vertical_alignment') == "taptapalignbottom") { ?>
			.taptap-main-inner-inner { vertical-align:bottom; }
		<?php } ?>

		/* menu animations (top/left/right/bottom/fade) */
		<?php if(get_option('bonfire_taptap_menu_animation') == "taptaptop") { ?>
		<?php } else if(get_option('bonfire_taptap_menu_animation') == "taptapleft") { ?>
			.taptap-main-wrapper,
			.taptap-background-color,
			.taptap-background-image {
				-webkit-transform:translateY(0) translateX(-100%);
				-moz-transform:translateY(0) translateX(-100%);
				transform:translateY(0) translateX(-100%);
			}
			.taptap-main-wrapper-active,
			.taptap-background-color-active,
			.taptap-background-image-active {
				-webkit-transform:translateY(0) translateX(0);
				-moz-transform:translateY(0) translateX(0);
				transform:translateY(0) translateX(0);
			}
		<?php } else if(get_option('bonfire_taptap_menu_animation') == "taptapright") { ?>
			.taptap-main-wrapper,
			.taptap-background-color,
			.taptap-background-image {
				-webkit-transform:translateY(0) translateX(100%);
				-moz-transform:translateY(0) translateX(100%);
				transform:translateY(0) translateX(100%);
			}
			.taptap-main-wrapper-active,
			.taptap-background-color-active,
			.taptap-background-image-active {
				-webkit-transform:translateY(0) translateX(0);
				-moz-transform:translateY(0) translateX(0);
				transform:translateY(0) translateX(0);
			}
		<?php } else if(get_option('bonfire_taptap_menu_animation') == "taptapbottom") { ?>
			.taptap-main-wrapper,
			.taptap-background-color,
			.taptap-background-image {
				-webkit-transform:translateY(100%);
				-moz-transform:translateY(100%);
				transform:translateY(100%);
			}
			.taptap-main-wrapper-active,
			.taptap-background-color-active,
			.taptap-background-image-active {
				-webkit-transform:translateY(0);
				-moz-transform:translateY(0);
				transform:translateY(0);
			}
		<?php } else { ?>
			.taptap-background-color {
				opacity:0;
				
				-webkit-transition:opacity .4s ease, top 0s ease .4s;
				-moz-transition:opacity .4s ease, top 0s ease .4s;
				transition:opacity .4s ease, top 0s ease .4s;
			}
			.taptap-background-color-active {
				opacity:<?php if(get_option('bonfire_taptap_background_color_opacity')) { ?><?php echo get_option('bonfire_taptap_background_color_opacity'); ?><?php } else { ?>1<?php } ?>;
				
				-webkit-transition:opacity .4s ease, top 0s ease 0s;
				-moz-transition:opacity .4s ease, top 0s ease 0s;
				transition:opacity .4s ease, top 0s ease 0s;
			}
			.taptap-main-wrapper,
			.taptap-background-color,
			.taptap-background-image {
				-webkit-transform:translateY(0) translateX(0);
				-moz-transform:translateY(0) translateX(0);
				transform:translateY(0) translateX(0);
			}
			.taptap-main-wrapper-active,
			.taptap-background-color-active,
			.taptap-background-image-active {
				-webkit-transform:translateY(0) translateX(0);
				-moz-transform:translateY(0) translateX(0);
				transform:translateY(0) translateX(0);
			}
			.taptap-background-image { opacity:0; }
			.taptap-background-image-active { opacity:<?php if(get_option('bonfire_taptap_background_image_opacity')) { ?><?php echo get_option('bonfire_taptap_background_image_opacity'); ?><?php } else { ?>0.1<?php } ?>; }
		<?php } ?>
		
		/* background image horizontal + vertical alignment */
		.taptap-background-image {
			background-position:<?php if(get_option('bonfire_taptap_background_vertical_alignment') == "taptapbackgroundmiddle") { ?>center<?php } else if(get_option('bonfire_taptap_background_vertical_alignment') == "taptapbackgroundbottom") { ?>bottom<?php } else { ?>top<?php } ?> <?php if(get_option('bonfire_taptap_background_horizontal_alignment') == "taptapbackgroundleft") { ?>left<?php } else if(get_option('bonfire_taptap_background_horizontal_alignment') == "taptapbackgroundright") { ?>right<?php } else { ?>center<?php } ?>;
		}	
		
		/* menu button animations (-/X) */
		<?php if(get_option('bonfire_taptap_button_animation') == "taptapminusanimation") { ?>
			/* middle bar #1 animation (4 lines) */
			.taptap-menu-active .taptap-menu-button div.taptap-menu-button-middle:before {
				margin:0 0 -1px 0;
				width:28px;
			}
			/* middle bar #2 animation (4 lines) */
			.taptap-menu-active .taptap-menu-button div.taptap-menu-button-middle:after {
				margin:-1px 0 0 0;
			}
			
			/* top+bottom bar fade out (4 lines) */
			.taptap-menu-active .taptap-menu-button:before,
			.taptap-menu-active .taptap-menu-button:after {
				opacity:0;
				width:28px;
				
				-webkit-transition:all .25s ease;
				-moz-transition:all .25s ease;
				transition:all .25s ease;
			}
			/* middle bar #1 animation (3 lines) */
			.taptap-menu-active .taptap-menu-button-three div.taptap-menu-button-three-middle:before {
				margin:0 0 -1px 0;
			}
			
			/* top bar fade out (3 lines) */
			.taptap-menu-active .taptap-menu-button-three:before {
				opacity:0;
				
				-webkit-transform:translateY(8px);
				-moz-transform:translateY(8px);
				transform:translateY(8px);
				
				-webkit-transition:-webkit-transform .25s ease, opacity 0s ease .25s;
				-moz-transition:-moz-transform .25s ease, opacity 0s ease .25s;
				transition:transform .25s ease, opacity 0s ease .25s;
			}
			/* bottom bar fade out (3 lines) */
			.taptap-menu-active .taptap-menu-button-three:after {
				opacity:0;
				
				-webkit-transform:translateY(-7px);
				-moz-transform:translateY(-7px);
				transform:translateY(-7px);
				
				-webkit-transition:-webkit-transform .25s ease, opacity 0s ease .25s;
				-moz-transition:-moz-transform .25s ease, opacity 0s ease .25s;
				transition:transform .25s ease, opacity 0s ease .25s;
			}
		<?php } else if(get_option('bonfire_taptap_button_animation') == "taptapxanimation") { ?>
			/* top bar animation (4 lines) */
			.taptap-menu-active .taptap-menu-button:before {
				margin:5px 0 0 -2px;
				
				transform:translateY(9px) rotate(45deg);
				-moz-transform:translateY(9px) rotate(45deg);
				-webkit-transform:translateY(9px) rotate(45deg);
			}
			/* bottom bar animation (4 lines) */
			.taptap-menu-active .taptap-menu-button:after {
				margin:5px 0 0 -2px;
				width:28px;
				
				transform:translateY(-9px) rotate(-45deg);
				-moz-transform:translateY(-9px) rotate(-45deg);
				-webkit-transform:translateY(-9px) rotate(-45deg);
			}
			/* middle bars fade out (4 lines) */
			.taptap-menu-active div.taptap-menu-button-middle:before,
			.taptap-menu-active div.taptap-menu-button-middle:after {
				opacity:0;
				width:28px;
				
				-webkit-transition:all .2s ease;
				-moz-transition:all .2s ease;
				transition:all .2s ease;
			}
			/* top bar animation (3 lines) */
			.taptap-menu-active .taptap-menu-button-three:before {
				margin:4px 0 0 -2px;
				
				transform:translateY(8px) rotate(45deg);
				-moz-transform:translateY(8px) rotate(45deg);
				-webkit-transform:translateY(8px) rotate(45deg);
			}
			/* bottom bar animation (3 lines) */
			.taptap-menu-active .taptap-menu-button-three:after {
				margin:4px 0 0 -2px;
				
				transform:translateY(-8px) rotate(-45deg);
				-moz-transform:translateY(-8px) rotate(-45deg);
				-webkit-transform:translateY(-8px) rotate(-45deg);
			}
			/* middle bar fade out (3 lines) */
			.taptap-menu-active div.taptap-menu-button-three-middle:before {
				opacity:0;
				
				-webkit-transition:all .15s ease;
				-moz-transition:all .15s ease;
				transition:all .15s ease;
			}
		<?php } else { ?>
		<?php } ?>
		
		/* if submenu arrow divider is hidden */
		<?php if( get_option('bonfire_taptap_hide_submenu_divider') ) { ?>
		.taptap-by-bonfire .menu li span {
			border:none;
			<?php if(get_option('bonfire_taptap_horizontal_alignment') == "taptapalignright") { ?>
				margin-right:-3px;
			<?php } else { ?>
				margin-left:-3px;
			<?php } ?>
		}
		<?php } ?>
		
		/* hide taptap between resolutions */
		@media ( min-width:<?php echo get_option('bonfire_taptap_smaller_than'); ?>px) and (max-width:<?php echo get_option('bonfire_taptap_larger_than'); ?>px) {
			.taptap-menu-button-wrapper,
			.taptap-logo-wrapper,
			.tap-tap-header,
			.taptap-background-color,
			.taptap-background-image,
			.taptap-main-wrapper,
			.taptap-search-wrapper,
			.taptap-search-button,
			.taptap-search-button-right { display:none; }
			body { margin-top:0 !important; }
		}
		</style>
		<!-- END CUSTOM COLORS (WP THEME CUSTOMIZER) -->
	
	<?php
	}
	add_action('wp_footer','bonfire_taptap_header_customize');

?>