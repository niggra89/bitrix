<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent("shop:catalog.sections.top", ".default", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"SECTION_ID" => $arParams["SECTION_ID"],
	"SHOW_ALL" => $arParams["SHOW_ALL"],
	"SHOW_NEW" =>  $arParams["SHOW_NEW"],
	"SECTION_FIELDS" => array(),
	"SECTION_USER_FIELDS" => array(),
	"SECTION_SORT_FIELD" => "sort",
	"SECTION_SORT_ORDER" => "asc",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => $arParams["FILTER_NAME"],
	"SECTION_COUNT" => "20",
	"ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "specification",
		2 => "",
	),
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => $arParams["BASKET_URL"],
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"CACHE_TYPE" => "Y",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"DISPLAY_COMPARE" => "Y",
	"PRICE_CODE" => $arParams["PRICE_CODE"],
	"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
	"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "Y",
	"SET_TITLE" => $arParams["SET_TITLE"],
	),
	false
);?>