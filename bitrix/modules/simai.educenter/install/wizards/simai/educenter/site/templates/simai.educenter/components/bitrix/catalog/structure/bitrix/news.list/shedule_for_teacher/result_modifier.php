<?

$arResult["ROOMS"]=array();
$arSelect = Array("ID", "IBLOCK_ID","CODE","LANG_DIR", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID_ROOMS"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arResult["ROOMS"][$arFields["ID"]]=array("NAME"=>$arFields["NAME"],"DETAIL_PAGE_URL"=>$arFields["DETAIL_PAGE_URL"]);
}
$arResult["CLASS"]="";
$arSelect = Array("ID", "IBLOCK_ID","CODE","LANG_DIR", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID_CLASSES"], "ACTIVE"=>"Y","ID" => Array($_REQUEST["group"]));
$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arResult["CLASS"][$arFields["ID"]]=array("NAME"=>$arFields["NAME"],"DETAIL_PAGE_URL"=>$arFields["DETAIL_PAGE_URL"]);
}

$arResult["SHEDULE"]=array();
$arResult["SHEDULE"][GetMessage("Mon")]=array();
$arResult["SHEDULE"][GetMessage("Tue")]=array();
$arResult["SHEDULE"][GetMessage("Wed")]=array();
$arResult["SHEDULE"][GetMessage("Thu")]=array();
$arResult["SHEDULE"][GetMessage("Fri")]=array();
$arResult["SHEDULE"][GetMessage("Sat")]=array();


$sort=array();
$sort[GetMessage("Mon")]=array();
$sort[GetMessage("Tue")]=array();
$sort[GetMessage("Wed")]=array();
$sort[GetMessage("Thu")]=array();
$sort[GetMessage("Fri")]=array();
$sort[GetMessage("Sat")]=array();




foreach($arResult["ITEMS"] as $arItem)
{
  $arResult["SHEDULE"][$arItem["PROPERTIES"]["DAY_OF_WEEK"]["VALUE"]][]=array("NAME"=>$arItem["NAME"],
                                                                              "TIME"=>array("NAME"=>$arItem["PROPERTIES"]["TIME"]["NAME"],"VALUE"=>$arItem["PROPERTIES"]["TIME"]["VALUE"]),
                                                                              "ROOM"=>array("NAME"=>$arItem["PROPERTIES"]["ROOM"]["NAME"],"VALUE"=>$arResult["ROOMS"][$arItem["PROPERTIES"]["ROOM"]["VALUE"]]),          
                                                                              "CLASS"=>array("NAME"=>$arItem["PROPERTIES"]["GROUP"]["NAME"],"VALUE"=>$arResult["CLASS"][$arItem["PROPERTIES"]["GROUP"]["VALUE"]]));
 
    $min=strpos($arItem["PROPERTIES"]["TIME"]["VALUE"], "-");
	if($min>strpos($arItem["PROPERTIES"]["TIME"]["VALUE"], ":")&&strpos($arItem["PROPERTIES"]["TIME"]["VALUE"], ":"))$min=strpos($arItem["PROPERTIES"]["TIME"]["VALUE"], ":");
	$sort[$arItem["PROPERTIES"]["DAY_OF_WEEK"]["VALUE"]][]=(int)substr($arItem["PROPERTIES"]["TIME"]["VALUE"], 0,$min); 	
}
foreach($sort as $key => $ar)
{
    $length = count($ar);

     for ($i = 0; $i < $length-1; $i++) {
         for ($j = 0; $j < $length-$i-1; $j++) {
             if ($sort[$key][$j] > $sort[$key][$j+1]) {
                 $b = $sort[$key][$j];
                 $tmp= $arResult["SHEDULE"][$key][$j];			 
                 $sort[$key][$j] = $sort[$key][$j+1];
                 $sort[$key][$j+1] = $b;
				$arResult["SHEDULE"][$key][$j] =$arResult["SHEDULE"][$key][$j+1];
                $arResult["SHEDULE"][$key][$j+1] = $tmp;
             }
         }
     }
 
}
?>