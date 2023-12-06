<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="subscribe-form line">

<form action="<?=$arResult["FORM_ACTION"]?>" name="subscribe">

<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
	<div class="line">
		<label for="sf_RUB_ID_<?=$itemValue["ID"]?>" class="small_gray">
		<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> style="margin-top:0;float:left;" /> <?=$itemValue["NAME"]?>
		</label><br />
	</div>
<?endforeach;?>
				<div class="line" style="margin-top:5px;">
<span class="input" ><span class="right">
<input type="text" name="sf_EMAIL" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" style="width:140px;"/>
</span></span> 

	</div>
	<div class="line">
		<a href="#" onclick="forms['subscribe'].submit();return false;" style="font-size:12px;" class="color_theme"><?=GetMessage("subscr_form_button")?></a> 
	</div>
</form>
</div>
