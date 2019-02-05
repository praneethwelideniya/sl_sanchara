$(document).ready(function(){
	"use strict";	
   /* ==============================================================
		===================================================
					owl zoom silder Start
	============================================================== */
	if($('.slider').length){
		$('.slider').owlCarousel({
			loop:true,
			center: true,
			margin:30,
			responsive:{
				0:{
					items:1
				},
				450:{
					items:2
				},
				600:{
					items:2
				},
				1000:{
					items:5
				}
			}
		});
	}

	/* =======================================================================
		  		 TABS Script
	   =======================================================================
	*/	
		 $(window).scroll(function () {
			if ($(this).scrollTop() > 400) {
				$('.go-up').fadeIn();
			} else {
				$('.go-up').fadeOut();
			}
		});
		$('.go-up').on('click', function () {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});

});


