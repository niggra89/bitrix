<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<?	$APPLICATION->IncludeComponent (
"shop:catalog.filter.specification",
	"",
	Array(
		"IBLOCK_ID" => "#IBLOCK_CATALOG_ID#",
		"IBLOCK_SPECIFICATION_ID" => "#IBLOCK_SPECIFICATION_ID#",
		"FILTER_NAME" => "arrFilter",
		"FILTER_SPECIFICATION_NAME" => "arrFilterS",		
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"IBLOCK_PRICE_CODE" => 1,
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => SITE_DIR."catalog-section/",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "#SECTION_ID#/",
			"list" => "#SECTION_ID#/#params#/",
		)
	),
false
);
?>