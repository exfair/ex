;(function () {

	wp.customize.bind('ready', function () {

		wp.customize.control('show_hide_slider', function (control) {
			
			// When Page Refresh
			if( !control.params.value ){
				jQuery('#customize-control-slider_height,#customize-control-customizer_break').attr('style', 'display: none !important');
			} else {
				jQuery('#customize-control-slider_height,#customize-control-customizer_break').attr('style', 'display: block !important');
			}

			// When user change the data
			control.setting.bind(function (value) {
				if(!value){
					jQuery('#customize-control-slider_height,#customize-control-customizer_break').attr('style', 'display: none !important');
				} else {
					jQuery('#customize-control-slider_height,#customize-control-customizer_break').attr('style', 'display: block !important');
				}			
			});			

		});
		
	});

})();