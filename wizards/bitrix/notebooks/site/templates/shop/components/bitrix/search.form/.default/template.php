<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form action="<?=$arResult["FORM_ACTION"]?>">
	<div class="search_input">
		<div class="s_i_left"></div>
		<div class="s_i_content">
			<input type="text" name="q" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" size="15" maxlength="50" onfocus="javascript: if(this.value == '<?=GetMessage("BSF_T_SEARCH_BUTTON");?>') this.value = '';" onblur="javascript: if(this.value == '') { this.value = '<?=GetMessage("BSF_T_SEARCH_BUTTON");?>';}"/>
		</div>
		<div class="s_i_right"></div>
	</div>
	<input name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" style="display:none;"/>
</form>
