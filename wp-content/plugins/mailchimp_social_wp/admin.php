<?php
if(!class_exists('MailChimp_Social_WP_Settings')):
require_once("app/classes/MailChimp/mailchimp.php");
require_once("app/classes/Handling.class.php");

class MailChimp_Social_WP_Settings{
		public function __construct(){
			add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		}

        public function admin_init(){
            $merge_array = Handling::make_merge_tags();
            $keys = array_keys($merge_array);

            $settings = array('mailchimp_social_wp-plugin_set-group' => (array_merge(array('success_redirect_page', 'error_redirect_page', 'repeated_redirect_page', 'bad_email_redirect_page', 'enable_groupings', 'disable_namefields', 'disable_birthday', 'confirm_form', 'confirm_facebook', 'confirm_google', 'confirm_microsoft', 'confirm_linkedin', 'confirm_vk'),
                $keys)),
                'mailchimp_social_wp-social-group' => array('facebook_appid', 'facebook_appsecret', 'facebook_redirect_url', 'Mailchimp_ApiKey', 'Mailchimp_ListID', 'google_app_client_id', 'google_client_secret', 'google_redirect_uri', 'linkedin_api_key', 'linkedin_api_secret', 'linkedin_callback_url', 'microsoft_client_secret', 'microsoft_client_id', 'microsoft_response_url', 'vk_app_id', 'vk_callback_url', 'vk_api_secret'),
                'mailchimp_social_wp-popovers-group' => array('popovers-facebooktrigger', 'popovers-googletrigger', 'popovers-microsofttrigger', 'popovers-linkedintrigger', 'popovers-emailtrigger', 'popovers-vktrigger', 'popovers-iframe_width', 'popovers-iframe_height', 'popovers-extra_text_embed', 'popovers-iframe_extra_text_color', 'popovers-iframe_button_color'),
                'mailchimp_social_wp-embed-group' => array('facebooktrigger', 'googletrigger', 'microsofttrigger', 'linkedintrigger', 'vktrigger', 'emailtrigger', 'iframe_width', 'iframe_height', 'extra_text_embed', 'iframe_extra_text_color', 'iframe_button_color', 'iframe_theme'),
                'mailchimp_social_wp-language-group' => array('enable_languages')
            );

            foreach ($settings as $group => $array_settings) {
                foreach ($array_settings as $setting) {
                    register_setting($group, $setting);
                }
            }

            //-------------------------------------------------------------------------
            $array_front = array("txt-title" => "Title (embed)", "txt-facebook_label" => "Facebook label",
                "txt-google_label" => "Google label", "txt-outlook_label" => "Outlook label", "txt-linkedin_label" => "LinkedIn label", "txt-vk_label" => "VK label",
                "txt-email_label" => "E-mail label", "txt-subscribe_label" => "Subscribe label");
            $array_response = array("txt-title_response" => "Title response", "txt-its_free" => "It's free",
                "txt-email_wrong" => "E-mail wrong", "txt-someting_went_wrong" => "Something went wrong",
                "txt-already_subscribed" => "Already subscribed", "txt-thank_you" => "Thank you",
                "txt-greeting" => "Text greeting", "txt-please_confirm" => "Please confirm your email!");
            $array_namefields = array("namefields_title" => "Title", "namefields_fname" => "First Name",
                "namefields_lname" => "Last Name", "namefields_email" => "E-mail",
                "namefields_subscribe_text" => "Subscribe", "collected_via" => "Collected via", "tooltip_has_fname" => "Tooltip has Fist Name", "tooltip_collect_fname" => "Tooltip collect First Name", "tooltip_has_lname" => "Tooltip has Last Name", "tooltip_collect_lname" => "Tooltip collect Last Name",
                        "tooltip_has_email" => "Tooltip has email", "tooltip_collect_email" => "Tooltip collect email", "sellect_what_to_subscribe" => "Select what to subscribe",
                        "tooltip_has_birth_day" => "Tooltip has birthday day",
                        "tooltip_collect_birth_day" => "Tooltip collect birthday day",
                        "tooltip_has_birth_month" => "Tooltip has birthday month",
                        "tooltip_collect_birth_month" => "Tooltip collect birth month",
                        "why_cant_get_birthday_popover" => "Why can't get birthday popover",
                        "why_cant_get_birthday_ask" => "Why can't get birthday ask");

            foreach ($array_front as $key => $value) {
                register_setting('mailchimp_social_wp-text-group', $key);
            }
            foreach ($array_response as $key => $value) {
                register_setting('mailchimp_social_wp-text-group', $key);
            }
            foreach ($array_namefields as $key => $value) {
                register_setting('mailchimp_social_wp-text-group', $key);
            }
            //-------------------------------------------------------------------------

            /* SOCIAL TAB */
            add_settings_section(
                'mailchimp_social_wp_facebook-section',
                'Facebook',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-social'
            );
            add_settings_section(
                'mailchimp_social_wp_mailchimp-section',
                'MailChimp',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-social'
            );
            add_settings_section(
                'mailchimp_social_wp_google-section',
                'Google',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-social'
            );
            add_settings_section(
                'mailchimp_social_wp_linkedin-section',
                'LinkedIn',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-social'
            );
            add_settings_section(
                'mailchimp_social_wp_microsoft-section',
                'Microsoft',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-social'
            );
            add_settings_section(
                'mailchimp_social_wp_vk-section',
                'VK',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-social'
            );
            /* SOCIAL TAB */
            /* EMBED CODE TAB */
            add_settings_section(
                'mailchimp_social_wp_enable_iframe_widget-section',
                'Size',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-embed'
            );
            add_settings_section(
                'mailchimp_social_wp_embed-section',
                'Disable services of the embed code',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-embed'
            );
            add_settings_section(
                'mailchimp_social_wp_embed_extra_text-section',
                'Extra text',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-embed'
            );
            add_settings_section(
                'mailchimp_social_wp_embed_theme-section',
                'Theme',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-embed'
            );
            /* EMBED CODE TAB */
            /* POP OVERS TAB */
            add_settings_section(
                'mailchimp_social_wp_size_popovers-section',
                'Size',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-popovers'
            );
            add_settings_section(
                'mailchimp_social_wp_disable_services_popovers-section',
                'Disable services',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-popovers'
            );
            add_settings_section(
                'mailchimp_social_wp_popovers_extra_text-section',
                'Extra text',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-popovers'
            );
            add_settings_section(
                'mailchimp_social_wp_popovers_theme-section',
                'Theme',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-popovers'
            );
            /* POP OVERS TAB */
            /* PLUGIN SETTINGS TAB */
            add_settings_section(
                'mailchimp_social_wp_groupings-section',
                'Groupings',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-plugin_set'
            );
            add_settings_section(
                'mailchimp_social_wp_name_fields-section',
                'List fields and *|MERGE|* tags',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-plugin_set'
            );
            add_settings_section(
                'mailchimp_social_wp_double-section',
                'Double Opt-in Confirmation',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-plugin_set'
            );
            add_settings_section(
                'mailchimp_social_wp_redirect-section',
                'Response redirect links',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-plugin_set'
            );
            /* PLUGIN SETTINGS TAB */
            /* LANGUAGE TAB */
            add_settings_section(
                'mailchimp_social_wp_enable_language-section',
                'Enable language support',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-language'
            );
            /* LANGUAGE TAB */
            /* TEXT TAB */
            add_settings_section(
                'mailchimp_social_wp_txt-front-section',
                'Widgets/Iframe text',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-text'
            );
            add_settings_section(
                'mailchimp_social_wp_txt-namefields-section',
                'Confirmation data page',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-text'
            );
            add_settings_section(
                'mailchimp_social_wp_txt-response-section',
                'Response text',
                array(&$this, 'after_section_title'),
                'mailchimp_social_wp-text'
            );
            /* TEXT TAB */

            //Selection boxs
            $this->new_checkbox_setting('facebooktrigger', 'Facebook subscription not available', 'mailchimp_social_wp_embed', 'embed');
            $this->new_checkbox_setting('googletrigger', 'Google subscription not available', 'mailchimp_social_wp_embed', 'embed');
            $this->new_checkbox_setting('microsofttrigger', 'Microsoft subscription not available', 'mailchimp_social_wp_embed', 'embed');
            $this->new_checkbox_setting('linkedintrigger', 'LinkedIn subscription not available', 'mailchimp_social_wp_embed', 'embed');
            $this->new_checkbox_setting('vktrigger', 'VK subscription not available', 'mailchimp_social_wp_embed', 'embed');
            $this->new_checkbox_setting('emailtrigger', 'E-mail subscription not available', 'mailchimp_social_wp_embed', 'embed');
            /* POP OVERS Selection boxs */
            $this->new_checkbox_setting('popovers-facebooktrigger', 'Facebook subscription not available', 'mailchimp_social_wp_disable_services_popovers', 'popovers');
            $this->new_checkbox_setting('popovers-googletrigger', 'Google subscription not available', 'mailchimp_social_wp_disable_services_popovers', 'popovers');
            $this->new_checkbox_setting('popovers-microsofttrigger', 'Microsoft subscription not available', 'mailchimp_social_wp_disable_services_popovers', 'popovers');
            $this->new_checkbox_setting('popovers-vktrigger', 'VK subscription not available', 'mailchimp_social_wp_disable_services_popovers', 'popovers');
            $this->new_checkbox_setting('popovers-linkedintrigger', 'LinkedIn subscription not available', 'mailchimp_social_wp_disable_services_popovers', 'popovers');
            $this->new_checkbox_setting('popovers-emailtrigger', 'E-mail subscription not available', 'mailchimp_social_wp_disable_services_popovers', 'popovers');
            /* POP OVERS Selection boxs */
            //Groupings($id, $name, $section, $tab)
            $this->new_checkbox_setting('enable_groupings', 'Enable groupings', 'mailchimp_social_wp_groupings', 'plugin_set', '');
            //name fields
            $this->new_checkbox_setting('disable_namefields', 'Disable collect the First and Last name', 'mailchimp_social_wp_name_fields', 'plugin_set', '');
            $this->new_checkbox_setting('disable_birthday', 'Disable collect the Birthday', 'mailchimp_social_wp_name_fields', 'plugin_set', '');
            foreach ($merge_array as $key => $value) {
                $this->new_checkbox_setting($key, 'Enable collect the field "'.$value["name"].'"', 'mailchimp_social_wp_name_fields', 'plugin_set', '');
            }
            
            #confirmations
            $this->new_checkbox_setting('confirm_form', 'Don\'t send Opt-In Confirmation Email for form', 'mailchimp_social_wp_double', 'plugin_set', '');
            $this->new_checkbox_setting('confirm_facebook', 'Send Opt-In Confirmation Email for Facebook', 'mailchimp_social_wp_double', 'plugin_set', '');
            $this->new_checkbox_setting('confirm_google', 'Send Opt-In Confirmation Email for Google', 'mailchimp_social_wp_double', 'plugin_set', '');
            $this->new_checkbox_setting('confirm_microsoft', 'Send Opt-In Confirmation Email for Microsoft', 'mailchimp_social_wp_double', 'plugin_set', '');
            $this->new_checkbox_setting('confirm_linkedin', 'Send Opt-In Confirmation Email for LinkedIn', 'mailchimp_social_wp_double', 'plugin_set', '');
            $this->new_checkbox_setting('confirm_vk', 'Send Opt-In Confirmation Email for VK', 'mailchimp_social_wp_double', 'plugin_set', '');

            //Response redirect links
            $this->new_field_setting('success_redirect_page', 'Success redirect page', 'mailchimp_social_wp_redirect', 'plugin_set');
            $this->new_field_setting('error_redirect_page', 'Error redirect page', 'mailchimp_social_wp_redirect', 'plugin_set');
            $this->new_field_setting('repeated_redirect_page', 'Repeated redirect page', 'mailchimp_social_wp_redirect', 'plugin_set');
            $this->new_field_setting('bad_email_redirect_page', 'Bad email redirect page', 'mailchimp_social_wp_redirect', 'plugin_set');
            //FACEBOOK, GOOGLE, HOTMAIL, MAILCHIMP
            $this->new_field_setting('facebook_appid', 'Facebook APP ID', 'mailchimp_social_wp_facebook', 'social');
            $this->new_field_setting('facebook_appsecret', 'Facebook APP Secret', 'mailchimp_social_wp_facebook', 'social');
            $this->new_field_setting('facebook_redirect_url', 'Facebook Redirect URL', 'mailchimp_social_wp_facebook', 'social');
            //MailChimp
            $this->new_field_setting('Mailchimp_ApiKey', 'MailChimp API Key', 'mailchimp_social_wp_mailchimp', 'social');
            //Google
            $this->new_field_setting('google_app_client_id', 'Google Client ID', 'mailchimp_social_wp_google', 'social');
            $this->new_field_setting('google_client_secret', 'Google Client Secret', 'mailchimp_social_wp_google', 'social');
            $this->new_field_setting('google_redirect_uri', 'Google Redirect URI', 'mailchimp_social_wp_google', 'social');
            //LinkedIn
            $this->new_field_setting('linkedin_api_key', 'LinkedIn API Key', 'mailchimp_social_wp_linkedin', 'social');
            $this->new_field_setting('linkedin_api_secret', 'LinkedIn API Secret', 'mailchimp_social_wp_linkedin', 'social');
            $this->new_field_setting('linkedin_callback_url', 'LinkedIn Callback URL', 'mailchimp_social_wp_linkedin', 'social');
            //VK
            $this->new_field_setting('vk_app_id', 'VK APP ID', 'mailchimp_social_wp_vk', 'social');
            $this->new_field_setting('vk_api_secret', 'VK API Secret', 'mailchimp_social_wp_vk', 'social');
            $this->new_field_setting('vk_callback_url', 'VK Callback URL', 'mailchimp_social_wp_vk', 'social');
            //Microsoft
            $this->new_field_setting('microsoft_client_secret', 'Microsoft Client Secret', 'mailchimp_social_wp_microsoft', 'social');
            $this->new_field_setting('microsoft_client_id', 'Microsoft Client ID', 'mailchimp_social_wp_microsoft', 'social');
            $this->new_field_setting('microsoft_response_url', 'Microsoft Response URL', 'mailchimp_social_wp_microsoft', 'social');
            //Text - response
            foreach ($array_front as $key => $value) {
                $this->new_field_setting($key, $value, 'mailchimp_social_wp_txt-front', 'text');
            }
            foreach ($array_response as $key => $value) {
                $this->new_field_setting($key, $value, 'mailchimp_social_wp_txt-response', 'text');
            }
            foreach ($array_namefields as $key => $value) {
                $this->new_field_setting($key, $value, 'mailchimp_social_wp_txt-namefields', 'text');
            }

            //Change button color
            add_settings_field(
                'mailchimp_social_wp-setting-button_class',
                'Change button class',
                array(&$this, 'sandbox_select_element'),
                'mailchimp_social_wp-embed',
                'mailchimp_social_wp_embed_theme-section',
                array(
                    'field_name' => 'iframe_button_color',
                    'values'     => array("btn-default", "btn-primary", "btn-success", "btn-info", "btn-warning", "btn-danger", "btn-link"),
                )
            );

            //Change button color - Popovers
            add_settings_field(
                'mailchimp_social_wp-setting-button_class',
                'Change button class',
                array(&$this, 'sandbox_select_element'),
                'mailchimp_social_wp-popovers',
                'mailchimp_social_wp_popovers_theme-section',
                array(
                    'field_name' => 'popovers-iframe_button_color',
                    'values'     => array("btn-default", "btn-primary", "btn-success", "btn-info", "btn-warning", "btn-danger", "btn-link"),
                )
            );

            //Mailchimp Lists ID
            add_settings_field(
                'mailchimp_social_wp-setting-Mailchimp_ListID',
                'MailChimp Lists ID',
                array(&$this, 'sandbox_multi_select_lists'),
                'mailchimp_social_wp-social',
                'mailchimp_social_wp_mailchimp-section',
                array(
                    'field_name' => 'Mailchimp_ListID',
                )
            );

            if(get_option("enable_groupings")){
                //get lists
                try{
                    $mailchimp = new MSW_Mailchimp(get_option("Mailchimp_ApiKey"));
                    $lists_info = $mailchimp->lists->getList();
                }catch(Exception $e){
                    $lists_info = array();
                }

                $lists_selected = get_option("Mailchimp_ListID");
                
                if(is_array($lists_selected) && isset($lists_info['data'])){
                    foreach ($lists_info['data'] as $list) {
                        register_setting('mailchimp_social_wp-plugin_set-group', 'groupings'.$list['id']);
                        if(in_array($list['id'], $lists_selected)){
                            add_settings_field(
                                'mailchimp_social_wp-setting-groupings'.$list['id'],
                                'Select groups and interests for '.$list['name'],
                                array(&$this, 'sandbox_multi_select'),
                                'mailchimp_social_wp-plugin_set',
                                'mailchimp_social_wp_groupings-section',
                                array(
                                    'field_name' => 'groupings'.$list['id'],
                                    'values'     => $this->get_groups_list($list['id']),
                                )
                            );
                        }
                    }
                }
            }
            //Iframe select
            add_settings_field(
                'mailchimp_social_wp-setting-iframe_theme',
                'Select iframe for embed',
                array(&$this, 'sandbox_select_element'),
                'mailchimp_social_wp-embed',
                'mailchimp_social_wp_embed_theme-section',
                array(
                    'field_name' => 'iframe_theme',
                    'values'     => array("1", "2", "3", "4", "5"),
                )
            );

            //Enable language support
            add_settings_field(
                'mailchimp_social_wp-setting-enable_languages',
                'Enable languages support',
                array(&$this, 'sandbox_checkbox_element'),
                'mailchimp_social_wp-language',
                'mailchimp_social_wp_enable_language-section',
                array(
                    'field' => 'enable_languages',
                    'label' => 'Checked = Language support enable!'
                )
            );

            $this->new_field_setting('iframe_width', 'Width', 'mailchimp_social_wp_enable_iframe_widget', 'embed');
            $this->new_field_setting('iframe_height', 'Height', 'mailchimp_social_wp_enable_iframe_widget', 'embed');
            $this->new_field_setting('extra_text_embed', 'Extra text', 'mailchimp_social_wp_embed_extra_text', 'embed');
            $this->new_field_setting('iframe_extra_text_color', 'Extra text color', 'mailchimp_social_wp_embed_theme', 'embed');

            $this->new_field_setting('popovers-iframe_width', 'Width', 'mailchimp_social_wp_size_popovers', 'popovers');
            $this->new_field_setting('popovers-iframe_height', 'Height', 'mailchimp_social_wp_size_popovers', 'popovers');
            $this->new_field_setting('popovers-extra_text_embed', 'Extra text', 'mailchimp_social_wp_popovers_extra_text', 'popovers');
            $this->new_field_setting('popovers-iframe_extra_text_color', 'Extra text color', 'mailchimp_social_wp_popovers_theme', 'popovers');
        }

        private function new_field_setting($id, $name, $section, $tab){
            add_settings_field(
                "mailchimp_social_wp-setting-$id",
                $name,
                array(&$this, 'sandbox_input_text_element'),
                'mailchimp_social_wp-'.$tab,
                $section.'-section',
                array(
                    'field' => $id
                )
            );
        }

        private function new_checkbox_setting($id, $name, $section, $tab, $label = 'Checked = disabled'){
            add_settings_field(
                'mailchimp_social_wp-setting-'.$id,
                $name,
                array(&$this, 'sandbox_checkbox_element'),
                'mailchimp_social_wp-'.$tab,
                $section.'-section',
                array(
                    'field' => $id,
                    'label' => $label
                )
            );
        }

        public function after_section_title(){
            echo "<hr>";
        }

        public function sandbox_input_text_element($args){
            $field = $args['field'];
            $value = get_option($field);
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        }

        public function sandbox_checkbox_element($args) {
            $field = $args['field'];
            $option = get_option($field);
            $html = "<input type=\"checkbox\" id=\"".$field."\" name=\"".$field."\" value=\"1\"".checked(1, $option, false)."/>";
            $html .= '<label for="'.$field.'">'.$args['label'].'</label>';
            echo $html;
        }

        public function sandbox_select_element($args) {
            $field_name = $args['field_name'];
            $description = $args['description'];
            $selected_option = get_option($field_name);

            echo '<label for="'.$field_name.'">'.$description.'</label>';
            echo '<select name="'.$field_name.'" id="'.$field_name.'" class="large">';

            foreach ($args['values'] as $option) {
                echo '<option value="' . $option . '" id="' . $option . '"', $selected_option == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            }

            echo '</select>';
            echo $html;
        }

        public function sandbox_multi_select_lists($args){
            try{
                $mailchimp = new MSW_Mailchimp(get_option("Mailchimp_ApiKey"));
                $lists_info = $mailchimp->lists->getList();
            }catch(Exception $e){
                echo "Your MailChimp API Key is not valid. <br/><b>MailChimp Message:</b> ".print_r($e->getMessage(), true);
                return;
            }

            if(isset($lists_info['total'])){
                $field_name = $args['field_name'];
                $description = $args['description'];
                $selected_option = get_option($field_name);

                if(!is_array($selected_option)){
                    $selected_option = array();
                }
            
                echo '<label for="'.$field_name.'">'.$description.'</label>';
                echo '<select name="'.$field_name.'[]" id="'.$field_name.'" multiple style="width: 200px">';

                foreach ($lists_info["data"] as $list) {
                    if(isset($list['id']) && isset($list['name'])):
                            echo '<option value="' . $list['id'] . '" id="' . $list['id'] . '"', in_array($list['id'], $selected_option)  ? ' selected="selected"' : '', '>', $list['name'], '</option>';
                    endif;
                }

                echo '</select>';
                echo $html;
            }else{
                echo "Please create a new list at MailChimp.";
            }
        }

        public function sandbox_multi_select($args) {
            $field_name = $args['field_name'];
            $description = $args['description'];
            $selected_option = get_option($field_name);
            
            if(!is_array($selected_option)){
                $selected_option = array();
            }
            
            echo '<label for="'.$field_name.'">'.$description.'</label>';
            echo '<select name="'.$field_name.'[]" id="'.$field_name.'" multiple style="width: 200px">';

            if(isset($args['values']) && is_array($args['values'])):
                foreach ($args['values'] as $group) {
                    if(isset($group['name']) && isset($group['groups']) && isset($group['id'])):
                        echo '<optgroup label="' . $group['name'] . '">';
                        foreach ($group['groups'] as $interest) {
                            $option = $group['id'].'-'.$interest['name'];
                            echo '<option value="' . $option . '" id="' . $option . '"', in_array($option, $selected_option)  ? ' selected="selected"' : '', '>', $interest['name'], '</option>';
                        }
                        echo '</optgroup>';
                    endif;
                }
            endif;

            echo '</select>';
            echo $html;
        }

        public function add_menu(){
        	add_options_page(
        	    'MailChimp Social WP - Settings',
        	    'MailChimp Social WordPress',
        	    'manage_options',
        	    'mailchimp_social_wp',
        	    array(&$this, 'plugin_settings_page')
        	);
        }

        private function options_tabs($current_tab = "social") {
            $tabs = array("social" => "Social keys", "plugin_set" => "Plugin settings",
                          "text" => "Text", "language" => "Multi-Language",
                          "embed" => "Embed code", "popovers" => "Pop Overs", "help" => "Help");
            echo "<div class=\"wrap\"><h2>MailChimp Social WordPress</h2>";
            echo '<h2 class="nav-tab-wrapper">';
            foreach ($tabs as $tab_key => $tab_caption) {
                $active = $current_tab == $tab_key ? 'nav-tab-active' : '';
                if($tab_key=="help"):
                    echo '<a class="nav-tab ' . $active . '" style="color: #CF5300" href="?page=mailchimp_social_wp&tab=' . $tab_key . '">' . $tab_caption . '</a>';
                else:
                    echo '<a class="nav-tab ' . $active . '" href="?page=mailchimp_social_wp&tab=' . $tab_key . '">' . $tab_caption . '</a>';
                endif;
            }
            echo '</h2>';
        }

        public function plugin_settings_page(){
        	if(!current_user_can('manage_options')){
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}

            if(isset($_GET['tab'])){
                $this->options_tabs($_GET['tab']);
            }else{
                $this->options_tabs();
            }

        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        }

        public function get_groups_list($id){
            if(!get_option("Mailchimp_ApiKey")){
                return NULL;
            }else{
                $instance = new MSW_Mailchimp(get_option("Mailchimp_ApiKey"));
                try{
                    return $instance->lists->interestGroupings($id);
                }catch (Exception $e) {
                    return NULL;
                }
            }
        }
}
endif;