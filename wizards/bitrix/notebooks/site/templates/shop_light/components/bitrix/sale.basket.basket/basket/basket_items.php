<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo ShowError($arResult["ERROR_MESSAGE"]);?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
<div class="basket_items" >
<div class="content with_line" >
<div class="line with_line thin"></div>
<table class="sale_basket_basket data-table" width="100%" cellspacing="0" cellpadding="0">
	<tr class="table_line basket_items_header">
		<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<th align="left" class="left" ><?= GetMessage("SALE_NAME")?></th>
		<?endif;?>
		<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_PROPS")?></th>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_PRICE")?></th>
		<?endif;?>
		<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_PRICE_TYPE")?></th>
		<?endif;?>
		<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_DISCOUNT")?></th>
		<?endif;?>
		<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_QUANTITY")?></th>
		<?endif;?>
		
		<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_OTLOG")?></th>
		<?endif;?>
		<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_WEIGHT")?></th>
		<?endif;?>
		<th><?= GetMessage("SALE_COST")?></th>
		<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
			<th class="last"><?= GetMessage("SALE_DELETE")?></th>
		<?endif;?>
	</tr>
	<?
	$i=0;
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
	{
		?>
		<tr class="table_line items">
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td class="left"><?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?><a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>"><?
				endif;
				?><?=$arBasketItems["NAME"] ?><?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?></a><?
				endif;
				?></td>
			<?endif;?>
			<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
				<td>
				<?
				foreach($arBasketItems["PROPS"] as $val)
				{
					echo $val["NAME"].": ".$val["VALUE"]."<br />";
				}
				?>
				</td>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td align="right"><?=$arBasketItems["PRICE_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td><?=$arBasketItems["NOTES"]?></td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><input maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=intval($arBasketItems["QUANTITY"])?>" size="3" ></td>
			<?endif;?>
			
			<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><input type="checkbox" name="DELAY_<?=$arBasketItems["ID"] ?>" value="Y"></td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><?=$arBasketItems["WEIGHT"] ?> <?=(strlen($arParams["WEIGHT_UNIT"]) > 0 ? $arParams["WEIGHT_UNIT"] : GetMessage("SALE_WEIGHT_G"))?></td>
			<?endif;?>
				<td align="center" class="cost"><?=FormatCurrency(floatval($arBasketItems["PRICE"])*floatval($arBasketItems["QUANTITY"]),$arBasketItems["CURRENCY"])?></td>
			<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><input type="checkbox" name="DELETE_<?=$arBasketItems["ID"] ?>" id="DELETE_<?=$i?>" value="Y"></td>
			<?endif;?>
		</tr>
		<?
		$i++;
	}
	?>
	<script>
	function sale_check_all(val)
	{
		for(i=0;i<=<?=count($arResult["ITEMS"]["AnDelCanBuy"])-1?>;i++)
		{
			if(val)
				document.getElementById('DELETE_'+i).checked = true;
			else
				document.getElementById('DELETE_'+i).checked = false;
		}
	}
	</script>
	<tr >
		<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<td align="right" nowrap colspan="3" class="SALE_ITOGO">
				<?/*if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
					<b><?echo GetMessage('SALE_VAT_INCLUDED')?></b><br />
				<?endif;
				*/?>
				<?
				if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
				{
					?><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
					if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
						echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?><?
				}
				?>
				<?= GetMessage("SALE_ITOGO")?>
			</td>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<td align="left" nowrap class="allSum_FORMATED" colspan="2">
				<?/*if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
					<?=$arResult["allVATSum_FORMATED"]?><br />
				<?endif;*/?>
				<?
				if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
				{
					echo $arResult["DISCOUNT_PRICE_FORMATED"]."<br />";
				}
				?>
				<?=$arResult["allSum_FORMATED"]?><br />
			</td>
		<?endif;?>
	</tr>
</table>
<table width="100%" cellpadding="0" class="order_refresh">
	<?/*if ($arParams["HIDE_COUPON"] != "Y"):?>
		<tr>
			<td colspan="3">
				
				<?= GetMessage("STB_COUPON_PROMT") ?>
				<input type="text" name="COUPON" value="<?=$arResult["COUPON"]?>" size="20">
				<br /><br />
			</td>
		</tr>
	<?endif;*/?>
	<tr>
		<td align="left" class="left">
			<input type="submit" value="<?echo GetMessage("SALE_REFRESH")?>" name="BasketRefresh" class="refresh">			
		</td>
		<td align="right">
			<input type="submit" value="<?echo GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2">
		</td>
	</tr>
</table>
</div>
</div>
