<!-- BEGIN HIDE MENU WHEN MENU ITEM CLICKED -->
jQuery('.taptap-by-bonfire ul li a').on('touchstart click', function(e) {
'use strict';
		if(jQuery('.taptap-background-color').hasClass('taptap-background-color-active'))
		{
			/* hide main wrapper */
			jQuery('.taptap-main-wrapper').removeClass('taptap-main-wrapper-active');
			/* hide background color */
			jQuery('.taptap-background-color').removeClass('taptap-background-color-active');
			/* hide background image */
			jQuery('.taptap-background-image').removeClass('taptap-background-image-active');
			/* hide expanded menu button */
			jQuery('.taptap-menu-button-wrapper').removeClass('taptap-menu-active');
			/* hide menu */
			jQuery('.taptap-menu').removeClass('taptap-menu-active');
		}
});
<!-- END HIDE MENU WHEN MENU ITEM CLICKED -->