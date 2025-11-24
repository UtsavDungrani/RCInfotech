jQuery(document).ready(function () {
  if (jQuery("#rev_slider_4_1").revolution == undefined) {
    revslider_showDoubleJqueryError("#rev_slider_4_1");
  } else {
    jQuery("#rev_slider_4_1")
      .show()
      .revolution({
        sliderType: "standard",
        jsFileLocation: "revolution/js/",
        sliderLayout: "fullwidth",
        dottedOverlay: "none",
        delay: 9000,
        navigation: {
          keyboardNavigation: "off",
          keyboard_direction: "horizontal",
          mouseScrollNavigation: "off",
          mouseScrollReverse: "default",
          onHoverStop: "on",
          touch: {
            touchenabled: "on",
            swipe_threshold: 75,
            swipe_min_touches: 1,
            swipe_direction: "horizontal",
            drag_block_vertical: false,
          },
          arrows: {
            style: "zeus",
            enable: true,
            hide_onmobile: true,
            hide_under: 600,
            hide_onleave: true,
            hide_delay: 200,
            hide_delay_mobile: 1200,
            tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
            left: {
              h_align: "left",
              v_align: "center",
              h_offset: 20,
              v_offset: 0,
            },
            right: {
              h_align: "right",
              v_align: "center",
              h_offset: 20,
              v_offset: 0,
            },
          },
          bullets: {
            enable: true,
            hide_onmobile: true,
            hide_under: 600,
            style: "zeus",
            hide_onleave: true,
            hide_delay: 200,
            hide_delay_mobile: 1200,
            direction: "horizontal",
            h_align: "center",
            v_align: "bottom",
            h_offset: 0,
            v_offset: 50,
            space: 5,
            tmp: '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>',
          },
        },
        viewPort: {
          enable: true,
          outof: "pause",
          visible_area: "80%",
          presize: false,
        },
        responsiveLevels: [1240, 1024, 778, 480],
        visibilityLevels: [1240, 1024, 778, 480],
        gridwidth: [1240, 1024, 778, 480],
        gridheight: [600, 500, 400, 300],
        lazyType: "none",
        parallax: {
          type: "scroll",
          origo: "slidercenter",
          speed: 400,
          levels: [
            5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 46, 47, 48, 49, 50, 55,
          ],
          type: "scroll",
        },
        shadow: 0,
        spinner: "off",
        stopLoop: "off",
        stopAfterLoops: -1,
        stopAtSlide: -1,
        shuffle: "off",
        autoHeight: "off",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: false,
        fallbacks: {
          simplifyAll: "off",
          nextSlideOnWindowFocus: "off",
          disableFocusListener: false,
        },
      });
  }
});
