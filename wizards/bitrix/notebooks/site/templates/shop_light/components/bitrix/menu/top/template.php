<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<ul>
<?foreach($arResult as $i=>$arItem):?>
	<?if ($arItem["PERMISSION"] > "D"):?>
		<li class="<?if($i==count($arResult)-1):?>last<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected<?endif?>"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li class="<?if($i==count($arResult)-1):?>last<?endif?>"><a href="" class="<?if ($arItem["SELECTED"]):?>selected<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>	
	<?endif?>
<?endforeach?>
</ul>
<?endif?>