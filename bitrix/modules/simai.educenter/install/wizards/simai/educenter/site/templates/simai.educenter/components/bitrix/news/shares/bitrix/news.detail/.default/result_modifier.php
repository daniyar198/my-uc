<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


if($arParams["FILTER_NAME"]!="")
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];


$arFilter =array('IBLOCK_ID' => $arParams["IBLOCK_ID"],'ACTIVE' => 'Y');
if(isset($arrFilter))
	$arFilter= array_merge($arrFilter, $arFilter);

$res = CIBlockElement::GetList(array('ACTIVE_FROM' => 'DESC','SORT' => 'ASC'),
                                $arFilter,
							   false, 
							   array('nPageSize' => 1, 'nElementID' => $arResult["ID"]), 
							   array('ID',"CODE", 'NAME'));
							   
while($ar_Fields = $res->GetNextElement())
{
    $arItem = $ar_Fields->GetFields();

	$arItem['DETAIL_PAGE_URL'] = $arParams["SEF_FOLDER"].$arItem["CODE"]."/";
    $arResult["NAVIGATION"][]=$arItem;
}

