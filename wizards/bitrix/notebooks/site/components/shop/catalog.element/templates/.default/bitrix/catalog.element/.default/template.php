<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog_element">
	<div class="line">
		<div class="detail_picture">			
			<?if(is_array($arResult["DETAIL_PICTURE"])):?>
				<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
			<?else:?>
				<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
			<?endif?>
			<?if(count($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])>0){?>
			<div class="line more_photo">
				<?foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $i=>$photo){
				if($i<3){?>
					<a href="<?=CFile::GetPath($photo)?>" class="fancy preview" rel="more_photo">
					    <?$file = CFile::ResizeImageGet($photo, array('width'=>40, 'height'=>40), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>                            
						<img src="<?=$file['src']?>" width="<?=$file['width']?>">
					</a>
				<?}
				}?>
			</div>
			<?}?>
		</div>
		<div class="description">	
			<div class="line name"><h1><?=$arResult["NAME"]?></h1></div>	
			<?if($arResult["PREVIEW_TEXT"]):?>
				<p class="preview_text"><?=$arResult["PREVIEW_TEXT"]?></p>
			<?endif;?>
		<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
			<?if($arPrice["CAN_ACCESS"]):?>
				<p>
				<?if($arParams["PRICE_VAT_SHOW_VALUE"] && ($arPrice["VATRATE_VALUE"] > 0)):?>
					<?if($arParams["PRICE_VAT_INCLUDE"]):?>
						(<?echo GetMessage("CATALOG_PRICE_VAT")?>)
					<?else:?>
						(<?echo GetMessage("CATALOG_PRICE_NOVAT")?>)
					<?endif?>
				<?endif;?>
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<div class="line" style="margin-top:7px;"><s><?=$arPrice["PRINT_VALUE"]?></s></div>
					<span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?if($arParams["PRICE_VAT_SHOW_VALUE"]):?><br />
						<?=GetMessage("CATALOG_VAT")?>:&nbsp;&nbsp;<span class="catalog-vat catalog-price"><?=$arPrice["DISCOUNT_VATRATE_VALUE"] > 0 ? $arPrice["PRINT_DISCOUNT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT")?></span>
					<?endif;?>
				<?else:?>
					<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?if($arParams["PRICE_VAT_SHOW_VALUE"]):?><br />
						<?=GetMessage("CATALOG_VAT")?>:&nbsp;&nbsp;<span class="catalog-vat catalog-price"><?=$arPrice["VATRATE_VALUE"] > 0 ? $arPrice["PRINT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT")?></span>
					<?endif;?>
				<?endif?>
				</p>
			<?endif;?>
		<?endforeach;?>
		<div class="line vote"><span><?=GetMessage("votes")?>:&nbsp;</span>
		<?$APPLICATION->IncludeComponent("bitrix:iblock.vote","stars",Array(
		"IBLOCK_ID" => $arResult["IBLOCK_ID"],
		"ELEMENT_ID" => $arResult["ID"],
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array("1","2","3","4","5"),
		"SET_STATUS_404" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"DISPLAY_AS_RATING" => "vote_avg",
	)
);?>
</div>
<div class="line">
<p><?=GetMessage("available")?>: <?if($arResult["CATALOG_QUANTITY"]>0){echo GetMessage("available_yes");}else{echo GetMessage("available_no");}?></p>
</div>
				<div class="line buttons">
					<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" >
						<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
						<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arResult["ID"]?>">
						<?if($arResult["CAN_BUY"]&&$arResult["CATALOG_QUANTITY"]>0){?>
							<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?//echo GetMessage("CATALOG_ADD_TO_BASKET")?>" class="add" >
						<?}
						else
						{?>
							<div class="buy_nonactive" alt="нет в наличии" ></div>
						<?}?>						
					</form>
				</div>
</div>
	</div>
	<?if($arResult["DETAIL_TEXT"]):?>
		<div class="line" style="margin-top:20px;"><?=$arResult["DETAIL_TEXT"]?></div>
	<?endif;?>
</div>
