    <form method="post" action="options.php">
        <?php if(!isset($_GET['tab'])): ?>
            <?php @settings_fields('mailchimp_social_wp-social-group'); ?>
            <?php @do_settings_fields('mailchimp_social_wp-social-group'); ?>
            <?php do_settings_sections('mailchimp_social_wp-social'); ?>
            <?php @submit_button(); ?>
        <?php elseif(isset($_GET['tab']) && $_GET['tab'] == "help"): ?>
            <h3>Step by Step Tutorial</h3>
            <iframe width="640" height="480" src="//www.youtube.com/embed/SLUjQyrYSfE" frameborder="0" allowfullscreen></iframe>
            <h3>Enable Google+ API</h3>
            <iframe width="640" height="480" src="//www.youtube.com/embed/NENb_klOR3w" frameborder="0" allowfullscreen></iframe>
            <p>This video is important to show how to get the birthday from google+ users!</p>
            <h3>LinkedIn APP configuration</h3>
            <iframe width="640" height="360" src="//www.youtube.com/embed/BmU8Vbqr0r8?rel=0" frameborder="0" allowfullscreen></iframe>
            <p><b>LinkedIn Callback URL:</b> http://YOUR_WEBSITE_URL/PATH_TO_PLUGINS/mailchimp_social_wp/app/linkedin</p>
            <h3>VK</h3>
            <p>URL to make the app: <a href="https://vk.com/apps?act=manage">https://vk.com/apps?act=manage</a></p>
            <p><b>VK Callback URL:</b> http://YOUR_WEBSITE_URL/PATH_TO_PLUGINS/mailchimp_social_wp/app/vk</p>
            <p></p>
            <h3>Single Optin vs Double Optin</h3>
            <iframe width="640" height="360" src="//www.youtube.com/embed/4RxZeAji1wQ" frameborder="0" allowfullscreen></iframe>
        <?php elseif (isset($_GET['tab']) && $_GET['tab'] == "popovers"): ?>
            <h3>Integration with others plugins</h3>
            <p>You can use this shortcode to integrate this plugin with others plugins.</p>
            <table>
                <tr>
                    <td style="width: 75%; vertical-align: top">
                        <p>
                            <strong>SHORTCODE:</strong><pre>[mailchimp_social_wp_popovers]</pre>
                        </p>
                        <p><strong>COMPATIBLE PLUGINS:</strong></p>
                        <ol>
                            <li><strong>Simple PopUp</strong> [free]&nbsp;&nbsp; - &nbsp;&nbsp;<a href="http://wordpress.org/plugins/simple-popup/" target="_blank">Download page</a></li>
                            <li><strong>WordPress PopUp</strong> [free]&nbsp;&nbsp; - &nbsp;&nbsp;<a href="http://wordpress.org/plugins/wordpress-popup/" target="_blank">Download page</a></li>
                            <li><strong>ITRO Popup Plugin</strong> [free]&nbsp;&nbsp; - &nbsp;&nbsp;<a href="http://wordpress.org/plugins/itro-popup/" target="_blank">Download page</a></li>
                            <li><strong>woo-popup</strong> [free]&nbsp;&nbsp; - &nbsp;&nbsp;<a href="http://wordpress.org/plugins/woo-popup/screenshots/" target="_blank">Download page</a></li>
                            <li><strong>Indeed Smart PopUp</strong> [paid]&nbsp;&nbsp; - &nbsp;&nbsp;<a href="http://codecanyon.net/item/indeed-smart-popup-for-wordpress/6634330?ref=RafaelFerreira" target="_blank">Download page</a></li>
                        </ol>
                        <p>
                            <i>See more Popup/pop over plugins <a href="http://www.webdesignrazzi.com/2014/wordpress-popup-plugins/" target="_blank">here!</a></i><br/>
                            <i>The plugin <strong>must</strong> be compatible with Wordpress shortcodes.</i>
                        </p>
                    </td>
                    <td>
                        <iframe width="420" height="315" src="//www.youtube.com/embed/RDJFdn1VxOc" frameborder="0" allowfullscreen></iframe>
                    </td>
                </tr>
            </table>
            <h2>Shortcode settings:</h2>
            <p>You can modify the html in popovers.php</p>
            <hr/>
            <?php @settings_fields('mailchimp_social_wp-'.$_GET['tab'].'-group'); ?>
            <?php @do_settings_fields('mailchimp_social_wp-'.$_GET['tab'].'-group'); ?>
            <?php do_settings_sections('mailchimp_social_wp-'.$_GET['tab'].''); ?>
            <p>You can view the themes in the Embed tag!</p>
            <?php @submit_button(); ?>
        <?php else: ?>
            <?php @settings_fields('mailchimp_social_wp-'.$_GET['tab'].'-group'); ?>
            <?php @do_settings_fields('mailchimp_social_wp-'.$_GET['tab'].'-group'); ?>
            <?php do_settings_sections('mailchimp_social_wp-'.$_GET['tab'].''); ?>
            <?php @submit_button(); ?>
            <?php if(isset($_GET['tab']) && $_GET['tab'] == "embed"): ?>
                <hr/>
                <h3>ShortCode WordPress</h3>
                <p>Use this shortcode in your pages/posts:  <b>[social_wp]</b></p>
                <h3>Preview:</h3>
                <?php echo do_shortcode('[social_wp]'); ?>
            <?php endif; ?>
        <?php endif; ?>
    </form>
</div>