<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>


<?if (!empty($arResult)):?>

<div class="main_banner"> 								
  <div style="padding-top: 7px; padding-right: 7px; padding-bottom: 7px; padding-left: 7px; "> 									
    <div class="main_banner_fon"> 										
      <table cellpadding="0" cellspacing="2" width="100%" border="0"> 											
        <tbody>
          <tr valign="middle"> 												
		  	<td width="230px">
				<input type="hidden" name="banner_sec" id="banner_sec_id" value="0"/>
				
				<? foreach($arResult as $ind_sec => $val_sec){?>
					<? if($ind_sec == "0"){?>			
						 <a href="javascript:void(0)" onclick="show_hide_banner('<?=$ind_sec?>')" >													
							<div class="main_banner" id="banner_sec_punct_<?=$ind_sec?>"> 															
									<div class="main_banner_act"> 																
										<div class="main_banner_act_arrow"><img src="/bitrix/components/bitrix/optimpro.slider/images/banner_arrow_act_punct.png"  /></div>
										<div class="main_banner_punct font_medium"> 							<?php /*?>										
											<div class="float_left" style="width: 15px; "><?=$ind_sec+1?></div><?php */?>
												<div class="float_left"<?php /*?> style="width: 170px;"<?php */?> id="banner_sec_punct_<?=$ind_sec?>_text"><?php /*?><?=$ind_sec+1?><?php */?> <?=$val_sec["NAME"]?></div>
												 <div class="clear"></div>
										</div>
									</div>
							</div>
						 </a> 		
					<? }else{?>
						  <a href="javascript:void(0)" onclick="show_hide_banner('<?=$ind_sec?>')" > 														
							<div class="main_banner" id="banner_sec_punct_<?=$ind_sec?>"> 															
							  <div class="main_banner_punct font_medium" id="banner_sec_punct_<?=$ind_sec?>_text">
								<?php /*?><?=$ind_sec+1?> <?php */?><?=$val_sec["NAME"]?>
							  </div>
							</div>
						  </a> 
					<? }?>
					  <? if($arResult[$ind_sec+1]){?>
					  	 <div style="height: 3px; "></div>
					  <? }?>	
				<? }?>
		</td>
		<td class="white_banner_fon"> 	
		
			<? foreach($arResult as $ind_sec => $val_sec){?>									 													
              <div id="banner_body_<?=$ind_sec?>" <? if($ind_sec>0){?> style="display:none"<? }?>> 														
                <table cellpadding="0" cellspacing="0" width="100%" border="0"> 															
                  <tbody>
                    <tr valign="middle">
						<td align="center" width="50px" id="arrow_left_<?=$ind_sec?>">
							<? if(count($val_sec["ELEMENTS"]) >1 ){?>
							<img src="/bitrix/components/bitrix/optimpro.slider/images/banner_arrow_left_pas.png"  />
							<? }?>
						</td>
						<td> 	
						
							<? foreach($val_sec["ELEMENTS"] as $item_index => $item_value){?>	
								<div id="banner_el_<?=$ind_sec?>_<?=$item_index?>" <? if($item_index>0){?> style="display:none"<? }?>>														
									<table cellpadding="0" cellspacing="0" border="0" width="100%" height="185px"> 	
										<tr valign="middle">
											<td width="80px" style="padding-right: 20px;">
												<? 
												$arPreview = "";
												$arPreview = CFile::ResizeImageGet($item_value["PREVIEW_PICTURE"], array("width" => 80, "height" => 150), BX_RESIZE_IMAGE_PROPORTIONAL,false);
												?>
												<a href="<?=$item_value["PROPERTY_LINK_VALUE"]?>"><img src="<?=$arPreview["src"]?>"  /></a>
											</td>
											<td class="banner_data"> 																				
												<div style="padding-bottom: 5px; "><a href="<?=$item_value["PROPERTY_LINK_VALUE"]?>" class="font_medium" ><?=$item_value["NAME"]?></a></div>
												<div style="padding-top: 5px; padding-right: 0px; padding-bottom: 10px; padding-left: 0px; " class="banner_dotted_line"></div>
												<div class="banner_text"><?=$item_value["PREVIEW_TEXT"]?></div>
												<br />
												<div class="banner_price font_medium"><?=GetMessage("STR_PRICE")?>: <span class="font30 red"><?=$item_value["PROPERTY_PRICE_VALUE"]?></span> <span class="font24"><?=GetMessage("STR_CUR")?></span></div>
											</td> 																		
										</tr>
									</table>
								</div>
							<? }?>
							
                       	</td>
						<td align="center" width="50px" id="arrow_right_<?=$ind_sec?>">
							<? if(count($val_sec["ELEMENTS"]) >1 ){?>
								<a href="javascript:void(0)" onclick="show_hide_banner_elem('1', '<?=count($val_sec["ELEMENTS"])?>')"><img src="/bitrix/components/bitrix/optimpro.slider/images/banner_arrow_right.png" /></a>
							<? }?>
						</td>
					</tr>
						
							<tr valign="middle">
								<td align="right" style="padding-bottom: 10px;padding-right: 20px; line-height:1; height:11px" colspan="3">
									<? if(count($val_sec["ELEMENTS"])>1){?>
										<? for($m=0; $m<count($val_sec["ELEMENTS"]); $m++){?>
											<? if($m == 0){?>
											<a href="javascript:void(0)" onclick="show_hide_banner_elem('<?=$m?>', '<?=count($val_sec["ELEMENTS"])?>')">
												<span id="pager_<?=$ind_sec?>_<?=$m?>"><img style="position:relative; top:1px;" src="/bitrix/components/bitrix/optimpro.slider/images/banner_act_box.png"  /></span>
											</a>
											<? }else{?>
											<a href="javascript:void(0)" onclick="show_hide_banner_elem('<?=$m?>', '<?=count($val_sec["ELEMENTS"])?>')">
												<span id="pager_<?=$ind_sec?>_<?=$m?>"><img src="/bitrix/components/bitrix/optimpro.slider/images/banner_box.png"  /></span>
											</a>
											<? }?>
										<? }?>
									<? }?>
								</td>
							</tr>
						
                   	</tbody>
                </table>
              </div>
           <? }?>
			
          </td>
		 </tr>
        </tbody>
      </table>
     </div>
  </div>
</div>
 		 		
<script>
    function show_hide_banner(block_num){
    var sec_text = "";
    if(document.getElementById('banner_body_'+block_num).style.display == 'none'){
    for(i=0; i<=3; i++){
    if(document.getElementById('banner_body_'+i).style.display != 'none'){
    $("#banner_body_"+i).hide();
    /*sec_fon*/
    if(document.getElementById('banner_sec_punct_'+i)){
    sec_text = "";
    sec_text = document.getElementById('banner_sec_punct_'+i+'_text').innerHTML;
    document.getElementById('banner_sec_punct_'+i).innerHTML = '<div class="main_banner_punct font_medium" id="banner_sec_punct_'+i+'_text">'+sec_text+'</div>';
    
    }
    /*end sec_fon*/
    }
    }
    document.getElementById('banner_sec_id').value = block_num;
    $("#banner_body_"+block_num).show();
    
    /*sec_fon*/
    if(document.getElementById('banner_sec_punct_'+block_num)){
    sec_text = "";
    sec_text = document.getElementById('banner_sec_punct_'+block_num+'_text').innerHTML;
    document.getElementById('banner_sec_punct_'+block_num).innerHTML = '<div class="main_banner_act"><div class="main_banner_act_arrow"><img src="/bitrix/components/bitrix/optimpro.slider/images/banner_arrow_act_punct.png" /></div><div class="main_banner_punct font_medium"><div class="float_left" id="banner_sec_punct_'+block_num+'_text">'+sec_text+'</div><div class="clear"></div></div></div>';
    
    }
    /*end sec_fon*/
    
    }
    }
    function show_hide_banner_elem(m, sum){
	//console.log(m,sum);
    if(document.getElementById('banner_el_'+document.getElementById('banner_sec_id').value+'_'+m).style.display == 'none'){
    for(i=0; i<sum; i++){
    if(document.getElementById('banner_el_'+document.getElementById('banner_sec_id').value+'_'+i).style.display != 'none'){
    $("#banner_el_"+document.getElementById('banner_sec_id').value+'_'+i).hide();
    }
    /*pager*/
    if(document.getElementById('pager_'+document.getElementById('banner_sec_id').value+'_'+i) && sum>1){
    document.getElementById('pager_'+document.getElementById('banner_sec_id').value+'_'+i).innerHTML = '<img src="/bitrix/components/bitrix/optimpro.slider/images/banner_box.png" />';
    }
    /*endpager*/
    }
    $("#banner_el_"+document.getElementById('banner_sec_id').value+'_'+m).show();
    /*pager*/
    if(document.getElementById('pager_'+document.getElementById('banner_sec_id').value+'_'+m) && sum>1){
    document.getElementById('pager_'+document.getElementById('banner_sec_id').value+'_'+m).innerHTML = '<img src="/bitrix/components/bitrix/optimpro.slider/images/banner_act_box.png" style="position:relative; top:1px;" />';
    }
    /*endpager*/
    
    /*arrows*/
	
    if(sum>1){
    /*next*/
	
    
    if(m < sum){
    var next = parseInt(m)+1;
    document.getElementById('arrow_right_'+document.getElementById('banner_sec_id').value).innerHTML = '<a href="javascript:void(0)" onclick="show_hide_banner_elem('+next+', '+sum+')"><img src="/bitrix/components/bitrix/optimpro.slider/images/banner_arrow_right.png" /></a>';
    }
    /*end next*/
    /*prev*/
    if(m == 0){
    document.getElementById('arrow_left_'+document.getElementById('banner_sec_id').value).innerHTML = '<img src="/bitrix/components/bitrix/optimpro.slider/images/banner_arrow_left_pas.png"/>';
    }
    if(m > 0){
    var prev = parseInt(m)-1;
    document.getElementById('arrow_left_'+document.getElementById('banner_sec_id').value).innerHTML = '<a href="javascript:void(0)" onclick="show_hide_banner_elem('+prev+', '+sum+')"><img src="/bitrix/components/bitrix/optimpro.slider/images/banner_arrow_left.png" /></a>';
    }
    /*end prev*/
    }
	if(m == sum-1){
		//console.log("end",document.getElementById('banner_sec_id').value,document.getElementById('arrow_right_'+document.getElementById('banner_sec_id').value));
		document.getElementById('arrow_right_'+document.getElementById('banner_sec_id').value).innerHTML = '<img src="/bitrix/components/bitrix/optimpro.slider/images/banner_arrow_right_pas.png"/>';
    }
    /*end arrows*/
    
    }
    }
    </script>

<?endif;?>