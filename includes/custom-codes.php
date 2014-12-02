<?php	$wm4d_options_css = get_option('wm4d_options_css');
		$wm4d_options_script = get_option('wm4d_options_script');
		$wm4d_options_html = get_option('wm4d_options_html');
?>
<?php if($wm4d_options_html !='' || $wm4d_options_html != null ) echo $wm4d_options_html; ?>
<?php if($wm4d_options_css !='' || $wm4d_options_css != null ) { ?>
<style>
<?php echo $wm4d_options_css; ?>
</style>
<?php } ?>
<?php if($wm4d_options_script !='' || $wm4d_options_script != null ) { ?>
<script>
<?php echo $wm4d_options_script; ?>
</script>
<?php } ?>
