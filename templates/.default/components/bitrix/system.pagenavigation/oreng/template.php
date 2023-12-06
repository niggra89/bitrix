<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="system-nav-orange"> 

<?if($arResult["bDescPageNumbering"] === true):?>

	<div class="nav-title"><?=$arResult["NavTitle"]?> <?=$arResult["NavFirstRecordShow"]?> - <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <span class="nav-title_b"><?=$arResult["NavRecordCount"]?></span></div>

	<div class="nav-pages">

	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_begin")?></a>&nbsp;&nbsp;
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><img src="/bitrix/templates/TUSO_1/images/nav-left.png"/></a>&nbsp;&nbsp;
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>&nbsp;&nbsp;
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><img src="/bitrix/templates/TUSO_1/images/nav-left.png"/></a>&nbsp;&nbsp;
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><img src="/bitrix/templates/TUSO_1/images/nav-left.png"/></a>&nbsp;&nbsp;
			<?endif?>
		<?endif?>
	<?endif?>

	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<span class="nav-current-page">&nbsp;<?=$NavRecordGroupPrint?>&nbsp;</span>&nbsp;
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>&nbsp;
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>&nbsp;
		<?endif?>

		<?$arResult["nStartPage"]--?>
	<?endwhile?>

	<?if ($arResult["NavPageNomer"] > 1):?>
		&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><img src="/bitrix/templates/TUSO_1/images/nav-right.png"/></a>&nbsp;&nbsp;
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_end")?></a>&nbsp;
	<?endif?>

<?else:?>

	<div class="nav-title"><?=$arResult["NavTitle"]?> <?=$arResult["NavFirstRecordShow"]?> - <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <span class="nav-title_b"><?=$arResult["NavRecordCount"]?></span></div>

	<div class="nav-pages">

	<?if ($arResult["NavPageNomer"] > 1):?>

		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_begin")?></a>&nbsp;&nbsp;
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><img src="/bitrix/templates/TUSO_1/images/nav-left.png"/></a>
			&nbsp;|&nbsp;
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>&nbsp;&nbsp;
			<?if ($arResult["NavPageNomer"] > 2):?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><img src="/bitrix/templates/TUSO_1/images/nav-left.png"/></a>
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><img src="/bitrix/templates/TUSO_1/images/nav-left.png"/></a>
			<?endif?>
			&nbsp;&nbsp;
		<?endif?>
	<?endif?>

	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<span class="nav-current-page">&nbsp;<?=$arResult["nStartPage"]?>&nbsp;</span>&nbsp;
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>&nbsp;
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>&nbsp;
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
	

	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><img src="/bitrix/templates/TUSO_1/images/nav-right.png"/></a>&nbsp;&nbsp;
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_end")?></a>&nbsp;
	<?endif?>

<?endif?>


<?if ($arResult["bShowAll"]):?>
	<noindex>
	<?if ($arResult["NavShowAll"]):?>
		&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>&nbsp; 
	<?else:?>
		&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>&nbsp;
	<?endif?>
	</noindex>
<?endif?>

	</div>

</div>