<?
$require_prop=true;
function check_link_s($id)
{
	$iblock_configure_id = 0;
    $res = CIBlock::GetList(
        Array(), 
        Array(
            'XML_ID'=>'products-configure_#SITE_ID#'
        ), true
    );
    while($ar_res = $res->Fetch())
    {
        $iblock_configure_id = $ar_res['ID'];
    }
	$rs=CIBlockElement::GetList(array(), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$iblock_configure_id,"PROPERTY_products"=>$id), false, false, array("IBLOCK_ID","ID","PROPERTY_specification","PROPERTY_required")); 
	if($ar=$rs->GetNext()) 
	{ 
		return $ar; 
	}
	else
	{
		return false;
	}
}

	$sect=$_POST["IBLOCK_SECTION"][0];
	while(!($link_res = check_link_s($sect))&&$sect)
	{
		$res1 = CIBlockSection::GetByID($sect);
		if($ar_res1 = $res1->GetNext())
		{
			if($ar_res1['DEPTH_LEVEL']==1)
			{
				$sect=false;
			}
			else
			{
				$sect = $ar_res1['IBLOCK_SECTION_ID'];
			}
		}
	}
	
	$key = 0;
	if($link_res){				
		$arr_req = $link_res["PROPERTY_REQUIRED_VALUE"];
$spec_prop_id = 0;
    $iblock_catalog = 0;
    $ibc_res = CIBlock::GetList(
        Array(), 
        Array(
            'XML_ID'=>'products-products_#SITE_ID#'
        ), true
    );
    while($ar_ibc_res = $ibc_res->Fetch())
    {
        $iblock_catalog = $ar_ibc_res['ID'];
    }		
$prop_c_res = CIBlock::GetProperties($iblock_catalog, Array(), Array("CODE"=>"specification"));
if($res_arr = $prop_c_res->Fetch()){
   $spec_prop_id = $res_arr["ID"];
		}
foreach($PROP[$spec_prop_id] as $prop_s=>$prop_elem)
		{			
			$el_index = array_search($prop_s,$arr_req);				
			if($prop_elem["VALUE"]!=""&&!($el_index===false)){				
				unset($arr_req[$el_index]);				
			}
		}

		if(count($arr_req)==0){
			$require_prop=false;
		}
				
		if($REQUEST_METHOD=="POST" && $require_prop){
			$error = new _CIBlockError(2, "DESCRIPTION_REQUIRED", "Вы не заполнили обязательные характеристики.");
			$bVarsFromForm=true;
		}
		
	}




?>