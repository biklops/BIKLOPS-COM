<?php

function goalWPoptions() {
    $goalWP = get_option('goalWP');
    if(empty($goalWP['apikey'])){
        include(plugin_dir_path( __FILE__ ) . '/views/goalform.php');
    } else {
        include(plugin_dir_path( __FILE__ ) . '/views/goalaccount.php');
    }
};

?>

<div class="wrap" style="max-width:600px;">
<h2>MailChimp Goal Tracking</h2>

<?php

$goalWP = get_option('goalWP');

if($_POST['clear']){
    delete_option('goalWP');
}elseif($_POST['mcapi']){
    require_once(plugin_dir_path( __FILE__ ) . '/lib/Goal.php');
    $goalWPapikey = trim(strip_tags($_POST['mcapi']));
    try{
        $api = new GoalWP($goalWPapikey);

        $account_details = $api->get($api->root, $api->apikey);

        $options['user_id']  = $account_details->account_id;
        $options['apikey']   = $api->apikey;
        $options['dc']       = $api->dc;
        $options['username'] = $account_details->account_name;
        
        update_option('goalWP', $options);
        ?>

        <div>

        <?php echo __('Success!', 'goalWP');?>

        </div>

        <?php
            } catch (Exception $e) {
                if($e->getMessage()) {
                            ?>

                        <div class="error">

                <?php echo $e->getMessage();?>
                        
                        </div>

                <?php
            
                    delete_option('goalWP');
            
                }
            }
};

goalWPoptions();
