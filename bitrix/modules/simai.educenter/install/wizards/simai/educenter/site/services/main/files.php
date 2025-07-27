<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if (!defined("WIZARD_SITE_ID"))
	return;
if (!defined("WIZARD_SITE_DIR"))
	return;

$wizard =& $this->GetWizard();


CopyDirFiles(
	WIZARD_ABSOLUTE_PATH."/site/".WIZARD_TEMPLATE_ID,
	$_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".WIZARD_TEMPLATE_ID,
	$rewrite = true,
	$recursive = true,
	$delete_after_copy = false
);

if ($wizard->GetVar("siteInstallPublic") == "Y")
{
	CopyDirFiles(
		WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID,
		WIZARD_SITE_PATH,
		$rewrite = true,
		$recursive = true,
		$delete_after_copy = false
	);
	
	$arUrlRewrite = Array();
	if (is_file(WIZARD_SITE_ROOT_PATH."/urlrewrite.php"))
		include(WIZARD_SITE_ROOT_PATH."/urlrewrite.php");
	
	$arNewUrlRewrite = Array();
	if (is_file(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/urlrewrite_array.php"))
		include(WIZARD_SITE_ROOT_PATH.WIZARD_SERVICE_RELATIVE_PATH."/data/urlrewrite_array.php");
	
	foreach ($arNewUrlRewrite as $arUrl)
	{
		if (!in_Array($arUrl, $arUrlRewrite))
			CUrlRewriter::Add($arUrl);
	}
}
?>