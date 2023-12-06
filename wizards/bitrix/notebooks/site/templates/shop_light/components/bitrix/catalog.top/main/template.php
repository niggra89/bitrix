<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
<script>
$(document).ready(function(){
	var height_res = 0;
	$('.best_item ').each(function(){
		var height = $(this).find('.name').height()+$(this).find('.property').height();
		if(height>height_res){height_res = height;}
	});
	$('.best_item').each(function(){
		var name_height = $(this).find('.name').height();
		$(this).find('.property').height(height_res-name_height);
	});

});
</script>
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

	<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<div class="best_item" <?if($cell==0){?>style="margin:0;"<?}?>>
	<?
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="name"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></div>
	<div class="preview_picture">
	<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
		<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" <?if($arElement["PREVIEW_PICTURE"]["WIDTH"]>$arElement["PREVIEW_PICTURE"]["HEIGHT"])echo "width='100px'";?>  <?if($arElement["PREVIEW_PICTURE"]["WIDTH"]<=$arElement["PREVIEW_PICTURE"]["HEIGHT"])echo "height='100px'";?> alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
	<?endif?>
	</div>
	<div class="description">
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
		<div class="price">
				<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
					<?if($arPrice["CAN_ACCESS"]):?>						
						<?=$arPrice["PRINT_VALUE"]?>						
					<?endif;?>
				<?endforeach;?>
		</div>
	</div>
	</div>
		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
