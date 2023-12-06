<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["FORM_TYPE"] == "login"):?>
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>
<?if($arResult["AUTH_SERVICES"]):?>
<div style="text-align: right; margin-top: 5px;">
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
?>
</div>
<?endif?>
<?endif?>