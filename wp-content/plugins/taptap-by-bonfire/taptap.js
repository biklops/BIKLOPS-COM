<!-- BEGIN MENU -->
jQuery('.taptap-menu-button-wrapper').on('touchstart click', function(e) {
'use strict';
	e.preventDefault();
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
		} else {
			/* hide main wrapper */
			jQuery('.taptap-main-wrapper').addClass('taptap-main-wrapper-active');
			/* show background color */
			jQuery('.taptap-background-color').addClass('taptap-background-color-active');
			/* show background image */
			jQuery('.taptap-background-image').addClass('taptap-background-image-active');
			/* show expanded menu button */
			jQuery('.taptap-menu-button-wrapper').addClass('taptap-menu-active');
			/* show menu */
			jQuery('.taptap-menu').addClass('taptap-menu-active');
		}
});
<!-- END MENU -->

<!-- BEGIN HIDE MENU WHEN ESC BUTTON PRESSED -->
jQuery(document).keyup(function(e) {
	if (e.keyCode == 27) { 

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

		return false;

	}
});
<!-- END HIDE MENU WHEN ESC BUTTON PRESSED -->

<!-- BEGIN SHOW SEARCH FORM -->
jQuery('.taptap-search-button, .taptap-search-button-right').on('touchstart click', function(e) {
'use strict';
	e.preventDefault();
		if(jQuery('.taptap-search-wrapper').hasClass('taptap-search-wrapper-active'))
		{
			/* hide search field */
			jQuery('.taptap-search-wrapper').removeClass('taptap-search-wrapper-active');
			jQuery('.taptap-search-wrapper #searchform #s').blur();
		} else {
			/* show search field */
			setTimeout(function(){
				jQuery('.taptap-search-wrapper').addClass('taptap-search-wrapper-active');
			},100);
			/* focus search field */
			jQuery('.taptap-search-wrapper #searchform #s').focus();
		}
});
<!-- END SHOW SEARCH FORM -->

<!-- BEGIN HIDE SEARCH FORM -->
jQuery('.taptap-search-close-icon').on('touchstart click', function(e) {
'use strict';
	e.preventDefault();		
		/* hide search field */
		jQuery('.taptap-search-wrapper').removeClass('taptap-search-wrapper-active');
		jQuery('.taptap-search-wrapper #searchform #s').blur();
});
<!-- END HIDE SEARCH FORM -->

<!-- BEGIN REMOVE MENU DESCRIPTION DIV IF NO DESCRIPTION ENTERED -->
jQuery(document).ready(function() {
'use strict';
	jQuery('.taptap-menu-item-description:empty').remove();
});
<!-- END REMOVE MENU DESCRIPTION DIV IF NO DESCRIPTION ENTERED -->