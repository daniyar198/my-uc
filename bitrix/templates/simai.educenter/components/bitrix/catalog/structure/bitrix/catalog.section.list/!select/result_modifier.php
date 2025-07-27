<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$ib = IntVal(max($arResult["SECTION"]["IBLOCK_ID"],$arResult["SECTIONS"][0]["IBLOCK_ID"]));
if ($arParams["CURRENT_SECTION"])
{
    if(is_numeric($arParams["CURRENT_SECTION"]))$res = $DB->Query("SELECT `ID` FROM `b_iblock_section` WHERE `ID`=".IntVal($arParams["CURRENT_SECTION"])." AND `IBLOCK_ID`=".$ib);
    else $res = $DB->Query("SELECT `ID` FROM `b_iblock_section` WHERE `CODE`='".trim($arParams["CURRENT_SECTION"])."' AND `IBLOCK_ID`=".$ib);
	if ($arr = $res->GetNext()) $arResult["SECTION_ID"] = $arr["ID"];
}

$arResult["chain_sections"] = Array();
if ($arResult["SECTION_ID"] > 0)
{
	$nav = CIBlockSection::GetNavChain(false, $arResult["SECTION_ID"]);
	while($arr = $nav->GetNext())
	{
		$arResult["chain_sections"][] = $arr["ID"];
	}
}
?>