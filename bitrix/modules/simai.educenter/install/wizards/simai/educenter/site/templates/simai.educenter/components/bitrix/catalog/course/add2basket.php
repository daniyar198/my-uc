<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$items = Array();
if ($_REQUEST['item_id'] > 0)
{ 
	$item_id = IntVal($_REQUEST['item_id']);
	if (!is_array($_SESSION['simai_basket_items']))
		$_SESSION['simai_basket_items'] = Array();
	if (is_array($_SESSION['simai_basket_items'][$item_id]))
		$_SESSION['simai_basket_items'][$item_id]["COUNT"]++;
	else
	{	
		$_SESSION['simai_basket_items'][$item_id] = Array();
		$_SESSION['simai_basket_items'][$item_id]["ID"] = $item_id;
		$_SESSION['simai_basket_items'][$item_id]["COUNT"] = 1;
	}
}

$APPLICATION->IncludeComponent("simai:sf.basket.count", "", array(
	 "BASKET_PATH" => "/order/"
	),
	false
);
?>