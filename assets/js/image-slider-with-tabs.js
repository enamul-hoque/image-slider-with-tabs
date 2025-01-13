(function ($) {
	'use strict';
	
	var ISWT_Widget = function($scope) {
		// Toggle Tabs
		var $tabFilters = $scope.find(".iswt_filters"),
			$tabPane = $scope.find(".iswt_tab");

		$tabFilters.on("click", "li", function() {
			var $this = $(this);
			var $index = $this.index();

			$this.addClass("active").siblings().removeClass("active");

			// $tabPane.eq($index).addClass("active").siblings().removeClass("active");
			$tabPane.eq($index).fadeIn().siblings().hide();
		});

		// Slider
        var $sliderList = $scope.find(".swiper");
        const Swiper = elementorFrontend.utils.swiper;

		$sliderList.each(function(index, element) {
			var $this = $(this);

			var $slider = new Swiper($this, {
				slidesPerView: 1,
				spaceBetween: 30,
				navigation: {
					prevEl: ".iswt_prev-" + index,
					nextEl: ".iswt_next-" + index
				},
				breakpoints: {
					768: {
						slidesPerView: $this.data("slidesperview")
					}
				}
			});
		});
	};
	
	// Make sure you run this code under Elementor.
	$(window).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction('frontend/element_ready/iswt_widget.default', ISWT_Widget);
	} );
}(jQuery));
