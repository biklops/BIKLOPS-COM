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

if(isset($services->facebooktrigger) || isset($services->googletrigger) || isset($services->microsofttrigger) || isset($services->linkedintrigger) || isset($services->emailtrigger)):

	$button_class = strip_tags($options->iframe_button_color);
	$extra_text_color = strip_tags($options->iframe_extra_text_color);

	if(!isset($_GET['u'])){	echo "Missing u."; exit(); }
	$base_url = strip_tags(urldecode($_GET['u']));
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
   	<?php if(isset($services->facebooktrigger)): ?>
        <a class="btn btn-block btn-social btn-facebook" onclick="javascript:href_send('<?=$base_url?>/mailchimp_social_wp/app/facebook');" href="#"><i class="fa fa-facebook"></i> <?php echo strip_tags($output_texts->facebook_label); ?></a>
    <?php endif; ?>
    <?php if(isset($services->googletrigger)): ?>
        <a class="btn btn-block btn-social btn-google-plus" onclick="javascript:href_send('<?=$base_url?>/mailchimp_social_wp/app/google')" href="#"><i class="fa fa-google-plus"></i> <?php echo strip_tags($output_texts->google_label); ?></a>
    <?php endif; ?>
    <?php if(isset($services->microsofttrigger)): ?>
        <a class="btn btn-block btn-social btn-microsoft" onclick="javascript:href_send('<?=$base_url?>/mailchimp_social_wp/app/microsoft');" href="#"><i class="fa fa-windows"></i> <?php echo strip_tags($output_texts->outlook_label); ?></a>
    <?php endif; ?>
    <?php if(isset($services->linkedintrigger)): ?>
        <a class="btn btn-block btn-social btn-linkedin" onclick="javascript:href_send('<?=$base_url?>/mailchimp_social_wp/app/linkedin');" href="#"><i class="fa fa-linkedin"></i> <?php echo strip_tags($output_texts->linkedin_label); ?></a>
    <?php endif; ?>
    <?php if(isset($services->vktrigger)): ?>
        <a class="btn btn-block btn-social btn-vk" onclick="javascript:href_send('<?=$base_url?>/mailchimp_social_wp/app/vk');" href="#"><i class="fa fa-vk"></i> <?php echo strip_tags($output_texts->vk_label); ?></a>
    <?php endif; ?>
	<?php if(isset($services->emailtrigger)): ?>
		<br/>
		<form name="formsubmit" onsubmit="javascript:href_send('')" target="popup" action="<?=$base_url?>/mailchimp_social_wp/app/email">
			<div class="form-group">
				<input type="email" name="email" class="form-control input-sm" placeholder="<?=$output_texts->email_label;?>" required/>
		    </div>
			<button class="btn btn-block <?=$button_class?>"><?php echo strip_tags($output_texts->subscribe_label); ?></button>
		</form>
	<?php endif; ?>
	<?php if(isset($_GET['extra_text']) && strlen($_GET['extra_text'])!=0): ?>
	    <small style="color:<?=$extra_text_color?>"><?php echo urldecode($_GET['extra_text']); ?></small>
	<?php endif; ?>
	</body>
<?php endif;
