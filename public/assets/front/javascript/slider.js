$(document).ready(function() {
    $('.tp-banner').show().revolution({
        sliderType:"standard",
        sliderLayout:"auto",
        dottedOverlay:"none",
        delay:9000,
        navigation: {
            onHoverStop:"off",
        },
        responsiveLevels:[1240,1240,778,480],
        visibilityLevels:[1240,1240,778,480],
        gridwidth:[1240,1024,778,480],
        gridheight:[860,768,800,420],
        lazyType:"none",
        shadow:0,
        spinner:"spinner0",
        stopLoop:"off",
        stopAfterLoops:-1,
        stopAtSlide:-1,
        shuffle:"off",
        autoHeight:"off",
        disableProgressBar:"on",
        hideThumbsOnMobile:"off",
        hideSliderAtLimit:0,
        hideCaptionAtLimit:0,
        hideAllCaptionAtLilmit:0,
        debugMode:false,
      
    });

    // revapi4 = tpj("#rev_slider_4_1").show().revolution({
    //                     sliderType:"standard",
    //                     sliderLayout:"auto",
    //                     dottedOverlay:"none",
    //                     delay:9000,
    //                     navigation: {
    //                         onHoverStop:"off",
    //                     },
    //                     responsiveLevels:[1240,1240,778,480],
    //                     visibilityLevels:[1240,1240,778,480],
    //                     gridwidth:[1240,1024,778,480],
    //                     gridheight:[860,768,800,420],
    //                     lazyType:"none",
    //                     shadow:0,
    //                     spinner:"spinner0",
    //                     stopLoop:"off",
    //                     stopAfterLoops:-1,
    //                     stopAtSlide:-1,
    //                     shuffle:"off",
    //                     autoHeight:"off",
    //                     disableProgressBar:"on",
    //                     hideThumbsOnMobile:"off",
    //                     hideSliderAtLimit:0,
    //                     hideCaptionAtLimit:0,
    //                     hideAllCaptionAtLilmit:0,
    //                     debugMode:false,
    //                     fallbacks: {
    //                         simplifyAll:"off",
    //                         nextSlideOnWindowFocus:"off",
    //                         disableFocusListener:false,
    //                     }
    //                 });
});