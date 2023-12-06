<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.list",
	"compare",
	Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "products",
		"IBLOCK_ID" => "#IBLOCK_CATALOG_ID#",
		"DETAIL_URL" => "",
		"COMPARE_URL" => SITE_DIR."content/catalog/compare.php",
		"NAME" => "CATALOG_COMPARE_LIST",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?> 