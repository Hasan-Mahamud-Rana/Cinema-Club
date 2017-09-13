<?php get_header(); ?>
<div class="small-12 medium-12 large-12 searchBG">
	<div class="row">
	<div class="small-12 medium-12 large-12">
			<button class="close-button-menu callSpin" data-close aria-label="Close modal" type="button" onclick="location.href='<?php echo site_url(); ?>';">
			<a class="crossText"></a>
			</button>
	</div>
		<div class="small-12 medium-12 large-12">
			<form role="search" method="get" class="search-form" action="<?php echo site_url(); ?>">
				<label>
					<div class="inputStyle">
						<input type="search" class="search-field-result" placeholder="<?php echo esc_attr_x( 'Indtast søgeord...', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Søge efter:', 'jointswp' ) ?>" autofocus>
					</div>
				</label>
				<br><br><br>
				<?php
				if (!$_GET['s']==""){
				$allsearch = new WP_Query("s=$s&showposts=0&cat=-38");
				$allPages= $allsearch ->found_posts;
				
				if($allPages==0){
					echo $allPages.' resultater';
				}
				elseif($allPages<=1){
					echo $allPages.' resultat';
				}
				else{
					echo $allPages.' resultater';
				}
				}
				?>
			</form>
		</div>
		<div class="accordion-item divMarginResult"></div>
		<div class="searchWrapper">
			<?php
			if ( is_search() ) {
				query_posts($query_string . '&cat=-38');
			}
			if (have_posts() && $allPages > 0) : while (have_posts()) : the_post();
				get_template_part( 'parts/loop', 'archive-search' );
			endwhile; ?>
		</div>
		<div class="accordion-item divMarginResult"></div>
		<div class="linknav">
			<?php
							$currentpage = max( 1, get_query_var('paged') );
							$num_rec_per_page=get_option('posts_per_page');// Get post per page value from WP admin settings
							$total_pages = ceil($allPages / $num_rec_per_page);
							for ($i=1; $i<=$total_pages; $i++) {
										$url = "/page/".$i."/?s=".$s;
										if($currentpage==$i){
										echo "<span style='font-weight:bold;'>".$i."</span>&nbsp;&nbsp;&nbsp;";
										}else{
										echo "<a href='".home_url( $url )."'>".$i."</a>&nbsp;&nbsp;&nbsp;";
										}
							};
							echo '<span style="float: right;">Side ' . $currentpage . ' af ' . $total_pages . '</span>';
			?>
			<?php
			wp_reset_postdata();
			?>
		</div>
		<?php else : ?>
		<?php get_template_part( 'parts/content', 'missing' ); ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>