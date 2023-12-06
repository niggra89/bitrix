$(document).ready(function(){
	equal_cols();
	$('a.prop_value').bind('click',function()
	{
		$(this).parent().prev().addClass('selected').css('display','none');
		$(this).parent().css('display','none');
		var a = $(this).clone();
		a.attr('data',$(this).attr('id'));
		a.attr('id','');
		a.bind('click',function(){
			//alert($(this).attr('data'));
			$('.filter_variants a#'+$(this).attr('data')).parent().css('display','block').prev().css('display','block');
			$(this).parent().remove();
			filter();
			return false;
		});
		var val = $(this).attr('id').substring(11);
		a.append('<div class="closeFilter_button">&nbsp;</div>');
		var line = $("<div class='line'></div>").append("<span>"+$(this).parent().prev().clone().html()+":</span>").append(a).append("<input type='hidden' value='"+val+"' name='filter[]'></input>");	
		line.appendTo('#selected_props');		
		filter();
		return false;
	});
	$('a.selected_prop_value').bind('click',function()
	{
		$('a#'+$(this).attr('data')).parent().css('display','block').prev().css('display','block');			
		$(this).prev().remove();
		$(this).next().remove();
		$(this).remove();
		filter();
		return false;
	});
	
	$('.priceInterval a').bind('click',function(){
		$(this).parent().remove();
		var max = $( "#slider-range" ).slider( "option", "max" );
		var min = $( "#slider-range" ).slider( "option", "min" );
		$( "#slider-range" ).slider( "values", 0 ,min);$( "#slider-range" ).slider( "values", 1 ,max);
		filter();
	});	
	
});
function equal_cols()
{
	var lh = $('.left_column').css('height','auto');
	var lh = $('.left_column').height();
	var rh = $('.right_column').height();
	if(lh<rh)
	{
		$('.left_column').height(rh);
	}
}
function filter()
{
	var selected_p = new Object();
	var i=0, j=0;
	$('#selected_props input').each(function(){
		selected_p['filter_prop['+i+']']=$(this).attr('value');
		i++;
	});
	//---------------------- забираем цены -------------------------
	$('#selected_prices input').each(function(){
		selected_p['filter_price['+j+']']=$(this).attr('value');
		j++;
	});
	//alert(selected_p);
	//--------------------------------------------------------------
	selected_p["IBLOCK_ID"]=IBLOCK_ID;
	selected_p["SECTION_ID"]=SECTION_ID;
	$.ajax({
		url: '/bitrix/components/shop/catalog.filter.specification/templates/.default/filter_count.php',			
		success: function( data ) {		
			var jdata = jQuery.parseJSON(data);
			//alert(jdata);
			reCount(jdata.count, jdata.props);
		},
		type:"POST",
		data:selected_p
	});	
}
function inProp(val,props)
{
	for(var i in props) {
		if(props[i]==val)
			return true;
	}
	return false;
}
function reCount(count,props)
{
	$('.products_count .count').html(count);
	$('.products_count').css('display','block');
	
	$('.prop_name').each(function(){
		var visible = false;
		$(this).next().find('a.prop_value').each(function(){
			var id = $(this).attr('id').substring(11);
			
			if(!inProp(id,props))
			{
				$(this).css('display','none');
			}
			else
			{
				$(this).css('display','inline-block');		
				visible = true;				
			}
		});
		
		if(!visible){
			$(this).css('display','none');
			$(this).next().css('display','none');
		}
		else
		{
			if(!$(this).hasClass('selected'))
			{
				$(this).css('display','inline');
				$(this).next().css('display','block');
			}
		}
	});
	if($('div#selected_props a').length){
		$('p.selected_props').css('display','inline');
	}
	else
	{
		$('p.selected_props').css('display','none');
	}
	$('.filter_result').css('display','block');
	if(count==0)
	{
		$('.products_count a.show').css('display','none');
	}
	else
	{
		$('.products_count a.show').css('display','inline-block');
	}
	equal_cols();
}

function intval( mixed_var, base ) {	
				var tmp;

				if( typeof( mixed_var ) == 'string' ){
					tmp = parseInt(mixed_var);
					if(isNaN(tmp)){
						return 0;
					} else{
						return tmp.toString(base || 10);
					}
				} else if( typeof( mixed_var ) == 'number' ){
					return Math.floor(mixed_var);
				} else{
					return 0;
				}
			}
function clearFilter()
{
	$('#selected_props').find('.line').each(function(){
		$(this).remove();
	});

	if($( "#slider-range" ).attr('id')){
	var max = $( "#slider-range" ).slider( "option", "max" );
		var min = $( "#slider-range" ).slider( "option", "min" );
		$( "#slider-range" ).slider( "values", 0 ,min);$( "#slider-range" ).slider( "values", 1 ,max);
	}
	$('.filter').submit();
}