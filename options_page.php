<div class="wrap">
    <h2>SimpleCdnfy settings</h2>

    <form method="post" action="options.php">
			<?php wp_nonce_field('update-options'); ?>
			<?php settings_fields('simplecdnfy'); ?>
<?php if($error != ""):?>
<div id="setting-error-settings_updated" class="updated settings-error">
    <p><strong><?php echo $error; ?></strong></p>
</div>
<?php endif;?>

<table class="form-table">
    <tr valign="top">
        <th scope="row">Assets Cdn:<br><small>(include http://)</small></th>
        <td><input type="text" name="_simpleCdn_assets_url" value="<?php echo get_option('_simpleCdn_assets_url'); ?>" /></td>
    </tr>

<!--    <tr valign="top">-->
<!--        <th scope="row">Upload file cdn :<br><small>(include http://)</small></th>-->
<!--        <td><input type="text" name="_simpleCdn_file_url" value="--><?php //echo get_option('_simpleCdn_file_url'); ?><!--" /></td>-->
<!--    </tr>-->

</table>


<p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div> 