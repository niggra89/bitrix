<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>

			<?
			if ($_REQUEST["filter_history"] == "Y")
			{
				?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_history=N"><?echo GetMessage("STPOL_CUR_ORDERS")?></a><?
			}
			else
			{
				?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_history=Y&filter_status=F"><?echo GetMessage("STPOL_ORDERS_HISTORY")?></a><?
			}
			echo "<br /><br />";
			?>
			<div class="order_item">
			<?
			$bNoOrder = true;
			foreach($arResult["ORDER_BY_STATUS"] as $key => $val)
			{
				$bShowStatus = true;
				foreach($val as $vval)
				{
					$bNoOrder = false;
					if($bShowStatus)
					{
						?><h3 class="black"><?echo GetMessage("STPOL_STATUS")?> "<?=$arResult["INFO"]["STATUS"][$key]["NAME"] ?>"</h3>
						<small><?=$arResult["INFO"]["STATUS"][$key]["DESCRIPTION"] ?></small>
					<?
					}
					$bShowStatus = false;
					?>
					<table class="sale_personal_order_list">
						<tr>
							<td>
								<b>
								<?echo GetMessage("STPOL_ORDER_NO")?>
								<a title="<?echo GetMessage("STPOL_DETAIL_ALT")?>" href="<?=$vval["ORDER"]["URL_TO_DETAIL"] ?>"><?= $vval["ORDER"]["ID"] ?></a>
								<?echo GetMessage("STPOL_FROM")?>
								<?= $vval["ORDER"]["DATE_INSERT"]; ?>
								</b>
								<?
								if ($vval["ORDER"]["CANCELED"] == "Y")
									echo GetMessage("STPOL_CANCELED");
								?>
								<br />
								<b>
								<?echo GetMessage("STPOL_SUM")?>
								<?=$vval["ORDER"]["FORMATED_PRICE"]?>
								</b>
								<?if($vval["ORDER"]["PAYED"]=="Y")
									echo GetMessage("STPOL_PAYED_Y");
								else
									echo GetMessage("STPOL_PAYED_N");
								?>
								<?if(IntVal($vval["ORDER"]["PAY_SYSTEM_ID"])>0)
									echo GetMessage("P_PAY_SYS").$arResult["INFO"]["PAY_SYSTEM"][$vval["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?>
								<br />
								<b><?echo GetMessage("STPOL_STATUS_T")?></b>
								<?=$arResult["INFO"]["STATUS"][$vval["ORDER"]["STATUS_ID"]]["NAME"]?>
								<?echo GetMessage("STPOL_STATUS_FROM")?>
								<?=$vval["ORDER"]["DATE_STATUS"];?>
								<br />
								<?if(IntVal($vval["ORDER"]["DELIVERY_ID"])>0)
								{
									echo "<b>".GetMessage("P_DELIVERY")."</b>".$arResult["INFO"]["DELIVERY"][$vval["ORDER"]["DELIVERY_ID"]]["NAME"];
								}
								elseif (strpos($vval["ORDER"]["DELIVERY_ID"], ":") !== false)
								{
									echo "<b>".GetMessage("P_DELIVERY")."</b>";
									$arId = explode(":", $vval["ORDER"]["DELIVERY_ID"]);
									echo $arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]." (".$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"].")";
								}
								?>
							</td>
						</tr>
						<tr>
							<td>
								<table class="sale_personal_order_list_table">
									<tr>
										<td width="0%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td width="100%">
											<b><?echo GetMessage("STPOL_CONTENT")?></b>
										</td>
										<td width="0%">&nbsp;</td>
									</tr>
									<?
									foreach($vval["BASKET_ITEMS"] as $vvval)
									{
										?>
										<tr>
											<td width="0%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td width="100%">
												
												<?
												if (strlen($vvval["DETAIL_PAGE_URL"]) > 0)
													echo "<a href=\"".$vvval["DETAIL_PAGE_URL"]."\">";
												echo $vvval["NAME"];
												if (strlen($vvval["DETAIL_PAGE_URL"]) > 0)
													echo "</a>";
												?>
											</td>
											<td width="0%" nowrap><?= $vvval["QUANTITY"] ?> <?echo GetMessage("STPOL_SHT")?></td>
										</tr>
										<?
									}
									?>
								</table>
							</td>
						</tr>
						<tr>
							<td align="right">
								<a title="<?= GetMessage("STPOL_DETAIL_ALT") ?>" href="<?=$vval["ORDER"]["URL_TO_DETAIL"]?>"><?= GetMessage("STPOL_DETAILS") ?></a>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a title="<?= GetMessage("STPOL_REORDER") ?>" href="<?=$vval["ORDER"]["URL_TO_COPY"]?>"><?= GetMessage("STPOL_REORDER1") ?></a>
								<?if ($vval["ORDER"]["CAN_CANCEL"] == "Y"):?>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a title="<?= GetMessage("STPOL_CANCEL") ?>" href="<?=$vval["ORDER"]["URL_TO_CANCEL"]?>"><?= GetMessage("STPOL_CANCEL") ?></a>
								<?endif;?>
							</td>
						</tr>
					</table>
					<br />
				<?
				}
				?>
				<br />
				<?
			}

			if ($bNoOrder)
			{?>
			<center><?echo GetMessage("STPOL_NO_ORDERS")?></center><?
			}
			?>
		</div>	
		<div class="stpol_hint">
			<?echo GetMessage("STPOL_HINT")?><br /><br />
			<?echo GetMessage("STPOL_HINT1")?>
		</div>