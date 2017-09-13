jQuery('.movieGallery p').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.movieGalleryThumb p'
});
jQuery('.movieGallery p').slickLightbox();
jQuery('.movieGalleryThumb p').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.movieGallery p',
  dots: false,
  arrows: false,
  centerMode: true,
  focusOnSelect: true
});
jQuery(".movieGalleryThumb p a").removeAttr('href');
jQuery(".movieGallery, .movieGalleryThumb").addClass("tricky");
/*
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=453365598200378";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/