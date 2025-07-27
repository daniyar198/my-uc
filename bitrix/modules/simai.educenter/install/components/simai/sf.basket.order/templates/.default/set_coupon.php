<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$coupon = trim($_REQUEST['coupon']);



$iblock_coupon = "sf-ru-coupon";


$IBLOCK_ID= "";
//получаем ид инфоблока купонов
$res = CIBlock::GetList(Array(), Array("CODE"=>$iblock_coupon), true);
if($ar_res = $res->Fetch())
{
   $IBLOCK_ID = $ar_res['ID'];
}


//получаем данные купона
$arSelect = Array("ID", "IBLOCK_ID", "NAME","PROPERTY_*");
$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_CODE" => $coupon);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
if($ob = $res->GetNextElement()){ 

	 $arProps = $ob->GetProperties();
	 //сохраняем данные в сессии
	 
	  $_SESSION['simai_basket_coupon'] = array(
	   "CODE" => $arProps["CODE"]["VALUE"],
	   "DISCOUNT" => $arProps["DISCOUNT"]["VALUE"],
	   "DISCOUNT_SUM" => $arProps["DISCOUNT_SUM"]["VALUE"],
	);
}


$property_price = htmlspecialchars($_REQUEST['property_price']);
$display_cents = ($_REQUEST['display_cents'] == "y");

$PRICE_CODE = false;
$PRICE_MODE = false;

if (substr($property_price, 0, 6) == 'price_'):
	$PRICE_CODE = substr($property_price, 6);
	$PRICE_MODE = "price";
elseif (substr($property_price, 0, 5) == 'prop_'):
	$PRICE_CODE = substr($property_price, 5);
	$PRICE_MODE = "prop";
endif;


	$PRICES = false;
	if ($PRICE_MODE == "price"):
		if (CModule::IncludeModule("catalog")):
			//$PRICES = CIBlockPriceTools::GetCatalogPrices($IBLOCK_ID, array($PRICE_CODE));
			//print_r($PRICES);
		endif;
	endif;

	$item_ids = Array();
	if (count($_SESSION['simai_basket_items']) > 0):
		foreach ($_SESSION['simai_basket_items'] as $item_id=>$item_count):
			$item_id = IntVal($item_id);
			if ($item_id > 0):
				$item_ids[] = $item_id;
			endif;
		endforeach;
	endif;
	
	$SUM = 0;
	
	if (count($item_ids) > 0):
	
	  foreach($item_ids as $itemID):
	  

	  $res = CIBlockElement::GetByID($itemID);
	  if($ar_res = $res->GetNext()):
		  $IBLOCK_ID = $ar_res['IBLOCK_ID'];
	  
			$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
			if ($PRICE_MODE == "prop"):
				$arSelect[] = "PROPERTY_".$PRICE_CODE;
			elseif ($PRICE_MODE == "price"):
				$arSelect[] = $PRICES[$PRICE_CODE]["SELECT"];
			endif;	
			$arFilter = Array("ACTIVE"=>"Y", "ID"=>$itemID, "IBLOCK_ID" => $IBLOCK_ID);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			if($arr = $res->GetNext()):
				
				if (is_array($PRICES)):
					$iPRICES = CIBlockPriceTools::GetItemPrices($arr["IBLOCK_ID"], $PRICES, $arr, true);
					$arr["PRICE"] = round($iPRICES[$PRICE_CODE]["DISCOUNT_VALUE_VAT"],2);
				endif;
				
				if ($arr["PROPERTY_".$PRICE_CODE."_VALUE"] > 0):
					$arr["PRICE"] = round($arr["PROPERTY_".$PRICE_CODE."_VALUE"],2);
				endif;
				
				if ($arr["PRICE"] > 0):
					$SUM = $SUM + ($arr["PRICE"]*$_SESSION['simai_basket_items'][$itemID]);
				endif;
				
			endif;
		 endif;
		endforeach;
	endif;
	
	
	//пересчитываем сумму с учётом скидки
    if(isset($_SESSION['simai_basket_coupon']["DISCOUNT"])){
		
		$SUM = ($SUM*(100 - intVal($_SESSION['simai_basket_coupon']["DISCOUNT"])))/100;
	}
	
	if(isset($_SESSION['simai_basket_coupon']["DISCOUNT_SUM"])){
		
		$SUM = $SUM - intVal($_SESSION['simai_basket_coupon']["DISCOUNT_SUM"]);
	}

	$SUM = number_format($SUM, ($display_cents ? 2 : 0), '.', ' ');
	
	echo $SUM;
?>