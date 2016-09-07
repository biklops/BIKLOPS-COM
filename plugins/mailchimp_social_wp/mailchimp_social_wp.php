<?php
/*
Plugin Name: MailChimp Social Wordpress
Plugin URI: http://mailchimpwp.rafaelferreira.pt
Description: Simple plugin and widget to subscribe your MailChimp newsletter via social networks!
Version: 1.4.3
Author: Rafael Ferreira
Author URI: http://www.gust.pt
License: CodeCanyon License
*/
$plugins_url = plugins_url();

class Mailchimp_Social_WP extends WP_Widget{

	const WIDGET_NAME = "MailChimp Social Wordpress";
	const WIDGET_DESCRIPTION = "Simple plugin and widget to subscribe your MailChimp newsletter via social networks!";
	const VERSION = '1.4.3';

	static $textdomain;
	var $fields;

	public function __construct(){
		global $plugins_url;
	
		//Initialize Settings
		require_once(sprintf("%s/admin.php", dirname(__FILE__)));
		$MailChimp_Social_WP_Settings = new MailChimp_Social_WP_Settings();

		//Add fields
		$this->add_field('title', 'Enter title:', 'Subscribe!', 'text');
		$this->add_field('width', 'Width:', '230px', 'text');
		$this->add_field('height', 'Height:', '300px', 'text');
		//Checks box's
		$this->add_field('facebooktrigger', 'Disable Facebook', '', 'checkbox');
		$this->add_field('googletrigger', 'Disable Google+', '', 'checkbox');
		$this->add_field('microsofttrigger', 'Disable Microsoft', '', 'checkbox');
		$this->add_field('linkedintrigger', 'Disable LinkedIn', '', 'checkbox');
		$this->add_field('vktrigger', 'Disable VK', '', 'checkbox');
		$this->add_field('emailtrigger', 'Disable email', '', 'checkbox');
		//Checks box's
		$this->add_field('extra_text', 'Extra text:', 'You agree to have your details collected in MailChimp by Subscribing.', 'text');
		$this->add_field('extra_text_color', 'Color of the extra text:', 'white', 'text');
		//Dropdown
		$this->add_field('button_class', 'Select button class:', array("btn-default", "btn-primary", "btn-success", "btn-info", "btn-warning", "btn-danger", "btn-link"), 'select');


		//Standart options
		if(!get_option('success_redirect_page') && !get_option('error_redirect_page') && !get_option('repeated_redirect_page') && !get_option('bad_email_redirect_page')){
			add_option('success_redirect_page', $plugins_url.'/mailchimp_social_wp/response/success.php', '', 'yes');
			add_option('error_redirect_page', $plugins_url.'/mailchimp_social_wp/response/error.php', '', 'yes');
			add_option('repeated_redirect_page', $plugins_url.'/mailchimp_social_wp/response/repeated.php', '', 'yes');
			add_option('bad_email_redirect_page', $plugins_url.'/mailchimp_social_wp/response/bad_email.php', '', 'yes');
		}

		#confirm data page
		if(!get_option('namefields_title')){
			add_option('namefields_title', 'Please confirm and fill the subscription form! :)', '', 'yes');
		}
		if(!get_option('namefields_fname')){
			add_option('namefields_fname', 'First Name', '', 'yes');
		}
		if(!get_option('namefields_lname')){
			add_option('namefields_lname', 'Last Name', '', 'yes');
		}
		if(!get_option('namefields_email')){
			add_option('namefields_email', 'Email', '', 'yes');
		}
		if(!get_option('namefields_subscribe_text')){
			add_option('namefields_subscribe_text', 'Subscribe to the mailing list!', '', 'yes');
		}
		if(!get_option('tooltip_has_fname')){
			add_option('tooltip_has_fname', 'We already collected your First Name, thank you! :)', '', 'yes');
		}
		if(!get_option('collected_via')){
			add_option('collected_via', 'Some of the data were collected via ', '', 'yes');
		}
		if(!get_option('tooltip_collect_fname')){
			add_option('tooltip_collect_fname', 'Please provide your First Name :)', '', 'yes');
		}
		if(!get_option('tooltip_has_lname')){
			add_option('tooltip_has_lname', 'We already collected your Last Name, thank you! :)', '', 'yes');
		}
		if(!get_option('tooltip_collect_lname')){
			add_option('tooltip_collect_lname', 'Please provide your Last Name :)', '', 'yes');
		}
		if(!get_option('tooltip_has_email')){
			add_option('tooltip_has_email', 'We already collected your email, thank you! :)', '', 'yes');
		}
		if(!get_option('tooltip_collect_email')){
			add_option('tooltip_collect_email', 'Please provide your email :)', '', 'yes');
		}
		if(!get_option('sellect_what_to_subscribe')){
			add_option('sellect_what_to_subscribe', 'Select what you want to subscribe:', '', 'yes');
		}
		if(!get_option('tooltip_has_birth_day')){
			add_option('tooltip_has_birth_day', 'We already collected your birthday day, thank you! :)', '', 'yes');
		}
		if(!get_option('tooltip_collect_birth_day')){
			add_option('tooltip_collect_birth_day', 'Please provide your birthday day :)', '', 'yes');
		}
		if(!get_option('tooltip_has_birth_month')){
			add_option('tooltip_has_birth_month', 'We already collected your birthday month, thank you! :)', '', 'yes');
		}
		if(!get_option('tooltip_collect_birth_month')){
			add_option('tooltip_collect_birth_month', 'Please provide your birthday month :)', '', 'yes');
		}
		if(!get_option('why_cant_get_birthday_popover')){
			add_option('why_cant_get_birthday_popover', 'Facebook: Your privacy settings do not allow us to get it; Google: Please go to your Google+ Profile and edit the privacy settings of your birthday; Microsoft: Please go to your Microsoft account and then to your Messenger settings and fill your birthday', '', 'yes');
		}
		if(!get_option('why_cant_get_birthday_ask')){
			add_option('why_cant_get_birthday_ask', 'Why we can\'t get your birthday?', '', 'yes');
		}

		if(!get_option('extra_text_embed')){
			add_option('extra_text_embed', 'You agree to have your details collected in MailChimp by Subscribing', '', 'yes');
		}
		if(!get_option('iframe_width') || !get_option('iframe_height')){
			add_option('iframe_width', '230px', '', 'yes');
			add_option('iframe_height', '300px', '', 'yes');
		}
		if(!get_option('extra_text_embed')){
			add_option('extra_text_embed', 'You agree to have your details collected in MailChimp by Subscribing', '', 'yes');
		}
		if(!get_option('extra_text_color')){
			add_option('extra_text_color', 'white', '', 'yes');
		}
		if(!get_option('iframe_button_color')){
			add_option('iframe_button_color', 'btn-primary', '', 'yes');
		}
		if(!get_option('iframe_theme')){
			add_option('iframe_theme', '1', '', 'yes');
		}

		if(!get_option('popovers-iframe_width') || !get_option('popovers-iframe_height')){
			add_option('popovers-iframe_width', '230px', '', 'yes');
			add_option('popovers-iframe_height', '300px', '', 'yes');
		}
		if(!get_option('popovers-extra_text_embed')){
			add_option('popovers-extra_text_embed', 'You agree to have your details collected in MailChimp by Subscribing', '', 'yes');
		}
		if(!get_option('popovers-extra_text_color')){
			add_option('popovers-extra_text_color', 'white', '', 'yes');
		}
		if(!get_option('popovers-iframe_button_color')){
			add_option('popovers-iframe_button_color', 'btn-primary', '', 'yes');
		}

		$array_front = array("txt-title" => "Subscribe to the Mailing List", "txt-facebook_label" => "Subscribe with Facebook",
                "txt-google_label" => "Subscribe with Google+", "txt-outlook_label" => "Subscribe with Outlook", "txt-linkedin_label" => "Subscribe with LinkedIn", "txt-vk_label" => "Subscribe with VK",
                "txt-email_label" => "Email Address", "txt-subscribe_label" => "Subscribe");
        $array_response = array("txt-title_response" => "Subscribe our newsletter!", "txt-its_free" => "We Promise to Not Spam You",
                "txt-email_wrong" => "Please re-check your e-mail", "txt-someting_went_wrong" => "An error occurred, we have been notified. Sorry!",
                "txt-already_subscribed" => "You are already subscribed", "txt-thank_you" => "Thanks!",
                "txt-greeting" => "Thank you for subscribing!", "txt-please_confirm" => "Please confirm your email!");

		/* DEFAULT VALUES OF TEXT */
		foreach ($array_front as $key => $value) {
			if(!get_option($key)){
				add_option($key, $value, '', 'yes');
			}
		}
		foreach ($array_response as $key => $value) {
			if(!get_option($key)){
				add_option($key, $value, '', 'yes');
			}
		}

		//Settings
		$plugin = plugin_basename(__FILE__);
		add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));

		self::$textdomain = strtolower(get_class($this));
		//Translations
		load_plugin_textdomain(self::$textdomain, false, basename(dirname(__FILE__)) . '/languages' );

		//Init the widget
		add_shortcode('social_wp', array($this,'embed_output'));
		add_shortcode('mailchimp_social_wp_popovers', array($this,'popovers_output'));
		parent::__construct(self::$textdomain, __(self::WIDGET_NAME, self::$textdomain), array( 'description' => __(self::WIDGET_DESCRIPTION, self::$textdomain), 'classname' => self::$textdomain));
	}

	function plugin_settings_link($links){
		$settings_link = '<a href="options-general.php?page=mailchimp_social_wp">Settings</a>';
		array_unshift($links, $settings_link);
		return $links;
	}

	private function add_field($field_name, $field_description = '', $field_default_value = '', $field_type = 'text'){
		if(!is_array($this->fields))
			$this->fields = array();
		$this->fields[$field_name] = array('name' => $field_name, 'description' => $field_description, 'default_value' => $field_default_value, 'type' => $field_type);
	}

	public function widget($args, $instance){
		$title = apply_filters('widget_title', $instance['title']);

		$output = $args['before_widget'];

		if (!empty($title))
			if(get_option('enable_languages')){
				$output .= $args['before_title'] . __('Subscribe our newsletter!', self::$textdomain) . $args['after_title'];
			}else{
				$output .= $args['before_title'] . $title . $args['after_title'];
			}

		$output .= $this->widget_output($args, $instance);

		echo $output .= $args['after_widget'];
	}

	public static function getLanguage(){
		if(get_option('enable_languages')):
			return 	array(
						"title_tb" => __('Subscribe our newsletter!', self::$textdomain),
						"facebook_label" => __('Subscribe with Facebook', self::$textdomain),
						"google_label" => __('Subscribe with Google+', self::$textdomain),
						"outlook_label" => __('Subscribe with Outlook', self::$textdomain),
						"linkedin_label" => __('Subscribe with LinkedIn', self::$textdomain),
						"vk_label" => __('Subscribe with VK', self::$textdomain),
						"email_label" => __('Email Address', self::$textdomain),
						"subscribe_label" => __('Subscribe!', self::$textdomain),
						"extra_text" => __('At subscribe you agree that I collect your email to MailChimp.', self::$textdomain)
			);
		else:
        	return 	array(
						"title_tb" => get_option('txt-title'),
						"facebook_label" => get_option('txt-facebook_label'),
						"google_label" => get_option('txt-google_label'),
						"outlook_label" => get_option('txt-outlook_label'),
						"linkedin_label" => get_option('txt-linkedin_label'),
						"vk_label" => get_option('txt-vk_label'),
						"email_label" => get_option('txt-email_label'),
						"subscribe_label" => get_option('txt-subscribe_label')
			);
		endif;
	}

	public static function getResponseLanguage(){
		if(get_option('enable_languages')):
			return array(
						"title" => __('Subscribe our newsletter!', self::$textdomain),
						"its_free" => __('It\'s free!', self::$textdomain),
						"email_wrong" => __('Your email is wrong!', self::$textdomain),
						"someting_went_wrong" => __('Something went wrong! Sorry!', self::$textdomain),
						"already_subscribed" => __('You have already subscribe our newsletter!', self::$textdomain),
						"please_confirm" => __('Please confirm your email!', self::$textdomain),
						"thank_you" => __('Thank you!', self::$textdomain),
						"greeting" => __('Thank you for subscribe our newsletter!', self::$textdomain)
			);
		else:
			return array(
						"title" => get_option('txt-title_response'),
						"its_free" => get_option('txt-its_free'),
						"email_wrong" => get_option('txt-email_wrong'),
						"someting_went_wrong" => get_option('txt-someting_went_wrong'),
						"already_subscribed" => get_option('txt-already_subscribed'),
						"please_confirm" => get_option('txt-please_confirm'),
						"thank_you" => get_option('txt-thank_you'),
						"greeting" => get_option('txt-greeting')
			);
        endif;
	}

	public static function getNameFieldsLanguage(){
		if(get_option('enable_languages')):
			return array(
						"title" => __('Please confirm and fill the subscription form! :)', self::$textdomain),
						"fname" => __('First Name', self::$textdomain),
						"lname" => __('Last Name', self::$textdomain),
						"email" => __('Email', self::$textdomain),
						"collected_via" => __('Some of the data were collected via ', self::$textdomain),
						"tooltip_has_fname" => __('We already collected your First Name, thank you! :)', self::$textdomain),
						"tooltip_collect_fname" => __('Please provide your First Name :)', self::$textdomain),
						"tooltip_has_lname" => __('We already collected your Last Name, thank you! :)', self::$textdomain),
						"tooltip_collect_lname" => __('Please provide your Last Name :)', self::$textdomain),
						"tooltip_has_email" => __('We already collected your email, thank you! :)', self::$textdomain),
						"tooltip_collect_email" => __('Please provide your email :)', self::$textdomain),
						"sellect_what_to_subscribe" => __('Select what you want to subscribe:', self::$textdomain),
						"tooltip_has_birth_day" => __('We already collected your birthday day, thank you! :)', self::$textdomain),
						"tooltip_collect_birth_day" => __('Please provide your birthday day :)', self::$textdomain),
						"tooltip_has_birth_month" => __('We already collected your birthday month, thank you! :)', self::$textdomain),
						"tooltip_collect_birth_month" => __('Please provide your birthday month :)', self::$textdomain),
						"why_cant_get_birthday_popover" => __('Facebook: Your privacy settings do not allow us to get it; Google: Please go to your Google+ Profile and edit the privacy settings of your birthday; Microsoft: Please go to your Microsoft account and then to your Messenger settings and fill your birthday', self::$textdomain),
						"why_cant_get_birthday_ask" => __('Why we can\'t get your birthday?', self::$textdomain),
 						"subscribe_text" => __('Subscribe to the mailing list!', self::$textdomain),
			);
		else:
			return array(
						"title" => get_option('namefields_title'),
						"fname" => get_option('namefields_fname'),
						"lname" => get_option('namefields_lname'),
						"email" => get_option('namefields_email'),
						"collected_via" => get_option('collected_via'),
						"tooltip_has_fname" => get_option('tooltip_has_fname'),
						"tooltip_collect_fname" => get_option('tooltip_collect_fname'),
						"tooltip_has_lname" => get_option('tooltip_has_lname'),
						"tooltip_collect_lname" => get_option('tooltip_collect_lname'),
						"tooltip_has_email" => get_option('tooltip_has_email'),
						"tooltip_collect_email" => get_option('tooltip_collect_email'),
						"sellect_what_to_subscribe" => get_option('sellect_what_to_subscribe'),
						"tooltip_has_birth_day" => get_option('tooltip_has_birth_day'),
						"tooltip_collect_birth_day" => get_option('tooltip_collect_birth_day'),
						"tooltip_has_birth_month" => get_option('tooltip_has_birth_month'),
						"tooltip_collect_birth_month" => get_option('tooltip_collect_birth_month'),
						"why_cant_get_birthday_popover" => get_option('why_cant_get_birthday_popover'),
						"why_cant_get_birthday_ask" => get_option('why_cant_get_birthday_ask'),
						"subscribe_text" => get_option('namefields_subscribe_text'),
			);
        endif;
	}

	public function widget_output($args, $instance){
		global $plugins_url;
		extract($instance);
		if(!isset($facebooktrigger) || !isset($googletrigger) || !isset($microsofttrigger) || !isset($linkedintrigger) || !isset($emailtrigger)){

			$services = array();
			if(!isset($facebooktrigger)){
				$services["facebooktrigger"] = "d";
			}
			if(!isset($googletrigger)){
				$services["googletrigger"] = "d";
			}
			if(!isset($linkedintrigger)){
				$services["linkedintrigger"] = "d";
			}
			if(!isset($microsofttrigger)){
				$services["microsofttrigger"] = "d";
			}
			if(!isset($vktrigger)){
				$services["vktrigger"] = "d";
			}
			if(!isset($emailtrigger)){
				$services["emailtrigger"] = "d";
			}
			
			$output_texts = $this->getLanguage();
			$options["iframe_button_color"] = $button_class;
			$options["iframe_extra_text_color"] = $extra_text_color;

			$base_url = $plugins_url;

			$scripts = "<script src=\"".$plugins_url."/mailchimp_social_wp/templates/css/iframes/jquery.responsiveiframe.js\"></script>
						<script>
						  ;(function($){          
						      $(function(){
						        $('#widget_iframe').responsiveIframe();
						      });        
						  })(jQuery);
						</script>";

			return $scripts."<iframe id=\"widget_iframe\" src=\"".$plugins_url."/mailchimp_social_wp/widget.php?iframe=6&services=".base64_encode(json_encode($services))."&extra_text=".urlencode($extra_text)."&ot=".base64_encode(json_encode($output_texts))."&o=".base64_encode(json_encode($options))."&u=".urlencode($base_url)."\" class=\"iframe\" allowtransparency=\"true\" height=\"".$height."\" style=\"width: 100%; padding: 0px; margin: 0px; border: none; display: block;\" scrolling=\"no\" frameborder=\"0\"></iframe>";
		}
	}

	public function embed_output(){
		global $plugins_url;
		
		$services = array();
		if(!get_option("facebooktrigger")){
			$services["facebooktrigger"] = "d";
		}
		if(!get_option("googletrigger")){
			$services["googletrigger"] = "d";
		}
		if(!get_option("linkedintrigger")){
			$services["linkedintrigger"] = "d";
		}
		if(!get_option("vktrigger")){
			$services["vktrigger"] = "d";
		}
		if(!get_option("microsofttrigger")){
			$services["microsofttrigger"] = "d";
		}
		if(!get_option("emailtrigger")){
			$services["emailtrigger"] = "d";
		}
			
		$output_texts = $this->getLanguage();

		$options["iframe_button_color"] = get_option('iframe_button_color');
		$options["iframe_extra_text_color"] = get_option('iframe_extra_text_color');

		$base_url = $plugins_url;
		$unique_id = uniqid();

		$scripts = "<script src=\"".$plugins_url."/mailchimp_social_wp/templates/css/iframes/jquery.responsiveiframe.js\"></script>
						<script>
						  ;(function($){          
						      $(function(){
						        $('#".$unique_id."').responsiveIframe();
						      });        
						  })(jQuery);
						</script>";
		return "<iframe id=\"".$unique_id."\" src=\"".$plugins_url."/mailchimp_social_wp/iframe.php?iframe=".get_option('iframe_theme')."&services=".base64_encode(json_encode($services))."&extra_text=".urlencode(get_option('extra_text_embed'))."&ot=".base64_encode(json_encode($output_texts))."&o=".base64_encode(json_encode($options))."&u=".urlencode($base_url)."\" class=\"iframe\" allowtransparency=\"true\" width=\"".get_option('iframe_width')."\" height=\"".get_option('iframe_height')."\" scrolling=\"no\" frameborder=\"0\"></iframe>";
	}

	public function popovers_output(){
		global $plugins_url;
		
		$services = array();
		if(!get_option("popovers-facebooktrigger")){
			$services["facebooktrigger"] = "d";
		}
		if(!get_option("popovers-googletrigger")){
			$services["googletrigger"] = "d";
		}
		if(!get_option("popovers-linkedintrigger")){
			$services["linkedintrigger"] = "d";
		}
		if(!get_option("popovers-microsofttrigger")){
			$services["microsofttrigger"] = "d";
		}
		if(!get_option("popovers-vktrigger")){
			$services["vktrigger"] = "d";
		}
		if(!get_option("popovers-emailtrigger")){
			$services["emailtrigger"] = "d";
		}
		$output_texts = $this->getLanguage();

		$options["iframe_button_color"] = get_option('popovers-iframe_button_color');
		$options["iframe_extra_text_color"] = get_option('popovers-iframe_extra_text_color');

		$base_url = $plugins_url;
		$unique_id = uniqid();

		$scripts = "<script src=\"".$plugins_url."/mailchimp_social_wp/templates/css/iframes/jquery.responsiveiframe.js\"></script>
						<script>
						  ;(function($){          
						      $(function(){
						        $('#".$unique_id."').responsiveIframe();
						      });        
						  })(jQuery);
						</script>";
		return "<iframe id=\"".$unique_id."\" src=\"".$plugins_url."/mailchimp_social_wp/popovers.php?&services=".base64_encode(json_encode($services))."&extra_text=".urlencode(get_option('popovers-extra_text_embed'))."&ot=".base64_encode(json_encode($output_texts))."&o=".base64_encode(json_encode($options))."&u=".urlencode($base_url)."\" class=\"iframe\" allowtransparency=\"true\" width=\"".get_option('popovers-iframe_width')."\" height=\"".get_option('popovers-iframe_height')."\" scrolling=\"no\" frameborder=\"0\"></iframe>";
	}

	public function form($instance){
		foreach($this->fields as $field_name => $field_data){
			if($field_data['type'] === 'text'):
			?>
				<p>
					<label for="<?php echo $this->get_field_id($field_name); ?>"><?php _e($field_data['description'], self::$textdomain ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id($field_name); ?>" name="<?php echo $this->get_field_name($field_name); ?>" type="text" value="<?php echo esc_attr(isset($instance[$field_name]) ? $instance[$field_name] : $field_data['default_value']); ?>" />
				</p>
			<?php
			elseif($field_data['type'] === 'checkbox'):
				if(isset($instance[$field_name]) && $instance[$field_name] == "on"){
					$check = "checked";
				}else{
					$check = "";
				}
			?>
				<p>
				    <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id($field_name); ?>" name="<?php echo $this->get_field_name($field_name); ?>" <?=$check?>/>
				    <label for="<?php echo $this->get_field_id($field_name); ?>"><?=$field_data['description']?></label>
				</p>
			<?php
			elseif($field_data['type'] === 'select'):
			?>
			<p>
				<label for="<?php echo $this->get_field_id($field_name); ?>"><?php echo $field_data['description'] ?></label>
				<select name="<?php echo $this->get_field_name($field_name); ?>" id="<?php echo $this->get_field_id($field_name); ?>" class="widefat">
					<?php
					foreach ($field_data['default_value'] as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $instance[$field_name] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
					?>
				</select>
			</p>
			<?php
			else:
				echo __('Error - Field type not supported', self::$textdomain) . ': ' . $field_data['type'];
			endif;
		}
	}

	public function update($new_instance, $old_instance){
		return $new_instance;
	}
	
	private static function curlHttpRequest($url, $method = "get", $request_fields = array()) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

		if($method == "post"){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request_fields);
		}else if($method == "get"){
			curl_setopt($ch, CURLOPT_HTTPGET, true);
		}else if($method == "del"){
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		}

		return curl_exec($ch);
	}

	public static function sendError($error = "", $file = "", $line = ""){
		$erro["description"] = $error;
		$erro["file"] = $file;
		$erro["line"] = $line;

		$array['error_details'] = json_encode($erro);
		
		$array['version'] = self::version();
		$array['website'] = get_site_url();
		$array['product'] = "mailchimp_social_wp";
		
		self::curlHttpRequest("http://codecanyon.rafaelferreira.pt/registry/count/error.json", "post", $array);
	}

	public static function version(){
		return self::VERSION;
	}

	public static function php_version(){
		return version_compare(phpversion(), '5.2.17', '>=');
	}

	public static function activation() {
		/* verify PHP version */
		if(!self::php_version()){
			exit("MailChimp Social Wordpress requires at least PHP version 5.2.17! Please go to your hosting settings and change your PHP Version!");
		}
		/* verify if cURL is active */
		if(!function_exists('curl_version')){
			exit("cURL is not active! Please contact your hosting support to activate.");
		}
		/* only statistic to prevent illegal copies */
		$version = get_plugin_data(__FILE__);
		if(isset($version)){
			$version = $version['Version'];
		}else{
			self::version();
		}
		/* email for support issues */
		$current_user = wp_get_current_user();
		$ctx = stream_context_create(array('http' => array('timeout' => 50)));
		@file_get_contents("http://codecanyon.rafaelferreira.pt/registry/count/make.json?product=mailchimp_wp&website=".get_site_url()."&version=".$version."&email=".@$current_user->user_email, 0, $ctx);
	}
}

register_activation_hook(__FILE__, array('Mailchimp_Social_WP', 'activation'));
add_action('widgets_init', create_function('', 'return register_widget("Mailchimp_Social_WP");'));

$ctx = stream_context_create(array('http' => array('timeout' => 50)));
$version = @json_decode(@file_get_contents("http://codecanyon.rafaelferreira.pt/registry/count/newest_version.json", 0, $ctx));

if(isset($version->version) && Mailchimp_Social_WP::version()!=$version->version){
	add_action('admin_notices', 'update_notice');
}
if(!is_bool(plugin_ready())){
	add_action('admin_notices', 'plugin_configuration_missing');
}
function update_notice() {
	echo '<div class="updated"><p>New version of MailChimp Social WP is available at CodeCanyon, please go to your <a href="http://www.codecanyon.net/downloads">downloads!</a></p></div>';
}
function plugin_configuration_missing() {
	echo '<div class="error"><p>'.plugin_ready().'</p></div>';
}
function plugin_ready(){
	$help = "Do you need help? Go <a href=\"options-general.php?page=mailchimp_social_wp&tab=help\">here</a>";
	$text = "You are using subscription via %s but are missing %s app details! ".$help;

	if(!get_option("Mailchimp_ApiKey") || !get_option("Mailchimp_ListID")){
		return "Please configure your Mailchimp details! ".$help;
	}
	if((get_option("google_app_client_id") && !get_option("google_redirect_uri")) ||
	   (!get_option("google_app_client_id") && get_option("google_client_secret")) ||
	   (!get_option("google_client_secret") && get_option("google_redirect_uri"))){
		return sprintf($text, "Google", "Google");
	}
	if(get_option("facebook_appid")  xor get_option("facebook_appsecret")){
		return sprintf($text, "Facebook", "Facebook");
	}
	if((get_option("microsoft_client_secret") && !get_option("microsoft_response_url")) ||
	   (!get_option("microsoft_client_secret") && get_option("microsoft_client_id")) ||
	   (!get_option("microsoft_client_id") && get_option("microsoft_response_url"))){
		return sprintf($text, "Microsoft", "Microsoft");
	}
	return true;
}