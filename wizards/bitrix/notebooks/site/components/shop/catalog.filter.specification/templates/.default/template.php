<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=$arParams["RESULT_URL"]?>" method="POST" class="filter">
	<input type="hidden" value="<?=$arParams["SECTION_ID"]?>" name="SECTION_ID" />
	<div class="line" >

		<div class="filter_result" <?if(count($arResult["SELECTED_VALUE"])>0||($arResult["SELECTED_PRICE"]["FROM"]!=$arResult["MIN_PRICE"]||$arResult["SELECTED_PRICE"]["TO"]!=$arResult["MAX_PRICE"])){echo "style='display:block;'";}?>>
			<div id="selected_props" class="line">
				<p class="selected_props"><?=GetMessage("selected_filter");?></p>
				<?foreach($arResult["SELECTED_VALUE"] as $prop_value){?>
					<div class="line">
						<span><?=trim($prop_value["NAME"]).":";?></span>
						<a href="#" data="prop_value_<?=$prop_value["ID"]?>" class="selected_prop_value"><?=$prop_value["VALUE"]?><div class="closeFilter_button">&nbsp;</div></a>
						<input type="hidden" name="filter[]" value="<?=$prop_value["ID"]?>" />
					</div>
				<?}?>
				<?if($arResult["SELECTED_PRICE"]["FROM"]!=$arResult["MIN_PRICE"]||$arResult["SELECTED_PRICE"]["TO"]!=$arResult["MAX_PRICE"]){?>
					<div class="line priceInterval">
						<span><?echo GetMessage("filter_price");?></span>
						<a href='javascript:void(0);' ><?echo GetMessage("filter_price_from");?><?=$arResult["SELECTED_PRICE"]["FROM"]?><?echo GetMessage("filter_price_to");?><?=$arResult["SELECTED_PRICE"]["TO"]?><?echo GetMessage("filter_price_currency");?><div class="closeFilter_button">&nbsp;</div></a>
					</div>
				<?}?>
			</div>	
			<div class="products_count line" >
				<?echo GetMessage("selected_count");?><span class="count" ><?=$arResult["ELEMENTS_COUNT"]?></span>. <a class="show" href="#" onclick="javascript:$('.filter').submit();return false;">&nbsp;</a> 
			</div>
			<div class="line">
				<a href="<?=$APPLICATION->GetCurPageParam("", array("filter","filter_price"))?>" class="clear_all" onclick="javascript:clearFilter();return false;"></a>
			</div>
		</div>

		<?if($arParams["SHOW_PRICE"]=="Y"){?>
		<!------------      start price slider      ------------>
			<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui-1.7.3.custom.min.js"></script>
			<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/ui-lightness/jquery-ui-1.7.3.custom.css");?>

			<script>
			$(function() {
				$( "#slider-range" ).slider({
					range: true,
					animate: true,
					min: <?=$arResult["MIN_PRICE"]?>,
					max: <?=$arResult["MAX_PRICE"]?>,
					values: [ <?=$arResult["SELECTED_PRICE"]["FROM"]?>, <?=$arResult["SELECTED_PRICE"]["TO"]?> ],
					slide: function( event, ui ) {
						$( "#amount" ).val( "<?echo GetMessage("filter_price_from");?>" + ui.values[ 0 ] + "<?echo GetMessage("filter_price_to");?>" + ui.values[ 1 ] +"<?echo GetMessage("filter_price_currency");?>");
					},
					change: function(event, ui) {
						$( "#amount" ).val( "<?echo GetMessage("filter_price_from");?>" + ui.values[ 0 ] + "<?echo GetMessage("filter_price_to");?>" + ui.values[ 1 ] +"<?echo GetMessage("filter_price_currency");?>");		
						$( "#selected_prices .min_price" ).val( ui.values[ 0 ] );
						$( "#selected_prices .max_price" ).val( ui.values[ 1 ] );
						if(event.which==1){
							addPriceToFilter($( "#slider-range" ).slider( "values", 0 ),$( "#slider-range" ).slider( "values", 1 ));
							filter();	
						}			
					}
				});
				$( "#amount" ).val( "<?echo GetMessage("filter_price_from");?>" + $( "#slider-range" ).slider( "values", 0 ) +
					"<?echo GetMessage("filter_price_to");?>" + $( "#slider-range" ).slider( "values", 1 ) + "<?echo GetMessage("filter_price_currency");?>");
				$( "#selected_prices .min_price" ).val( $( "#slider-range" ).slider( "values", 0 ) );
					$( "#selected_prices .max_price" ).val( $( "#slider-range" ).slider( "values", 1 ) );
			});
			function addPriceToFilter(from,to)
			{
				if($('#selected_props .priceInterval').length)
				{
					$('#selected_props .priceInterval a').html('<?echo GetMessage("filter_price_from");?>' + from + '<?echo GetMessage("filter_price_to");?>' + to + '<?echo GetMessage("filter_price_currency");?>'+'<div class="closeFilter_button">&nbsp;</div>');
				}
				else
				{
					var a_price = $("<a href='javascript:void(0);' ></a>").html('<?echo GetMessage("filter_price_from");?>' + from + '<?echo GetMessage("filter_price_to");?>' + to + '<?echo GetMessage("filter_price_currency");?>'+'<div class="closeFilter_button">&nbsp;</div>').bind('click',function(){
						$(this).parent().remove();
						var max = $( "#slider-range" ).slider( "option", "max" );
						var min = $( "#slider-range" ).slider( "option", "min" );
						$( "#slider-range" ).slider( "values", 0 ,min);$( "#slider-range" ).slider( "values", 1 ,max);
						filter();
					});		
					var line = $("<div class='line priceInterval'></div>").append("<span><?echo GetMessage("filter_price");?></span>").append(a_price);	
					line.appendTo('#selected_props');	
				}
				return false;			}
			

			$(document).ready(function(){
				$('#selected_prices input').bind('keyup',function(e)
				{
					var code = (e.keyCode ? e.keyCode : e.which);
					if(code == 13)
					{
						var slider_min = $( "#slider-range" ).slider( "option", "min" );	
						var slider_max = $( "#slider-range" ).slider( "option", "max" );	
							
						var cur_val = $(this).attr('value');
						
						var min_p = $('#selected_prices input.min_price').attr('value');
						var max_p = $('#selected_prices input.max_price').attr('value');
						
						min_p = intval(min_p);max_p = intval(max_p);cur_val = intval(cur_val);
						
						if((min_p-max_p)>0){
							if(min_p==cur_val){
								max_p=min_p;
							}
							if(max_p==cur_val){
								min_p=max_p;
							}
						}

						if(min_p<slider_min)
							min_p = slider_min;			
						else if(min_p>slider_max)
							min_p = slider_max;							
						if(max_p>slider_max)
							max_p = slider_max;
						else if(max_p<slider_min)
							max_p = slider_min;
						

						$( "#slider-range" ).slider( "values", 0 ,min_p);
						$( "#slider-range" ).slider( "values", 1 ,max_p);
						addPriceToFilter($( "#slider-range" ).slider( "values", 0 ),$( "#slider-range" ).slider( "values", 1 ));
						filter();
					}
				});
			});
			</script>
			<div class="line">
				<label for="amount" style="float:left;width:100%;margin:0 0 10px;" class="color_theme"><?echo GetMessage("filter_price");?></label>
				<div id="selected_prices">
					<?echo GetMessage("filter_price_from");?><input type="text" name="filter_price[min]" value="0" class="min_price"/>
					 <?echo GetMessage("filter_price_to");?><input type="text" name="filter_price[max]" value="0" class="max_price"/><?echo GetMessage("filter_price_currency");?>		
				</div>
			</div>
			<div class="line" style="margin-top:10px;margin-bottom: 10px;">
				<div id="slider-range"></div>
			</div>
		<?}?>
		<div class="filter_variants">
			<?foreach($arResult["ITEMS"] as $prop_first_level){?>
			<div class="line">
				<div class="prop_<?echo $prop_first_level["ID"];?>">
					<?foreach($prop_first_level["VALUES"] as $prop_name){?>
						<?
						$visible = false;
						foreach($prop_name["VALUE"] as $prop_value){
							if($prop_value["VISIBLE"]!="N")$visible = true;
						}?>

						<p class="prop_name prop_<?echo $prop_name["ID"];?> <?if($prop_name["SELECTED"]=="Y"){echo "selected";}?>" <?if($prop_name["SELECTED"]=="Y"||!$visible){echo "style='display:none;'";}?>><span class="arrow"><?echo trim($prop_name["NAME"]);?></span></p>
						<div class="prop_values prop_<?echo $prop_name["ID"];?>" <?if($prop_name["SELECTED"]=="Y"||!$visible){echo "style='display:none;'";}?>>
							<?foreach($prop_name["VALUE"] as $prop_value){?>
								<a href="#" id="prop_value_<?=$prop_value["ID"]?>" class="prop_value" <?if($prop_value["VISIBLE"]=="N"){echo "style='display:none;'";}?>><?=$prop_value["VALUE"]?></a>
							<?}?>
						</div>
					<?}?>
				</div>
			</div>
			<?}?>
		</div>
	</div>
	<input type="hidden" name="use_filter" value="Y"/>	
</form>
