<?
IncludeModuleLangFile(__FILE__);
class simai_educenter extends CModule
{
	const MODULE_ID = 'simai.educenter';
	var $MODULE_ID = 'simai.educenter';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("simai.educenter_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("simai.educenter_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("simai.educenter_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("simai.educenter_PARTNER_URI");
	}

	function InstallDB($arParams = array())
	{
		global $DB, $DBType, $APPLICATION;
		RegisterModule("simai.educenter");
		return true;
	}

	function UnInstallDB($arParams = array())
	{
		return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles($arParams = array())
	{
		CheckDirPath($_SERVER["DOCUMENT_ROOT"]."/bitrix/admin/simai");
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.educenter/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin/simai", true, true);
		
	    CheckDirPath($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/simai");
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.educenter/install/components/simai", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/simai", true, true);
		CheckDirPath($_SERVER["DOCUMENT_ROOT"]."/bitrix/wizards/simai");
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.educenter/install/wizards/simai", $_SERVER["DOCUMENT_ROOT"]."/bitrix/wizards/simai", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.educenter/styles/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/simai", true, true);
		
		if(!file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.complexprop")){
			
			CheckDirPath($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.complexprop");
			CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.educenter/install/wizards/simai/educenter/simai.complexprop", $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.complexprop", true, true);
			RegisterModule("simai.complexprop");
			RegisterModuleDependences("iblock", "OnIBlockPropertyBuildList", "simai.complexprop", "CCustomTypeSimaiComplex", "GetUserTypeDescription");			
			RegisterModuleDependences("main", "OnBeforeProlog", "simai.complexprop", "CIBEditSimaiComplexProp", "OnBeforePrologHandler");
			RegisterModuleDependences("iblock", "OnStartIBlockElementAdd", "simai.complexprop", "CIBEditSimaiComplexProp", "OnStartIBlockElementUpdateHandler");
			RegisterModuleDependences("iblock", "OnStartIBlockElementUpdate", "simai.complexprop", "CIBEditSimaiComplexProp", "OnStartIBlockElementUpdateHandler");
			RegisterModuleDependences("iblock", "OnBeforeIBlockElementAdd", "simai.complexprop", "CIBEditSimaiComplexProp", "OnBeforeIBlockElementUpdateHandler");
			RegisterModuleDependences("iblock", "OnBeforeIBlockElementUpdate", "simai.complexprop", "CIBEditSimaiComplexProp", "OnBeforeIBlockElementUpdateHandler");
			RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "simai.complexprop", "CIBEditSimaiComplexProp", "OnAfterIBlockElementUpdateHandler");
			RegisterModuleDependences("iblock", "OnAfterIBlockElementUpdate", "simai.complexprop", "CIBEditSimaiComplexProp", "OnAfterIBlockElementUpdateHandler");
    
		}
	    return true;
	}

	function UnInstallFiles()
	{
			//получить список компонентов модулей simai которые установлены
		$arComponents = array();
		$connection = \Bitrix\Main\Application::getConnection();
		$sql = "SELECT ID FROM b_module WHERE ID LIKE 'simai.%'";
		$recordset = $connection->query($sql);
		while ($record = $recordset->fetch()){
			
			   if(file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$record['ID']."/install/bitrix/components/simai/")){
				   
				   $files = scandir($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$record['ID']."/install/bitrix/components/simai/");
				   foreach($files as $fname){
					   if($fname == "." || $fname == "..") continue;
					   $arComponents[$fname] = $fname;
				   }
			   }
			   
			   if(file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$record['ID']."/install/components/simai/")){
				   
				   $files = scandir($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$record['ID']."/install/components/simai/");
				   foreach($files as $fname){
					   if($fname == "." || $fname == "..") continue;
					   $arComponents[$fname] = $fname;
				   }
			   }	   
		}
		
		
		//получить список компонентов решения
		$dir = $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/components/simai/";
		$files = scandir($dir);
		foreach($files as $fname){
			
			if($fname == "." || $fname == "..") continue;
			//удалить только те компоненты которых нет в других модулей
			if(!isset($arComponents[$fname])){
				DeleteDirFilesEx("/bitrix/components/simai/".$fname);
			}
		}
		DeleteDirFilesEx("/bitrix/templates/simai.educenter");
		DeleteDirFilesEx("/bitrix/wizards/simai.educenter");
		return true;
	}

	function DoInstall()
	{
		global $APPLICATION;
		$this->InstallFiles();
		$this->InstallDB();
	}

	function DoUninstall()
	{
		global $APPLICATION;
		UnRegisterModule(self::MODULE_ID);
		$this->UnInstallDB();
		$this->UnInstallFiles();
	}
}
?>