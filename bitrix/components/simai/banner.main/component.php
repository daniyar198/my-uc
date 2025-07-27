<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @global CIntranetToolbar $INTRANET_TOOLBAR */

use Bitrix\Main\Context;
use Bitrix\Main\Type\DateTime;



CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

if(!isset($arParams["SF_BANNER_DELAY"]))
	$arParams["SF_BANNER_DELAY"] = 1500;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if(strlen($arParams["IBLOCK_TYPE"])<=0)
	$arParams["IBLOCK_TYPE"] = "news";
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);

$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
if(strlen($arParams["SORT_BY1"])<=0)
	$arParams["SORT_BY1"] = "ACTIVE_FROM";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER1"]))
	$arParams["SORT_ORDER1"]="DESC";

if(strlen($arParams["SORT_BY2"])<=0)
	$arParams["SORT_BY2"] = "SORT";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER2"]))
	$arParams["SORT_ORDER2"]="ASC";

if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}


if(!is_array($arParams["FIELD_CODE"]))
	$arParams["FIELD_CODE"] = array();
foreach($arParams["FIELD_CODE"] as $key=>$val)
	if(!$val)
		unset($arParams["FIELD_CODE"][$key]);


$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);

$arParams["NEWS_COUNT"] = intval($arParams["NEWS_COUNT"]);
if($arParams["NEWS_COUNT"]<=0)
	$arParams["NEWS_COUNT"] = 20;

$arParams["CACHE_FILTER"] = $arParams["CACHE_FILTER"]=="Y";
if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
	$arParams["CACHE_TIME"] = 0;



if($this->StartResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $bUSER_HAVE_ACCESS, $arNavigation, $arrFilter, $pagerParameters)))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("SF_IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	if(is_numeric($arParams["IBLOCK_ID"]))
	{
		$rsIBlock = CIBlock::GetList(array(), array(
			"ACTIVE" => "Y",
			"ID" => $arParams["IBLOCK_ID"],
		));
	}
	else
	{
		$rsIBlock = CIBlock::GetList(array(), array(
			"ACTIVE" => "Y",
			"CODE" => $arParams["IBLOCK_ID"],
			"SITE_ID" => SITE_ID,
		));
	}
	if($arResult = $rsIBlock->GetNext())
	{
		$arResult["USER_HAVE_ACCESS"] = $bUSER_HAVE_ACCESS;
		//SELECT
		$arSelect = array_merge($arParams["FIELD_CODE"], array(
			"ID",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"ACTIVE_FROM",
			"TIMESTAMP_X",
			"DETAIL_PAGE_URL",
			"LIST_PAGE_URL",
			"DETAIL_TEXT",
			"DETAIL_TEXT_TYPE",
			"PREVIEW_TEXT",
			"PREVIEW_TEXT_TYPE",
			"PREVIEW_PICTURE",
			"PROPERTY_*",
		));

		$arSelect[]="PROPERTY_*";
		//WHERE
		$arFilter = array (
			"IBLOCK_ID" => $arResult["ID"],
			"IBLOCK_LID" => SITE_ID,
			"ACTIVE" => "Y",
		);
		$arFilter["ACTIVE_DATE"] = "Y";
		$arSort = array(
			$arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
			$arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"],
		);
		if(!array_key_exists("ID", $arSort))
			$arSort["ID"] = "DESC";

		$obParser = new CTextParser;
		$arResult["ITEMS"] = array();
		$rsElement = CIBlockElement::GetList($arSort, array_merge($arFilter, $arrFilter), false, false, $arSelect);
		while($obElement = $rsElement->GetNextElement())
		{
			$arItem = $obElement->GetFields();

			$arButtons = CIBlock::GetPanelButtons(
				$arItem["IBLOCK_ID"],
				$arItem["ID"],
				0,
				array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
			$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];


			if(strlen($arItem["ACTIVE_FROM"])>0)
				$arItem["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["ACTIVE_FROM"], CSite::GetDateFormat()));
			else
				$arItem["DISPLAY_ACTIVE_FROM"] = "";

			$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arItem["IBLOCK_ID"], $arItem["ID"]);
			$arItem["IPROPERTY_VALUES"] = $ipropValues->getValues();

			if(isset($arItem["PREVIEW_PICTURE"]))
			{
				$arItem["PREVIEW_PICTURE"] = (0 < $arItem["PREVIEW_PICTURE"] ? CFile::GetFileArray($arItem["PREVIEW_PICTURE"]) : false);
				if ($arItem["PREVIEW_PICTURE"])
				{
					$arItem["PREVIEW_PICTURE"]["ALT"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"];
					if ($arItem["PREVIEW_PICTURE"]["ALT"] == "")
						$arItem["PREVIEW_PICTURE"]["ALT"] = $arItem["NAME"];
					$arItem["PREVIEW_PICTURE"]["TITLE"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"];
					if ($arItem["PREVIEW_PICTURE"]["TITLE"] == "")
						$arItem["PREVIEW_PICTURE"]["TITLE"] = $arItem["NAME"];
				}
			}
			if(isset($arItem["DETAIL_PICTURE"]))
			{
				$arItem["DETAIL_PICTURE"] = (0 < $arItem["DETAIL_PICTURE"] ? CFile::GetFileArray($arItem["DETAIL_PICTURE"]) : false);
				if ($arItem["DETAIL_PICTURE"])
				{
					$arItem["DETAIL_PICTURE"]["ALT"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"];
					if ($arItem["DETAIL_PICTURE"]["ALT"] == "")
						$arItem["DETAIL_PICTURE"]["ALT"] = $arItem["NAME"];
					$arItem["DETAIL_PICTURE"]["TITLE"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"];
					if ($arItem["DETAIL_PICTURE"]["TITLE"] == "")
						$arItem["DETAIL_PICTURE"]["TITLE"] = $arItem["NAME"];
				}
			}

			$arItem["FIELDS"] = array();
			foreach($arParams["FIELD_CODE"] as $code)
				if(array_key_exists($code, $arItem))
					$arItem["FIELDS"][$code] = $arItem[$code];

				$arItem["PROPERTIES"] = $obElement->GetProperties();

			
			$tmp=array();
			foreach($arItem["PROPERTIES"] as $pid => $val)
			{
				$prop = &$arItem["PROPERTIES"][$pid];
				if((is_array($prop["VALUE"]) && count($prop["VALUE"])>0)|| (!is_array($prop["VALUE"]) && strlen($prop["VALUE"])>0))
				{
					$tmp[$pid] = CIBlockFormatProperties::GetDisplayValue($arItem, $prop, "news_out");
					//crop banner
					if($pid=="BANNER_IMAGE" && $arParams["SF_BANNER_RESTRICT"]=="Y" )
					{
						
					 $arFileTmp = CFile::ResizeImageGet(
						$tmp["BANNER_IMAGE"]["FILE_VALUE"],
						array("width" => $arParams["SF_BANNER_WIDTH"], "height" => 3000),
						BX_RESIZE_IMAGE_PROPORTIONAL,
						true
					);
					$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
					$tmp["BANNER_IMAGE"]["FILE_VALUE"] = array(
						"SRC" => $arFileTmp["src"],
						"WIDTH" => IntVal($arSize[0]),
						"HEIGHT" => IntVal($arSize[1]),
						"DESCRIPTION" => $tmp["BANNER_IMAGE"]["FILE_VALUE"]["DESCRIPTION"],
						"OLD_LINK" => $tmp["BANNER_IMAGE"]["FILE_VALUE"]["SRC"]
					);
						
					}
					//crop image
					if($pid=="IMAGE" && $arParams["SF_BANNER_RESTRICT"]=="Y" )
					{
						
					 $arFileTmp = CFile::ResizeImageGet(
						$tmp["IMAGE"]["FILE_VALUE"],
						array("width" => 3000, "height" => $arParams["SF_BANNER_HEIGHT"]),
						BX_RESIZE_IMAGE_PROPORTIONAL,
						true
					);
					$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
					$tmp["IMAGE"]["FILE_VALUE"] = array(
						"SRC" => $arFileTmp["src"],
						"WIDTH" => IntVal($arSize[0]),
						"HEIGHT" => IntVal($arSize[1]),
						"DESCRIPTION" => $tmp["IMAGE"]["FILE_VALUE"]["DESCRIPTION"],
						"OLD_LINK" => $tmp["IMAGE"]["FILE_VALUE"]["SRC"]
					);
						
					}
				}
			}
            $arItem["PROPERTIES"]=$tmp;
			$arResult["ITEMS"][]=$arItem;
		}
		$this->SetResultCacheKeys(array(
			"ID",
			"IBLOCK_TYPE_ID",
			"LIST_PAGE_URL",
			"NAME",
			"SECTION",
			"ITEMS",
			"IPROPERTY_VALUES",
			"ITEMS_TIMESTAMP_X",
		));
		$this->IncludeComponentTemplate();
	}
	else
	{
		$this->AbortResultCache();
	}
}
