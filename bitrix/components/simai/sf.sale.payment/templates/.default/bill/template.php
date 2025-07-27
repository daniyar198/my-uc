<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
require "functions.php";
?>

<?$module="simai.educenter";?>
<style>
	table { border-collapse: collapse; }
	td{ border: 1pt solid #000000; }

</style>

<div style="background: #ffffff; width:705px; margin:0 auto; padding-top:20px;">
	<div style="line-height: 1px;">
	 <p style="margin-bottom:20px"><?=COption::GetOptionString($module, "recipient", "")?></p>
	 <p><?=COption::GetOptionString($module, "address", "")?></p>
	 <p><?=Loc::getMessage('PHONE')?>: <?=COption::GetOptionString($module, "phone", "")?></p>
	 <p><?=Loc::getMessage('EMAIL')?>: <?=COption::GetOptionString($module, "email", "")?></p>
	 <p><?=Loc::getMessage('SITE')?>: http://<?=SITE_SERVER_NAME?></p>
	</div>
	
	<p style="margin-top:20px;font-size: 13px;"><?=Loc::getMessage('EXAMPLE_PLATEJ')?></p>
	<table width="100%">
	  <tr>
		<td width="60%" colspan="4" style="border-bottom:0px;">&nbsp;<?=COption::GetOptionString($module, "bank", "")?></td>
		<td width="10%">&nbsp;<?=Loc::getMessage('BIK')?></td>
		<td width="30%" style="border-bottom:0px;">&nbsp;<?=COption::GetOptionString($module, "bik", "")?></td>
	  </tr>
	  <tr>
		<td width="60%" colspan="4" style="border-top:0px;border-bottom:0px;"></td>
		<td width="10%" style="border-bottom:0px;">&nbsp;<?=Loc::getMessage('BILL_NUM')?></td>
		<td width="30%" style="border-top:0px;border-bottom:0px;">&nbsp;<?=COption::GetOptionString($module, "ks", "")?></td>
	  </tr>
	  <tr>
		<td width="60%" colspan="4" style="border-top:0px;font-size: 12px;">&nbsp;<?=Loc::getMessage('BANK_RECIPIENT')?></td>
		<td width="10%" style="border-top:0px;"></td>
		<td width="30%"  style="border-top:0px;"></td>
	  </tr>
	  <tr>
		<td width="10%">&nbsp;<?=Loc::getMessage('INN')?></td>
		<td width="20%">&nbsp;<?=COption::GetOptionString($module, "inn", "")?></td>
		<td width="10%">&nbsp;<?=Loc::getMessage('KPP')?></td>
		<td width="20%">&nbsp;<?=COption::GetOptionString($module, "kpp", "")?></td>
		<td width="10%" style="border-bottom:0px;">&nbsp;<?=Loc::getMessage('BILL_NUM')?></td>
		<td width="30%"  style="border-bottom:0px;">&nbsp;<?=COption::GetOptionString($module, "bill", "")?></td>
	  </tr>
	   <tr>
		<td width="60%" colspan="4" style="border-bottom:0px;">&nbsp;<?=COption::GetOptionString($module, "recipient", "")?></td>
		<td width="10%" style="border:0px;"></td>
		<td width="30%" style="border-bottom:0px;border-top:0px;"></td>
	  </tr>
	   <tr>
		<td width="60%" colspan="4" style="border-top:0px;font-size: 12px;">&nbsp;<?=Loc::getMessage('RECIPIENT')?></td>
		<td width="10%" style="border-top:0px;"></td>
		<td width="30%" style="border-top:0px;"></td>
	  </tr>
	</table>
	<h2 style="text-align:center; margin-top:30px;"><?=Loc::getMessage('BILL_NA_OPLATU')?> <?=$arResult["NUMBER"]?> <?=Loc::getMessage('FROM')?> <?=FormatDate("j F Y", MakeTimeStamp($arResult["DATE_ACTIVE_FROM"]))?></h2>
	
	<div style="line-height: 3px;margin-top:30px;margin-left:10px;font-size: 14px;margin-bottom: 45px;">
	 <p><?=Loc::getMessage('PROVIDER')?>: <?=COption::GetOptionString($module, "recipient", "")?></p>
     <p><?=Loc::getMessage('BUYER')?>:</p>
    </div>
	
	<table width="100%">
		<tr style="text-align:center;">
			<td width="5%"><?=Loc::getMessage('NOMER')?></td>
			<td width="55%"><?=Loc::getMessage('ITEMS')?></td>
			<td width="10%"><?=Loc::getMessage('COUNT')?></td>
			<td width="10%"><?=Loc::getMessage('ED')?></td>
			<td width="10%"><?=Loc::getMessage('COST')?></nobr></td>
			<td width="10%"><?=Loc::getMessage('SUM')?></td>
		</tr>
	<?foreach($arResult["PRODUCT"] as $key=> $arProduct):?>
	 <tr>
		<td>&nbsp;<?=$key+1?></td>
		<td>&nbsp;<?=$arProduct["NAME"]?></td>
		<td style="text-align:right;"><?=$arProduct["COUNT"]?></td>
		<td style="text-align:center;"><?=Loc::getMessage('ED_SMALL')?></td>
		<td style="text-align:right;"><?=number_format($arProduct["SUM"]/$arProduct["COUNT"], 2, '.', '')?></nobr></td>
		<td style="text-align:right;"><?=number_format($arProduct["SUM"], 2, '.', '')?></td>
	 </tr>
	 <?endforeach;?>
	</table>
	
	<div style="width:250px;float:right; text-align:right; margin-top:20px;">
	 <table width="100%">
	  <tr>
	   <td style="border:0px; text-align:right; font-weight:600;"><?=Loc::getMessage('ITOGO')?>:</td>
	   <td style="border:0px; text-align:right; font-weight:600;"><?=number_format($arResult["SUM"], 2, '.', '')?></td>
	  </tr>
	  <tr>
	   <td style="border:0px; text-align:right;"><?=Loc::getMessage('NDS_IN')?>:</td>
	   <td style="border:0px; text-align:right;"><?=Loc::getMessage('WITHOUT_NDS')?></td>
	  </tr>
	</table>
   </div>
   <div style="clear:both;"></div>
   <p style="padding-top:15px;line-height: 0px;"><?=Loc::getMessage('VSEGO_K_OPLATE')?>: <?=num2str($arResult["SUM"])?></p>
   <hr size="3" color="#000"/>
   
   <div>
    <div style="height:40px;"> </div>
	   <table width="100%">
		  <tr>
		   <td  width="15%" style="border:0px;padding-top: 25px;"><?=Loc::getMessage('PROVIDER')?></td>
		   <td width="40%" style="border-top:0px;border-right:0px;border-left:0px;text-align:center;padding-top: 25px;"><?=COption::GetOptionString($module, "provider_post", "")?></td>
		   <td width="20%" style="border-top:0px;border-right:0px;border-left:0px; text-align:center;">
		   <?if(COption::GetOptionString($module, "provider_sign", "")!=""):?>
		    <img height="50px" src="<?=COption::GetOptionString($module, "provider_sign", "")?>"/>
		   <?endif;?>
		  </td>
		   <td  width="5%" style="border:0px;"></td>
		   <td width="20%" style="border-top:0px;border-right:0px;border-left:0px;text-align:center;padding-top: 25px;"><?=COption::GetOptionString($module, "provider_sign_trans", "")?></td>
		  </tr>
		  
		  <tr style="line-height: 9px;">
		   <td  width="15%" style="border:0px;"></td>
		   <td width="35%" style="border:0px;text-align:center;font-size: 10px;"><?=Loc::getMessage('POST')?></td>
		   <td width="25%" style="border:0px;text-align:center;font-size: 10px;"><?=Loc::getMessage('SIGN')?></td>
		   <td  width="5%" style="border:0px;"></td>
		   <td width="20%" style="border:0px;text-align:center;font-size: 10px;"><?=Loc::getMessage('FULLNAME')?></td>
		  </tr>
		  
		
		  <tr>
		   <td  width="55%" colspan="2" style="border:0px;padding-top: 25px;"><?=Loc::getMessage('MAIN_BOOKER')?></td>
		   <td width="20%" style="border-top:0px;border-right:0px;border-left:0px;text-align:center;">
		   <?if(COption::GetOptionString($module, "booker_sign", "")!=""):?>
		    <img height="50px" src="<?=COption::GetOptionString($module, "booker_sign", "")?>"/>
		   <?endif;?>
		   </td>
		   <td  width="5%" style="border:0px;"></td>
		   <td width="20%" style="border-top:0px;border-right:0px;border-left:0px;text-align:center;font-size: 14px;padding-top: 25px;">
			   <?if(COption::GetOptionString($module, "booker_sign_trans", "")!=""):?>
				 <?=COption::GetOptionString($module, "booker_sign_trans", "")?>
			   <?else:?>
				 <?=Loc::getMessage('NOT_USE')?>
			   <?endif;?>
		   </td>
		  </tr>
		  
		  <tr style="line-height: 9px;">
		   <td width="55%" colspan="2" style="border:0px;"></td>
		   <td width="20%" style="border:0px;text-align:center;font-size: 10px;"><?=Loc::getMessage('SIGN')?></td>
		   <td  width="5%" style="border:0px;"></td>
		   <td width="20%" style="border:0px;text-align:center;font-size: 10px;"><?=Loc::getMessage('FULLNAME')?></td>
		  </tr>
		  
		</table>
     <div style="height:40px;"> </div>
   </div>
	
   <?if(COption::GetOptionString($module, "stamp", "")!=""):?>
	  <img src="<?=COption::GetOptionString($module, "stamp", "")?>" style="width: 200px;position: absolute;top: 610px;left: 50%; margin-left: -100px;">
   <?endif;?>
</div>

