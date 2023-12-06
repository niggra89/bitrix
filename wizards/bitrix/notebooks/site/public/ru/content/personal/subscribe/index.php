<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка");
$APPLICATION->AddChainItem("Подписка", "");
?>
<div class="line"><span  class="personal_title">Подписка</span>
	<?$APPLICATION->IncludeComponent("bitrix:menu","personal",Array(
		"ROOT_MENU_TYPE" => "personal", 
		"MAX_LEVEL" => "1", 
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N", 
		"MENU_CACHE_TIME" => "3600", 
		"MENU_CACHE_USE_GROUPS" => "Y", 
		"MENU_CACHE_GET_VARS" => "" 
	),false
);?></div>
<div class="line">
<?$APPLICATION->IncludeComponent("bitrix:subscribe.edit","",Array(
		"AJAX_MODE" => "N", 
		"SHOW_HIDDEN" => "Y", 
		"ALLOW_ANONYMOUS" => "Y", 
		"SHOW_AUTH_LINKS" => "Y", 
		"CACHE_TYPE" => "A", 
		"CACHE_TIME" => "3600", 
		"SET_TITLE" => "Y", 
		"AJAX_OPTION_SHADOW" => "Y", 
		"AJAX_OPTION_JUMP" => "N", 
		"AJAX_OPTION_STYLE" => "Y", 
		"AJAX_OPTION_HISTORY" => "N" 
	),false
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>