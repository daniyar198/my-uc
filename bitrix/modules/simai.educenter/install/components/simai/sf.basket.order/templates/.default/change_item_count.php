<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$item_id = IntVal($_REQUEST['item_id']);
$count = IntVal($_REQUEST['count']);
$key = IntVal($_REQUEST['key']);




$res = CIBlockElement::GetByID($item_id);
if($ar_res = $res->GetNext())
  $IBLOCK_ID = $ar_res['IBLOCK_ID'];



$property_price = htmlspecialchars($_REQUEST['property_price']);
$display_cents = ($_REQUEST['display_cents'] == "y");


if (array_key_exists($item_id."_".$key,$_SESSION['simai_basket_items']) && $count > 0):
	$_SESSION['simai_basket_items'][$item_id."_".$key]["count"] = $count;
	
	
	
$arResult = array();
$arResult["BASKET"] = array();

	$item_ids = Array();
	if (count($_SESSION['simai_basket_items']) > 0):
		foreach ($_SESSION['simai_basket_items'] as $id=>$item):
			$item_id = IntVal($item["id"]);
			if ($item_id > 0):
				$item_ids[$item_id] = $item_id;
			endif;
			if(isset($arResult["BASKET"][$item["id"]])){
				$arResult["BASKET"][$item["id"]]["FORMS"][] = array("KEY"=> $item["key"],"COUNT" => $item["count"]);
			}else{
			   $arResult["BASKET"][$item["id"]] = array("ID" => $item["id"],"FORMS" => array(0=>array("KEY"=> $item["key"],"COUNT" => $item["count"])));
			}
		endforeach;
	endif;

 $arResult["SUM"]=0;
 if (count($item_ids) > 0):
	
   foreach($item_ids as $itemID):
	  
	  $res = CIBlockElement::GetByID($itemID);
	  if($ar_res = $res->GetNext()):
		  $IBLOCK_ID = $ar_res['IBLOCK_ID'];
	  
			$arSelect = Array("ID", "NAME", "IBLOCK_ID","PROPERTY_*");
			$arFilter = Array("ACTIVE" => "Y", "ID" => $itemID, "IBLOCK_ID" => $IBLOCK_ID);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			if($ob = $res->GetNextElement()):
				
				 
				$arProps = $ob->GetProperties();
		        $arFields = $ob->GetFields();
				$arItem["FORMS"] = array();
					 
				$arForms = array();
					 
				foreach($arResult["BASKET"][$arFields["ID"]]["FORMS"] as $form){
						 
					$arForm = array();
					$arTmp = $arProps["FORM"]["VALUE"][$form["KEY"]]["SUB_VALUES"];
					$arForm["KEY"] = $form["KEY"];
				    $arForm["DISCOUNT"] = $arTmp["DISCOUNT_FORM"]["~VALUE"];
				    $arForm["FULL_COST"] = $arTmp["COST_FORM"]["~VALUE"];
					$arForm["COUNT"] = $form["COUNT"];
					
					if(is_numeric($arForm["FULL_COST"])&&is_numeric($arForm["DISCOUNT"])){
						$arForm["COST"] = $arForm["FULL_COST"]*((100 - $arForm["DISCOUNT"])/100);
					}else{
						$arForm["COST"] = $arForm["FULL_COST"];
					}
						 
					$arResult["SUM"]+=$arForm["COST"]*$arForm["COUNT"];
				}
				
				
			endif;
		 endif;
		endforeach;
	endif;
	echo number_format($arResult["SUM"], 2 , ".", " ");
endif;
?>