<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
require_once __DIR__."/lang/ru/template.php";
//delayed function must return a string

if(empty($arResult))
	return "";

$strReturn = '<ol class="breadcrumb">';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index == 0)
		$strReturn .= '<li><a href="'.SITE_DIR.'"><i class="fa fa-home"></i></a>';
	
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "")
		$strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
	else
		$strReturn .= '<li class="active">'.$title.'</li>';
}

$strReturn .= '</ol>';
return $strReturn;
?>


