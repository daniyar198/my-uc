<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$teacherKey="";
foreach($arResult["ITEMS"] as $key=>$arItem)
{
	if(strpos($arItem["INPUT_NAME"], "TEACHER"))
		$teacherKey = $key;
		
	
    if(is_string($arItem["INPUT_NAME"]))
    {
        $pattern = '/\[([\S]+)\]/';
        preg_match($pattern, $arItem["INPUT_NAME"], $matches);
        if(is_string(getMessage($matches[1])))$arResult["ITEMS"][$key]["NAME"]=getMessage($matches[1]);
    }
}

 if(isset($arParams["IBLOCK_ID_TEACHER"])):
 
    $arResult["TEACHER"] = array();
	
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID_TEACHER"], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array("nPageSize"=>100), $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arFields = $ob->GetFields();
	 $arResult["TEACHER"][$arFields["ID"]] = $arFields["NAME"];
	}
	
 endif;	

 
 $result = '<select class="form-control" name="arrFilter_pf[TEACHER]"> <option value="">'.getMessage("ALL_TEACHERS").'</option>';
 
 foreach($arResult["TEACHER"] as $id => $name):
    $result .= '<option value="'.$id.'">'.$name.'</option>';
 endforeach; 

  $result .= '</select>';
  
  if($teacherKey!="")
	   $arResult["ITEMS"][$teacherKey]['INPUT'] = $result;
	  
  