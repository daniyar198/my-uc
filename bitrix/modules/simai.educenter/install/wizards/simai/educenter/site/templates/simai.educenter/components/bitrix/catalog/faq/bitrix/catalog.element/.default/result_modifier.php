<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$rsUser = CUser::GetByID($arResult["CREATED_BY"]);
$arUser = $rsUser->Fetch();
$arResult["AUTHOR"]["NAME"]=($arUser["NAME"]?$arUser["NAME"].($arUser["LAST_NAME"]?" ".$arUser["LAST_NAME"]:""):"");
$arResult["AUTHOR"]["LOGIN"]=$USER->GetLogin();
if(intVal($arUser["PERSONAL_PHOTO"]))
{
    $arFileTmp = CFile::ResizeImageGet(
        intVal($arUser["PERSONAL_PHOTO"]),
        array("width" => 75, "height" => 75),
        BX_RESIZE_IMAGE_EXACT,
        false
    );
    $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
    $arResult["AUTHOR"]["AVATAR"]= array(
        "SRC" => $arFileTmp["src"],
        "WIDTH" => IntVal($arSize[0]),
        "HEIGHT" => IntVal($arSize[1])
    );
}
$arResult["CATEGORY"]=array();
$db_old_groups = CIBlockElement::GetElementGroups($arResult["ID"], true);
while($ar_group = $db_old_groups->Fetch()){
    $ar_new_groups[] = $ar_group["ID"];
}
if(!empty($ar_new_groups)){
    $ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ID"=>$ar_new_groups),false, Array("ID","NAME","SECTION_PAGE_URL"));
    while($res=$ar_result->GetNext()){$arResult["CATEGORY"][]=$res;}

}
$res = CIBlockElement::GetList(array($arParams["ELEMENT_SORT_FIELD"] => $arParams["ELEMENT_SORT_ORDER"],$arParams["ELEMENT_SORT_FIELD2"] => $arParams["ELEMENT_SORT_ORDER2"]), array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'ACTIVE' => 'Y','SECTION_GLOBAL_ACTIVE' => 'Y'),false, array('nPageSize' => 1, 'nElementID' => $arResult["ID"]), array('ID', 'DETAIL_PAGE_URL'));
while($ar_Fields = $res->GetNextElement())
{
    $arItem = $ar_Fields->GetFields();
    $arResult["NAVIGATION"][]=$arItem;
}
if(is_array($arResult["DISPLAY_PROPERTIES"]["RESPONDENT"]))
{
    $respondent=$arResult["DISPLAY_PROPERTIES"]["RESPONDENT"]["LINK_ELEMENT_VALUE"][$arResult["DISPLAY_PROPERTIES"]["RESPONDENT"]["VALUE"]];
    if($respondent["PREVIEW_PICTURE"])
    {
        $arFileTmp = CFile::ResizeImageGet(
            $respondent["PREVIEW_PICTURE"],
            array("width" => 75, "height" => 75),
            BX_RESIZE_IMAGE_EXACT,
            false
        );
        $arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
        $arResult["RESPONDENT_IMG"]= array(
            "SRC" => $arFileTmp["src"],
            "WIDTH" => IntVal($arSize[0]),
            "HEIGHT" => IntVal($arSize[1]),
        );
    }
    $arResult["RESPONDENT"]=$respondent["NAME"];
    $arResult["RESPONDENT_DETAIL_PAGE_URL"]=$respondent["DETAIL_PAGE_URL"];
    $VALUES = array();
    $res = CIBlockElement::GetProperty($respondent["IBLOCK_ID"], $respondent["ID"], array("sort"=>"asc"), array("CODE" => "POSITION"));
    if($ob = $res->GetNext())
    {
        $arResult["RESPONDENT_POSITION"] = $ob['VALUE'];
    }
}