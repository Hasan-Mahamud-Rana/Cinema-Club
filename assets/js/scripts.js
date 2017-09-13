jQuery(document).foundation();
jQuery(document).ready(function() {
  jQuery('.accordion p:empty, .orbit p:empty').remove();
  jQuery('.archive-grid .columns').last().addClass('end');
  jQuery('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').wrap("<div class='flex-video'/>");
    if (jQuery(".membership-packages > div").length === 2) {
      jQuery('<div class="mym2 hide-for-small-only">&nbsp;</div>').prependTo(".membership-packages");
    }
    if (jQuery(".membership-packages > div").length === 1) {
      jQuery('<div class="column">&nbsp;</div>').prependTo(".membership-packages");
    }
  jQuery('.movie').slick({
    dots: true,
    autoplay: true,
    infinite: true,
    arrow: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [{
    breakpoint: 1024,
    settings: {
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    dots: true
    }
    }, {
    breakpoint: 600,
    settings: {
    slidesToShow: 2,
    slidesToScroll: 2
    }
    }, {
    breakpoint: 480,
    settings: {
    slidesToShow: 2,
    slidesToScroll: 2
    }
    }]
  });
  jQuery('.lottery').slick({
    arrow: false,
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [{
    breakpoint: 1024,
    settings: {
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    dots: true
    }
    }, {
    breakpoint: 600,
    settings: {
    slidesToShow: 2,
    slidesToScroll: 2
    }
    }, {
    breakpoint: 480,
    settings: {
    slidesToShow: 2,
    slidesToScroll: 2
    }
    }]
  });
  jQuery('.flexMovie').slick({
    dots: true,
    infinite: false,
    arrow: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [{
    breakpoint: 1024,
    settings: {
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    dots: true
    }
    }, {
    breakpoint: 600,
    settings: {
    slidesToShow: 2,
    slidesToScroll: 2
    }
    }, {
    breakpoint: 480,
    settings: {
    slidesToShow: 2,
    slidesToScroll: 2
    }
    }]
  });
  jQuery('.kuponSlider').slick({
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 1,
    dots: false,
    focusOnSelect: true,
    responsive: [{
    breakpoint: 1024,
    settings: {
    slidesToShow: 4,
    slidesToScroll: 1
    }
    }, {
    breakpoint: 600,
    settings: {
    slidesToShow: 3,
    slidesToScroll: 1
    }
    }, {
    breakpoint: 480,
    settings: {
    slidesToShow: 2,
    slidesToScroll: 1
    }
  }]
  });
  jQuery(".movie, .flexMovie, .kuponSlider, .lottery, .membership-packages, .message-panel").addClass("tricky");
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
  jQuery("div.floatingPurchase")
  .mouseenter(function() {
    jQuery(this).addClass("sizeExpand");
  })
  .mouseleave(function() {
    jQuery(this).removeClass("sizeExpand");
  });
  jQuery("#menuModalMain .menu > li.menu-item-has-children")
  .mouseenter(function() {
    jQuery("#menuModalMain .menu > li.menu-item-has-children > ul.sub-menu").addClass("menuExpand");
  })
  .mouseleave(function() {
    jQuery("#menuModalMain .menu > li.menu-item-has-children > ul.sub-menu").removeClass("menuExpand");
  });
  setTimeout(function() {
    jQuery(".singleKupon > div.couponBg + div").slideUp("fast");
    jQuery("#menuModalMain .menu > li.menu-item-has-children > ul.sub-menu").slideUp("fast");
  });
  jQuery(".singleKupon > div.couponBg").mouseenter(function() {
    var myattr = jQuery(this).attr("myattr");
    jQuery(".singleKupon > div.couponBg + div").slideUp("fast");
    jQuery("div." + myattr).slideDown(300);
  });
  jQuery("#menuModalMain .menu > li.menu-item-has-children")
    .mouseenter(function() {
    jQuery("#menuModalMain .menu > li.menu-item-has-children > ul.sub-menu").slideDown(300);
  })
  .mouseleave(function() {
    jQuery("#menuModalMain .menu > li.menu-item-has-children > ul.sub-menu").slideUp("fast");
  });
  jQuery(".serverError input").focus(function() {
    jQuery(this).parent().removeClass("serverError");
    jQuery(this).parent().parent().removeClass("serverError");
  });
  jQuery("input.serverError, select.serverError").focus(function() {
    jQuery(this).removeClass("serverError");
  });
  if (localStorage.getItem('popState') != 'shown') {
    //jQuery("#cookiesPopup").delay(500).fadeIn();
    jQuery("#cookiesPopupFooter").delay(500).fadeIn();
    localStorage.setItem('popState', 'shown')
  }
  /*
  var isshow = localStorage.getItem('isshow');
  if (isshow == null) {
        localStorage.setItem('isshow', 1);
        //jQuery("#cookiesPopup").delay(500).fadeIn();
        jQuery("#cookiesPopupFooter").delay(1000).fadeIn();
  }*/
  var options = {
    valueNames: ['name', 'address', 'zipcode', 'city']
  };
  //var cinemaList = new List('cinema', options);
  var wrapperElement = jQuery('#cinema');
  var cinemaList = new List(wrapperElement[0], options);
  cinemaList.on('updated', function(list) {
    if (list.matchingItems.length > 0) {
      jQuery('ul.searchResult').removeClass("tricky").hide()
    } else {
      jQuery('ul.searchResult').addClass("tricky").show()
    }
  })
  var opts = {
    lines: 15,
    length: 10,
    width: 5,
    radius: 15,
    scale: 1,
    corners: 1,
    color: '#1b1b1b',
    opacity: 0.25,
    rotate: 0,
    direction: 1,
    speed: 1,
    trail: 60,
    fps: 20,
    zIndex: 2e9,
    className: 'spinner',
    top: '50%',
    left: '50%',
    shadow: false,
    hwaccel: false,
    position: 'absolute'
  }
  var target = document.getElementById('loader')
  var spinner = new Spinner(opts).spin(target);
    jQuery(function() {
      jQuery("ul.menu li a, .callSpin").click(function() {
      chokkor();
    });
  });
  jQuery(".invalid_credit_card_notice").addClass("showNotice").appendTo(".noticeDestination");
  function chokkor() {
    jQuery("#loader").show();
    setTimeout(function() {
      jQuery("#loader").hide();
    }, 5500);
  }
  jQuery(window).load(function() {
    jQuery("#loader").fadeOut("slow");
  });
  jQuery("a.openWhenPageload").click();
  if (jQuery("span.flex_not_active").length > 0)
  {
    jQuery("li.nav-update-card").addClass("hide");
  }
  jQuery('form').parsley();
  jQuery(function() {
    jQuery('form').parsley().on('field:validated', function() {
      jQuery("input.parsley-error").each(function() {
        var placeholder = jQuery(this).attr("data-parsley-required-message");
        jQuery(this).attr("placeholder", placeholder);
      });
    })
  });
  jQuery(function() {
    jQuery("form").on('submit', function(e){
      jQuery("input.button[type=submit]").each(function() {
        chokkor();
      });
    })
  });
});