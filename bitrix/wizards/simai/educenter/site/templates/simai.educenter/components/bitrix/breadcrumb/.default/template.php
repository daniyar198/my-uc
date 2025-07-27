<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use Bitrix\Main\Localization\Loc;

if(empty($arResult))
	return "";

$strReturn = '<ol class="t-list m-0 p-0 my-4" itemscope itemtype="http://schema.org/BreadcrumbList">';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index == 0)
		$strReturn .= '<li class="float-left"><a href="'.SITE_DIR.'"><i class="fa fa-home mr-2"></i></a>';
	
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "")
		$strReturn .= '<li class="float-left" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><i class="far fa-angle-right mx-2" aria-hidden="true"></i> <a href="'.$arResult[$index]["LINK"].'" title="'.$title.'"  itemprop="item"><span itemprop="name">'.$title.'</span></a><meta itemprop="position" content="'.$index.'" /></li>';
	else
		$strReturn .= '<li class="float-left active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><i class="far fa-angle-right mx-2" aria-hidden="true"></i> '.$title.'</li>';
}

$strReturn .= '</ol>';
return $strReturn;
?>


