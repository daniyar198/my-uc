<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;
global $APPLICATION;


use Bitrix\Main\Localization\Loc; 

Loc::loadMessages(__FILE__);




if(!isset($_REQUEST["type"])||!isset($_REQUEST["iblock"])) die();

$paymentKey = $_REQUEST["type"];
$iblockPayment = $_REQUEST["iblock"];


    CModule::IncludeModule("iblock");
	
    $arResult=array();
	$arResult["PAYMENT"]=array();
	
	$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID" => $iblockPayment, "CODE" => "TYPE"));
	while($enum_fields = $property_enums->GetNext())
	{
	  $arResult["PAYMENT"][$enum_fields["XML_ID"]] = array("NAME" => $enum_fields["VALUE"],"METHOD" => array());
	}
	

	$arSelect = Array("ID", "NAME","CODE","IBLOCK_ID","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID" => $iblockPayment, "ACTIVE"=>"Y");

	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()):
		
		
		
		 $arFields = $ob->GetFields();
		 $arItem = array();
		 $arItem["ID"] = $arFields["ID"];
		 $arItem["NAME"] = $arFields["NAME"];
         $arItem["CODE"] = $arFields["CODE"];
		 $arProps = $ob->GetProperties();
		 $arItem["PROPERTIES"] = $arProps;
		
		 $arResult["PAYMENT"][$arProps["TYPE"]["VALUE_XML_ID"]]["METHOD"][] = $arItem;
		 
	endwhile;
	
	
	
	 
	  $keyMethod = key($arResult["PAYMENT"][$paymentKey ]["METHOD"]);
	  $method = $arResult["PAYMENT"][$paymentKey]["METHOD"][$keyMethod];
	 
	 ?>
	 <div class="mb-3">
	   <div class="mt-3"><?=Loc::getMessage("METHOD_PAIDS")?></div>
		 <?foreach($arResult["PAYMENT"][$paymentKey]["METHOD"] as $key=> $value):?>
			 
			  <div>
			   <input type="radio" id="<?=$value["CODE"]?>" name="method" value="<?=$value["CODE"]?>" <?if($keyMethod==$key):?> checked<?endif?>>
			   <label for="<?=$value["CODE"]?>"><?=$value["NAME"]?></label>
			</div>
		 
		  <?endforeach;?>
	  </div>
	  
	 <?foreach($method["PROPERTIES"]["FIELDS"]["VALUE"] as $value):?>
	 
		<div class="form-group mt-3">
		   <label for="<?=$value["SUB_VALUES"]["FIELD_CODE"]["VALUE"]?>" class=""><?if($value["SUB_VALUES"]["FIELD_REQUIRED"]["VALUE"]!=""):?><span class="starrequired">*</span><?endif?> <?=$value["SUB_VALUES"]["FIELD_NAME"]["VALUE"]?></label>
		   <input type="text" 
				  name="PROP[<?=$value["SUB_VALUES"]["FIELD_CODE"]["VALUE"]?>]" 
				  value="" 
				  id="<?=$value["SUB_VALUES"]["FIELD_CODE"]["VALUE"]?>"
				  class="form-control" 
				  placeholder="<?=$value["SUB_VALUES"]["FIELD_NAME"]["VALUE"]?>" <?if($value["SUB_VALUES"]["FIELD_REQUIRED"]["VALUE"]!=""):?> required<?endif?>>
		</div>
	 
	 <?endforeach;?>



