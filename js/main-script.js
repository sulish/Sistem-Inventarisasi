jQuery(document).on('ready',function(){

	jQuery('#id_register').on('keyup',function(){
	
		jQuery('#username_register').val(jQuery(this).val());
		
	});
});