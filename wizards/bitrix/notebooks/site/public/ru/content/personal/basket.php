<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
$APPLICATION->AddChainItem("Корзина", "");?>
		<div class="line">
		<span class="personal_title">Корзина</span>
	<?$APPLICATION->IncludeComponent("bitrix:menu","personal",Array(
		"ROOT_MENU_TYPE" => "personal", 
		"MAX_LEVEL" => "1", 
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N", 
		"MENU_CACHE_TIME" => "3600", 
		"MENU_CACHE_USE_GROUPS" => "Y", 
		"MENU_CACHE_GET_VARS" => "" 
	),true
);?>
</div><div class="line">
 <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket","basket",Array(
		"PATH_TO_ORDER" => "#SITE_DIR#content/personal/order.php",
		"HIDE_COUPON" => "N",
		"COLUMNS_LIST" => Array("NAME", "PRICE", "QUANTITY", "DELETE"),
		"QUANTITY_FLOAT" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"SET_TITLE" => "Y"
	)
);?></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>