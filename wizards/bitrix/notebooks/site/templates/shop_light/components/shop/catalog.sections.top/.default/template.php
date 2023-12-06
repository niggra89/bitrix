<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
<div class="catalog_sections_top">
<?if($arParams["SHOW_ALL"]=="Y"){?>
<div class="all">
<div class="item line">
<div class="line with_line thin" style="margin-bottom:8px;*margin:0;"></div>
<a href="<?=$arResult["ALL"]["SECTION_PAGE_URL"]?>all/" class="title"><h2 class="with_line"><?=GetMessage('all')?> <?=strtolower($arResult["ALL"]["NAME"])?></h2></a>
<div class="item_content">
<p class="section_description"><?=$arResult["ALL"]["DESCRIPTION"]?></p>
		<?
		$cell = 0;
		foreach($arResult["ALL"]["ITEMS"] as $i => $arElement):
		?>
		<div class="element_item" <?if(($i+1)%3==0)echo "style='margin:0px;'";?> id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<?
		 $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		 $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="line">
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
				<?=$arElement["NAME"]?>
			</a>
		</div>
		<div class="preview_picture">
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
				<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
					<img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="100" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?else:?>
					<img border="0" src="/images/nophoto.jpg" width="100" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?endif?>
			</a>
		</div>					
		<div class="elem">	
			<div class="elem_descr">
			<div class="property">
				<?if(strlen($arElement["PREVIEW_TEXT"])>3){?>
					<?=$arElement["PREVIEW_TEXT"]?>		
				<?}else{?>
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
				<?}?>
			</div>				
</div><div class="price_m">
			<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<div class="line"><span><?=GetMessage('old_price')?></span><br/>
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
			<div class="line buttons">
				<?if($arElement["CAN_BUY"]&&$arElement["CATALOG_QUANTITY"]>0&&((count($arElement["PRICES"]) > 0) || count($arElement["PRICE_MATRIX"]["COLS"])>0)){?>				
					<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" class="form_buy">
					<input type="hidden" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" >
					<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
					<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>">
					<noindex>
						<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow" class="buy color_theme"><?echo GetMessage("CATALOG_BUY")?></a>
					</noindex>						
					</form>					
				<?}
				else
				{
					if($arElement["CATALOG_QUANTITY"]<=0&&((count($arElement["PRICES"]) > 0) || count($arElement["PRICE_MATRIX"]["COLS"])>0)){?>
					<div class="form_buy"><span><?= GetMessage("CATALOG_NOT_AVAILABLE")?></span></div>
					<?}else{?>&nbsp;
				<?}
				}?>
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
</div>
<?}?>
<?foreach($arResult["SECTIONS"] as $arSection):?>
<div class="item line">
<div class="line with_line thin" style="margin-bottom:8px;*margin:0;"></div>
<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="title"><h2 class="with_line"><?=$arSection["NAME"]?></h2></a>
<div class="item_content">
<p class="section_description"><?=$arSection["DESCRIPTION"]?></p>
		<?
		$cell = 0;
		foreach($arSection["ITEMS"] as $i => $arElement):
		?>
		<div class="element_item" id="<?=$this->GetEditAreaId($arElement['ID']);?>" <?if(($i+1)%3==0)echo "style='margin:0px;'";?>>
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="line">
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
				<?=$arElement["NAME"]?>
			</a>
		</div>
		<div class="preview_picture">
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
				<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
					<img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="100" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?else:?>
					<img border="0" src="/images/nophoto.jpg" width="100" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?endif?>
			</a>
		</div>					
		<div class="elem">		
		<div class="elem_descr">
			<div class="property">
				<?if(strlen($arElement["PREVIEW_TEXT"])>3){?>
					<?=$arElement["PREVIEW_TEXT"]?>		
				<?}else{?>
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
				<?}?>
			</div>						
		</div>
		<div class="price_m">
			<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<div class="line"><span><?=GetMessage('old_price')?></span><br/><s><?=$arPrice["PRINT_VALUE"]?></s></div> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?>
						<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif?>
				<?endif;?>
			<?endforeach;?>
			<?if(is_array($arElement["PRICE_MATRIX"])):?>
				<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
					<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
						<?	if (IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
							elseif (IntVal($arQuantity["QUANTITY_FROM"]) > 0)
								echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
							elseif (IntVal($arQuantity["QUANTITY_TO"]) > 0)
								echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));?>
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
				<?if($arElement["CAN_BUY"]&&$arElement["CATALOG_QUANTITY"]>0&&((count($arElement["PRICES"]) > 0) || count($arElement["PRICE_MATRIX"]["COLS"])>0)){?>				
					<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" class="form_buy">
					<input type="hidden" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" >
					<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
					<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>">
					<noindex><a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow" class="buy color_theme"><?echo GetMessage("CATALOG_BUY")?></a></noindex>						
					</form>					
				<?}
				else
				{
					if($arElement["CATALOG_QUANTITY"]<=0&&((count($arElement["PRICES"]) > 0) || count($arElement["PRICE_MATRIX"]["COLS"])>0)){?>
					<div class="form_buy"><span><?= GetMessage("CATALOG_NOT_AVAILABLE")?></span></div>
					<?}else{?>&nbsp;
				<?}
				}?>
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
<?endforeach?>
<?if($arParams["SHOW_NEW"]=="Y"){?>
<div class="all">
<div class="item line">
<div class="line with_line thin" style="margin-bottom:8px;*margin:0;"></div>
<a href="<?=$arResult["NEW"]["SECTION_PAGE_URL"]?>new/" class="title"><h2 class="with_line"><?=GetMessage("NEW_TITLE")?></h2></a>
<div class="item_content">
<p class="section_description"><?=GetMessage("NEW_DESCRIPTION")?></p>
		<?
		$cell = 0;
		foreach($arResult["NEW"]["ITEMS"] as $i => $arElement):
		?>
		<div class="element_item" <?if(($i+1)%3==0)echo "style='margin:0px;'";?> id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="line">
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
				<?=$arElement["NAME"]?>
			</a>
		</div>
		<div class="preview_picture">
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
				<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
					<img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="100" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?else:?>
					<img border="0" src="/images/nophoto.jpg" width="100" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
				<?endif?>
			</a>
		</div>					
		<div class="elem">	
		<div class="elem_descr">		
			<div class="property">
				<?if(strlen($arElement["PREVIEW_TEXT"])>3){?>
					<?=$arElement["PREVIEW_TEXT"]?>		
				<?}else{?>
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
				<?}?>
			</div>				
		</div>
		<div class="price_m">
			<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
				<?if($arPrice["CAN_ACCESS"]):?>
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<div class="line">
							<span><?=GetMessage('old_price')?></span><br/><s><?=$arPrice["PRINT_VALUE"]?></s>
						</div>
							<span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?else:?>
						<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif?>
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
				<?if($arElement["CAN_BUY"]&&$arElement["CATALOG_QUANTITY"]>0&&((count($arElement["PRICES"]) > 0) || count($arElement["PRICE_MATRIX"]["COLS"])>0)){?>				
					<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" class="form_buy">
					<input type="hidden" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" >
					<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
					<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>">
					<noindex><a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow" class="buy color_theme"><?echo GetMessage("CATALOG_BUY")?></a></noindex>						
					</form>					
				<?}
				else
				{
					if($arElement["CATALOG_QUANTITY"]<=0&&((count($arElement["PRICES"]) > 0) || count($arElement["PRICE_MATRIX"]["COLS"])>0)){?>
					<div class="form_buy"><span><?= GetMessage("CATALOG_NOT_AVAILABLE")?></span></div>
					<?}else{?>&nbsp;
					<?}
				}?>
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
</div>
<?}?>
</div>