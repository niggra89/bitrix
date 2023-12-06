<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
<?/*?>
<script>
$(document).ready(function(){
	var height_res = 0;
	$('.best_item .property').each(function(){
		var height = $(this).height();
		if(height>height_res){height_res = height;}
	});
	$('.best_item .property').each(function(){
		$(this).height(height_res);
	});
	
});
</script>
<?*/?>
<div class="section_list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

	<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<div class="section_list_item" <?if($cell%2==1){?>style="margin-left:20px;"<?}?>>
	<?
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<div class="preview_picture">
	<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
		<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
	<?endif?>
	</div>
	
	<div class="name"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></div>
	
			<div class="property">
						<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<?if($pid=="specification"){
							foreach($arProperty["VALUE"] as $i=>$val){
$res = CIBlockElement::GetByID($val);
if($ar_res = $res->GetNext()){
if($i!=0){echo "&nbsp;/&nbsp;";}
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
		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
