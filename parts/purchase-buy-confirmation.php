<?php
if ( is_bkdk_user_logged_in() != true ) {
	wp_redirect(site_url().'/login/');
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="createProfile-panel buyConfirmation">
		<div class="row">
			<div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel columns">
				<input type="hidden" id="refresh" value="no">
				<div class="row purchasePackage-form">
					<div class="large-12">
						<header class="article-header pPayment">
							<?php the_title('<p class="page-title">', '</p>'); ?>
						</header>
						<section class="entry-content" itemprop="articleBody">
							<?php	the_content(); ?>
						</section>
						<p class="text-center ovrLayBtn">
							<a href="<?php echo site_url(); ?>" class="button callSpin">TILBAGE TIL FORSIDEN</a>
						</p>
						<p class="text-center ovrLayBtn">
						<a data-open="recommendToaFriendButton" class="secondary button" >Anbefal til en ven</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<script type="text/javascript">
jQuery(document).ready(function(e) {
  var siteUrl = '<?php echo site_url() ;?>';
	jQuery('#refresh').val() == 'yes' ? window.location.replace(siteUrl + "/purchase/") : jQuery('#refresh').val('yes');
});
</script>