<?php
$current_content = json_decode($query[0]->global_config, true);

// Example how to display a Global Param 
//$rfa = new Royal_Forms_Admin(null, null);
//echo $rfa->get_config_param("onemore");
?>
    <div class="wrap">
        <h2>Royal Forms Configuration</h2>
        <hr />
        <?php if ( $updateConfig != FALSE ) { ?>
        <div class="updated notice">
            <p><strong>Global Config Saved!</strong></p>
        </div>
        <?php } ?>
    </div>
    <form method="post" id="create-quiz" name="create-quiz">
    <?php
    // Add as many params you want :)
    $params = [
    	"Your Param" => "param-global",
    	"Another Param" => "google-analytics-code",
    	"Mailchimp API" => "mailchimp",
    	"I need one more" => "onemore",
    ];
    ?>
    <table class="form-table">
        <tbody>
        	<?php foreach ($params as $text => $value) { ?>
            <tr>
                <th scope="row"><label for="config[<?=$value?>]"><?=$text?>:</label></th>
                <td><input name="config[<?=$value?>]" value="<?=$current_content[$value]?>" type="text" id="config[<?=$value?>]" class="regular-text"></td>
            </tr>
        	<?php } ?>
        </tbody>
    </table>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-secondary" value="Save Global Configuration">
    </p>
    </form>