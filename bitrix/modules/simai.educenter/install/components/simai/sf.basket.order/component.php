<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return false;

$arResult["ERRORS"] = Array();

//получить ссылки



$arParams["IBLOCK_ID"] = IntVal($arParams["IBLOCK_ID"]);
$arParams["CATALOG_IBLOCK_ID"] = IntVal($arParams["CATALOG_IBLOCK_ID"]);
$arParams["ITEMS_LINKS"] = ($arParams["ITEMS_LINKS"] != "N");
$arParams["DISPLAY_CENTS"] = ($arParams["DISPLAY_CENTS"] != "N");
$arParams["CONT_SESSION"] = ($arParams["CONT_SESSION"] != "N");

$PRICE_CODE = false;
$PRICE_MODE = false;

if (substr($arParams["CATALOG_PRICE_PROPERTY"], 0, 6) == 'price_'):
	$PRICE_CODE = substr($arParams["CATALOG_PRICE_PROPERTY"], 6);
	$PRICE_MODE = "price";
elseif (substr($arParams["CATALOG_PRICE_PROPERTY"], 0, 5) == 'prop_'):
	$PRICE_CODE = substr($arParams["CATALOG_PRICE_PROPERTY"], 5);
	$PRICE_MODE = "prop";
endif;

if ($_REQUEST['action'] == 'clear'):
	unset($_SESSION['simai_basket_items']);
	LocalRedirect($APPLICATION->GetCurPage()); die();
elseif ($_REQUEST['action'] == 'delete' && $_REQUEST['id'] > 0):
	$id = IntVal($_REQUEST['id']);
	$key = IntVal($_REQUEST['key']);
	
	unset($_SESSION['simai_basket_items'][$id."_".$key]);
	if (count($_SESSION['simai_basket_items']) == 0):
		unset($_SESSION['simai_basket_items']);
	endif;
	LocalRedirect($APPLICATION->GetCurPage()); die();
endif;

$arResult["BASKET"] = array();
$arResult["SUM"] = 0;
$item_ids = Array();
if (is_array($_SESSION['simai_basket_items'])):
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
endif;




if (count($item_ids) > 0):
	
	
	$arResult["ITEMS"] = array();
	//выборка данных
	$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL","IBLOCK_ID","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>$arParams["CATALOG_IBLOCK_ID"], "ACTIVE"=>"Y", "ID"=>$item_ids);

	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()):
		
		
		$arFields = $ob->GetFields();
		$arItem = array();
		$arItem["ID"] = $arFields["ID"];
	    $arItem["NAME"] = $arFields["NAME"];
		$arItem["DETAIL_PAGE_URL"] = $arFields["DETAIL_PAGE_URL"];
		$arProps = $ob->GetProperties();
		 
		$arItem["FORMS"] = array();
		$arForms = array();
		 
		 foreach($arResult["BASKET"][$arFields["ID"]]["FORMS"] as $form){
			 
			 $arForm = array();
			 $arTmp = $arProps["FORM"]["VALUE"][$form["KEY"]]["SUB_VALUES"];
			 $arForm["KEY"] = $form["KEY"];
			 $arForm["NAME"] = $arTmp["NAME_FORM"]["~VALUE"];
			 $arForm["TYPE"] = $arTmp["TYPE_FORM"]["~VALUE"];
			 $arForm["DURING"] = $arTmp["DURING_FORM"]["~VALUE"];
			 $arForm["COST"] = $arTmp["COST_FORM"]["~VALUE"];
			 $arForm["DISCOUNT"] = $arTmp["DISCOUNT_FORM"]["~VALUE"];
			 $arForm["FULL_COST"] = $arTmp["COST_FORM"]["~VALUE"];
			 $arForm["COUNT"] = $form["COUNT"];
			  if(is_numeric($arForm["FULL_COST"])&&is_numeric($arForm["DISCOUNT"])){
				$arForm["COST"] = $arForm["FULL_COST"]*((100 - $arForm["DISCOUNT"])/100);
			 }else{
				 $arForm["COST"] = $arForm["FULL_COST"];
			 }
			 $arItem["FORMS"][] = $arForm;
			 
			 $arResult["SUM"]+=$arForm["COST"]*$arForm["COUNT"];
		 }
		 
		 $arResult["ITEMS"][] = $arItem;
		 
	endwhile;
	
	
	
	$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL","IBLOCK_ID","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>$arParams["CATALOG_IBLOCK_ID_2"], "ACTIVE"=>"Y", "ID"=>$item_ids);

	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()):
		
		
		
		 $arFields = $ob->GetFields();
		 $arItem = array();
		 $arItem["ID"] = $arFields["ID"];
		 $arItem["NAME"] = $arFields["NAME"];
		 $arItem["DETAIL_PAGE_URL"] = $arFields["DETAIL_PAGE_URL"];

		 $arProps = $ob->GetProperties();
		 $arItem["FORMS"] = array();
		 
		 $arForms = array();
		 
		 foreach($arResult["BASKET"][$arFields["ID"]]["FORMS"] as $form){
			 
			 $arForm = array();
			 $arTmp = $arProps["FORM"]["VALUE"][$form["KEY"]]["SUB_VALUES"];
			 $arForm["KEY"] = $form["KEY"];
			 $arForm["NAME"] = $arTmp["NAME_FORM"]["~VALUE"];
			 $arForm["TYPE"] = $arTmp["TYPE_FORM"]["~VALUE"];
			 $arForm["DURING"] = $arTmp["DURING_FORM"]["~VALUE"];
			 $arForm["FULL_COST"] = $arTmp["COST_FORM"]["~VALUE"];
			 $arForm["DISCOUNT"] = $arTmp["DISCOUNT_FORM"]["~VALUE"];
	
			 if(is_numeric($arForm["FULL_COST"])&&is_numeric($arForm["DISCOUNT"])){
				$arForm["COST"] = $arForm["FULL_COST"]*((100 - $arForm["DISCOUNT"])/100);
			 }else{
				 $arForm["COST"] = $arForm["FULL_COST"];
			 }
			 $arForm["COUNT"] = $form["COUNT"];
			 $arItem["FORMS"][] = $arForm;
			 $arResult["SUM"]+=$arForm["COST"]*$arForm["COUNT"];
		 }
		 
		 $arResult["ITEMS"][] = $arItem;
		 
	endwhile;
	
	
	
	
endif;

if (!($USER->IsAuthorized())):
	include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
endif;



if (!$USER->IsAuthorized()):
	$arResult["CAP_CODE"] = $GLOBALS["APPLICATION"]->CaptchaGetCode();
endif;

if (is_array($arResult["ITEMS"])):
	if (count($arResult["ITEMS"]) > 0):
		CAjax::Init();
	endif;
endif;

$this->IncludeComponentTemplate();

?>
