<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Профиль покупателя");
$APPLICATION->AddChainItem("Профиль покупателя", "");
?>	<div class="line"><span  class="personal_title">Профиль покупателя</span>
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
<div class="line"><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"user",
	Array(
		"SET_TITLE" => "Y", 
	)
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>