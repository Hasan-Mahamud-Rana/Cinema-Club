<?php
function doctype_opengraph($output) {
	return $output . '
	xmlns:og="http://opengraphprotocol.org/schema/"
	xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');

function fb_opengraph() {
	global $post;
	if(is_single()) {
		if($content = $post->post_content) {
			$content = strip_tags($post->post_content);
			$content = str_replace("", "'", $content);
		} else {
			$content = get_bloginfo('description');
		}
?>
	<meta property="fb:app_id" content="453365598200378" />
	<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
	<meta property="og:url" content="<?php echo the_permalink(); ?>"/>
	<meta property="og:type" content="article"/>
	<meta property="og:title" content="<?php echo the_title(); ?>"/>
	<meta property="og:description" content="<?php echo $content; ?>"/>
	<meta property="og:image" content="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>"/>
<?php
		if(get_field('movie_trailer')){
			$field_name_movie_trailer = "movie_trailer";
			$movieTrailer = get_field_object($field_name_movie_trailer);
echo '<meta property="og:video" content="' .$movieTrailer['value']. '"/>';
?>
	<meta name="medium" content="video">
	<meta name="video_type" content="video/mp4">
	<meta name="video_width" content="1920">
	<meta name="video_height" content="1080">
<?php
}
	} else {
		return;
	}
}
add_action('wp_head', 'fb_opengraph', 5);
?>