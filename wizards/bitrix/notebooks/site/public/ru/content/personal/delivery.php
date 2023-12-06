<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Профили доставки");
$APPLICATION->AddChainItem("Профили доставки", "");
?>
	<div class="line"><span  class="personal_title">Профили доставки</span>
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
<div class="line">
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.profile","profiles",Array(
		"PER_PAGE" => 20,
		"USE_AJAX_LOCATIONS" => "Y",
		"VARIABLE_ALIASES" => Array(
			"list" => Array(),
			"detail" => Array(
				"ID" => "ID"
			),
		)
	)
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>