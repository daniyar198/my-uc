<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
$GLOBALS["moduleName"]=substr(SITE_TEMPLATE_PATH,strrpos(SITE_TEMPLATE_PATH,"/")+1);
if (CModule::IncludeModuleEx($GLOBALS["moduleName"])!=3)
{
	SIMAITemplate::SetColumn($APPLICATION->GetProperty("show_left_column"),$APPLICATION->GetProperty("show_right_column"),$APPLICATION->GetProperty("dont_show_navbar"));
	SIMAITemplate::GetStyle();
}else if(file_exists(__DIR__."/framework/include/include.php"))unlink(__DIR__."/framework/include/include.php");
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?include_once "framework/include.php";?>
	<?$APPLICATION->ShowHead();?>
    <?CJSCore::Init(array("ajax"));?>
	<title><?$APPLICATION->ShowTitle();?></title>
	<link rel="icon" href="/favicon.ico" type="image/ico">
</head>

<body 
	<?=$GLOBALS["style_template"]?> 
	<?if(isset($GLOBALS["styleBackground"])):?> 
	<?=$GLOBALS["styleBackground"]?><?endif;?>
	>
<?$APPLICATION->ShowPanel();?>


<?=COption::GetOptionString($GLOBALS["moduleName"], "top", "");?>

<div class="body-wrap <?=$GLOBALS["body_width"]?>">

<?$APPLICATION->IncludeComponent("simai:template.special",$GLOBALS["moduleName"],
Array(
        "COMPONENT_TEMPLATE" => $GLOBALS["moduleName"],
        "COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "STATIC"));?>	
<?$APPLICATION->IncludeComponent(
	"simai:template.header", 
	$GLOBALS["moduleName"], 
	array(
		"COMPONENT_TEMPLATE" => $GLOBALS["moduleName"],
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "STATIC"
	),
	false
);?>
<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "sect","AREA_FILE_SUFFIX" => "top_inc","AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html","EDIT_TEMPLATE" => "sect_top_inc.php"));?>
<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "page","AREA_FILE_SUFFIX" => "top_inc","AREA_FILE_RECURSIVE" => "N","EDIT_MODE" => "html","EDIT_TEMPLATE" => "page_top_inc.php"));?>  

<section class="slice bb<?if($APPLICATION->GetCurDir(false) == SITE_DIR):?> p-0<?endif?>">
<div class="wp-section">
<div class="<?if(!CSite::InDir(SITE_DIR . "index.php")) echo 'container '?>content"> <!-- container -->
<?
function componentHeader()
{
	global $APPLICATION;
	$show_left_column = ($APPLICATION->GetProperty("show_left_column") == "Y" ? true : false);
	$show_right_column = ($APPLICATION->GetProperty("show_right_column") == "Y" ? true : false);

	$show_title = ($APPLICATION->GetProperty("show_title")== "Y" ? true : false);
	$right_column_width = COption::GetOptionString($GLOBALS["moduleName"], "right_column", "4");
	$left_column_width  = COption::GetOptionString($GLOBALS["moduleName"], "left_column", "4");
	$main_column_width = 12;
    if($show_left_column) 
	    $main_column_width = $main_column_width - $left_column_width;
    if($show_right_column) 
	    $main_column_width = $main_column_width - $right_column_width;
		ob_start();
?>
<?if($show_left_column || $show_right_column):?>
	<div class="row">

<?endif;?>

<?if($show_left_column):?>
	<div class="col-md-<?=$left_column_width?> left-column">
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "page","AREA_FILE_SUFFIX" => "left_inc","AREA_FILE_RECURSIVE" => "N","EDIT_MODE" => "html","EDIT_TEMPLATE" => "page_left_inc.php"));?> 
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "sect","AREA_FILE_SUFFIX" => "left_inc","AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html","EDIT_TEMPLATE" => "sect_left_inc.php"));?>
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "page","AREA_FILE_SUFFIX" => "inc","AREA_FILE_RECURSIVE" => "N","EDIT_MODE" => "html","EDIT_TEMPLATE" => "page_inc.php"));?>
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "sect","AREA_FILE_SUFFIX" => "inc","AREA_FILE_RECURSIVE" => "Y","EDIT_TEMPLATE" => "sect_inc.php"),false);?>
	</div>
<?endif;?>

<?if($show_left_column || $show_right_column):?>
	<div class="col-md-<?=$main_column_width?>">
<?endif;?>

<?if($APPLICATION->GetCurDir(false) != SITE_DIR && $show_title):?>
	<h1><?=$APPLICATION->GetTitle(false);?></h1>
<?endif?>
<?		$contentTime = ob_get_contents();
		ob_end_clean();
		return $contentTime;
}?>
<?$APPLICATION->AddBufferContent("componentHeader");?>

