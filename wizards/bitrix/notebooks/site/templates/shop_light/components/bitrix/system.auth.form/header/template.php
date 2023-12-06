<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>
<a href="<?=SITE_DIR?>auth/"><?=GetMessage("ENTER")?></a>


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
<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
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
<?endif?>
<?endif?>

<?
//if($arResult["FORM_TYPE"] == "login")
else:
?>

<form action="<?=$arResult["AUTH_URL"]?>" name="logout">

				[<?=$arResult["USER_LOGIN"]?>]<br/>
			<div class="line">	<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>" style="float: right; margin: 2px 0;"><?=GetMessage("AUTH_PROFILE")?></a>
</div>
			<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="logout" value="yes" />
			<a href="#" onclick="forms['logout'].submit();return false;" style="float: right; margin: 2px 0;"><?=GetMessage("EXIT")?></a> 

</form>
<?endif?>