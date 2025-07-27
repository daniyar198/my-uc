<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить отзыв");
?>
<?$APPLICATION->IncludeComponent(
	"simai:feedback.all.string", 
	"reviews", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "15",
		"EMAIL" => COption::GetOptionString($GLOBALS["moduleName"], "email", ""),
		"EMAIL_SUBJ" => "Новый отзыв",
		"OK_MSG" => "Успешно отправлено",
		"ADD_ACTIVE" => "N",
		"COMPONENT_TEMPLATE" => "reviews"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>