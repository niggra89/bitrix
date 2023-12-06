$(document).ready(function(){
	$('.line_item2').each(function(){
		var e_h = 0;
		$(this).find('.elem_descr').each(function(){
			if(e_h<$(this).height())e_h = $(this).height();
		});
		$(this).find('.elem_descr').each(function(){
			$(this).height(e_h);
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