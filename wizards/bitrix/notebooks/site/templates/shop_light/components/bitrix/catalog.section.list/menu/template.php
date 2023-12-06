<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$selected_id = 0;
if(isset($_REQUEST["SECTION_ID"]))
{
	$selected_id = $_REQUEST["SECTION_ID"];
	
}
elseif(isset($_REQUEST["ELEMENT_ID"]))
{
	$res_el = CIBlockElement::GetByID($_REQUEST["ELEMENT_ID"]);
	if($ar_res = $res_el->GetNext())
		$selected_id = $ar_res['IBLOCK_SECTION_ID'];
}
else
{
	$arVariables = array();
	$page = CComponentEngine::ParseComponentPath(SITE_DIR, array(
		"sections" => "catalog-section/#SECTION_ID#/",
		"list" => "catalog-section/#SECTION_ID#/#params#/",
                "element" => "catalog-item/#ELEMENT_ID#/",
	), $arVariables);
	if(isset($arVariables["SECTION_ID"]))
	{
		$selected_id = $arVariables["SECTION_ID"];
	}
	else
	{
		/*$page = CComponentEngine::ParseComponentPath(SITE_DIR."catalog-item/", array(
			"element" => "#ELEMENT_ID#/",
		), $arVariables);
		*/
		$res_el = CIBlockElement::GetByID($arVariables["ELEMENT_ID"]);
		if($ar_res = $res_el->GetNext())
			$selected_id = $ar_res['IBLOCK_SECTION_ID'];
	}
}
?>
<?$res = Array();
foreach($arResult["SECTIONS"] as $arSection){
	if(!$arSection["IBLOCK_SECTION_ID"]){
		$res[$arSection["ID"]] = $arSection;
	}
	else
	{
		$res[$arSection["IBLOCK_SECTION_ID"]]["SUBSECTION"][$arSection["ID"]] = $arSection;
		
		if($selected_id==$arSection["ID"])$selected_id = $arSection["IBLOCK_SECTION_ID"];
	}
}
$res_s = CIBlockSection::GetByID($selected_id);
if($ar_res = $res_s->GetNext()){
	if($ar_res['DEPTH_LEVEL']==3)
	{
		$res_s2 = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);
		if($ar_res2 = $res_s2->GetNext()){
			$selected_id = $ar_res2['IBLOCK_SECTION_ID'];
		}
	}
}
?>
<ul class="root">	
<?foreach($res as $id=>$arSection){
?><li class="root <?if($arSection["ID"]==$selected_id){?>selected<?}?>">
	<a href="<?=$arSection["LIST_PAGE_URL"]?>" class="root"><?=$arSection["NAME"]?></a><?	
	if(count($arSection["SUBSECTION"])>0){?>
		<ul>
		<?if(strtolower($arSection["NAME"])==GetMessage("notebooks")){?>
			<li><a href="<?=$arSection["SECTION_PAGE_URL"]?>all/" ><?=GetMessage("all")?></a></li>
		<?}?>
		<?foreach($arSection["SUBSECTION"] as $subSection){
				?>
					<li><a href="<?=$subSection["SECTION_PAGE_URL"]?>" ><?=$subSection["NAME"]?></a></li>
				<?
				}
				if(strtolower($arSection["NAME"])==GetMessage("notebooks")){
				?>
					<li><a href="<?=$arSection["SECTION_PAGE_URL"]?>new/" ><?=GetMessage("new")?></a></li>
				<?
				}
			?>
			</ul>
	<?}?>
	</li>
<?}?>
</ul>
				


