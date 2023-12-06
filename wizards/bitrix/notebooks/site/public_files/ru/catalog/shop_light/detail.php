<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Главная страница");
?>
<?$APPLICATION->IncludeComponent(
	"shop:catalog.element",
	"",
	Array(
		"IBLOCK_TYPE" => "products",
		"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=products-catalog)#",
		"IBLOCK_SPECIFICATION_ID" => "#IBLOCK.ID(XML_ID=products-characteristics)#",
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"ELEMENT_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "#SITE_DIR#personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "NAME",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"PROPERTY_CODE" => array("specification"),
		"PRICE_CODE" => array("BASE"),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_PROPERTIES" => array("specification"),
		"USE_PRODUCT_QUANTITY" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"USE_REVIEW" => "Y",
		"USE_SPECIFICATION" => "Y",
		"USE_RELATED" => "Y",
		"USE_ANALOG" => "Y",
		"FORUM_ID" => "#FORUM_ID#",
		"PATH_TO_SMILE"=>"/bitrix/images/forum/smile/",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "#SITE_DIR#catalog-item/",
		"SEF_URL_TEMPLATES" => array(
			"element" => "#ELEMENT_ID#/",
		)
	),
false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>