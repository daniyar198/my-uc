<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Iblock;
use Bitrix\Currency;

global $USER_FIELD_MANAGER;

if (!Loader::includeModule('iblock'))
	return;
$catalogIncluded = Loader::includeModule('catalog');
$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$iblockFilter = (
	!empty($arCurrentValues['IBLOCK_TYPE'])
	? array('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
	: array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch())
	$arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
unset($arr, $rsIBlock, $iblockFilter);

$arProperty = array();
$arProperty_N = array();
$arProperty_X = array();
$arProperty_F = array();


if ($iblockExists)
{
	$propertyIterator = Iblock\PropertyTable::getList(array(
		'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE'),
		'filter' => array('=IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], '=ACTIVE' => 'Y'),
		'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
	));
	while ($property = $propertyIterator->fetch())
	{
		$propertyCode = (string)$property['CODE'];
		if ($propertyCode == '')
			$propertyCode = $property['ID'];
		$propertyName = '['.$propertyCode.'] '.$property['NAME'];

		if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
		{
			$arProperty[$propertyCode] = $propertyName;

			if ($property['MULTIPLE'] == 'Y')
				$arProperty_X[$propertyCode] = $propertyName;
			elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_LIST)
				$arProperty_X[$propertyCode] = $propertyName;
			elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_ELEMENT && (int)$property['LINK_IBLOCK_ID'] > 0)
				$arProperty_X[$propertyCode] = $propertyName;
		}
		else
		{
			if ($property['MULTIPLE'] == 'N')
				$arProperty_F[$propertyCode] = $propertyName;
		}

		if ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_NUMBER)
			$arProperty_N[$propertyCode] = $propertyName;
	}
	unset($propertyCode, $propertyName, $property, $propertyIterator);
}
$arProperty_LNS = $arProperty;

$arIBlock_LINK = array();
$iblockFilter = (
	!empty($arCurrentValues['LINK_IBLOCK_TYPE'])
	? array('TYPE' => $arCurrentValues['LINK_IBLOCK_TYPE'], 'ACTIVE' => 'Y')
	: array('ACTIVE' => 'Y')
);
$rsIblock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIblock->Fetch())
	$arIBlock_LINK[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
unset($iblockFilter);

$arProperty_LINK = array();
if (!empty($arCurrentValues['LINK_IBLOCK_ID']) && (int)$arCurrentValues['LINK_IBLOCK_ID'] > 0)
{
	$propertyIterator = Iblock\PropertyTable::getList(array(
		'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE'),
		'filter' => array('=IBLOCK_ID' => $arCurrentValues['LINK_IBLOCK_ID'], '=PROPERTY_TYPE' => Iblock\PropertyTable::TYPE_ELEMENT, '=ACTIVE' => 'Y'),
		'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
	));
	while ($property = $propertyIterator->fetch())
	{
		$propertyCode = (string)$property['CODE'];
		if ($propertyCode == '')
			$propertyCode = $property['ID'];
		$arProperty_LINK[$propertyCode] = '['.$propertyCode.'] '.$property['NAME'];
	}
	unset($propertyCode, $property, $propertyIterator);
}

$arUserFields_S = array("-"=>" ");
$arUserFields_F = array("-"=>" ");
if ($iblockExists)
{
	$arUserFields = $USER_FIELD_MANAGER->GetUserFields('IBLOCK_'.$arCurrentValues['IBLOCK_ID'].'_SECTION', 0, LANGUAGE_ID);
	foreach ($arUserFields as $FIELD_NAME => $arUserField)
	{
		$arUserField['LIST_COLUMN_LABEL'] = (string)$arUserField['LIST_COLUMN_LABEL'];
		$arProperty_UF[$FIELD_NAME] = $arUserField['LIST_COLUMN_LABEL'] ? '['.$FIELD_NAME.']'.$arUserField['LIST_COLUMN_LABEL'] : $FIELD_NAME;
		if ($arUserField["USER_TYPE"]["BASE_TYPE"] == "string")
			$arUserFields_S[$FIELD_NAME] = $arProperty_UF[$FIELD_NAME];
		if ($arUserField["USER_TYPE"]["BASE_TYPE"] == "file" && $arUserField['MULTIPLE'] == 'N')
			$arUserFields_F[$FIELD_NAME] = $arProperty_UF[$FIELD_NAME];
	}
	unset($arUserFields);
}

$offers = false;
$arProperty_Offers = array();
$arProperty_OffersWithoutFile = array();
if ($catalogIncluded && $iblockExists)
{
	$offers = CCatalogSKU::GetInfoByProductIBlock($arCurrentValues['IBLOCK_ID']);
	if (!empty($offers))
	{
		$propertyIterator = Iblock\PropertyTable::getList(array(
			'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE'),
			'filter' => array('=IBLOCK_ID' => $offers['IBLOCK_ID'], '=ACTIVE' => 'Y', '!=ID' => $offers['SKU_PROPERTY_ID']),
			'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
		));
		while ($property = $propertyIterator->fetch())
		{
			$propertyCode = (string)$property['CODE'];
			if ($propertyCode == '')
				$propertyCode = $property['ID'];
			$propertyName = '['.$propertyCode.'] '.$property['NAME'];

			$arProperty_Offers[$propertyCode] = $propertyName;
			if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
				$arProperty_OffersWithoutFile[$propertyCode] = $propertyName;
		}
		unset($propertyCode, $propertyName, $property, $propertyIterator);
	}
}

$arSort = CIBlockParameters::GetElementSortFields(
	array('SHOWS', 'SORT', 'TIMESTAMP_X', 'NAME', 'ID', 'ACTIVE_FROM', 'ACTIVE_TO'),
	array('KEY_LOWERCASE' => 'Y')
);

$arPrice = array();
if ($catalogIncluded)
{
	$arSort = array_merge($arSort, CCatalogIBlockParameters::GetCatalogSortFields());
	$arPrice = CCatalogIBlockParameters::getPriceTypesList();
}
else
{
	$arPrice = $arProperty_N;
}

$arAscDesc = array(
	"asc" => GetMessage("IBLOCK_SORT_ASC"),
	"desc" => GetMessage("IBLOCK_SORT_DESC"),
);

$arComponentParameters = array(
	"GROUPS" => array(
		"FILTER_SETTINGS" => array(
			"NAME" => GetMessage("T_IBLOCK_DESC_FILTER_SETTINGS"),
		),
		"SECTIONS_SETTINGS" => array(
			"NAME" => GetMessage("CP_BC_SECTIONS_SETTINGS"),
		),
		"LIST_SETTINGS" => array(
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_SETTINGS"),
		),
		"LINK" => array(
			"NAME" => GetMessage("IBLOCK_LINK"),
		),
		"UPLOAD_SETTINGS" => array(
			"NAME" => GetMessage("UPLOAD_SETTINGS"),
		),
		"ALSO_BUY_SETTINGS" => array(
			"NAME" => GetMessage("T_IBLOCK_DESC_ALSO_BUY_SETTINGS"),
		),
		"GIFTS_SETTINGS" => array(
			"NAME" => GetMessage("SALE_T_DESC_GIFTS_SETTINGS"),
		),
		"BIG_DATA_SETTINGS" => array(
			"NAME" => GetMessage("CP_BC_GROUP_BIG_DATA_SETTINGS")
		),
		"EXTENDED_SETTINGS" => array(
			"NAME" => GetMessage("IBLOCK_EXTENDED_SETTINGS"),
			"SORT" => 10000
		)
	),
	"PARAMETERS" => array(
		"VARIABLE_ALIASES" => array(
			"ELEMENT_ID" => array(
				"NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_ELEMENT_ID"),
			),
			"SECTION_ID" => array(
				"NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_SECTION_ID"),
			),

		),
		"SEF_MODE" => array(
			"sections" => array(
				"NAME" => GetMessage("SECTIONS_TOP_PAGE"),
				"DEFAULT" => "",
				"VARIABLES" => array(
				),
			),
			"section" => array(
				"NAME" => GetMessage("SECTION_PAGE"),
				"DEFAULT" => "#SECTION_ID#/",
				"VARIABLES" => array(
					"SECTION_ID",
					"SECTION_CODE",
					"SECTION_CODE_PATH",
				),
			),
		    "upload" => array(
				"NAME" => GetMessage("UPLOAD"),
				"DEFAULT" => "upload/",
				"VARIABLES" => array(
					"ELEMENT_ID",
					"ELEMENT_CODE",
					"SECTION_ID",
					"SECTION_CODE",
					"SECTION_CODE_PATH",
				),
			),
		),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"USE_FILTER" => array(
			"PARENT" => "FILTER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_USE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		"SECTION_TOP_DEPTH" => array(
			"PARENT" => "SECTIONS_SETTINGS",
			"NAME" => GetMessage('CP_BC_SECTION_TOP_DEPTH'),
			"TYPE" => "STRING",
			"DEFAULT" => "2",
		),
	   "SECTIONS_HEIGHT_IMAGE" => array(
			"PARENT" => "SECTIONS_SETTINGS",
			"NAME" => GetMessage('SECTIONS_HEIGHT_IMAGE'),
			"TYPE" => "STRING",
			"DEFAULT" => "400",
		),
		
		"PAGE_ELEMENT_COUNT" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_PAGE_ELEMENT_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "30",
		),
	    "SECTION_HEIGHT_IMAGE" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage('SECTIONS_HEIGHT_IMAGE'),
			"TYPE" => "STRING",
			"DEFAULT" => "400",
		),
		"MAX_WIDTH" => array(
			"PARENT" => "UPLOAD_SETTINGS",
			"NAME" => GetMessage("MAX_WIDTH"),
			"TYPE" => "STRING",
			"DEFAULT" => "1000",
		),
		"MAX_HEIGHT" => array(
			"PARENT" => "UPLOAD_SETTINGS",
			"NAME" => GetMessage("MAX_HEIGHT"),
			"TYPE" => "STRING",
			"DEFAULT" => "1000",
		),
		
		
		"ELEMENT_SORT_FIELD" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_FIELD"),
			"TYPE" => "LIST",
			"VALUES" => $arSort,
			"ADDITIONAL_VALUES" => "Y",
			"DEFAULT" => "sort",
		),
		"ELEMENT_SORT_ORDER" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_ORDER"),
			"TYPE" => "LIST",
			"VALUES" => $arAscDesc,
			"DEFAULT" => "asc",
			"ADDITIONAL_VALUES" => "Y",
		),
		"ELEMENT_SORT_FIELD2" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_FIELD2"),
			"TYPE" => "LIST",
			"VALUES" => $arSort,
			"ADDITIONAL_VALUES" => "Y",
			"DEFAULT" => "id",
		),
		"ELEMENT_SORT_ORDER2" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_ORDER2"),
			"TYPE" => "LIST",
			"VALUES" => $arAscDesc,
			"DEFAULT" => "desc",
			"ADDITIONAL_VALUES" => "Y",
		),
		"LIST_PROPERTY_CODE" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arProperty_LNS,
		),
		"INCLUDE_SUBSECTIONS" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CP_BC_INCLUDE_SUBSECTIONS"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"Y" => GetMessage('CP_BC_INCLUDE_SUBSECTIONS_ALL'),
				"A" => GetMessage('CP_BC_INCLUDE_SUBSECTIONS_ACTIVE'),
				"N" => GetMessage('CP_BC_INCLUDE_SUBSECTIONS_NO'),
			),
			"DEFAULT" => "Y",
		),
		"LIST_META_KEYWORDS" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CP_BC_LIST_META_KEYWORDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arUserFields_S,
		),
		"LIST_META_DESCRIPTION" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CP_BC_LIST_META_DESCRIPTION"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arUserFields_S,
		),
		"LIST_BROWSER_TITLE" => array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CP_BC_LIST_BROWSER_TITLE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"DEFAULT" => "-",
			"VALUES" => array_merge(array("-"=>" ", "NAME" => GetMessage("IBLOCK_FIELD_NAME")), $arUserFields_S),
		),
		"SECTION_BACKGROUND_IMAGE" =>array(
			"PARENT" => "LIST_SETTINGS",
			"NAME" => GetMessage("CP_BC_BACKGROUND_IMAGE"),
			"TYPE" => "LIST",
			"DEFAULT" => "-",
			"MULTIPLE" => "N",
			"VALUES" => array_merge(array("-"=>" "), $arUserFields_F)
		),
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BC_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SET_TITLE" => array(),
		"ADD_SECTIONS_CHAIN" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BC_ADD_SECTIONS_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),
		"USE_ALSO_BUY" => array(
			"PARENT" => "ALSO_BUY_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_USE_ALSO_BUY"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),

		"USE_GIFTS_DETAIL" => array(
			"PARENT" => "GIFTS_SETTINGS",
			"NAME" => GetMessage("SALE_T_DESC_USE_GIFTS_DETAIL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
		),

		"USE_GIFTS_SECTION" => array(
			"PARENT" => "GIFTS_SETTINGS",
			"NAME" => GetMessage("SALE_T_DESC_USE_GIFTS_SECTION_LIST"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
		),

		"USE_GIFTS_MAIN_PR_SECTION_LIST" => array(
			"PARENT" => "GIFTS_SETTINGS",
			"NAME" => GetMessage("SALE_T_DESC_USE_GIFTS_MAIN_PR_DETAIL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
		),

	),
);

CIBlockParameters::AddPagerSettings(
	$arComponentParameters,
	GetMessage("T_IBLOCK_DESC_PAGER_CATALOG"), //$pager_title
	true, //$bDescNumbering
	true, //$bShowAllParam
	true, //$bBaseLink
	$arCurrentValues["PAGER_BASE_LINK_ENABLE"]==="Y" //$bBaseLinkEnabled
);

CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);

if($arCurrentValues["SEF_MODE"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["VARIABLE_ALIASES"] = array();
	$arComponentParameters["PARAMETERS"]["VARIABLE_ALIASES"]["ELEMENT_ID"] = array(
		"NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_ELEMENT_ID"),
		"TEMPLATE" => "#ELEMENT_ID#",
	);
	$arComponentParameters["PARAMETERS"]["VARIABLE_ALIASES"]["ELEMENT_CODE"] = array(
		"NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_ELEMENT_CODE"),
		"TEMPLATE" => "#ELEMENT_CODE#",
	);
	$arComponentParameters["PARAMETERS"]["VARIABLE_ALIASES"]["SECTION_ID"] = array(
		"NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_SECTION_ID"),
		"TEMPLATE" => "#SECTION_ID#",
	);
	$arComponentParameters["PARAMETERS"]["VARIABLE_ALIASES"]["SECTION_CODE"] = array(
		"NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_SECTION_CODE"),
		"TEMPLATE" => "#SECTION_CODE#",
	);
	$arComponentParameters["PARAMETERS"]["VARIABLE_ALIASES"]["SECTION_CODE_PATH"] = array(
		"NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_SECTION_CODE_PATH"),
		"TEMPLATE" => "#SECTION_CODE_PATH#",
	);
	$arComponentParameters["PARAMETERS"]["VARIABLE_ALIASES"]["SMART_FILTER_PATH"] = array(
		"NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_SMART_FILTER_PATH"),
		"TEMPLATE" => "#SMART_FILTER_PATH#",
	);

	$smartBase = ($arCurrentValues["SEF_URL_TEMPLATES"]["section"]? $arCurrentValues["SEF_URL_TEMPLATES"]["section"]: "#SECTION_ID#/");
}

if($arCurrentValues["USE_COMPARE"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["COMPARE_NAME"] = array(
		"PARENT" => "COMPARE_SETTINGS",
		"NAME" => GetMessage("IBLOCK_COMPARE_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "CATALOG_COMPARE_LIST"
	);
	$arComponentParameters["PARAMETERS"]["COMPARE_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("IBLOCK_FIELD"), "COMPARE_SETTINGS");
	$arComponentParameters["PARAMETERS"]["COMPARE_PROPERTY_CODE"] = array(
		"PARENT" => "COMPARE_SETTINGS",
		"NAME" => GetMessage("IBLOCK_PROPERTY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "Y",
	);
	if(!empty($offers))
	{
		$arComponentParameters["PARAMETERS"]["COMPARE_OFFERS_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("CP_BC_COMPARE_OFFERS_FIELD_CODE"), "COMPARE_SETTINGS");
		$arComponentParameters["PARAMETERS"]["COMPARE_OFFERS_PROPERTY_CODE"] = array(
			"PARENT" => "COMPARE_SETTINGS",
			"NAME" => GetMessage("CP_BC_COMPARE_OFFERS_PROPERTY_CODE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_OffersWithoutFile,
			"ADDITIONAL_VALUES" => "Y",
		);
	}
	$arComponentParameters["PARAMETERS"]["COMPARE_ELEMENT_SORT_FIELD"] = array(
		"PARENT" => "COMPARE_SETTINGS",
		"NAME" => GetMessage("CP_BC_COMPARE_ELEMENT_SORT_FIELD"),
		"TYPE" => "LIST",
		"VALUES" => $arSort,
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT" => "sort",
	);
	$arComponentParameters["PARAMETERS"]["COMPARE_ELEMENT_SORT_ORDER"] = array(
		"PARENT" => "COMPARE_SETTINGS",
		"NAME" => GetMessage("CP_BC_COMPARE_ELEMENT_SORT_ORDER"),
		"TYPE" => "LIST",
		"VALUES" => $arAscDesc,
		"DEFAULT" => "asc",
		"ADDITIONAL_VALUES" => "Y",
	);
	$arComponentParameters["PARAMETERS"]["DISPLAY_ELEMENT_SELECT_BOX"] = array(
		"PARENT" => "COMPARE_SETTINGS",
		"NAME"=>GetMessage("T_IBLOCK_DESC_ELEMENT_BOX"),
		"TYPE"=>"CHECKBOX",
		"DEFAULT"=>"N",
		"REFRESH"=>"Y",
	);
	if($arCurrentValues["DISPLAY_ELEMENT_SELECT_BOX"]=="Y")
	{
		$arComponentParameters["PARAMETERS"]["ELEMENT_SORT_FIELD_BOX"] = array(
			"PARENT" => "COMPARE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_FIELD_BOX"),
			"TYPE" => "LIST",
			"VALUES" => $arSort,
			"ADDITIONAL_VALUES" => "Y",
			"DEFAULT" => "name",
		);
		$arComponentParameters["PARAMETERS"]["ELEMENT_SORT_ORDER_BOX"] = array(
			"PARENT" => "COMPARE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_ORDER_BOX"),
			"TYPE" => "LIST",
			"VALUES" => $arAscDesc,
			"DEFAULT" => "asc",
			"ADDITIONAL_VALUES" => "Y",
		);
		$arComponentParameters["PARAMETERS"]["ELEMENT_SORT_FIELD_BOX2"] = array(
			"PARENT" => "COMPARE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_FIELD_BOX2"),
			"TYPE" => "LIST",
			"VALUES" => $arSort,
			"ADDITIONAL_VALUES" => "Y",
			"DEFAULT" => "id",
		);
		$arComponentParameters["PARAMETERS"]["ELEMENT_SORT_ORDER_BOX2"] = array(
			"PARENT" => "COMPARE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_SORT_ORDER_BOX2"),
			"TYPE" => "LIST",
			"VALUES" => $arAscDesc,
			"DEFAULT" => "desc",
			"ADDITIONAL_VALUES" => "Y",
		);
	}
}

if (!empty($offers))
{
	$arComponentParameters["PARAMETERS"]["LIST_OFFERS_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("CP_BC_LIST_OFFERS_FIELD_CODE"), "LIST_SETTINGS");
	$arComponentParameters["PARAMETERS"]["LIST_OFFERS_PROPERTY_CODE"] = array(
		"PARENT" => "LIST_SETTINGS",
		"NAME" => GetMessage("CP_BC_LIST_OFFERS_PROPERTY_CODE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_Offers,
		"ADDITIONAL_VALUES" => "Y",
	);
	$arComponentParameters["PARAMETERS"]["LIST_OFFERS_LIMIT"] = array(
		"PARENT" => "LIST_SETTINGS",
		"NAME" => GetMessage("CP_BC_LIST_OFFERS_LIMIT"),
		"TYPE" => "STRING",
		"DEFAULT" => 5,
	);

	$arComponentParameters["PARAMETERS"]["DETAIL_OFFERS_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("CP_BC_DETAIL_OFFERS_FIELD_CODE"), "DETAIL_SETTINGS");
	$arComponentParameters["PARAMETERS"]["DETAIL_OFFERS_PROPERTY_CODE"] = array(
		"PARENT" => "DETAIL_SETTINGS",
		"NAME" => GetMessage("CP_BC_DETAIL_OFFERS_PROPERTY_CODE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_Offers,
		"ADDITIONAL_VALUES" => "Y",
	);
}

if($arCurrentValues["USE_FILTER"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["FILTER_NAME"] = array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_FILTER"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	);
	$arComponentParameters["PARAMETERS"]["FILTER_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("IBLOCK_FIELD"), "FILTER_SETTINGS");
	$arComponentParameters["PARAMETERS"]["FILTER_PROPERTY_CODE"] = array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_PROPERTY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "Y",
	);
	if(!empty($offers))
	{
		$arComponentParameters["PARAMETERS"]["FILTER_OFFERS_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("CP_BC_FILTER_OFFERS_FIELD_CODE"), "FILTER_SETTINGS");
		$arComponentParameters["PARAMETERS"]["FILTER_OFFERS_PROPERTY_CODE"] = array(
			"PARENT" => "FILTER_SETTINGS",
			"NAME" => GetMessage("CP_BC_FILTER_OFFERS_PROPERTY_CODE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_OffersWithoutFile,
			"ADDITIONAL_VALUES" => "Y",
		);
	}
}



if ($catalogIncluded && $arCurrentValues["USE_STORE"]=='Y')
{
	$storeIterator = CCatalogStore::GetList(
		array(),
		array('SHIPPING_CENTER' => 'Y'),
		false,
		false,
		array('ID', 'TITLE')
	);
	while ($store = $storeIterator->GetNext())
		$arStore[$store['ID']] = "[".$store['ID']."] ".$store['TITLE'];

	$userFields = $USER_FIELD_MANAGER->GetUserFields("CAT_STORE", 0, LANGUAGE_ID);
	$propertyUF = array();

	foreach($userFields as $fieldName => $userField)
		$propertyUF[$fieldName] = $userField["LIST_COLUMN_LABEL"] ? $userField["LIST_COLUMN_LABEL"] : $fieldName;

	$arComponentParameters["PARAMETERS"]['STORES'] = array(
		'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('STORES'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $arStore
	);
	$arComponentParameters["PARAMETERS"]['USE_MIN_AMOUNT'] = array(
		'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('USE_MIN_AMOUNT'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		"REFRESH" => "Y",
	);
	$arComponentParameters["PARAMETERS"]['USER_FIELDS'] = array(
			"PARENT" => "STORE_SETTINGS",
			"NAME" => GetMessage("STORE_USER_FIELDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $propertyUF,
		);
	$arComponentParameters["PARAMETERS"]['FIELDS'] = array(
		'NAME' => GetMessage("STORE_FIELDS"),
		'PARENT' => 'STORE_SETTINGS',
		'TYPE'  => 'LIST',
		'MULTIPLE' => 'Y',
		'ADDITIONAL_VALUES' => 'Y',
		'VALUES'    => Array(
			'TITLE'  => GetMessage("STORE_TITLE"),
			'ADDRESS'  => GetMessage("ADDRESS"),
			'DESCRIPTION'  => GetMessage('DESCRIPTION'),
			'PHONE'  => GetMessage('PHONE'),
			'SCHEDULE'  => GetMessage('SCHEDULE'),
			'EMAIL'  => GetMessage('EMAIL'),
			'IMAGE_ID'  => GetMessage('IMAGE_ID'),
			'COORDINATES'  => GetMessage('COORDINATES'),
		)
	);
	if ($arCurrentValues['USE_MIN_AMOUNT']!="N")
	{
		$arComponentParameters["PARAMETERS"]["MIN_AMOUNT"] = array(
				"PARENT" => "STORE_SETTINGS",
				"NAME"		=> GetMessage("MIN_AMOUNT"),
				"TYPE"		=> "STRING",
				"DEFAULT"	=> 10,
			);
	}
	$arComponentParameters["PARAMETERS"]['SHOW_EMPTY_STORE'] = array(
		'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('SHOW_EMPTY_STORE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	);
	$arComponentParameters["PARAMETERS"]['SHOW_GENERAL_STORE_INFORMATION'] = array(
		'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('SHOW_GENERAL_STORE_INFORMATION'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	);
	$arComponentParameters["PARAMETERS"]['STORE_PATH'] = array(
		'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('STORE_PATH'),
		"TYPE"		=> "STRING",
		"DEFAULT"	=> "/store/#store_id#",
	);
	$arComponentParameters["PARAMETERS"]['MAIN_TITLE'] = array(
		'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('MAIN_TITLE'),
		"TYPE"		=> "STRING",
		"DEFAULT"	=> GetMessage('MAIN_TITLE_VALUE'),
	);
}

if(!ModuleManager::isModuleInstalled("sale"))
{
	unset($arComponentParameters["PARAMETERS"]["USE_ALSO_BUY"]);
	unset($arComponentParameters["GROUPS"]["ALSO_BUY_SETTINGS"]);

	unset($arComponentParameters["PARAMETERS"]["USE_GIFTS_DETAIL"]);
	unset($arComponentParameters["PARAMETERS"]["USE_GIFTS_SECTION"]);
	unset($arComponentParameters["PARAMETERS"]["USE_GIFTS_MAIN_PR_SECTION_LIST"]);
	unset($arComponentParameters["GROUPS"]["GIFTS_SETTINGS"]);
}
else
{
	if($arCurrentValues["USE_ALSO_BUY"] == "Y")
	{
		$arComponentParameters["PARAMETERS"]["ALSO_BUY_ELEMENT_COUNT"] = array(
				"PARENT" => "ALSO_BUY_SETTINGS",
				"NAME"		=> GetMessage("T_IBLOCK_DESC_ALSO_BUY_ELEMENT_COUNT"),
				"TYPE"		=> "STRING",
				"DEFAULT"	=> 5
			);
		$arComponentParameters["PARAMETERS"]["ALSO_BUY_MIN_BUYES"] = array(
				"PARENT" => "ALSO_BUY_SETTINGS",
				"NAME"		=> GetMessage("T_IBLOCK_DESC_ALSO_BUY_MIN_BUYES"),
				"TYPE"		=> "STRING",
				"DEFAULT"	=> 1
			);
	}

	$useGiftsDetail = $arCurrentValues["USE_GIFTS_DETAIL"] === null && $arComponentParameters['PARAMETERS']['USE_GIFTS_DETAIL']['DEFAULT'] == 'Y' || $arCurrentValues["USE_GIFTS_DETAIL"] == "Y";
$useGiftsSection = $arCurrentValues["USE_GIFTS_SECTION"] === null && $arComponentParameters['PARAMETERS']['USE_GIFTS_SECTION']['DEFAULT'] == 'Y' || $arCurrentValues["USE_GIFTS_SECTION"] == "Y";
$useGiftsMainPrSectionList = $arCurrentValues["USE_GIFTS_MAIN_PR_SECTION_LIST"] === null && $arComponentParameters['PARAMETERS']['USE_GIFTS_MAIN_PR_SECTION_LIST']['DEFAULT'] == 'Y' || $arCurrentValues["USE_GIFTS_MAIN_PR_SECTION_LIST"] == "Y";
	if($useGiftsDetail || $useGiftsSection || $useGiftsMainPrSectionList)
	{
		if($useGiftsDetail)
		{
			$arComponentParameters["PARAMETERS"]["GIFTS_DETAIL_PAGE_ELEMENT_COUNT"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PAGE_ELEMENT_COUNT_DETAIL"),
				"TYPE" => "STRING",
				"DEFAULT" => "3",
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_DETAIL_HIDE_BLOCK_TITLE"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PARAMS_HIDE_BLOCK_TITLE_DETAIL"),
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "",
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_DETAIL_BLOCK_TITLE"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PARAMS_BLOCK_TITLE_DETAIL"),
				"TYPE" => "STRING",
				"DEFAULT" => GetMessage("SGB_PARAMS_BLOCK_TITLE_DETAIL_DEFAULT"),
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_DETAIL_TEXT_LABEL_GIFT"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PARAMS_TEXT_LABEL_GIFT_DETAIL"),
				"TYPE" => "STRING",
				"DEFAULT" => GetMessage("SGP_PARAMS_TEXT_LABEL_GIFT_DEFAULT"),
			);
		}
		if($useGiftsSection)
		{
			$arComponentParameters["PARAMETERS"]["GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PAGE_ELEMENT_COUNT_SECTION_LIST"),
				"TYPE" => "STRING",
				"DEFAULT" => "3",
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PARAMS_HIDE_BLOCK_TITLE_SECTION_LIST"),
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "",
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_SECTION_LIST_BLOCK_TITLE"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PARAMS_BLOCK_TITLE_SECTION_LIST"),
				"TYPE" => "STRING",
				"DEFAULT" => GetMessage("SGB_PARAMS_BLOCK_TITLE_SECTION_LIST_DEFAULT"),
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_SECTION_LIST_TEXT_LABEL_GIFT"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PARAMS_TEXT_LABEL_GIFT_SECTION_LIST"),
				"TYPE" => "STRING",
				"DEFAULT" => GetMessage("SGP_PARAMS_TEXT_LABEL_GIFT_DEFAULT"),
			);
		}

		if($useGiftsDetail || $useGiftsSection)
		{
			$arComponentParameters["PARAMETERS"]["GIFTS_SHOW_DISCOUNT_PERCENT"] = array(
				'PARENT' => 'GIFTS_SETTINGS',
				'NAME' => GetMessage('CVP_SHOW_DISCOUNT_PERCENT'),
				'TYPE' => 'CHECKBOX',
				'DEFAULT' => 'Y'
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_SHOW_OLD_PRICE"] = array(
				'PARENT' => 'GIFTS_SETTINGS',
				'NAME' => GetMessage('CVP_SHOW_OLD_PRICE'),
				'TYPE' => 'CHECKBOX',
				'DEFAULT' => 'Y'
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_SHOW_NAME"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("CVP_SHOW_NAME"),
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "Y",
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_SHOW_IMAGE"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("CVP_SHOW_IMAGE"),
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "Y",
			);
			$arComponentParameters["PARAMETERS"]['GIFTS_MESS_BTN_BUY'] = array(
				'PARENT' => 'GIFTS_SETTINGS',
				'NAME' => GetMessage('CVP_MESS_BTN_BUY_GIFT'),
				'TYPE' => 'STRING',
				'DEFAULT' => GetMessage('CVP_MESS_BTN_BUY_GIFT_DEFAULT')
			);
		}
		if($useGiftsMainPrSectionList)
		{
			$arComponentParameters["PARAMETERS"]["GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PAGE_ELEMENT_COUNT_MAIN_PR_DETAIL"),
				"TYPE" => "STRING",
				"DEFAULT" => "3",
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_PARAMS_HIDE_BLOCK_TITLE_MAIN_PR_DETAIL"),
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "",
			);
			$arComponentParameters["PARAMETERS"]["GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE"] = array(
				"PARENT" => "GIFTS_SETTINGS",
				"NAME" => GetMessage("SGP_MAIN_PRODUCT_PARAMS_BLOCK_TITLE"),
				"TYPE" => "STRING",
				"DEFAULT" => GetMessage('SGB_MAIN_PRODUCT_PARAMS_BLOCK_TITLE_DEFAULT'),
			);
		}
	}
}


