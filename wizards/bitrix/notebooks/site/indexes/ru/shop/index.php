<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Интернет-магазин ноутбуков");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Главная страница");
?>

<h2>Лучшие предложения недели</h2>
<div class="best">
<?global $top_filter; $top_filter = Array();$APPLICATION->IncludeComponent(
"bitrix:catalog.top",
	"main",
	Array(
		"IBLOCK_ID" => "#IBLOCK_CATALOG_ID#",
		"ELEMENT_SORT_FIELD" => "SHOWS",
		"ELEMENT_SORT_ORDER" => "desc",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "#SITE_DIR#personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DISPLAY_COMPARE" => "N",
		"ELEMENT_COUNT" => "5",
		//"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array("specification"),
		"OFFERS_FIELD_CODE" => array(),
		"OFFERS_PROPERTY_CODE" => array(),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"PRICE_CODE" => array("BASE"),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"OFFERS_CART_PROPERTIES" => array(),
		"FILTER_NAME" => "top_filter",
	),
false
);?>

</div>	
<div class="line">
	<div class="col1">
		<h3>Новости и спецпредложения</h3>
		<?$APPLICATION->IncludeComponent("bitrix:news.list","news_main",Array(
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => "news",
			"IBLOCK_ID" => "#IBLOCK_NEWS_ID#",
			"NEWS_COUNT" => "3",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "",
			"FIELD_CODE" => Array(""),
			"PROPERTY_CODE" => Array(""),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "Y",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"AJAX_OPTION_SHADOW" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => ""
			)
		);?>
	</div>
	<div class="col2">
		<h3>Полезные статьи</h3>
		<?$APPLICATION->IncludeComponent("bitrix:news.list","news_main",Array(
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => "news",
			"IBLOCK_ID" => "#IBLOCK_ARTICLES_ID#",
			"NEWS_COUNT" => "3",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "",
			"FIELD_CODE" => Array(""),
			"PROPERTY_CODE" => Array(""),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "Y",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"AJAX_OPTION_SHADOW" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => ""
			)
		);?>

	</div>
	<div class="col3">	
		<div class="line">
			<!--#VOTE#-->
		</div>		
		<div class="subscribe line">
			<p style="font-size:12px;">Подписка</p>
			
			<?$APPLICATION->IncludeComponent("bitrix:subscribe.form","main_page",Array(
					"USE_PERSONALIZATION" => "Y", 
					"PAGE" => "#SITE_DIR#content/personal/subscribe/", 
					"SHOW_HIDDEN" => "Y", 
					"CACHE_TYPE" => "A", 
					"CACHE_TIME" => "3600" 
				),false
			);?>
		</div>
		
	</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>