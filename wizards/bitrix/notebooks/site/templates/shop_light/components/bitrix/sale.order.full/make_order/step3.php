<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="right_block2">
	<p style="margin-top:0;font-size:18px;  line-height: 1.3;">		
		<?echo GetMessage("STOF_DELIVERY_NOTES")?>
	</p>
	<p style="line-height:1.8;">
		<?echo GetMessage("STOF_PRIVATE_NOTES")?>
	</p>
</div><div class="left_block2">
		<table class="sale_order_full_table">

			<?
				foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
				{
					if ($delivery_id !== 0 && intval($delivery_id) <= 0):
				?>
				<tr>
					<td colspan="2">
						<b><?=$arDelivery["TITLE"]?></b><?if (strlen($arDelivery["DESCRIPTION"]) > 0):?><br />
						<?=nl2br($arDelivery["DESCRIPTION"])?><br /><?endif;?>
						<table border="0" cellspacing="0" cellpadding="3">
						
					<?
						foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile)
						{
							?>
					<tr>
						<td width="20" nowrap="nowrap">&nbsp;</td>
						<td width="0%" valign="top"><input type="radio" id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>" name="<?=$arProfile["FIELD_NAME"]?>" value="<?=$delivery_id.":".$profile_id;?>" <?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : "";?> /></td>
						<td width="50%" valign="top">
							<label for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>">
								<?=$arProfile["TITLE"]?><?if (strlen($arProfile["DESCRIPTION"]) > 0):?><br />
								<small><?=nl2br($arProfile["DESCRIPTION"])?></small><?endif;?>
							</label>
						</td>
						<td width="221px" valign="top" align="right" class="calc">
						<?
							$APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', '', array(
								"NO_AJAX" => $arParams["SHOW_AJAX_DELIVERY_LINK"] == 'S' ? 'Y' : 'N',
								"DELIVERY" => $delivery_id,
								"PROFILE" => $profile_id,
								"ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
								"ORDER_PRICE" => $arResult["ORDER_PRICE"],
								"LOCATION_TO" => $arResult["DELIVERY_LOCATION"],
								"LOCATION_ZIP" => $arResult['DELIVERY_LOCATION_ZIP'],
								"CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
							));
						?>
						<?if ($arParams["SHOW_AJAX_DELIVERY_LINK"] == 'N'):?>
						<script type="text/javascript">deliveryCalcProceed({STEP:1,DELIVERY:'<?=CUtil::JSEscape($delivery_id)?>',PROFILE:'<?=CUtil::JSEscape($profile_id)?>',WEIGHT:'<?=CUtil::JSEscape($arResult["ORDER_WEIGHT"])?>',PRICE:'<?=CUtil::JSEscape($arResult["ORDER_PRICE"])?>',LOCATION:'<?=intval($arResult["DELIVERY_LOCATION"])?>',CURRENCY:'<?=CUtil::JSEscape($arResult["BASE_LANG_CURRENCY"])?>'})</script>
						<?endif;?>
						</td>
					</tr>
							<?
						} // endforeach
					?>
						</table>

						
					</td>
				</tr>
				<?
					else:
?>
					<tr>
						<td valign="top" width="0%">
							<input type="radio" id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>" name="<?=$arDelivery["FIELD_NAME"]?>" value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>>
						</td>
						<td valign="top" width="100%">
							<label for="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>">
							<b><?= $arDelivery["NAME"] ?></b><br />
							<?
							if (strlen($arDelivery["PERIOD_TEXT"])>0)
							{
								echo $arDelivery["PERIOD_TEXT"];
								?><br /><?
							}
							?>
							<?=GetMessage("SALE_DELIV_PRICE");?> <?=$arDelivery["PRICE_FORMATED"]?><br />
							<?
							if (strlen($arDelivery["DESCRIPTION"])>0)
							{
								?>
								<?=$arDelivery["DESCRIPTION"]?><br />
								<?
							}
							?>
							</label>
						</td>
					</tr>
					<?
					endif;
				
				} // endforeach
			?>
			<?
			//endif;
			?>
		</table>
</div>
		<div class="line" style="margin-top:15px;">

		<?if(!($arResult["SKIP_FIRST_STEP"] == "Y"))
		{
			?>
			<input type="submit" name="backButton" class="backButton" value="&nbsp;" style="display:none;">
			<a href="#" onclick="javascript:$('input.backButton').trigger('click');return false;" class="color_theme back">
				<?= GetMessage("SALE_BACK_BUTTON")?>
			</a>
			<?
		}
		?>
			<input type="submit" name="contButton" class="contButton" value="Y" style="display:none;" >
			<a href="#" onclick="javascript:$('input.contButton').trigger('click');return false;" class="color_theme">
				<?= GetMessage("SALE_CONTINUE")?>
			</a>
		</div>
	
