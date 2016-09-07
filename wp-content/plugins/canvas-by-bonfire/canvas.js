/* show/hide slideout (triangle button) */
jQuery('.bonfire-slideout-button, .bonfire-slideout-button-top-left, .bonfire-slideout-button-top-right, .bonfire-slideout-button-bottom-left, .canvas-text-trigger').on('touchstart click', function(e) {
e.preventDefault();
	if(jQuery('.bonfire-slideout').hasClass('bonfire-slideout-active'))
	{

		/* enable browser scroll */
		var html = jQuery('html');
		var scrollPosition = html.data('scroll-position');
		html.css('overflow', html.data('previous-overflow'));
		window.scrollTo(scrollPosition[0], scrollPosition[1]);

		/* hide canvas */
		jQuery('.bonfire-slideout').removeClass('bonfire-slideout-active');
		jQuery('.bonfire-slideout').removeClass('bonfire-slideout-active-translate');

		return false;

	} else {

		/* disable browser scroll */
		var scrollPosition = [
		self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
		self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
		];
		var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
		html.data('scroll-position', scrollPosition);
		html.data('previous-overflow', html.css('overflow'));
    	html.css('overflow', 'hidden');
		window.scrollTo(scrollPosition[0], scrollPosition[1]);

		/* show canvas */
		jQuery('.bonfire-slideout').addClass('bonfire-slideout-active');
		jQuery('.bonfire-slideout').addClass('bonfire-slideout-active-translate');

		return false;
	}
});

/* show/hide slideout (X button) */
jQuery('.bonfire-slideout-close').on('touchstart click', function(e) {
e.preventDefault();

		/* enable browser scroll */
		var html = jQuery('html');
		var scrollPosition = html.data('scroll-position');
		html.css('overflow', html.data('previous-overflow'));
		window.scrollTo(scrollPosition[0], scrollPosition[1]);

		/* hide canvas */
		jQuery('.bonfire-slideout').removeClass('bonfire-slideout-active');
		jQuery('.bonfire-slideout').removeClass('bonfire-slideout-active-translate');

		return false;
});

/* hide slideout (ESC button) */
jQuery(document).keyup(function(e) {
	if (e.keyCode == 27) { 

		/* enable browser scroll */
		var html = jQuery('html');
		var scrollPosition = html.data('scroll-position');
		html.css('overflow', html.data('previous-overflow'));
		window.scrollTo(scrollPosition[0], scrollPosition[1]);

		/* hide canvas */
		jQuery('.bonfire-slideout').removeClass('bonfire-slideout-active');
		jQuery('.bonfire-slideout').removeClass('bonfire-slideout-active-translate');

		return false;

	}
});