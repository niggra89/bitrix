<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="basket-line">
	<?
	//print_r($arResult);
	if (IntVal($arResult["NUM_PRODUCTS"])>0)
	{
		?>
		<a href="<?=$arParams["PATH_TO_BASKET"]?>" class="basket-line-basket"></a>
		<a href="<?=$arParams["PATH_TO_BASKET"]?>"><?=GetMessage("basket")?></a> (<?=$arResult["NUM_PRODUCTS"]?><?=GetMessage("basket_element")?><?=BasketNumberWordEndings($arResult["NUM_PRODUCTS"])?>)
		<?
	}
	else
	{
		?>
		<div class="basket-line-basket"></div>
		<?=$arResult["ERROR_MESSAGE"]?><?
	}
	if($arParams["SHOW_PERSONAL_LINK"] == "Y")
	{
		?>
		<a href="<?=$arParams["PATH_TO_PERSONAL"]?>" class="basket-line-personal"></a>
		<a href="<?=$arParams["PATH_TO_PERSONAL"]?>"><?=GetMessage("TSB1_PERSONAL") ?></a>
		<?
	}
	?>
</div>