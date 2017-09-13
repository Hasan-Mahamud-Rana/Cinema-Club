<?php
/*
Template Name: FB Redirect
*/
?>

<script type="text/javascript">
document.location.href = String( document.location.href ).replace("/fb-redirect/?#", "/fb-login/?&");
</script>

<?php
	get_header();
	get_footer();
?>