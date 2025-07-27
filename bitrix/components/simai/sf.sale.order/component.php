<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return false;

$arResult["ERRORS"] = Array();

//получить ссылки


/*
echo "<pre>";
print_r($arParams["IBLOCK_ID_PAYMENT"]);
echo "</pre>";
*/

//проверка на событие


$rsET = CEventType::GetList(Array("TYPE_ID" => "SIMAI_NEW_ORDER"));
if ($rsET->Fetch()):

else:
	$et = new CEventType;
	$et->Add(array(
		"LID" => LANGUAGE_ID,
		"EVENT_NAME" => "SIMAI_NEW_ORDER",
		"NAME" => getMessage("SIMAI_FORM_EVENT_NAME"),
		"DESCRIPTION" => getMessage("SIMAI_FORM_EVENT_DESCRIPTION"),
	));
	
	$arSites = array();
	$sites = CSite::GetList(($b=""), ($o=""), Array("LANGUAGE_ID"=>LANGUAGE_ID));
	while ($site = $sites->Fetch()):
		$arSites[] = $site["LID"];
	endwhile;
	
	if(count($arSites) > 0):
	
		$emess = new CEventMessage;
		$emess->Add(array(
			"ACTIVE" => "Y",
			"EVENT_NAME" => "SIMAI_NEW_ORDER",
			"LID" => $arSites,
			"EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
			"EMAIL_TO" => "#EMAIL#",
			"SUBJECT" => getMessage("SIMAI_FORM_EVENT_SENDER_THEME"),
			"BODY_TYPE" => "html",
			"MESSAGE" => getMessage("SIMAI_FORM_EVENT_SENDER_MESSAGE")
		));
		
		$emess = new CEventMessage;
		$emess->Add(array(
			"ACTIVE" => "Y",
			"EVENT_NAME" => "SIMAI_NEW_ORDER",
			"LID" => $arSites,
			"EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
			"EMAIL_TO" => "#DEFAULT_EMAIL_FROM#",
			"SUBJECT" => getMessage("SIMAI_FORM_EVENT_ADMIN_THEME"),
			"BODY_TYPE" => "html",
			"MESSAGE" => getMessage("SIMAI_FORM_EVENT_ADMIN_MESSAGE")
		));
		
		
		
	endif;
endif;






$arParams["IBLOCK_ID"] = IntVal($arParams["IBLOCK_ID"]);
$arParams["CATALOG_IBLOCK_ID"] = IntVal($arParams["CATALOG_IBLOCK_ID"]);
$arParams["ITEMS_LINKS"] = ($arParams["ITEMS_LINKS"] != "N");
$arParams["DISPLAY_CENTS"] = ($arParams["DISPLAY_CENTS"] != "N");
$arParams["CONT_SESSION"] = ($arParams["CONT_SESSION"] != "N");

$PRICE_CODE = false;
$PRICE_MODE = false;

if (substr($arParams["CATALOG_PRICE_PROPERTY"], 0, 6) == 'price_'):
	$PRICE_CODE = substr($arParams["CATALOG_PRICE_PROPERTY"], 6);
	$PRICE_MODE = "price";
elseif (substr($arParams["CATALOG_PRICE_PROPERTY"], 0, 5) == 'prop_'):
	$PRICE_CODE = substr($arParams["CATALOG_PRICE_PROPERTY"], 5);
	$PRICE_MODE = "prop";
endif;

$arResult["BASKET"] = array();
$arResult["SUM"] = 0;
$item_ids = Array();
if (count($_SESSION['simai_basket_items']) > 0):
	foreach ($_SESSION['simai_basket_items'] as $id=>$item):
		$item_id = IntVal($item["id"]);
		if ($item_id > 0):
			$item_ids[$item_id] = $item_id;
		endif;
		if(isset($arResult["BASKET"][$item["id"]])){
			$arResult["BASKET"][$item["id"]]["FORMS"][] = array("KEY"=> $item["key"],"COUNT" => $item["count"]);
		}else{
		   $arResult["BASKET"][$item["id"]] = array("ID" => $item["id"],"FORMS" => array(0=>array("KEY"=> $item["key"],"COUNT" => $item["count"])));
		}
	endforeach;
else:
  return;
endif;





if (count($item_ids) > 0):
	
	
	$arResult["ITEMS"] = array();
	
	
	foreach($item_ids as $idItem){
		
		
	   $res1 = CIBlockElement::GetByID($idItem);
       if($ar_res = $res1->GetNext()):
		
			//выборка данных
			$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL","IBLOCK_ID","PROPERTY_*");
			$arFilter = Array("IBLOCK_ID"=>$ar_res["IBLOCK_ID"], "ACTIVE"=>"Y", "ID"=>$idItem);

			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			if($ob = $res->GetNextElement()):
				
				
				$arFields = $ob->GetFields();
				$arItem = array();
				$arItem["ID"] = $arFields["ID"];
				$arItem["NAME"] = $arFields["NAME"];
				$arItem["DETAIL_PAGE_URL"] = $arFields["DETAIL_PAGE_URL"];
				$arProps = $ob->GetProperties();
				 
				$arItem["FORMS"] = array();
				$arForms = array();
				 
				 foreach($arResult["BASKET"][$arFields["ID"]]["FORMS"] as $form){
					 
					 $arForm = array();
					 $arTmp = $arProps["FORM"]["VALUE"][$form["KEY"]]["SUB_VALUES"];
					 $arForm["KEY"] = $form["KEY"];
					 $arForm["NAME"] = $arTmp["NAME_FORM"]["~VALUE"];
					 $arForm["TYPE"] = $arTmp["TYPE_FORM"]["~VALUE"];
					 $arForm["DURING"] = $arTmp["DURING_FORM"]["~VALUE"];
					 $arForm["COST"] = $arTmp["COST_FORM"]["~VALUE"];
					 $arForm["DISCOUNT"] = $arTmp["DISCOUNT_FORM"]["~VALUE"];
					 $arForm["FULL_COST"] = $arTmp["COST_FORM"]["~VALUE"];
					 $arForm["COUNT"] = $form["COUNT"];
					  if(is_numeric($arForm["FULL_COST"])&&is_numeric($arForm["DISCOUNT"])){
						$arForm["COST"] = $arForm["FULL_COST"]*((100 - $arForm["DISCOUNT"])/100);
					 }else{
						 $arForm["COST"] = $arForm["FULL_COST"];
					 }
					 $arItem["FORMS"][] = $arForm;
					 
					 $arResult["SUM"]+=$arForm["COST"]*$arForm["COUNT"];
				 }
				 
				 $arResult["ITEMS"][] = $arItem;
			
			endif;
		endif;
	}
	
	
	
	$arResult["PAYMENT"]=array();
	
	$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID" => $arParams["IBLOCK_ID_PAYMENT"], "CODE" => "TYPE"));
	while($enum_fields = $property_enums->GetNext())
	{
	  $arResult["PAYMENT"][$enum_fields["XML_ID"]] = array("NAME" => $enum_fields["VALUE"],"METHOD" => array());
	}
	

	
	
	$arSelect = Array("ID", "NAME","CODE","IBLOCK_ID","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID_PAYMENT"], "ACTIVE"=>"Y");

	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()):
		
		
		
		 $arFields = $ob->GetFields();
		 $arItem = array();
		 $arItem["ID"] = $arFields["ID"];
		 $arItem["NAME"] = $arFields["NAME"];
         $arItem["CODE"] = $arFields["CODE"];
		 $arProps = $ob->GetProperties();
		 $arItem["PROPERTIES"] = $arProps;
		
		 $arResult["PAYMENT"][$arProps["TYPE"]["VALUE_XML_ID"]]["METHOD"][] = $arItem;
		 
	endwhile;
	

endif;

/*
echo "<pre>";
print_r($arResult["PAYMENT"]);
echo "</pre>";

*/
	


if ($_POST['ORDER_SUBMIT'] =="Y"):




    $arResult["ERRORS"] = array();
	$curMethod = array();
	$arNameRequizite= array();

	//search method
	foreach($arResult["PAYMENT"][$_POST["type"]]["METHOD"] as $method){
		
		if($_POST["method"] == $method["CODE"]){
			
			$curMethod = $method;
			break;
		}
	}

	foreach($curMethod["PROPERTIES"]["FIELDS"]["VALUE"] as $requizite){
		
		$arNameRequizite[$requizite["SUB_VALUES"]["FIELD_CODE"]["VALUE"]] = $requizite["SUB_VALUES"]["FIELD_NAME"]["VALUE"];
	}

	
    global $USER;
	//создаём пользователя если не авторизован
	
	$userAuth="";
	if (!$USER->IsAuthorized()):
	
		$pass=RandomString();
		$user = new CUser;
		$arFields = Array(
		  "NAME"              => $_POST['PROP']['FIO'],
		  "EMAIL"             => $_POST['PROP']["EMAIL"],
		  "LOGIN"             => $_POST['PROP']["EMAIL"],
		  "LID"               => SITE_ID,
		  "ACTIVE"            => "Y",
		  "PASSWORD"          => $pass,
		  "CONFIRM_PASSWORD"  => $pass,
		);
		 $idUser = $user->Add($arFields);
		 
		 if (intval($idUser) > 0)
               $userAuth = GetMessage("USER_AUTH", Array ("#LOGIN#" => $_POST['PROP']["EMAIL"],"#PASS#" => $pass));
         else
		    $arResult["ERRORS"][] = $user->LAST_ERROR;
	  
	else:
         $idUser = $USER->GetID();
	endif;
	
	if(empty($arResult["ERRORS"])):
	
		$res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
		if($ar_res = $res->GetNext())
		  $numberOrder = intval($ar_res["DESCRIPTION"]);
	  
	 
		$el = new CIBlockElement;

		$PROP = array();
		$PROP["CLIENT"] = $idUser;  
		$PROP["NOMER"] = $numberOrder; 
		$PROP["FIO"] = $_POST['PROP']['FIO']; 
		$PROP["HASH"] = md5(RandomString()); 
		$PROP["SUM"] = $arResult["SUM"];
		$PROP["METHOD"] = $curMethod["ID"];
		
		
		$PROP["ADDITIONAL"] = array(); 
		foreach($_POST["PROP"] as $codeProp=> $valProp){
			
			$PROP["ADDITIONAL"][] = array("SUBPROP_VALUES" => array(
																	 "NAME_REQUISITE" => $arNameRequizite[$codeProp],
																	 "CODE_REQUISITE" => $codeProp,
																	 "VALUE_REQUISITE" => $valProp,
																 ));
		}
		$products="";
		$PROP["PRODUCT"] = array();
		foreach($arResult["ITEMS"] as $arItem){
			
			
			foreach($arItem["FORMS"] as $arForm){
				
			   $PROP["PRODUCT"][] = array("SUBPROP_VALUES" => array(
																	 "PRODUCT_LINK" => $arItem["ID"],
																	 "PRODUCT_FORM" => 	 $arItem["NAME"]."(".mb_strtolower($arForm["NAME"]).", ".mb_strtolower($arForm["TYPE"]).")",
																	 "PRODUCT_SUM" => $arForm["COST"]*$arForm["COUNT"],
																	 "PRODUCT_COUNT" => $arForm["COUNT"],
																	 ));
																	 
				$products.= $arItem["NAME"]."(".mb_strtolower($arForm["NAME"]).", ".mb_strtolower($arForm["TYPE"]).") - ".$arForm["COUNT"]."\n";													 
			}

		}
		
		
		$arEnumList= array();
		$db_enum_list = CIBlockProperty::GetPropertyEnum("STATUS", Array(), Array("IBLOCK_ID" => $arParams["IBLOCK_ID"]));
		while($ar_enum_list = $db_enum_list->GetNext())
		{
			 $arEnumList[$ar_enum_list["XML_ID"]] = $ar_enum_list["ID"];
		}

		
	   $PROP["STATUS"] = $arEnumList["not_paid"];
		 
		
		
		
		
		$arLoad = Array(
		  "IBLOCK_ID"      => $arParams["IBLOCK_ID"],
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => GetMessage("ORDER_NUMBER", Array ("#NUMBER#" => $numberOrder)),
		  "ACTIVE"         => "Y",          
		 );

		if($PRODUCT_ID = $el->Add($arLoad)):
		
		
			 $numberNextOrder = $numberOrder+1;
			 $ib = new CIBlock;
			 $arIblockFields = Array(
				  "DESCRIPTION" => $numberNextOrder,
			 );
			 
			 
			 $arEventFields = array(
						"EMAIL" => $_POST['PROP']["EMAIL"],
						"USER_AUTH" => $userAuth,
						"ORDER_ID" => $numberOrder,
						"ORDER_DATE" => date('d.m.Y'),
						"ORDER_USER" => $_POST['PROP']["FIO"],
						"PRICE" => $PROP["SUM"],
						"ORDER_LIST" => $products,
					);
					
			 CEvent::Send("SIMAI_NEW_ORDER", SITE_ID, $arEventFields);
			 
			 
			 //set next order 
			 $ib->Update($arParams["IBLOCK_ID"], $arIblockFields);
			 
			 //clean basket
			 $_SESSION['simai_basket_items'] = array();
			 
			 LocalRedirect($arParams["LINKS"]."?id=".$PRODUCT_ID."&hash=".$PROP['HASH']);	
		 
		endif;
		
	endif;
endif;



$this->IncludeComponentTemplate();


function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;


}

?>
