<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\IO\File;

$arResult["DOCS"] = array();
$arDocId = array();

foreach($arResult["ITEMS"] as $key=>$arItem)
{
	if(is_array($arItem["PROPERTIES"]["DOCS"]["VALUE"])){

		foreach($arItem["PROPERTIES"]["DOCS"]["VALUE"] as $val){

			if($val!="")
			  $arDocId[$val] = $val;
		}
	}
}

//выборка элементов
if(!empty($arDocId)){
	$res = CIBlockElement::GetByID(current($arDocId));
	if($ar_res = $res->GetNext()){

		$arSelect = Array("ID", "IBLOCK_ID","DATE_CREATE", "CREATED_BY",  "NAME","PROPERTY_*");
		$arFilter = Array("IBLOCK_ID" => $ar_res["IBLOCK_ID"], "ID" => $arDocId, "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement()){ 


		   $arFields = $ob->GetFields();  
		   $item = $arFields;
		   $arProps = $ob->GetProperties();
		   $item["PROPERTIES"] = $arProps;
           $arResult["DOCS"][$arFields["ID"]] = $item;
		}
	}
} 

$certs = array();
$arUserId = array();
foreach($arResult["DOCS"] as $key=>$arItem)
{
		$arUserId[$arItem["CREATED_BY"]] = $arItem["CREATED_BY"];
        if($arItem["PROPERTIES"]["FILE"]["VALUE"])
        {
			$arFile = CFile::GetFileArray($arItem["PROPERTIES"]["FILE"]["VALUE"]);
            $info=substr($arFile["SRC"], strrpos($arFile["SRC"], '.') + 1);
            $arResult["DOCS"][$key]["TYPE"]=$info;
            $doc=array("pdf"=>array("icon"=>"pdf","color"=>"#FF9800"),"doc"=>array("icon"=>"word","color"=>"#3F51B5"),"docx"=>array("icon"=>"word","color"=>"#3F51B5"),"xls"=>array("icon"=>"excel","color"=>"#4CAF50"),"xml"=>array("icon"=>"excel","color"=>"#4CAF50"),"jpg" => array("icon"=>"image","color"=>"#E91E63"),"jpeg" => array("icon"=>"image","color"=>"#E91E63"),"png" => array("icon"=>"image","color"=>"#E91E63"),"bmp" => array("icon"=>"image","color"=>"#E91E63"),"gif" => array("icon"=>"image","color"=>"#E91E63"),"zip" => array("icon"=>"archive","color"=>"#3F51B5"),"rar" => array("icon"=>"archive","color"=>"#3F51B5"));
            if(array_key_exists($info,$doc)){
				$arResult["DOCS"][$key]["ICON"]["TYPE"]="file-".$doc[$info]["icon"]."-o";
				$arResult["DOCS"][$key]["ICON"]["COLOR"] = $doc[$info]["color"];
			}
            else{
				$arResult["DOCS"][$key]["ICON"]["TYPE"]="file-o";
				$arResult["DOCS"][$key]["ICON"]["COLOR"]="#607D8B";
			}
            $arResult["DOCS"][$key]["DOC_SRC"]=$arFile["SRC"];
            $arResult["DOCS"][$key]["DOC_SIZE"]=number_format(intVal($arFile["FILE_SIZE"])/1000, 0, '.', '');
        }
	  // signature
		if (!empty($arItem['PROPERTIES']['SIGNATURE_FILE']['VALUE']))
		{
			$content = file_get_contents(\Bitrix\Main\Application::getDocumentRoot().CFile::GetPath($arItem['PROPERTIES']['SIGNATURE_FILE']['VALUE']));
			if (!empty($content))
				$arResult["DOCS"][$key]['PROPERTIES']['SIGNATURE_FILE']['CONTENT'] = $content;
		}

		// certificates collecting
		if (!empty($arItem['PROPERTIES']['CERTIFICATE']['VALUE']))
			$certs[$key] = $arItem['PROPERTIES']['CERTIFICATE']['VALUE'];
}

// certificates
if (!empty($certs))
{
    $arSelect = ['ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_ORGANIZATION', 'PROPERTY_FILE', 'PROPERTY_RELEASED_BY',
        'PROPERTY_DATE_VALIDITY_BEGIN', 'PROPERTY_DATE_VALIDITY_END', 'PROPERTY_SERIAL','PROPERTY_WORK_POSITION'];
    $res = CIBlockElement::GetList([], ['ID' => $certs], false, false, $arSelect);
    while($ob = $res->GetNextElement())
        $arResult['CERTIFICATES'][ $ob->GetFields()['ID'] ] = $ob->GetFields();
}

$arResult["USER"] = array();

if(!empty($arUserId)){

 	$data = \Bitrix\Main\UserTable::getList(array(
        'select' => array('*'),
        'order' => array('id'=>'desc'),
        'filter' => array(
            '=ID' => $arUserId,
        ),
    ));

	while($arUser = $data->Fetch()) {

		$name="";
		if($arUser["LAST_NAME"]!="")
		   $name.=$arUser["LAST_NAME"]." ";

		 if($arUser["NAME"]!="")
		   $name.=$arUser["NAME"]." ";

		 if($arUser["SECOND_NAME"]!="")
		   $name.=$arUser["SECOND_NAME"]; 

		$arResult["USER"][$arUser['ID']] = array("NAME" => $name, "WORK_POSITION" => $arUser['WORK_POSITION']);
	}
}

?>