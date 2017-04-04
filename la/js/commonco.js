jQuery(document).ready(function() {

//jQuery('.spincrement').spincrement();
/*
	jQuery(document).ready(function(){
	  jQuery('.item').css('height', jQuery(window).height());
	});
	jQuery(window).resize(function() {
	  jQuery('.item').css('height', jQuery(window).height());
	});
*/
	
jQuery(function() { 
  jQuery(window).scroll(function() {
    var index = jQuery(this).scrollTop();
    if(index>100) {
      
      jQuery('.navbar').css('transition', '1s');
      jQuery('.navbar-header').css('display', 'none');
      jQuery('.cont_head').css('display', 'none');
      jQuery('header[role=banner] #logo-main').css('display', 'none');
    } else if(index<10){
		
		jQuery('.navbar-header').css('display', 'block');
		jQuery('.cont_head').css('display', 'block');
		jQuery('header[role=banner] #logo-main').css('display', 'block');
	}
  }); 
});


	jQuery(".navbar ul a").mPageScroll2id();

	jQuery(".nav a").on("click", function(){
	   jQuery(".nav").find(".active").removeClass("active");
	   jQuery(this).parent().addClass("active");
	});

jQuery(window).load(function() {

	jQuery(".loader_inner").fadeOut();
	jQuery(".loader").delay(400).fadeOut("slow");



}); 

});
