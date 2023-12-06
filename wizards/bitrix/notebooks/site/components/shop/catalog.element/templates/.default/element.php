<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="catalog_element">
<?$ElementID=$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"",
	Array(
 		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
 		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
 		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
 		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
 		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
 		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
		"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
		"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
		"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],

		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],

 		"ELEMENT_ID" => $arParams["ELEMENT_ID"],
 		
	),
	$component
);?><a name="specification">&nbsp;</a>
<a name="reviews">&nbsp;</a>
<a name="related">&nbsp;</a>
<a name="analogs">&nbsp;</a>
<script>

function equal_table(container){
if(!$(container).length){return false;}
	$(container).find('.ar_items').each(function(){
		var hres = 0;
		$(this).find('.preview_picture img').each(function(){
			if($(this).attr('height')>hres){
				hres = $(this).attr('height');
			}
		});
		$(this).find('.preview_picture').each(function(){
			$(this).height(hres);
		});
		
		var hnameres = 0;
		$(this).find('.name').each(function(){
			if($(this).height()>hnameres){
				hnameres = $(this).height();
			}
		});

		$(this).find('.name').each(function(){
			$(this).height(hnameres);
		});
		
		var hpriceres = 0;
		$(this).find('.price_m').each(function(){
			if($(this).height()>hpriceres){
				hpriceres = $(this).height();
			}
		});

		$(this).find('.price_m').each(function(){
			$(this).height(hpriceres);
		});
		
	});
}
$(document).ready(function(){
	$('.element_menu a').bind('click',function(){
		
		
		var menu_item = $(this).attr('data');
		$('div.menu_item').each(function(){
			
			if($(this).hasClass(menu_item)){
				$(this).css('display','block');				
			}
			else
			{
				$(this).css('display','none');
			}
		});
		$('.element_menu a').removeClass('selected');
		$(this).addClass('selected');
		if(menu_item=="related")
		{
			equal_table(".catalog_analog_table");					
		}
		if(menu_item=="analogs")
		{
			equal_table(".catalog_link_table");					
		}
	});
	var t = window.location.hash;
	var sel = false;
	$('.element_menu a').each(function(){
		if($(this).hasClass('selected'))
		{
			sel = true;
			var class_menu = $(this).attr('data');
			$('div.menu_item').each(function(){			
				if($(this).hasClass(class_menu)){
					$(this).css('display','block');
				}			
			});			
		}
	});
	if(!sel)
	{
		$('.element_menu a').first().addClass('selected');
		$('div.menu_item').each(function(){			
			if($(this).hasClass($('.element_menu a').first().attr('data'))){
				$(this).css('display','block');
			}			
		});		
	}
});
</script>
<div class="line element_menu" >
	<?if($arParams["USE_SPECIFICATION"]=="Y" && $ElementID){?>
		<a href="#specification" data="specification" ><div class="left" style="height:43px;"></div><span><?=GetMessage('SPECIFICATION')?></span><div class="right"></div></a>
	<?}?>
	<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID){?>
		<a href="#reviews" data="reviews" <?if(isset($_REQUEST["MID"])){echo " class='selected' ";}?>><div class="left"></div><span><?=GetMessage('REVIEWS')?></span><div class="right"></div></a>
	<?}?>
	<?if($arParams["USE_RELATED"]=="Y" && $ElementID){?>
		<a href="#related" data="related"><div class="left"></div><span><?=GetMessage('RELATED')?></span><div class="right"></div></a>
	<?}?>
	<?if($arParams["USE_ANALOG"]=="Y" && $ElementID){?>
		<a href="#analogs" data="analogs"><div class="left"></div><span><?=GetMessage('ANALOG')?></span><div class="right"></div></a>
	<?}?>
	<br /><br /><br />
</div>
<div class="menu_content_block">
<div class="top_left"></div><div class="top_center"></div><div class="top_right"></div>
<div class="content">
<?if($arParams["USE_SPECIFICATION"]=="Y" && $ElementID):?>
<div class="menu_item specification" >
<?$APPLICATION->IncludeComponent(
	"shop:catalog.element.specification",
	"",
	Array(
		"ELEMENT_ID" => $ElementID,
		"IBLOCK_SPECIFICATION_ID" => $arParams["IBLOCK_SPECIFICATION_ID"],
		"SET_TITLE" =>"N",
	),
	$component
);?>
</div>
<?endif?>
<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID):?>
<div class="menu_item reviews">
<?$APPLICATION->IncludeComponent(
	"bitrix:forum.topic.reviews",
	"",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
		"USE_CAPTCHA" => "Y",
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"SHOW_LINK_TO_FORUM" => "N",
		"ELEMENT_ID" => $ElementID,
 		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"POST_FIRST_MESSAGE" => $arParams["POST_FIRST_MESSAGE"],
		"URL_TEMPLATES_DETAIL" => $arParams["POST_FIRST_MESSAGE"]==="Y"? $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"] :"",
		"SHOW_POST_FORM" => "N",
	),
	$component
);?>
</div>
<?endif?>
<?if($arParams["USE_RELATED"]=="Y" && $ElementID):?>
<div class="menu_item related">
<?
/*-------------------------------------------------------------------------------------------------------------------------------*/
$APPLICATION->IncludeComponent(
	"shop:catalog.elements.related",
	"",
	Array(
		"ELEMENT_ID" => $ElementID,
 		"IBLOCK_ID" => $arParams["IBLOCK_ID"],		
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SET_TITLE" => "N",
		"PROPERTY_CODE" => array("specification"),
	),
	$component
);
/*--------------------------------------------------------------------------------------------------------------------------------*/
?>
</div>
<?endif?>
<?if($arParams["USE_ANALOG"]=="Y" && $ElementID){?>
<div class="menu_item analogs">

<?
 $APPLICATION->IncludeComponent("shop:catalog.link.list","table_three",Array(
		"ELEMENT_ID" => $ElementID,
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "N",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "Y",
		"PAGE_ELEMENT_COUNT" => "5",
		"PROPERTY_CODE" => array("specification"),
		"OFFERS_FIELD_CODE" => array("ID"),
		"OFFERS_SORT_FIELD" => "timestamp_x",
		"OFFERS_SORT_ORDER" => "asc",
		"PRICE_CODE" => array(),
		"USE_PRICE_COUNT" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"OFFERS_CART_PROPERTIES" => array("CML2_LINK"),
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	),true
);
?></div><?}?>

</div>
<div class="bottom_left"></div><div class="bottom_center"></div><div class="bottom_right"></div>
</div></div>