<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock"))
	return false;


$iblock_permission = CIBlock::GetPermission($arParams["IBLOCK_ID"]);

if($iblock_permission<"W")
       echo getmessage("ACCESS_CLOSE");
   else{

if(isset($_REQUEST["LINK"]))
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

	
	    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $_REQUEST["LINK"], $match)) {
           $YOUTUBE = $match[1];
       }
	
		$el = new CIBlockElement;
		$PROP = array();
	    $PROP["LINK"] = $YOUTUBE;
		//грузим картинку 
		
		
		$url = 'https://i.ytimg.com/vi/'.$YOUTUBE.'/hqdefault.jpg';
		$path = $_SERVER["DOCUMENT_ROOT"].'/upload/tmp/videotmpcapture.jpg';
		file_put_contents($path, file_get_contents($url));
		
		
		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => $USER->GetID(),
          "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "SHORT"),		  
		  "IBLOCK_SECTION_ID" => $arParams["SECTION_ID"],         
		  "IBLOCK_ID"      => $arParams["IBLOCK_ID"],
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $_REQUEST["NAME"],
		  "ACTIVE"         => "Y",           
		  "PREVIEW_PICTURE"   => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/upload/tmp/videotmpcapture.jpg"),
		  );
		  
		if($PRODUCT_ID = $el->Add($arLoadProductArray)){
            unlink($_SERVER["DOCUMENT_ROOT"].'/upload/tmp/videotmpcapture.jpg');
		    $res = CIBlockSection::GetByID($arParams["SECTION_ID"]);
            if($ar_res = $res->GetNext())LocalRedirect($arParams["DIRECTORY"].$ar_res["CODE"]."/");
         } else {
		  unlink($_SERVER["DOCUMENT_ROOT"].'/upload/tmp/videotmpcapture.jpg');
          echo 'Error: '.$el->LAST_ERROR;
        }

		
		
	  /*$db_props = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $PRODUCT_ID, array("sort" => "asc"), Array("CODE"=>"REAL_PICTURE"));
        $ar_props = $db_props->Fetch();
	    $file = CFile::ResizeImageGet($ar_props["VALUE"], array('width'=>$arParams["MAX_WIDTH"], 'height'=>$arParams["MAX_HEIGHT"]), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$file =CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$file["src"]);
		CIBlockElement::SetPropertyValues($PRODUCT_ID, $arParams["IBLOCK_ID"], $file, "REAL_PICTURE");
		$path_parts = pathinfo($value["tmp_name"]);
		*/



}

$this->IncludeComponentTemplate();
   }

?>

<?

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


