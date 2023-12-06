<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
				
				
<?
foreach($arResult["SECTIONS"] as $arSection){
?>
	<div class="line section">
	<h3><?=$arSection["NAME"]?></h3>
	<p><?=$arSection["DESCRIPTION"]?></p>
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"table",
	Array(
		"AJAX_MODE" => "N",
		//"IBLOCK_TYPE" => "",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arSection["ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
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
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "Y",
		"PAGE_ELEMENT_COUNT" => "2",
		"LINE_ELEMENT_COUNT" => "2",
		"PROPERTY_CODE" => array("specification"),
		//"OFFERS_FIELD_CODE" => array("ID"),
		//"OFFERS_PROPERTY_CODE" => array("CML2_LINK"),
		"OFFERS_SORT_FIELD" => "timestamp_x",
		"OFFERS_SORT_ORDER" => "asc",
		"PRICE_CODE" => array("BASE"),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		//"OFFERS_CART_PROPERTIES" => array("CML2_LINK"),
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
	</div>
<?
}
?>	


