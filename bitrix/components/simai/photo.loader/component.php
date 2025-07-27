<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock"))
	return false;

if (defined("SM_VERSION")) { 
  $vr = constant("SM_VERSION"); 
  $vr= substr($vr,0,strpos($vr,".")); 
}

$iblock_permission = CIBlock::GetPermission($arParams["IBLOCK_ID"]);
if($vr<16)
{
	echo getmessage("REFRESH_VERSION");
}else{
if($iblock_permission<"W")
       echo getmessage("ACCESS_CLOSE");
   else{

if(isset($_REQUEST["pic"]))
{
	if($_REQUEST["SECTION_ID"]=="-1")
	{
    
	$bs = new CIBlockSection;
		 $arFields = Array(
		  "ACTIVE" => "Y",
		  "IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
		  "IBLOCK_ID" => $arParams["IBLOCK_ID"],
		  "CODE" => translit($_REQUEST["SECTION_NAME"]),
		  "NAME" => $_REQUEST["SECTION_NAME"],
		  "SORT" => $SORT,
		  "DESCRIPTION" => "",
		  );
		$arParams["SECTION_ID"] = $bs->Add($arFields);
	}
	else $arParams["SECTION_ID"]=$_REQUEST["SECTION_ID"];

	
	foreach ($_REQUEST["pic"] as $key => $value) {
		 if(!strpos($value["tmp_name"], "upload/tmp")) 
			$value["tmp_name"]="/upload/tmp".$value["tmp_name"];
		$el = new CIBlockElement;
		$PROP = array();
		$newName=str_replace("default",$value["name"],$value["tmp_name"]);
		rename($_SERVER['DOCUMENT_ROOT'].$value["tmp_name"] , $_SERVER['DOCUMENT_ROOT'].$newName);
		$value["tmp_name"]=$_SERVER["DOCUMENT_ROOT"].$newName;  

		$PROP["REAL_PICTURE"] = $value;  
		
		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => $USER->GetID(), 
		  "IBLOCK_SECTION_ID" => $arParams["SECTION_ID"],         
		  "IBLOCK_ID"      => $arParams["IBLOCK_ID"],
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $value["name"],
		  "ACTIVE"         => "Y",           
		  "PREVIEW_TEXT"   => $_REQUEST["pic_descr"][$key],
		  );
		$PRODUCT_ID = $el->Add($arLoadProductArray);
		$db_props = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $PRODUCT_ID, array("sort" => "asc"), Array("CODE"=>"REAL_PICTURE"));
        $ar_props = $db_props->Fetch();
	    $file = CFile::ResizeImageGet($ar_props["VALUE"], array('width'=>$arParams["MAX_WIDTH"], 'height'=>$arParams["MAX_HEIGHT"]), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$file =CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$file["src"]);
		CIBlockElement::SetPropertyValues($PRODUCT_ID, $arParams["IBLOCK_ID"], $file, "REAL_PICTURE");
		$path_parts = pathinfo($value["tmp_name"]);
		 
        removeDir($path_parts["dirname"]);	
	}
	$res = CIBlockSection::GetByID($arParams["SECTION_ID"]);
    if($ar_res = $res->GetNext())LocalRedirect($arParams["DIRECTORY"].$ar_res["CODE"]."/");

}

$this->IncludeComponentTemplate();
   }
}
?>

<?
function removeDir($path_del)
{
    $it = new RecursiveDirectoryIterator($path_del);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach($files as $file)
    {
        if ($file->getFilename() === '.' || $file->getFilename() === '..')
        {
            continue;
        }
        if(is_link($file)) 
        {
            unlink($file);
        } 
        if ($file->isDir())
        {
            rmdir($file->getRealPath());
        } 
        else
        {
            unlink($file->getRealPath());
        }
    }
    rmdir($path_del);
}

function translit($stroka)
{
     $rus=array(
	 GetMessage("A"),
	 GetMessage("B"),
	 GetMessage("V"),
	 GetMessage("G"),
	 GetMessage("D"),
	 GetMessage("E"),
	 GetMessage("E1"),
	 GetMessage("J"),
	 GetMessage("Z"),
	 GetMessage("I"),
	 GetMessage("Y"),
	 GetMessage("K"),
	 GetMessage("L"),
	 GetMessage("M"),
	 GetMessage("N"),
	 GetMessage("O"),
	 GetMessage("P"),
	 GetMessage("R"),
	 GetMessage("S"),
	 GetMessage("T"),
	 GetMessage("U"),
	 GetMessage("F"),
	 GetMessage("H"),
	 GetMessage("C"),
	 GetMessage("CH"),
	 GetMessage("SH"),
	 GetMessage("SCH"),
	 GetMessage("Y1"),
	 GetMessage("Y2"),
	 GetMessage("Y3"),
	 GetMessage("E3"),
	 GetMessage("YU"),
	 GetMessage("YA"),
	 GetMessage("a"),
	 GetMessage("b"),
	 GetMessage("v"),
	 GetMessage("g"),
	 GetMessage("d"),
	 GetMessage("e"),
	 GetMessage("e1"),
	 GetMessage("j"),
	 GetMessage("z"),
	 GetMessage("i"),
	 GetMessage("y"),
	 GetMessage("k"),
	 GetMessage("l"),
	 GetMessage("m"),
	 GetMessage("n"),
	 GetMessage("o"),
	 GetMessage("p"),
	 GetMessage("r"),
	 GetMessage("s"),
	 GetMessage("t"),
	 GetMessage("u"),
	 GetMessage("f"),
	 GetMessage("h"),
	 GetMessage("c"),
	 GetMessage("ch"),
	 GetMessage("sh"),
	 GetMessage("sch"),
	 GetMessage("y1"),
	 GetMessage("y2"),
	 GetMessage("y3"),
	 GetMessage("e2"),
	 GetMessage("yu"),
	 GetMessage("ya"),
	 ' ');
	 $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','-');
	 return str_replace($rus, $lat, $stroka);
}

?>


