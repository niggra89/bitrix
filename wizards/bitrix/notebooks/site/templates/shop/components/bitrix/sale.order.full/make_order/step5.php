<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
		<div class="line">
		<div class="right_block2">
			<?echo GetMessage("STOF_PRIVATE_NOTES");?>
		</div>
		<div class="left_block2">
		<?
		if(!empty($arResult["ORDER_PROPS_PRINT"]))
		{?>
			<?foreach($arResult["ORDER_PROPS_PRINT"] as $arProperties){
					if ($arProperties["SHOW_GROUP_NAME"] == "Y")
					{
						?>
							<b><?= $arProperties["GROUP_NAME"] ?></b><br/>
						<?
					}
					if(strLen($arProperties["VALUE_FORMATED"])>0)
					{
						?>
						<p>
							<?= $arProperties["NAME"] ?>:<?=$arProperties["VALUE_FORMATED"]?>
						</p>
						<?}
					}?>

			<?}?>
		<b><?echo GetMessage("STOF_PAY_DELIV")?></b>

				<p><?= GetMessage("SALE_DELIV_SUBTITLE")?>:		
				
					<?
					//echo "<pre>"; print_r($arResult); echo "</pre>";

					if (is_array($arResult["DELIVERY"]))
					{
						echo $arResult["DELIVERY"]["NAME"];
						if (is_array($arResult["DELIVERY_ID"]))
						{
							echo " (".$arResult["DELIVERY"]["PROFILES"][$arResult["DELIVERY_PROFILE"]]["TITLE"].")";
						}
					}
					elseif ($arResult["DELIVERY"]=="ERROR")
					{
						echo ShowError(GetMessage("SALE_ERROR_DELIVERY"));
					}
					else
					{
						echo GetMessage("SALE_NO_DELIVERY");
					}
					?>
<p>
			<?if(is_array($arResult["PAY_SYSTEM"]) || $arResult["PAY_SYSTEM"]=="ERROR" || $arResult["PAYED_FROM_ACCOUNT"] == "Y")
			{
				?>
				<p><?= GetMessage("SALE_PAY_SUBTITLE")?>:
						<?
						if (is_array($arResult["PAY_SYSTEM"]))
						{
							echo $arResult["PAY_SYSTEM"]["PSA_NAME"];
						}
						elseif ($arResult["PAY_SYSTEM"]=="ERROR")
						{
							echo ShowError(GetMessage("SALE_ERROR_PAY_SYS"));
						}
						elseif($arResult["PAYED_FROM_ACCOUNT"] != "Y")
						{
							echo GetMessage("STOF_NOT_SET");
						}
						if($arResult["PAYED_FROM_ACCOUNT"] == "Y")
							echo " (".GetMessage("STOF_PAYED_FROM_ACCOUNT").")";
						?>				
					</p>
				<?
			}
			?>


</div></div>

		<p>&nbsp;<br /><b><font class="color_theme"><?=GetMessage("SALE_ORDER_CONTENT")?></font></b></p>

		<table class="sale_order_full data-table product_table" cellspacing="0">
			<tr>
				<th><?echo GetMessage("SALE_CONTENT_NAME")?></th>
				<th><?echo GetMessage("SALE_CONTENT_PRICE")?></th>
				<th><?echo GetMessage("SALE_CONTENT_QUANTITY")?></th>
				<th><?echo GetMessage("SALE_CONTENT_COST")?></th>
			</tr>
			<?
			foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
			{
				?>
				<tr>
					<td><?=$arBasketItems["NAME"]?></td>
					<td><?=$arBasketItems["PRICE_FORMATED"]?></td>

					<td align="center"><?=$arBasketItems["QUANTITY"]?></td>
					<td align="right"><?=FormatCurrency(doubleval($arBasketItems["QUANTITY"])*doubleval($arBasketItems["PRICE"]),$arBasketItems["CURRENCY"])?></td>
				</tr>
				<?
			}
			?>
			
			<tr>
				<td align="right"><b><?=GetMessage("SALE_CONTENT_PR_PRICE")?>:</b></td>
				<td align="right" colspan="6"><?=$arResult["ORDER_PRICE_FORMATED"]?></td>
			</tr>
			<?
			if (doubleval($arResult["DISCOUNT_PRICE_FORMATED"]) > 0)
			{
				?>
				<tr>
					<td align="right"><b><?echo GetMessage("SALE_CONTENT_DISCOUNT")?>:</b></td>
					<td align="right" colspan="6"><?echo $arResult["DISCOUNT_PRICE_FORMATED"]?>
						<?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?>
							(<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)
						<?endif;?>
					</td>
				</tr>
				<?
			}
			if (doubleval($arResult["VAT_PRICE"]) > 0)
			{
				?>
				<tr>
					<td align="right">
						<b><?echo GetMessage("SALE_CONTENT_VAT")?>:</b>
					</td>
					<td align="right" colspan="6"><?=$arResult["VAT_PRICE_FORMATED"]?></td>
				</tr>
				<?
			}
			if(!empty($arResult["arTaxList"]))
			{
				foreach($arResult["arTaxList"] as $val)
				{
					?>
					<tr>
						<td align="right"><?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?>:</td>
						<td align="right" colspan="6"><?=$val["VALUE_MONEY_FORMATED"]?></td>
					</tr>
					<?
				}
			}
			if (doubleval($arResult["DELIVERY_PRICE"]) > 0)
			{
				?>
				<tr>
					<td align="right">
						<b><?echo GetMessage("SALE_CONTENT_DELIVERY")?>:</b>
					</td>
					<td align="right" colspan="6"><?=$arResult["DELIVERY_PRICE_FORMATED"]?></td>
				</tr>
				<?
			}
			?>
			<tr>
				<td align="right"><b><?= GetMessage("SALE_CONTENT_ITOG")?>:</b></td>
				<td align="right" colspan="6"><b><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></b>
				</td>
			</tr>
			<?
			if (doubleval($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0)
			{
				?>
				<tr>
					<td align="right"><b><?echo GetMessage("STOF_PAY_FROM_ACCOUNT1")?></b></td>
					<td align="right" colspan="6"><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></td>
				</tr>
				<?
			}
			?>
		</table>

		<br /><br />
		<b><?= GetMessage("SALE_ADDIT_INFO")?></b><br /><br />

		<table class="sale_order_full_table">
			<tr>
				<td width="50%" align="right" valign="top">
					<?= GetMessage("SALE_ADDIT_INFO_PROMT")?>
				</td>
				<td width="50%" valign="top">
					<textarea rows="4" cols="40" name="ORDER_DESCRIPTION"><?=$arResult["ORDER_DESCRIPTION"]?></textarea>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td valign="top" width="60%" align="right">
		<div class="line" style="margin-top:15px;">
			<?if(!($arResult["SKIP_FIRST_STEP"] == "Y" && $arResult["SKIP_SECOND_STEP"] == "Y" && $arResult["SKIP_THIRD_STEP"] == "Y" && $arResult["SKIP_FORTH_STEP"] == "Y"))
			{
				?>
				<input type="submit" name="backButton" class="backButton" value="&nbsp;">
				<?
			}
			?>
			<input type="submit" name="contButton" class="contButton" value="&nbsp;">
		</div>
	</td>
</tr>
</table>