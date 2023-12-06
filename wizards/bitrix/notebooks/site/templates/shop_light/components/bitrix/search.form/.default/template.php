<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="search_form">
<form action="<?=$arResult["FORM_ACTION"]?>">
	<label for="s_input"><?=GetMessage("BSF_T_SEARCH_BUTTON")?></label>			
	<span class="input">
		<span class="right">
			<input id="s_input" type="text" name="q" value="" size="15" maxlength="50" />
		</span>
	</span>
	<input name="s" type="submit" value="&nbsp;" class="sub"/>
</form>
</div>