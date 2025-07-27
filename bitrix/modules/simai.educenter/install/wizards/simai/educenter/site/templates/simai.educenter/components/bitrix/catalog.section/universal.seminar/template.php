<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);


 switch($arParams["TEMPLATE_DEF"])
 {
	 
	case "list": require "skins/list.php"; break;
	case ".default": require "skins/cards.php"; break;
	case "table": require "skins/table.php"; break;
	default: require "skins/table.php";
	
 }