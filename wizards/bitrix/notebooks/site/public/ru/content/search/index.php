<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");?>
<h1>Поиск</h1>
<?$APPLICATION->IncludeComponent("bitrix:search.page", "clear", array(
	"RESTART" => "Y",
	"CHECK_DATES" => "Y",
	"USE_TITLE_RANK" => "Y",
	"DEFAULT_SORT" => "rank",
	"FILTER_NAME" => "",
	"arrFILTER" => array(
		0 => "no",
		1 => "main",
		2 => "iblock_news",
		3 => "iblock_products",
	),
	"SHOW_WHERE" => "Y",
	"arrWHERE" => array(
	),
	"SHOW_WHEN" => "Y",
	"PAGE_RESULT_COUNT" => "50",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"DISPLAY_TOP_PAGER" => "Y",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Результаты поиска",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "",
	"USE_LANGUAGE_GUESS" => "Y",
	"TAGS_SORT" => "NAME",
	"TAGS_PAGE_ELEMENTS" => "150",
	"TAGS_PERIOD" => "30",
	"TAGS_URL_SEARCH" => "/search/index.php",
	"TAGS_INHERIT" => "Y",
	"FONT_MAX" => "50",
	"FONT_MIN" => "10",
	"COLOR_NEW" => "000000",
	"COLOR_OLD" => "C8C8C8",
	"PERIOD_NEW_TAGS" => "",
	"SHOW_CHAIN" => "Y",
	"COLOR_TYPE" => "Y",
	"WIDTH" => "100%",
	"USE_SUGGEST" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>