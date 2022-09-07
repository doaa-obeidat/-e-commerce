var businessCommerceSliderAutoplay = false;

if ( '1' == businessCommerceSliderOptions.slider.autoplay ) {
	businessCommerceSliderAutoplay = {
	    delay: businessCommerceSliderOptions.slider.autoplayDelay,
	};
}

var mainSlider = new Swiper ( '#slider-section .slider', {
	autoHeight: true, //enable auto height
	loop: ( '1' == businessCommerceSliderOptions.slider.loop ),
	effect: businessCommerceSliderOptions.slider.effect,
	speed: parseInt( businessCommerceSliderOptions.slider.speed ),
	// If we need pagination
	pagination: {
		el: '#slider-section .swiper-pagination',
		type: 'bullets',
		clickable: 'true',
	},

	autoplay: businessCommerceSliderAutoplay,
	// Navigation arrows
	navigation: {
		nextEl: '#slider-section .swiper-button-next',
		prevEl: '#slider-section .swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '#slider-section .swiper-scrollbar',
	},
});

if ( 'undefined' != typeof mainSlider.el && '1' == businessCommerceSliderOptions.slider.autoplay && '1' == businessCommerceSliderOptions.slider.pauseOnHover ) {
	mainSlider.el.addEventListener( 'mouseenter', function( event ) {
		businessCommerceSlider.autoplay.stop();
	}, false);

	mainSlider.el.addEventListener( 'mouseleave', function( event ) {
		businessCommerceSlider.autoplay.start();
	}, false);
}
