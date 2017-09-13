<?php
if ( is_bkdk_user_logged_in() != true ) {
	wp_redirect(site_url().'/login/');
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
	$name =  $_POST['myname'];
  $email =  $_POST['email'];
  $message =  $_POST['message'];
}
$customerid = get_customerid();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="recommend_to_a_friend">
		<div class="row">
			<div class="small-12 medium-8 medium-centered large-8 large-centered flexCancel-panel columns">
				<?php
					$recommend_to_a_friend = call_recommend_to_a_friend($customerid);
					$success = $recommend_to_a_friend->success;
					if ($success != true) {
				?>
  			<div class="row flexCancel-heading">
					 <h3>Afsendelse mislykkedes</h3>
				</div>
				<section class="entry-content" itemprop="articleBody"><br/>
					<p>Din anbefaling blev desværre ikke sendt på grund af fejl på serveren. Prøv venligst igen.</p>
					<p class="text-center ovrLayBtn"><a href="<?php echo site_url() ?>" class="button callSpin">TILBAGE TIL FORSIDEN</a></p>
				</section>

  			<?php	} else { ?>

				<div class="row flexCancel-heading">
					<?php the_title('<h3>', '</h3>') ?>
				</div>
				<section class="entry-content" itemprop="articleBody"><br/>
					<?php
					the_excerpt();
					echo '<p class="text-center ovrLayBtn"><a href="' . site_url() . '" class="button callSpin">TILBAGE TIL FORSIDEN</a></p>';
					?>
				</section>
<?php } ?>

			</div>
		</div>
	</div>
</article>