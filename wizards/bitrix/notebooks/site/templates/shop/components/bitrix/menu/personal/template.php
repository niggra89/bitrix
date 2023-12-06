<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<div class="personal">
<ul>
<?foreach($arResult as $i => $arItem):?>
	<?if ($arItem["PERMISSION"] > "D"):?>
		<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected<?endif?>"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li><a href="" class="<?if ($arItem["SELECTED"]):?>selected<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>	
	<?endif?>
	<?if($i!=count($arResult)-1){?>
		<li><span class="bull">.</span><li>
	<?}?>
<?endforeach?>
</ul>
</div>
<?endif?>