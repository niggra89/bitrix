<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list","bottom_menu",Array(
		"IBLOCK_TYPE" => "products", 
		"IBLOCK_ID" => "#IBLOCK_CATALOG_ID#", 
		"SECTION_ID" => "", 
		"SECTION_CODE" => "", 
		"SECTION_URL" => "", 
		"COUNT_ELEMENTS" => "N", 
		"TOP_DEPTH" => "", 
		"ADD_SECTIONS_CHAIN" => "N", 
		"CACHE_TYPE" => "A", 
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y" 
	)
);?>