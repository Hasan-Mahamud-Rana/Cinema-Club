<?php
/*
Template Name: CreateProfile Complete
*/
?>
<?php get_header(); ?>
<?php get_template_part( 'parts/create', 'profile-complete' ); ?>
<?php if ( is_bkdk_user_logged_in() == true ) { ?>
<div class="homePageMovieTrailerPanel">
  <div class="row movieIntro">
    <div class="small-12">
      <?php get_template_part( 'parts/loop', 'movie-for-homepage' ); ?>
    </div>
  </div>
</div>
<?php }?>
<?php

//echo $_COOKIE['basketCartNumber'];
//echo $_COOKIE['basketFlexCartNumber'];

$userDetails = get_user_info($customerid);
//var_dump(get_user_info($customerid));
$activeMembership = $userDetails->active_membership;

if ($activeMembership != 1 || $activeMembership == '') { ?>
<?php $query = new WP_Query( array( 'page_id' => 4, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
<div id="content" class="frontpage" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)" data-equalizer>
  <div id="inner-content" class="row">
    <main id="main" class="small-12 medium-6 large-7 columns" role="main">
    <?php get_template_part( 'parts/loop', 'page' ); ?>
    </main>
  </div>
</div>
<?php endwhile;  wp_reset_postdata(); else : ?>
<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
<?php endif; ?>

<?php }?>
<?php get_template_part( 'parts/app', 'notice' ); ?>
<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_footer(); ?>