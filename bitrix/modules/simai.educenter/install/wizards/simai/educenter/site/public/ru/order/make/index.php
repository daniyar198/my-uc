<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?><?$APPLICATION->IncludeComponent(
	"simai:sf.sale.order", 
	".default", 
	array(
		"CATALOG_IBLOCK_ID" => "24",
		"CATALOG_IBLOCK_ID_2" => "29",
		"CATALOG_IBLOCK_TYPE" => "organization",
		"CATALOG_PRICE_PROPERTY" => "prop_PRICE",
		"COMPONENT_TEMPLATE" => ".default",
		"CONT_SESSION" => "Y",
		"COUPON_IBLOCK_ID" => "",
		"DISPLAY_CENTS" => "Y",
		"EMAIL" => " ",
		"EMAIL_SUBJ" => "",
		"EMAIL_THEME" => "новый заказ",
		"EMAIL_TO" => "",
		"FIELDS_2_USER" => array(
			0 => "USERNAME",
			1 => "PHONE",
			2 => "EMAIL",
		),
		"FIELDS_2_USER_REQ" => array(
			0 => "USERNAME",
			1 => "PHONE",
		),
		"IBLOCK_ID" => "#payment#",
		"IBLOCK_TYPE" => "payments",
		"ITEMS_LINKS" => "Y",
		"IBLOCK_ID_PAYMENT" => "#methods_paid#",
		"LINKS" => SITE_DIR."order/payment/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>