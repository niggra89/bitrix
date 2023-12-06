<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
<div class="catalog_analog_table">
	<div class="line ar_items">
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
			<?if($cell%3==0&&$cell!=0){?>
				</div><div class="line ar_items">
			<?}?>
			<div class="item" <?if(($cell+1)%3!=0){?>style='margin-right: 65px;'<?}?>>
				<?
				$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="line name">
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
						<?=$arElement["NAME"]?>
					</a>
				</div>
				<div class="line preview_picture">
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
						<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
							<img border="0" data="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
						<?else:?>
							<img border="0" src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arElement["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arElement["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
						<?endif?>
					</a>	
				</div>			
			<div class="property">
				<?if(strlen($arElement["PREVIEW_TEXT"])>3){?>
					<?=$arElement["PREVIEW_TEXT"]?>		
				<?}else{
					$count=0;
					foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
						<?if($pid=="specification"){
							foreach($arProperty["VALUE"] as $i=>$val){
								if($count<10){
									$res = CIBlockElement::GetByID($val);
									if($ar_res = $res->GetNext()){
										if($i!=0)echo "&nbsp;/ ";
										echo $ar_res['NAME'];
									}
								}
								$count++;	
							}														
						}
					endforeach;
				}?>
			</div>
				<div class="price_m">
				<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
					<?if($arPrice["CAN_ACCESS"]):?>
						<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
							<div class="line">
								<s><?=$arPrice["PRINT_VALUE"]?></s>
							</div>
							<span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
						<?else:?>
							<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
						<?endif?>
					<?endif;?>
				<?endforeach;?>
				<?if(is_array($arElement["PRICE_MATRIX"])):?>
					<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
						<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
							<div class="line price_line">
								<div class="line"><span><?= $arType["NAME_LANG"] ?>:</span></div><?
								if($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"]):?>								
								<div class="line">
									<s><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])?></s>
								</div>
								<span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>							
								<?else:?>
									<div class="line catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></div>
								<?endif?>&nbsp;	
							</div>					
						<?endforeach?>
					<?endforeach?>				
				<?endif?>
				</div>

				<?//if($arElement["CAN_BUY"]):?>
				<div class="line buttons">
					<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" >
					<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
					<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>">
					<?if($arElement["CAN_BUY"]&&$arElement["CATALOG_QUANTITY"]>0){?>
						<?/*?><input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?//echo GetMessage("CATALOG_ADD_TO_BASKET")?>" class="add" ><?*/?>
						<noindex><a href="<?echo $arResult["ADD_URL"]?>" rel="nofollow" class="buy color_theme"><?echo GetMessage("CATALOG_BUY")?></a></noindex>
					<?}
					else
					{?>
						<?if($arResult["CATALOG_QUANTITY"]<=0&&((count($arResult["PRICES"]) > 0) || count($arResult["PRICE_MATRIX"]["COLS"])>0)){?>
							<div class="form_buy"><span><?= GetMessage("CATALOG_NOT_AVAILABLE")?></span></div>
						<?}else{?>&nbsp;<?}?>
					<?}?>
					<?/*
					<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?//echo GetMessage("CATALOG_BUY")?>" class="buy">
					*/?>
					</form>

			<?/*elseif((count($arResult["PRICES"]) > 0) || is_array($arResult["PRICE_MATRIX"])):?>
				<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
			<?endif*/?>
				</div>
			</div>
		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
	</div>
</div>

