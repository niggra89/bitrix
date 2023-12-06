<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
function PrintPropsForm($arSource=Array(), $PRINT_TITLE = "", $arParams)
{
	if (!empty($arSource))
	{
		if (strlen($PRINT_TITLE) > 0)
		{
			?>
			<?= $PRINT_TITLE ?><br /><br />
			<?
		}
		?>

		<?
		foreach($arSource as $arProperties)
		{
			//print_r($arProperties);
			if($arProperties["SHOW_GROUP_NAME"] == "Y")
			{
				?>

						<p><?= $arProperties["GROUP_NAME"] ?></p>

				<?
			}
			?>

				<div class="line_prop">	<span class="PropertiesName" style=""><?= $arProperties["NAME"] ?>:<?
					if($arProperties["REQUIED_FORMATED"]=="Y")
					{
						?><span class="sof-req">*</span><?
					}
					?>
</span>
					<?
					if($arProperties["TYPE"] == "CHECKBOX")
					{
						?>
						<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>
						<?
					}
					elseif($arProperties["TYPE"] == "TEXT")
					{
						?>
						<input type="text" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>">
						<?
					}
					elseif($arProperties["TYPE"] == "SELECT")
					{
						?>
						<select name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
						<?
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
						}
						?>
						</select>
						<?
					}
					elseif ($arProperties["TYPE"] == "MULTISELECT")
					{
						?>
						<select multiple name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
						<?
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
						}
						?>
						</select>
						<?
					}
					elseif ($arProperties["TYPE"] == "TEXTAREA")
					{
						?>
						<textarea rows="<?=$arProperties["SIZE2"]?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>
						<?
					}
					elseif ($arProperties["TYPE"] == "LOCATION")
					{
						$value = 0;
						foreach ($arProperties["VARIANTS"] as $arVariant) 
						{
							if ($arVariant["SELECTED"] == "Y") 
							{
								$value = $arVariant["ID"]; 
								break;
							}
						}
						
						if ($arParams["USE_AJAX_LOCATIONS"] == "Y"):
							$GLOBALS["APPLICATION"]->IncludeComponent(
								'bitrix:sale.ajax.locations', 
								'', 
								array(
									"AJAX_CALL" => "N", 
									"COUNTRY_INPUT_NAME" => "COUNTRY_".$arProperties["FIELD_NAME"],
									"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
									"CITY_OUT_LOCATION" => "Y",
									"ALLOW_EMPTY_CITY" => $arParams["ALLOW_EMPTY_CITY"],
									"LOCATION_VALUE" => $value,
								),
								null,
								array('HIDE_ICONS' => 'N')
							);
						else:
						?>
						<select name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
						<?
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<option value="<?=$arVariants["ID"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
						}
						?>
						</select>
						<?
						endif;
					}
					elseif ($arProperties["TYPE"] == "RADIO")
					{
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<input type="radio" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["ID"]?>" value="<?=$arVariants["VALUE"]?>"<?if($arVariants["CHECKED"] == "Y") echo " checked";?>> <label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["ID"]?>"><?=$arVariants["NAME"]?></label><br />
							<?
						}
					}

					if (strlen($arProperties["DESCRIPTION"]) > 0)
					{
						?><br /><small><?echo $arProperties["DESCRIPTION"] ?></small><?
					}
					?>
			</div>
			<?
		}
		?>

		<?
		return true;
	}
	return false;
}
?>

		<div class="right_block2">
<p style="margin-top:0;font-size:18px;">		<?echo GetMessage("STOF_CORRECT_NOTE")?></p>
<p style="line-height:1.8;">			<?echo GetMessage("STOF_PRIVATE_NOTES")?></p>
</div>
<div class="left_block2">
			<?
			$bPropsPrinted = PrintPropsForm($arResult["PRINT_PROPS_FORM"]["USER_PROPS_N"], "", $arParams);

			if(!empty($arResult["USER_PROFILES"]))
			{
			
				if ($bPropsPrinted)
					echo "<br /><br />";
				?>
				<?/*
				<?echo GetMessage("STOF_PROFILES")?><br /><br />
*/?>
							<p><?= GetMessage("SALE_PROFILES_PROMT")?>:</p>
							<script language="JavaScript">
							function SetContact(enabled)
							{
								if(enabled)
									document.getElementById('sof-prof-div').style.display="block";
								else
									document.getElementById('sof-prof-div').style.display="none";
							}
							</script>

					<?
					foreach($arResult["USER_PROFILES"] as $arUserProfiles)
					{
						?>

								<input type="radio" name="PROFILE_ID" id="ID_PROFILE_ID_<?= $arUserProfiles["ID"] ?>" value="<?= $arUserProfiles["ID"];?>"<?if ($arUserProfiles["CHECKED"]=="Y") echo " checked";?> onClick="SetContact(false)">

								<label for="ID_PROFILE_ID_<?= $arUserProfiles["ID"] ?>">
								<?=$arUserProfiles["NAME"]?><br/>

								<?
								foreach($arUserProfiles["USER_PROPS_VALUES"] as $arUserPropsValues)
								{
									
									if (strlen($arUserPropsValues["VALUE_FORMATED"]) > 0)
									{
										?>
										<p>
										<?=$arResult["PRINT_PROPS_FORM"]["USER_PROPS_Y"][$arUserPropsValues["ORDER_PROPS_ID"]]["NAME"]?>:
										<?=$arUserPropsValues["VALUE_FORMATED"]?>
										</p>
										<?
									}
								}
								?>

								</label><br/>

						<?
					}
					?>
							<input type="radio" name="PROFILE_ID" id="ID_PROFILE_ID_0" value="0"<?if ($arResult["PROFILE_ID"]=="0") echo " checked";?> onClick="SetContact(true)">
						<label for="ID_PROFILE_ID_0"><?echo GetMessage("SALE_NEW_PROFILE")?></label><br />
				<?
			}
			else
			{
			
				?><input type="hidden" name="PROFILE_ID" value="0"><?
			}
			?>
			
			<div id="sof-prof-div">
			<?
			PrintPropsForm($arResult["PRINT_PROPS_FORM"]["USER_PROPS_Y"], GetMessage("SALE_NEW_PROFILE_TITLE"), $arParams);
			?>
			</div>
			<?
			if ($arResult["USER_PROFILES_TO_FILL"]=="Y")
			{
				?>
				<script language="JavaScript">
					SetContact(<?echo ($arResult["USER_PROFILES_TO_FILL_VALUE"]=="Y" || $arResult["PROFILE_ID"] == "0")?"true":"false";?>);
				</script>
				<?
			}
			?>
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
