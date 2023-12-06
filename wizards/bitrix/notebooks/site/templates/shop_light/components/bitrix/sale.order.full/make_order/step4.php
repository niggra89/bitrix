<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

		<?
		if ($arResult["PAY_FROM_ACCOUNT"]=="Y")
		{
			?>
			<input type="hidden" name="PAY_CURRENT_ACCOUNT" value="N">
			<input type="checkbox" name="PAY_CURRENT_ACCOUNT" id="PAY_CURRENT_ACCOUNT" value="Y"<?if($arResult["PAY_CURRENT_ACCOUNT"]!="N") echo " checked";?>> <label for="PAY_CURRENT_ACCOUNT"><b><?echo GetMessage("STOF_PAY_FROM_ACCOUNT")?></b></label><br />
			<?=GetMessage("STOF_ACCOUNT_HINT1")?> <b><?=$arResult["CURRENT_BUDGET_FORMATED"]?></b> <?echo GetMessage("STOF_ACCOUNT_HINT2")?>
			<br /><br />
			<?
		}
		?>
		<?
		if(count($arResult["PAY_SYSTEM"])>0)
		{
			?>
			<table class="sale_order_full_table">
				<tr>
					<td colspan="2">
						
						<?echo GetMessage("STOF_PAYMENT_HINT2")?><br /><br />
						
					</td>
				</tr>
				<?
				foreach($arResult["PAY_SYSTEM"] as $arPaySystem)
				{
					?>
					<tr>
						<td valign="top" width="0%">
							<input type="radio" id="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>" name="PAY_SYSTEM_ID" value="<?= $arPaySystem["ID"] ?>"<?if ($arPaySystem["CHECKED"]=="Y") echo " checked";?>>
						</td>
						<td valign="top" width="100%">
							<label for="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>">
							<b><?= $arPaySystem["PSA_NAME"] ?></b><br />
							<?
							if (strlen($arPaySystem["DESCRIPTION"])>0)
							{
								?>
								<?=$arPaySystem["DESCRIPTION"]?>
								<br />
								<?
							}
							?>
							</label>
							
						</td>
					</tr>
					<?
				}
				?>
			</table>
		<?
		}
		if ($arResult["HaveTaxExempts"]=="Y")
		{
			?>

			<input type="checkbox" name="TAX_EXEMPT" value="Y" checked> <b><?echo GetMessage("STOF_TAX_EX")?></b><br />
			<?echo GetMessage("STOF_TAX_EX_PROMT")?>
			<br /><br />
			<?
		}
		?>
		
<div class="line" style="margin-top:15px;">

	<?if(!($arResult["SKIP_FIRST_STEP"] == "Y" && $arResult["SKIP_SECOND_STEP"] == "Y" && $arResult["SKIP_THIRD_STEP"] == "Y"))
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

