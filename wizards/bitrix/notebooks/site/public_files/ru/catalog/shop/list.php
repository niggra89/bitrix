<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Интернет магазин «НОУТБУК.РУ»");
$APPLICATION->SetTitle("Главная страница");
?>
<div class="left_column">
	<div class="line">
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.compare.list",
		"compare",
		Array(
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => "products",
			"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=products-catalog)#",
			"DETAIL_URL" => "",
			"COMPARE_URL" => "#SITE_DIR#content/catalog/compare.php",
			"NAME" => "CATALOG_COMPARE_LIST",
			"AJAX_OPTION_SHADOW" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => ""
		)
	);?> 
	</div>
<div class="line">
	<?	$APPLICATION->IncludeComponent (
	"shop:catalog.filter.specification",
		"",
		Array(
			"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=products-catalog)#",
			"IBLOCK_SPECIFICATION_ID" => "#IBLOCK.ID(XML_ID=products-characteristics)#",
			"FILTER_NAME" => "arrFilter",
			"FILTER_SPECIFICATION_NAME" => "arrFilterS",		
			"SECTION_ID" => $_REQUEST["SECTION_ID"],
			"IBLOCK_PRICE_CODE" => 1,
			"SEF_MODE" => "Y",
			"SEF_FOLDER" => "#SITE_DIR#catalog-section/",
			"SEF_URL_TEMPLATES" => array(
				"sections" => "#SECTION_ID#/",
				"list" => "#SECTION_ID#/#params#/",
			)
		),
	false
	);
	?>
	</div>

</div>
<div class="right_column">
	  <div class="line">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb","breadcrumb",Array(
					"START_FROM" => "0", 
					"PATH" => "", 
					"SITE_ID" => SITE_ID 
				),true
			);?>
		</div><div class="line">
<?
global $arrFilterS;global $arrFilter;

$arVariables = array();
$page = CComponentEngine::ParseComponentPath("#SITE_DIR#catalog-section/", array(
	"sections" => "#SECTION_ID#/",
	"list" => "#SECTION_ID#/#params#/",
), $arVariables);

if(isset($arVariables["SECTION_ID"])){
	$res = CIBlockSection::GetByID($arVariables["SECTION_ID"]);
	if($ar_res = $res->GetNext()){
		if($ar_res["NAME"]=="Ноутбуки"){
			$all="Y";$new="Y";
			}
	}
}?>
<?$APPLICATION->IncludeComponent("shop:catalog.sections.or.list", ".default", array(
	"IBLOCK_TYPE" => "products",
	"IBLOCK_ID" => "#IBLOCK.ID(XML_ID=products-catalog)#",
	"FILTER_NAME" => "arrFilter",
	"FILTER_SPECIFICATION_NAME" => "arrFilterS",	
	"SHOW_ALL" => $all,
	"SHOW_NEW" => $new,
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"BASKET_URL" => "#SITE_DIR#content/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "#SITE_DIR#catalog-section/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"DETAIL_META_KEYWORDS" => "-",
	"DETAIL_META_DESCRIPTION" => "-",
	"DETAIL_BROWSER_TITLE" => "-",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"PAGE_ELEMENT_COUNT" => "12",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"TOP_ELEMENT_COUNT" => "9",
	"TOP_LINE_ELEMENT_COUNT" => "2",
	"TOP_ELEMENT_SORT_FIELD" => "sort",
	"TOP_ELEMENT_SORT_ORDER" => "asc",
	"TOP_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"VARIABLE_ALIASES" => array(
		"SECTION_ID" => "SECTION_ID",
		"ELEMENT_ID" => "ELEMENT_ID",
	),
	"SEF_URL_TEMPLATES" => array(
		"sections" => "#SECTION_ID#/",
		"list" => "#SECTION_ID#/#params#/",
	)
	),
	false
);?>
</div></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>