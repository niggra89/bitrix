<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog_sections_top">
<?if($arParams["SHOW_ALL"]=="Y"){?>
<div class="all">
<div class="item line">
<a href="<?=$arResult["ALL"]["SECTION_PAGE_URL"]?>all/" class="title"><h3><?=GetMessage('all')?> <?=strtolower($arResult["ALL"]["NAME"])?></h3></a>
<p class="section_description"><?=$arResult["ALL"]["DESCRIPTION"]?></p>
		<?
		$cell = 0;
		foreach($arResult["ALL"]["ITEMS"] as $i => $arElement):
		?>
		<div class="element_item" <?if($i%2==1)echo "style='margin-left:20px;'";?> id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<?
		 $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		 $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
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
			</div>

					<?=$arElement["PREVIEW_TEXT"]?>					
</div><div class="price_m">
			<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<p>
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<div class="line"><span><?=GetMessage('old_price')?></span><br/>
						<s><?=$arPrice["PRINT_VALUE"]?></s>
</div>
						<span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?>
						<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif?>
					</p>
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
					</form>
				</div>
			&nbsp;
		</div>
	<?
	$cell++;
	?>
	</div>
	<?
	endforeach; 	
	?>
</div>
</div>
<?}?>
<?foreach($arResult["SECTIONS"] as $arSection):?>
<div class="item line">
<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="title"><h3><?=$arSection["NAME"]?></h3></a>
<p class="section_description"><?=$arSection["DESCRIPTION"]?></p>
		<?
		$cell = 0;
		foreach($arSection["ITEMS"] as $i => $arElement):
		?>
		<div class="element_item" id="<?=$this->GetEditAreaId($arElement['ID']);?>" <?if($i%2==1)echo "style='margin-left:20px;'";?>>
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
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
			</div>
			<?=$arElement["PREVIEW_TEXT"]?>					
</div><div class="price_m">
			<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<p>
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<div class="line"><span><?=GetMessage('old_price')?></span><br/><s><?=$arPrice["PRINT_VALUE"]?></s></div> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?>
						<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif?>
					</p>
				<?endif;?>
			<?endforeach;?>
			<?if(is_array($arElement["PRICE_MATRIX"])):?>
				<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
					<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
						<?
							if (IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
							elseif (IntVal($arQuantity["QUANTITY_FROM"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
							elseif (IntVal($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
						?>
					<?endif?>
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
					</form>
				</div>		
			&nbsp;
		</div>
	<?
	$cell++;
	?>
	</div>
	<?
	endforeach; 	
	?>
</div>
<?endforeach?>
<?if($arParams["SHOW_NEW"]=="Y"){?>
<div class="all">
<div class="item line">
<a href="<?=$arResult["NEW"]["SECTION_PAGE_URL"]?>new/" class="title"><h3><?=GetMessage("NEW_TITLE")?></h3></a>
<p class="section_description"><?=GetMessage("NEW_DESCRIPTION")?></p>
		<?
		$cell = 0;
		foreach($arResult["NEW"]["ITEMS"] as $i => $arElement):
		?>
		<div class="element_item" <?if($i%2==1)echo "style='margin-left:20px;'";?> id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
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
			</div>
			<?=$arElement["PREVIEW_TEXT"]?>					
		</div>
		<div class="price_m">
			<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<p>
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<div class="line">
							<span><?=GetMessage('old_price')?></span><br/><s><?=$arPrice["PRINT_VALUE"]?></s>
						</div>
							<span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?>
						<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif?>
					</p>
				<?endif;?>
			<?endforeach;?>
			<?if(is_array($arElement["PRICE_MATRIX"])):?>
				<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
					<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
						<?
							if (IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
							elseif (IntVal($arQuantity["QUANTITY_FROM"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
							elseif (IntVal($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
						?>
					<?endif?>
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
					</form>
				</div>
			&nbsp;
		</div>
	<?
	$cell++;
	?>
	</div>
	<?
	endforeach; 	
	?>
</div>
</div>
<?}?>
</div>