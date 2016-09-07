<?php
function isJson($string) {
	$ob_pl = json_decode($string);
	if($ob_pl === null){
		return false;
	}
	return true;
}

if(isset($_GET['o'])){
	$options = base64_decode($_GET['o']);
	if(!isJson($options)){ echo "Is not json: 1"; exit(); }
	$options = json_decode($options);
	if(!is_object($options)){ echo "Is not object."; exit(); }
}else{ echo "Missing o."; exit(); }

if(isset($_GET['ot'])){
	$output_texts = base64_decode($_GET['ot']);
	if(!isJson($output_texts)){ echo "Is not json: 2"; exit(); }
	$output_texts = json_decode($output_texts);
}else{ echo "Missing ot."; exit(); }

if(isset($_GET['services'])){
	$services = base64_decode($_GET['services']);
	if(!isJson($services)){ echo "Is not json: 3"; exit(); }
	$services = json_decode($services);
}else{ echo "Missing services."; exit(); }

if(isset($_GET['extra_text']) && strlen($_GET['extra_text'])!=0){
	$extra_text = urldecode($_GET['extra_text']);
}else{
	$extra_text = "";
}

if(isset($services->facebooktrigger) || isset($services->googletrigger) || isset($services->microsofttrigger) || isset($services->emailtrigger)):

	$button_class = strip_tags($options->iframe_button_color);
	$extra_text_color = strip_tags($options->iframe_extra_text_color);

	if(!isset($_GET['u'])){	echo "Missing u."; exit(); }
	$base_url = strip_tags(urldecode($_GET['u']));

	function iframe_title(){ global $output_texts; return strip_tags($output_texts->title_tb); }
	function facebook_button(){
		global $base_url, $output_texts;
		echo "<a class=\"btn btn-block btn-social btn-facebook\"";
		echo "onclick=\"javascript:href_send('".strip_tags($base_url)."/mailchimp_social_wp/app/facebook');\" href=\"#\"";
		echo "><i class=\"fa fa-facebook\"></i> ".strip_tags($output_texts->facebook_label)."</a>";
	}
	function google_button(){
		global $base_url, $output_texts;
		echo "<a class=\"btn btn-block btn-social btn-google-plus\"";
		echo "onclick=\"javascript:href_send('".strip_tags($base_url)."/mailchimp_social_wp/app/google')\" href=\"#\"";
		echo "><i class=\"fa fa-google-plus\"></i> ".strip_tags($output_texts->google_label)."</a>";
	}
	function microsoft_button(){
		global $base_url, $output_texts;
		echo "<a class=\"btn btn-block btn-social btn-microsoft\"";
		echo " onclick=\"javascript:href_send('".strip_tags($base_url)."/mailchimp_social_wp/app/microsoft');\" href=\"#\"";
		echo "><i class=\"fa fa-windows\"></i> ".strip_tags($output_texts->outlook_label)."</a>";
	}
	function linkedin_button(){
		global $base_url, $output_texts;
		echo "<a class=\"btn btn-block btn-social btn-linkedin\"";
		echo " onclick=\"javascript:href_send('".strip_tags($base_url)."/mailchimp_social_wp/app/linkedin');\" href=\"#\"";
		echo "><i class=\"fa fa-linkedin\"></i> ".strip_tags($output_texts->linkedin_label)."</a>";
	}
	function vk_button(){
		global $base_url, $output_texts;
		echo "<a class=\"btn btn-block btn-social btn-vk\"";
		echo " onclick=\"javascript:href_send('".strip_tags($base_url)."/mailchimp_social_wp/app/vk');\" href=\"#\"";
		echo "><i class=\"fa fa-vk\"></i> ".strip_tags($output_texts->vk_label)."</a>";
	}
	function email_form_sub(){
		global $base_url, $output_texts, $button_class;
		echo "<form name=\"formsubmit\"";
		echo "onsubmit=\"javascript:href_send('')\" target=\"popup\"";
		echo "action=\"".strip_tags($base_url)."/mailchimp_social_wp/app/email\">
				<div class=\"form-group\">
				    <input type=\"email\" name=\"email\" class=\"form-control input-sm\" placeholder=\"".strip_tags($output_texts->email_label)."\" required/>
				</div>
				<button class=\"btn btn-block ".strip_tags($button_class)."\">".strip_tags($output_texts->subscribe_label)."</button>
		</form>";
	}
	function extra_text_embed(){
		global $extra_text_color, $extra_text;
		echo "<br/><small style=\"color: ".strip_tags($extra_text_color)."\">".$extra_text."</small>";
	}
	?>
	<html>

	<head>
	    <meta charset="utf-8">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel='stylesheet' id='bootstrap-css-css'  href='templates/css/iframes/bootstrap.css' type='text/css' media='all' />
		<link rel='stylesheet' id='social-css-css'  href='templates/css/iframes/iframe1.css' type='text/css' media='all' />
	    <title>MailChimp Social Wordpress</title>
	</head>

	<body style="background-color: transparent">

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="templates/css/iframes/jquery.responsiveiframe.js"></script>
	<script>
	  var ri = responsiveIframe();
	  ri.allowResponsiveEmbedding();
	</script>

	<script type="text/javascript">
			function href_send(href){
				window.open(href,'popup','width=500,height=500,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0');
				return false;
			}
	</script>
	<?php
	if($_GET['iframe']==1):
	?>
		<div class="container">
        	<div class="row">
            	<div class="col-xs-12 col-sm-8 col-md-4">
                	<div class="panel panel-default">
						<div class="panel-heading">
				       		<h3 class="panel-title"><?=iframe_title();?></h3>
				    	</div>
					    <div class="panel-body">
			                <div class="form-group">
			                	<?php if(isset($services->facebooktrigger)): ?>
			                   		<?php facebook_button(); ?>
			                    <?php endif; ?>
			                    <?php if(isset($services->googletrigger)): ?>
			                   		<?php google_button(); ?>
			                    <?php endif; ?>
			                    <?php if(isset($services->microsofttrigger)): ?>
			                   		<?php microsoft_button(); ?>
			                	<?php endif; ?>
			                    <?php if(isset($services->linkedintrigger)): ?>
			                   		<?php linkedin_button(); ?>
			                	<?php endif; ?>
			                    <?php if(isset($services->vktrigger)): ?>
			                   		<?php vk_button(); ?>
			                	<?php endif; ?>
			                </div>
			                <?php if(isset($services->emailtrigger)): ?>
			                	<?php email_form_sub(); ?>
			                <?php endif; ?>
	                		<?php if(strlen($extra_text)!=0): ?>
				        		<?php extra_text_embed(); ?>
				        	<?php endif; ?>
	                	</div>
			        </div>
		    	</div>
			</div>
		</div>
	<?php
    elseif ($_GET['iframe']==2):
    ?>
		<div class="container">
        	<div class="row">
            	<div class="col-xs-12 col-sm-8 col-md-3">
                	<div class="panel panel-default">
						<div class="panel-heading">
				       		<h3 class="panel-title"><?=iframe_title();?></h3>
				    	</div>
					    <div class="panel-body">
			                <div class="form-group">
			                	<?php if(isset($services->facebooktrigger)): ?>
			                   		<?php facebook_button(); ?>
			                    <?php endif; ?>
			                    <?php if(isset($services->googletrigger)): ?>
			                   		<?php google_button(); ?>
			                    <?php endif; ?>
			                    <?php if(isset($services->microsofttrigger)): ?>
			                   		<?php microsoft_button(); ?>
			                	<?php endif; ?>
			                    <?php if(isset($services->linkedintrigger)): ?>
			                   		<?php linkedin_button(); ?>
			                	<?php endif; ?>
			                    <?php if(isset($services->vktrigger)): ?>
			                   		<?php vk_button(); ?>
			                	<?php endif; ?>
			                </div>
			                <?php if(isset($services->emailtrigger)): ?>
			                	<?php email_form_sub(); ?>
			                <?php endif; ?>
	                		<?php if(strlen($extra_text)!=0): ?>
				        		<?php extra_text_embed(); ?>
				        	<?php endif; ?>
	                	</div>
			        </div>
		    	</div>
			</div>
		</div>
	<?php
    elseif ($_GET['iframe']==3):
    ?>
			<div class="container">
		        <div class="row">
		            <div class="col-xs-12 col-sm-8 col-md-4">
		                <div class="lovebox-iframe">
				            <h4 class="text-center"><?=iframe_title();?></h4>
							<?php if(isset($services->facebooktrigger)): ?>
		                   		<?php facebook_button(); ?>
		                    <?php endif; ?>
		                    <?php if(isset($services->googletrigger)): ?>
		                   		<?php google_button(); ?>
		                    <?php endif; ?>
		                    <?php if(isset($services->microsofttrigger)): ?>
		                   		<?php microsoft_button(); ?>
		                	<?php endif; ?>
			                <?php if(isset($services->linkedintrigger)): ?>
			                  	<?php linkedin_button(); ?>
			                <?php endif; ?>
			                <?php if(isset($services->vktrigger)): ?>
			                	<?php vk_button(); ?>
			               	<?php endif; ?>
				            <br/>
				        </div>
					    <?php if(isset($services->emailtrigger)): ?>
							<?php email_form_sub(); ?>
						<?php endif; ?>
	                	<?php if(strlen($extra_text)!=0): ?>
			        		<?php extra_text_embed(); ?>
			        	<?php endif; ?>
		            </div>
		        </div>
		    </div>
	<?php
    elseif ($_GET['iframe']==4):
   	?>
			<div class="lovebox-iframe-small">
				<h4 class="text-center"><?=iframe_title();?></h4>
				<?php if(isset($services->facebooktrigger)): ?>
		        	<?php facebook_button(); ?>
		        <?php endif; ?>
		       	<?php if(isset($services->googletrigger)): ?>
		            <?php google_button(); ?>
		        <?php endif; ?>
		        <?php if(isset($services->microsofttrigger)): ?>
		            <?php microsoft_button(); ?>
		     	<?php endif; ?>
		     	<?php if(isset($services->linkedintrigger)): ?>
			        <?php linkedin_button(); ?>
			    <?php endif; ?>
			    <?php if(isset($services->vktrigger)): ?>
			    	<?php vk_button(); ?>
			    <?php endif; ?>
				<br/>
				<?php if(isset($services->emailtrigger)): ?>
					<?php email_form_sub(); ?>
				<?php endif; ?>
	            <?php if(strlen($extra_text)!=0): ?>
	        		<?php extra_text_embed(); ?>
	        	<?php endif; ?>
    <?php
    elseif ($_GET['iframe']==5):
   	?>
   			<?php if(isset($services->facebooktrigger)): ?>
   				<?php facebook_button(); ?>
          	<?php endif; ?>
          	<?php if(isset($services->googletrigger)): ?>
         		<?php google_button(); ?>
          	<?php endif; ?>
          	<?php if(isset($services->microsofttrigger)): ?>
          		<?php microsoft_button(); ?>
       		<?php endif; ?>
       		<?php if(isset($services->linkedintrigger)): ?>
			    <?php linkedin_button(); ?>
			<?php endif; ?>
			<?php if(isset($services->vktrigger)): ?>
			    <?php vk_button(); ?>
			<?php endif; ?>
			<br/>
			<?php if(isset($services->emailtrigger)): ?>
				<?php email_form_sub(); ?>
			<?php endif; ?>
	        <?php if(strlen($extra_text)!=0): ?>
	        	<?php extra_text_embed(); ?>
	        <?php endif; ?>
    <?php
    	endif;
    ?>
	</body>
	<?php
endif;
