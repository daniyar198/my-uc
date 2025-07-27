<?
if (check_bitrix_sessid() && $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_REQUEST["error_message"]) && !empty($_REQUEST["error_url"]))
{
    $arMailFields = Array();
    $arMailFields["ERROR_MESSAGE"] = trim ($_REQUEST["error_message"]);
    $arMailFields["ERROR_DESCRIPTION"] = trim ($_REQUEST["error_desc"]);
    $arMailFields["ERROR_URL"] = $_REQUEST["error_url"];
    $arMailFields["ERROR_REFERER"] = $_REQUEST["error_referer"];
    $arMailFields["ERROR_USERAGENT"] = $_REQUEST["error_useragent"];

    CEvent::Send("SIMAI_ERROR", SITE_ID, $arMailFields);
	

	$el = new CIBlockElement;
	$PROP = array();
	$PROP["URL"] = $_REQUEST["error_url"]; 
    $arLoadErrorArray = Array(
	  "MODIFIED_BY"    => $USER->GetID(), 
	  "IBLOCK_SECTION_ID" => false,         
	  "IBLOCK_ID"      => $arParams["IBLOCK_ID"],
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => trim($_REQUEST["error_message"]),
	  "ACTIVE"         => "Y",          
	  "PREVIEW_TEXT"   => trim($_REQUEST["error_desc"]),
    );
  $el->Add($arLoadErrorArray);     
}
$this->IncludeComponentTemplate();
?>