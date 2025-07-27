<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$item_id = IntVal($_REQUEST['item_id']);
$key = $_REQUEST['key'];
$basket_count = 0;

if ($item_id > 0):
	if (!is_array($_SESSION['simai_basket_items'])):
		$_SESSION['simai_basket_items'] = Array();
	endif;
	if (is_array($_SESSION['simai_basket_items'][$item_id."_".$key])):
		$_SESSION['simai_basket_items'][$item_id."_".$key]["count"]++;
	else:
		$_SESSION['simai_basket_items'][$item_id."_".$key] = array(
		   "id" => $item_id,
		   "key" => $key,
		   "count" => 1
		
		);
	endif;
	$basket_count = count($_SESSION['simai_basket_items']);
endif;

echo $basket_count?>