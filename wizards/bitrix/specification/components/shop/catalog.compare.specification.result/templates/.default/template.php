<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="catalog-compare-result">
<a name="compare_table"></a>
	<noindex><p>
<br />
<div style="
    overflow-x: auto;
    overflow-y: visible;
    padding-bottom: 1.5em;
    width: 100%;">
<form action="<?=$APPLICATION->GetCurPage()?>" method="get">
	<table class="data-table" cellspacing="0" cellpadding="0" border="0">
		<thead>

		<?foreach($arResult["ITEMS"][0]["FIELDS"] as $code=>$field):?>
		<tr>
			<th valign="top" nowrap width="260"></th>
			<?foreach($arResult["ITEMS"] as $arElement):?>
				<td valign="top">
					<?switch($code):
						case "NAME":
							?><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement[$code]?></a>
							<?break;
						case "PREVIEW_PICTURE":
						case "DETAIL_PICTURE":
							if(is_array($arElement["FIELDS"][$code])):?>
								<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["FIELDS"][$code]["SRC"]?>" width="<?=$arElement["FIELDS"][$code]["WIDTH"]?>" height="<?=$arElement["FIELDS"][$code]["HEIGHT"]?>" alt="<?=$arElement["FIELDS"][$code]["ALT"]?>" class="preview_picture" /></a>
							<?endif;
							break;
						default:
							echo $arElement["FIELDS"][$code];
							break;
					endswitch;
					?>
				</td>
			<?endforeach?>
		</tr>
		<?endforeach;?>
		</thead>
		<?foreach($arResult["ITEMS"][0]["PRICES"] as $code=>$arPrice):?>
			<?if($arPrice["CAN_ACCESS"]):?>
			<tr>
				<th valign="top" nowrap></th>
				<?foreach($arResult["ITEMS"] as $arElement):?>
					<td valign="top">
						<?if($arElement["PRICES"][$code]["CAN_ACCESS"]):?>
							<div class="catalog-price"><?=$arElement["PRICES"][$code]["PRINT_VALUE"]?></div>
						<?endif;?>
					</td>
				<?endforeach?>
			</tr>
			<?endif;?>
		<?endforeach;?>
		<tr>
			<td valign="center"><br/><input type="submit" value="<?=GetMessage("CATALOG_REMOVE_PRODUCTS")?>" /><br/>&nbsp;
			<input type="hidden" name="action" value="DELETE_FROM_COMPARE_RESULT" />
			<input type="hidden" name="IBLOCK_ID" value="<?=$arParams["IBLOCK_ID"]?>" /></td>
			<?foreach($arResult["ITEMS"] as $arElement):?>
				<td valign="center"  width="<?=round(100/count($arResult["ITEMS"]))?>%">
					<input type="checkbox" name="ID[]" value="<?=$arElement["ID"]?>" />
				</td>
			<?endforeach?>
		</tr>
		<?foreach($arResult["SHOW_OFFER_FIELDS"] as $code):
			$arCompare = Array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$Value = $arElement["OFFER_FIELDS"][$code];
				if(is_array($Value))
				{
					sort($Value);
					$Value = implode(" / ", $Value);
				}
				$arCompare[] = $Value;
			}
			$diff = (count(array_unique($arCompare)) > 1 ? true : false);
			if($diff || !$arResult["DIFFERENT"]):?>
				<tr>
					<th valign="top" nowrap>&nbsp;<?=GetMessage("IBLOCK_FIELD_".$code)?>&nbsp;</th>
					<?foreach($arResult["ITEMS"] as $arElement):?>
						<?if($diff):?>
						<td valign="top">&nbsp;
							<?=(is_array($arElement["OFFER_FIELDS"][$code])? implode("/ ", $arElement["OFFER_FIELDS"][$code]): $arElement["OFFER_FIELDS"][$code])?>
						</td>
						<?else:?>
						<th valign="top">&nbsp;
							<?=(is_array($arElement["OFFER_FIELDS"][$code])? implode("/ ", $arElement["OFFER_FIELDS"][$code]): $arElement["OFFER_FIELDS"][$code])?>
						</th>
						<?endif?>
					<?endforeach?>
				</tr>
			<?endif?>
		<?endforeach;?>
		<?foreach($arResult["SHOW_OFFER_PROPERTIES"] as $code=>$arProperty):
			$arCompare = Array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
				if(is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			$diff = (count(array_unique($arCompare)) > 1 ? true : false);
			if($diff || !$arResult["DIFFERENT"]):?>
				<tr>
					<th valign="top" nowrap>&nbsp;<?=$arProperty["NAME"]?>&nbsp;</th>
					<?foreach($arResult["ITEMS"] as $arElement):?>
						<?if($diff):?>
						<td valign="top">&nbsp;
							<?=(is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
						</td>
						<?else:?>
						<th valign="top">&nbsp;
							<?=(is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
						</th>
						<?endif?>
					<?endforeach?>
				</tr>
			<?endif?>
		<?endforeach;?>
		<?/*=============================================== Вывод характеристик ===========================================================*/?>
		<?$i=0;?>
		<tr><td colspan=<?=count($arResult["ITEMS"])+1?>>&nbsp;<br/><br/>&nbsp;</td></tr>
		<?foreach($arResult["SPECIFICATION"] as $spec){?>
			<?if($spec["NAME"]){?>
				<tr class="specification specification_title">
					<td class="table_left table_right<?if($i==0){echo " table_top";$i++;}?>" colspan=<?=count($arResult["ITEMS"])+1?>>
						<font style="font-size:14px;">
							<?=$spec["NAME"]?>
						</font>
					</td>
				</tr>
				<?foreach($spec["VALUES"] as $spec_vals){?>
					<?if(count($spec_vals["VALUES"])>0){?>
						<tr class="specification">
							<td width="260px" class="table_left"><?=$spec_vals["NAME"]?></td>
							<?foreach($arResult["ITEMS"] as $j=>$vals){?>
								<td class="<?if($j==count($arResult["ITEMS"])-1)echo "table_right";?>">
								<?if(array_key_exists($vals["ID"], $spec_vals["VALUES"])){?>
									<?echo $spec_vals["VALUES"][$vals["ID"]];?>
								<?}else{?>
									<?echo "&nbsp;";?>
								<?}?>
								</td>
							<?}?>
						</tr>
					<?}?>
				<?}?>
			<?}?>
		<?}?>
		<script>
		$(document).ready(function(){
			$('tr.specification').last().find('td').first().addClass('table_corner_bottom_left');
			$('tr.specification').last().find('td').last().addClass('table_corner_bottom_right');
		});
		</script>
<?/*================================================================================================================================*/?>

	</table>
	<br />
	
</form>
<br />
<?if(count($arResult["ITEMS_TO_ADD"])>0):?>
<p>
<form action="<?=$APPLICATION->GetCurPage()?>" method="get">
	<input type="hidden" name="IBLOCK_ID" value="<?=$arParams["IBLOCK_ID"]?>" />
	<input type="hidden" name="action" value="ADD_TO_COMPARE_RESULT" />
	<select name="id">
	<?foreach($arResult["ITEMS_TO_ADD"] as $ID=>$NAME):?>
		<option value="<?=$ID?>"><?=$NAME?></option>
	<?endforeach?>
	</select>
	<input type="submit" value="<?=GetMessage("CATALOG_ADD_TO_COMPARE_LIST")?>" />
</form>
</p>
<?endif?>

</div>
</div>
