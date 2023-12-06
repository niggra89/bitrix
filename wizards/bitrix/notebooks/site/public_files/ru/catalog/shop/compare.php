<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сравнение товаров");
$APPLICATION->AddChainItem("Сравнение товаров", "");
?>
<h1>Сравнение товаров</h1>
<?$APPLICATION->IncludeComponent("shop:catalog.compare.specification.result", "", array(
	"NAME" => "CATALOG_COMPARE_LIST",
	"IBLOCK_TYPE" => "products",
	"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=products-catalog)#",
	"FIELD_CODE" => array(
		0 => "PREVIEW_PICTURE",
		1 => "NAME",
	),
	"PROPERTY_CODE" => array(
		0 => "specification",
	),
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"DETAIL_URL" => "",
	"BASKET_URL" => "#SITE_DIR#content/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"PRICE_CODE" => array("BASE"),
	"USE_PRICE_COUNT" => "Н",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"DISPLAY_ELEMENT_SELECT_BOX" => "N",
	"ELEMENT_SORT_FIELD_BOX" => "name",
	"ELEMENT_SORT_ORDER_BOX" => "asc",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>