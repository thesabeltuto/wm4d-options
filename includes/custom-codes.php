<?php	$wm4d_css = get_option('wm4d_css');
		$wm4d_script = get_option('wm4d_script');
		if ( get_option('wm4d_flipper_select') == 'enable' ) {
			$wm4d_html = flipper_replace_ref(get_option('wm4d_html'));
		} else {
			$wm4d_html = get_option('wm4d_html');
		}
?>
<?php if(!empty($wm4d_html)) echo $wm4d_html; ?>
<?php if(!empty($wm4d_css)) { ?>
<style>
<?php echo $wm4d_css; ?>
</style>
<?php } ?>
<?php if(!empty($wm4d_script)) { ?>
<script>
<?php echo $wm4d_script; ?>
</script>
<?php } ?>
