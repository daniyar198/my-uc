<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$courseKey="";
foreach($arResult["ITEMS"] as $key=>$arItem)
{
	if(strpos($arItem["INPUT_NAME"], "COURSE"))
		$courseKey = $key;
		
	
    if(is_string($arItem["INPUT_NAME"]))
    {
        $pattern = '/\[([\S]+)\]/';
        preg_match($pattern, $arItem["INPUT_NAME"], $matches);
        if(is_string(getMessage($matches[1])))$arResult["ITEMS"][$key]["NAME"]=getMessage($matches[1]);
    }
}

 if(isset($arParams["IBLOCK_ID_COURSE"])):
 
    $arResult["COURSE"] = array();
	
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID_COURSE"], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array("nPageSize"=>100), $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arFields = $ob->GetFields();
	 $arResult["COURSE"][$arFields["ID"]] = $arFields["NAME"];
	}
	
 endif;	
 /*
 echo "<pre>";
 print_r($_REQUEST);
 echo "</pre>";
 */
 
 
 $result = '<select class="form-control" name="arrFilter_pf[COURSE]"> <option value="">Все семинары</option>';
 
 foreach($arResult["COURSE"] as $id => $name):
    $result .= '<option value="'.$id.'">'.$name.'</option>';
 endforeach; 

  $result .= '</select>';
  
  if($courseKey!="")
	   $arResult["ITEMS"][$courseKey]['INPUT'] = $result;
	  
  