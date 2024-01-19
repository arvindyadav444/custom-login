/*!Main Css v1.54 by @Prem */
  jQuery(document).ready(function($) {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,

          fixedContentPos: false
        });
     



var owl = $('#services-slider');
         owl.owlCarousel({
           center: false,
           margin: 20,
           dots:false,
           nav:true,
           loop: true,
           responsive: {
             0: { 
               center: false,
               items: 1.2
             },
             600: { 
               center: false,
               items: 1.5
             },
             991: {
               dots:false,
               items: 3.5
             },
             1200: {
               dots:false,
               items: 4.5
             }
           }
         });






var owl = $('#testimonials');
         owl.owlCarousel({
           center: true,
           margin: 30,
           dots:false,
           nav:true,
           loop: true,
           responsive: {
             0: { 
               center: false,
			   nav:true,
               items: 1.2
             },
             600: { 
               center: false,
			    nav:true,
               items: 1.5
             },
             991: {
               dots:false,
			    nav:true,
               items: 3
             },
             1200: {
               dots:false,
			    nav:true,
               items: 3
             }
           }
         });



var owl = $('#team-slider');
         owl.owlCarousel({
           center: true,
           margin: 30,
           dots:false,
           nav:true,
           loop: true,
           responsive: {
             0: { 
               center: false,
               items: 1.3,
			   nav:false
             },
             600: { 
               center: false,
			   nav:false,
               items: 1.3
             },
             991: {
               dots:false,
               items: 2
             },
             1200: {
               dots:false,
               items: 3
             }
           }
         });

 
// header
$(window).scroll(function() {    
             var scroll = $(window).scrollTop();
         
             if (scroll >= 300) {
                 $("header").addClass("darkHeader");
             }
            else{
                $("header").removeClass("darkHeader");
            }
            });
            
            
            
             $(window).scroll(function() {    
            var scrollDeep = $(window).scrollTop();
         
            if (scrollDeep >= 500) {
                $("header").addClass("darkHeader-2");
            }
         else{
            $("header").removeClass("darkHeader-2");
         }
         });

   // Initiate the wowjs animation library

  new WOW().init();





// header
$(window).scroll(function() {    
             var scroll = $(window).scrollTop();
         
             if (scroll >= 500) {
                 $(".tabs-faq").addClass("stickty-tab");
             }
            else{
                $(".tabs-faq").removeClass("stickty-tab");
            }
});
            
			

$(".tabs-faq ul li a").click(function() {
    $(this).parent().addClass('selected').siblings().removeClass('selected');
});

 });