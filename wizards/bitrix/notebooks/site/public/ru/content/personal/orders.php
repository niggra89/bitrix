<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
$APPLICATION->AddChainItem("Заказы", "");
?>
	<div class="line"><span  class="personal_title">Заказы</span>
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
);?></div>
<div class="orders" style="float:left;">
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order","list",Array(
		"SEF_MODE" => "N",
		"ORDERS_PER_PAGE" => 20,
		"PATH_TO_PAYMENT" => "#SITE_DIR#content/personal/payment.php",
		
		"PATH_TO_BASKET" => "#SITE_DIR#content/personal/basket.php",
		"SET_TITLE" => "Y",
		"SAVE_IN_SESSION" => "Y",
		"NAV_TEMPLATE" => " ",
		"PROP_1" => Array(),
		"PROP_2" => Array(),

		"VARIABLE_ALIASES" => Array(
			"list" => Array(),
			"detail" => Array(
				"ID" => "ID"
			),
			"cancel" => Array(
				"ID" => "ID"
			),
		)
	),false
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>