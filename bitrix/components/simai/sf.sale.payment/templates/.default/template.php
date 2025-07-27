<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


/*
	echo "<pre>";
	print_r($arResult);
	echo "</pre>";
	*/
	
	if(file_exists($_SERVER["DOCUMENT_ROOT"]. $templateFolder."/".$arResult["METHOD"]."/template.php")){
		require $_SERVER["DOCUMENT_ROOT"]. $templateFolder."/".$arResult["METHOD"]."/template.php";
	}
