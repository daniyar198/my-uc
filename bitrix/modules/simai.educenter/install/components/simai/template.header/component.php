<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$template=substr(SITE_TEMPLATE_PATH,strripos(SITE_TEMPLATE_PATH,"/")+1,strlen(SITE_TEMPLATE_PATH));
$papka=substr(__DIR__,0,strripos(__DIR__,"bitrix"));
if(file_exists($papka."/bitrix/modules/".$template."/"))$this->IncludeComponentTemplate();
?>
