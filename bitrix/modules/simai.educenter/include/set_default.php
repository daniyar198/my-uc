<?
   require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); 
   $path=substr(__DIR__,0,strlen(__DIR__)-8);
   require_once($path.'/classes/general/template.php');
   SIMAITemplate::setbydefault($_REQUEST["module"]);
 ?>