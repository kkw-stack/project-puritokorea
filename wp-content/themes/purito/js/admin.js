/*
* File       : js/admin.js
* Author     : STUDIO-JT (NICO)
*
* SUMMARY:
* INIT
* FUNCTIONS
*/

jQuery(function($){

	/* **************************************** *
	 * INIT
	 * **************************************** */
	logo_link();
	// page_list_add_type();


    
	/* **************************************** *
	 * FUNCTIONS
	 * **************************************** */
	// ADD LINK TO FRONT MAIN PAGE
	function logo_link(){
		
		$('#wpadminbar').prepend('<a class="jt_logo_link" href="/"><span class=" screen-reader-text">메인으로</span></a>');
		
	}
	
	// CUSTOM ADMIN UI LIST
	/*
	function page_list_add_type(){
		
		var $disableItems = $('.post-type-page #the-list').find('#post-SOME-ID,');
        var $componentItems = $('.post-type-page #the-list').find('#post-SOME-ID,');
		
		// Add disable ui class
		$disableItems.addClass('jt_has_redirect');

		// Disable click
		$('.post-type-page:not(.jt-user-1)').find('tr.jt_has_redirect a').on('click',function(e){ 
			e.preventDefault();
			e.stopPropagation();
		});
		
		// Add component class
		$componentItems.find('.row-title').append('<span class="jt_component_mark">컴포넌트</span>');
		
	}
	*/

})