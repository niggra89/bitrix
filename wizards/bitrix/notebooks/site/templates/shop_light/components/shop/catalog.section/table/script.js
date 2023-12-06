$(document).ready(function(){
	$('.line_item2').each(function(){
		var n_h = 0;
		$(this).find('.element_item').each(function(){
			var e_height = $(this).find('.name').height()+$(this).find('.elem_descr').height();
			if(n_h<e_height)n_h = e_height;
		});
		$(this).find('.element_item').each(function(){
			var name_height = $(this).find('.name').height();
			$(this).find('.elem_descr').height(n_h-name_height);
		});	
		
		var p_h = 0;
		$(this).find('.price_m').each(function(){
			if(p_h<$(this).height())p_h = $(this).height();
		});
		$(this).find('.price_m').each(function(){
			$(this).height(p_h);
		});
	});
});