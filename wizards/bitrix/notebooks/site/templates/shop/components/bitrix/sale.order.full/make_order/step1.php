<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="type_right_block">
	<p style="font-size:18px;color:#555555;margin-top:0;"><?echo GetMessage("STOF_PROC_DIFFERS")?></p>
	<p style="line-height:1.8;color:#555555;"><?echo GetMessage("STOF_PRIVATE_NOTES")?></p>
</div>
<div class="type_left_block">
			<?
			foreach($arResult["PERSON_TYPE_INFO"] as $v)
			{
				?><input type="radio" id="PERSON_TYPE_<?= $v["ID"] ?>" name="PERSON_TYPE" value="<?= $v["ID"] ?>"<?if ($v["CHECKED"]=="Y") echo " checked";?>> <label for="PERSON_TYPE_<?= $v["ID"] ?>"><?= $v["NAME"] ?></label><br /><?
			}
			?>
</div>
<input type="submit" class="contButton" name="contButton" value="<?= GetMessage("SALE_CONTINUE")?> &gt;&gt;" style="margin:40px 0 0 10px;">
	