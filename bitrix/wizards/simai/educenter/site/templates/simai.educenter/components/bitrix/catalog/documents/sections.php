<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"map.section", 
	array(
		"IBLOCK_TYPE" => "organization",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arParams["SECTION_ID"],
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => "N",
		"COMPONENT_TEMPLATE" => "map.section",
		"SECTION_CODE" => $arParams["SECTION_CODE"],
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "2",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_URL" => ""
	),
	false
);?>
<div class="mt-30"></div>

<?$APPLICATION->IncludeComponent("bitrix:news.detail", "sveden", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
		"ADD_ELEMENT_CHAIN" => "N",	// �������� �������� �������� � ������� ���������
		"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
		"AJAX_MODE" => "N",	// �������� ����� AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
		"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
		"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
		"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
		"BROWSER_TITLE" => "-",	// ���������� ��������� ���� �������� �� ��������
		"CACHE_GROUPS" => "Y",	// ��������� ����� �������
		"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
		"CACHE_TYPE" => "A",	// ��� �����������
		"CHECK_DATES" => "N",	// ���������� ������ �������� �� ������ ������ ��������
		"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
		"DISPLAY_DATE" => "Y",	// �������� ���� ��������
		"DISPLAY_NAME" => "N",	// �������� �������� ��������
		"DISPLAY_PICTURE" => "N",	// �������� ��������� �����������
		"DISPLAY_PREVIEW_TEXT" => "N",	// �������� ����� ������
		"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
		"ELEMENT_CODE" => "document",	// ��� �������
		"ELEMENT_ID" => "",	// ID �������
		"FIELD_CODE" => array(	// ����
			0 => "",
			1 => "",
		),
		"IBLOCK_ID" => $arParams["IBLOCK_ID_SVEDEN"],	// ��� ��������������� �����
		"IBLOCK_TYPE" => "content",	// ��� ��������������� ����� (������������ ������ ��� ��������)
		"IBLOCK_URL" => "",	// URL �������� ��������� ������ ��������� (�� ��������� - �� �������� ���������)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
		"MESSAGE_404" => "",	// ��������� ��� ������ (�� ��������� �� ����������)
		"META_DESCRIPTION" => "-",	// ���������� �������� �������� �� ��������
		"META_KEYWORDS" => "-",	// ���������� �������� ����� �������� �� ��������
		"PAGER_BASE_LINK_ENABLE" => "N",	// �������� ��������� ������
		"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
		"PAGER_TEMPLATE" => ".default",	// ������ ������������ ���������
		"PAGER_TITLE" => "",	// �������� ���������
		"PROPERTY_CODE" => array(	// ��������
			0 => "COMPLEX",
			1 => "DOCS",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// ������������� ��������� ���� ��������
		"SET_CANONICAL_URL" => "N",	// ������������� ������������ URL
		"SET_LAST_MODIFIED" => "N",	// ������������� � ���������� ������ ����� ����������� ��������
		"SET_META_DESCRIPTION" => "Y",	// ������������� �������� ��������
		"SET_META_KEYWORDS" => "N",	// ������������� �������� ����� ��������
		"SET_STATUS_404" => "N",	// ������������� ������ 404
		"SET_TITLE" => "N",	// ������������� ��������� ��������
		"SHOW_404" => "N",	// ����� ����������� ��������
		"STRICT_SECTION_CHECK" => "N",	// ������� �������� ������� ��� ������ ��������
		"USE_PERMISSIONS" => "N",	// ������������ �������������� ����������� �������
		"USE_SHARE" => "N",	// ���������� ������ ���. ��������
	),
	false
);?>