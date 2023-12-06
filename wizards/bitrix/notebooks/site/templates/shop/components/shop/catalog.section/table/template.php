<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($arParams);echo "</pre>";?>
<div class="catalog_section">
<div class="item">
	<div class="line">
		<h3><?if(isset($_REQUEST["all"])){
			echo "Все ".strtolower($arResult["NAME"]);
		}
		elseif(isset($_REQUEST["new"])){
			echo "Новинки";
		}
		else
		{echo $arResult["NAME"];}?></h3>
		<p class="section_description"><? if(!isset($_REQUEST["new"])){echo $arResult["DESCRIPTION"];}?></p>
	</div>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="line_item2 line">
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		
		<?if($cell!=0&&$cell%2==0){?>
			</div><div class="line_item2 line">
		<?}?>
		<div class="element_item" id="<?=$this->GetEditAreaId($arElement['ID']);?>" <?if($cell%2==1)echo "style='margin-left:20px;'";?>>
		<?//print_r(CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="preview_picture">
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
				<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
					<img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?else:?>
					<img border="0" src="/images/nophoto.jpg" width="150" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?endif?>
			</a>
		</div>	
		<div class="elem">			
				<div class="elem_descr">		
					<div class="line">
						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
							<?=$arElement["NAME"]?>
						</a>
					</div>
					<div class="property">
						<?if(strlen($arElement["PREVIEW_TEXT"])<3){?>
							<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
								<?if($pid=="specification"){
								foreach($arProperty["VALUE"] as $i=>$val){
									$res = CIBlockElement::GetByID($val);
									if($ar_res = $res->GetNext()){
										if($i!=0){echo "&nbsp;/ ";}
											echo $ar_res['NAME'];
										}
									}																
								}?>
							<?endforeach?>
						<?}else?>
						<?{?>
							<?=$arElement["PREVIEW_TEXT"]?>
						<?}?>
					</div>					
				</div>
				<div class="price_m">
					<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["CAN_ACCESS"]):?>
							<p>
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<div class="line"><span>Старая цена</span><br/><s><?=$arPrice["PRINT_VALUE"]?></s></div> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
							<?else:?><span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span><?endif;?>
							</p>
						<?endif;?>
					<?endforeach;?>
					<?if(is_array($arElement["PRICE_MATRIX"])):?>
						<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
							<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
								<div class="line price_line"><span><?= $arType["NAME_LANG"] ?>:</span>
								<?
									if($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"]):?>
										<div class="line"><s><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])?></s></div><span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
									<?else:?>
										<span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
									<?endif?>&nbsp;
								</div>
							<?endforeach?>
						<?endforeach?>
					<?endif?>
				</div>
				<?if($arElement["CAN_BUY"]):?>
				<div class="line buttons">
					<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" >
					<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
					<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>">					
					<?if($arElement["CAN_BUY"]&&$arElement["CATALOG_QUANTITY"]>0&&((count($arElement["PRICES"]) > 0) || count($arElement["PRICE_MATRIX"]["COLS"])>0)){?>
							<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?//echo GetMessage("CATALOG_ADD_TO_BASKET")?>" class="add" >
						<?}
						else
						{?>
							<div class="buy_nonactive" alt="нет в наличии" ></div>
						<?}?>
					<?/*
					<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?//echo GetMessage("CATALOG_BUY")?>" class="buy">
					*/?>
					</form>					
				<?/*?>
					<noindex>
					<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/images/addToBasket.png" alt="<?echo GetMessage("CATALOG_ADD")?>" title="<?echo GetMessage("CATALOG_ADD")?>" /></a></noindex>
					&nbsp;<a href="<?echo $arElement["BUY_URL"]?>" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/images/buy.png" alt="<?echo GetMessage("CATALOG_BUY")?>" title="<?echo GetMessage("CATALOG_BUY")?>" /></a>
				<?*/?>
				</div>
				<?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
					<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
				<?endif?>				
				<?if($arParams["DISPLAY_COMPARE"]):?>
					<noindex>
					<a href="<?echo htmlspecialchars_decode($arElement["COMPARE_URL"])?>" rel="nofollow" class="compare" ><?echo GetMessage("CATALOG_COMPARE")?></a>&nbsp;
					</noindex>
				<?endif?>
</div>

</div>
		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
</div>
