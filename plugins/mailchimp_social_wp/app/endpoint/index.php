<?php
require_once("../classes/MailChimp/mailchimp.php");
// for email not show this but if the option is enable enable this option
if(isset($_GET['skip']) && $_GET['skip'] == 'true'){
	set_transient('skip', 1, 4);
	header("Location: ../subscribe/?profile_identifier=".$transient);
}else{
	set_transient('skip', 0, 4);
}

?>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <!-- CSS -->
	    <link rel="stylesheet" href="../endpoint/css/bootstrap.min.css" type='text/css' media='all' />
		<link rel='stylesheet' href='../endpoint/css/bootstrap-select.min.css' type='text/css' media='all' />
		<link rel='stylesheet' href='../../templates/css/iframes/iframe1.css' type='text/css' media='all' />
		<link rel='stylesheet' href='../endpoint/css/profile.css' type='text/css' media='all' />
	    <!-- CSS -->
	    <!-- JS -->
    	<script src="../endpoint/js/jquery-1.10.2.min.js"></script>
    	<script src="../endpoint/js/bootstrap.min.js"></script>
	    <!-- JS -->
    	<title>MailChimp Social Wordpress</title>
	</head>
	<body style="background-color: transparent">
		<div class="container">
			<?php
			extract(Handling::obtain_transient($transient));
			$language = Mailchimp_Social_WP::getNameFieldsLanguage();
			?>
		    <form action="../subscribe/" method="post" style="width:400px; margin: 0 auto;">
		        <h1><?php echo $language['title']; ?></h1>
		        <small><i><?php echo $language['collected_via']; ?> '<?php echo $service; ?>'</i></small>

		        <?php if(!$Configuration["disable_flname"]): ?>
			        <?php if(isset($first_name)){ ?>
				        <div class="required-field-block form-group has-success">
				            <input type="text" placeholder="<?php echo $language['fname']; ?>" class="form-control" data-toggle="tooltip" value="<?php echo $first_name; ?>" data-placement="bottom" title="<?php echo $language['tooltip_has_fname']; ?>" readonly="true">
				        </div>
			        <?php }else{ ?>
				        <div class="required-field-block form-group has-error">
				            <input type="text" placeholder="<?php echo $language['fname']; ?>" name="first_name" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $language['tooltip_collect_fname']; ?>" required>
				            <div class="required-icon">
				                <div class="text">*</div>
				            </div>
				        </div>
			        <?php } ?>

			        <?php if(isset($last_name)){ ?>
			        <div class="required-field-block form-group has-success">
			            <input type="text" placeholder="<?php echo $language['lname']; ?>" class="form-control" data-toggle="tooltip"  value="<?php echo $last_name; ?>"  data-placement="bottom" title="<?php echo $language['tooltip_has_lname']; ?>"readonly="true">
			        </div>
			        <?php }else{ ?>
			        <div class="required-field-block form-group has-error">
			            <input type="text" placeholder="<?php echo $language['lname']; ?>" name="last_name" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $language['tooltip_collect_lname']; ?>" required>
			            <div class="required-icon">
			                <div class="text">*</div>
			            </div>
			        </div>
			        <?php } ?>
		    	<? endif; ?>
		        
		        <?php if(isset($email)){ ?>
		        	<div class="required-field-block form-group has-success">
			            <input type="text" placeholder="<?php echo $language['email']; ?>" class="form-control" value="<?php echo $email ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $language['tooltip_has_email']; ?>" readonly="true">
			        </div>
		        <?php }else{ ?>
		        	<div class="required-field-block form-group has-error">
			            <input type="text" placeholder="<?php echo $language['email']; ?>" name="email" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $language['tooltip_collect_email']; ?>">
			            <div class="required-icon">
			                <div class="text">*</div>
			            </div>
			        </div>
		        <?php } ?>
		        

		        <?php
		        global $Configuration;

		        try{
	                $mailchimp = new MSW_Mailchimp(get_option("Mailchimp_ApiKey"));
	                $lists_info = $mailchimp->lists->getList();
	            }catch(Exception $e){
	                exit("Something went wrong. Proabably the Mailchimp API Key is invalid!");
	            }


	            if(count($Configuration["Mailchimp_ListID"])==0){
	            	exit("Please select one or more lists at the plugin settings!");
	            }elseif(count($Configuration["Mailchimp_ListID"])==1){
	            ?>
	            <input type="hidden" name="lists" value="<?php echo current($Configuration["Mailchimp_ListID"]); ?>">
	            <?php
	            }else{
	            	$lists = array();
		            foreach ($lists_info['data'] as $list) {
		            	$lists[$list['id']] = $list['name'];
		            }
		        ?>
				    <div class="text-center">
				        <div class="bs-docs-example">
						  	<select class="selectpicker" size="<?php echo count($lists); ?>" name="lists[]" data-width="400px" title="<?php echo $language['sellect_what_to_subscribe']; ?>" style="display: none;" multiple>
							  	<optgroup label="<?php echo $language['sellect_what_to_subscribe']; ?>">
							  	<?php
							  	foreach ($lists as $key => $value) {
							  		if(in_array($key, $Configuration["Mailchimp_ListID"])){
							  		?>
								  		<option selected="select" value="<?php echo $key; ?>">
								      		<?php echo $value; ?>
								    	</option>
							  		<?
							  		}	
							  	}
							  	?>
							  	</optgroup>
						  	</select>
						</div>
	    			</div>
    			<?php } ?>

    			<div class="row">
    				<?php
    				//RADIO FIELDs
    				foreach (Handling::ative_merge_tags() as $key => $value) {
    					if(isset($value["field_type"]) && $value["field_type"] == "radio"){
    					?>
		    				<div class="form-group">
					    		<label for="<?php echo $value["name"]; ?>" class="col-sm-4 col-md-4 control-label text-right"><?php echo $value["label"]; ?></label>
					    		<div class="col-sm-7 col-md-7">
					    			<div class="input-group">
					    				<div id="radioBtn" class="btn-group">
					    					<a class="btn btn-primary btn-sm active" data-toggle="<?php echo $value["name"]; ?>" data-title="<?php echo current($value["choices"]); ?>"><?php echo current($value["choices"]); ?></a>
					    					<?php
					    					foreach (array_slice($value["choices"], 1) as $key => $val){
					    					?>
					    						<a class="btn btn-primary btn-sm notActive" data-toggle="<?php echo $value["name"]; ?>" data-title="<?php echo $val ?>"><?php echo $val ?></a>
					    					<?php } ?>
					    				</div>
					    				<input type="hidden" name="<?php echo $value["name"]; ?>" value="<?php echo current($value["choices"]); ?>" id="<?php echo $value["name"]; ?>">
					    			</div>
					    		</div>
					    	</div>
    					<?
    					}
    				}
    				?>

			    	<?php
			    	// BIRTHDAY COLLECT
			    	if(!$Configuration["disable_birthday"]):
			    	?>
			    	<div class="form-group">
			    		<div class="input-group required-field-block">
			    			<label for="fun" class="col-sm-4 col-md-4 control-label text-right">Birthday:</label>
			    			<br/>
		        			<?php if(isset($dateofbirth_day)){ ?>
							   	<div class="col-xs-2 has-success" style="padding-right: 0px;">
							        <input type="text" value="<?php echo $dateofbirth_day ?>" class="form-control" placeholder="DD" data-toggle="tooltip" data-placement="top" title="<?php echo $language['tooltip_has_birth_day']; ?>" readonly="true">
							    </div>
							<?php }else{ ?>
							   	<div class="col-xs-2 has-error" style="padding-right: 0px;">
							        <input type="text"value="<?php echo $dateofbirth_day ?>" class="form-control" name="dateofbirth_day" placeholder="DD" data-toggle="tooltip" data-placement="top" title="<?php echo $language['tooltip_collect_birth_day']; ?>" required>
							    </div>
							<?php } ?>
							<?php if(isset($dateofbirth_month)){ ?> 
							    <div class="col-xs-2 has-success" style="padding-left: 0px;">
							        <input type="text" value="<?php echo $dateofbirth_month ?>" class="form-control" placeholder="MM" data-toggle="tooltip" data-placement="top" title="<?php echo $language['tooltip_has_birth_month']; ?>" readonly="true">
							    </div>
							<?php }else{ ?>
								<div class="col-xs-2 has-error" style="padding-left: 0px;">
							        <input type="text" name="dateofbirth_month" value="<?php echo $dateofbirth_month ?>" class="form-control" placeholder="MM" data-toggle="tooltip" data-placement="top" title="<?php echo $language['tooltip_collect_birth_month']; ?>" required>
							    </div>
							<?php } ?>
						</div>
			    	</div>
			    	<div class="col-xs-6">
			    	<?php if(isset($service) && $service!="form" && (!isset($dateofbirth_month) || !isset($dateofbirth_day))): ?>
					    <small style="cursor: pointer" data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo $language['why_cant_get_birthday_popover']; ?>">&nbsp;<i><?php echo $language['why_cant_get_birthday_ask']; ?></i></small>
					    <?php endif; ?>
			    	</div>
			    	<?php endif; ?>
				</div>
				<div class="text-center">
				    <input type="hidden" name="profile_identifier" value="<?php echo $transient; ?>">
				    <button class="btn btn-primary"><?php echo $language['subscribe_text']; ?></button>
			    </div>
		    </form>
		    <br/>
		</div>
		<script type="text/javascript">
	      window.onload=function(){
	      	$('.selectpicker').selectpicker();
	      };
	      $('#radioBtn a').on('click', function(){
			    var sel = $(this).data('title');
			    var tog = $(this).data('toggle');
			    $('#'+tog).prop('value', sel);
			    
			    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
			    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
			});
	      	$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})
	      	$(function () {
			  $('[data-toggle="popover"]').popover()
			})
	    </script>
	    <script src="../endpoint/js/bootstrap-select.js" /></script>
	</body>
</html>