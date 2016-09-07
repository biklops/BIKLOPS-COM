<?php
require( '../../../../wp-config.php' );
$language = Mailchimp_Social_WP::getResponseLanguage();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MailChimp Social Wordpress</title>

    <!-- Bootstrap & core CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/social.css" />

</head>

<body>
    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?=$language['title']?> <small><?=$language['its_free']?></small></h3>
                    </div>
                    <div class="panel-body">
                        <h3><?=$language['email_wrong']?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
