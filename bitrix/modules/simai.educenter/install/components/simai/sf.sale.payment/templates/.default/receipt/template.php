<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
$subProps=array();
/*foreach($arResult["PROPERTIES"]["CODE_REQUISITE"]["VALUE"] as $key => $value)
 $subProps[$value] = $key;*/

$module="simai.educenter";

?>
<?
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
//$additional=$arResult["PROPERTIES"]["ADDITIONAL"]["VALUE"];
$kpp=str_split(COption::GetOptionString($module, "kpp", ""));
$inn=str_split(COption::GetOptionString($module, "inn", ""));
$bill=str_split(COption::GetOptionString($module, "bill", ""));
$ks=str_split(COption::GetOptionString($module, "ks", ""));
$bik=str_split(COption::GetOptionString($module, "bik", ""));
?>
<?/*
echo "<pre>";
print_r($arResult);
echo "</pre>";*/
?>
<style type="text/css">
   code { white-space: pre; }
   .nowr { white-space: nowrap; }
   td { padding: 0; border: 0;}
   table { border: none; }
   img { border: none; }
   form { margin: 0px; padding: 0px; }
   sup { font-size: 66%; line-height: .5; }
   li { list-style: square outside; padding: 0px; margin: 0px; }
   ul { list-style: square outside; padding: 0em 0em 0em 0em; margin: 0em 0em 0em 1.5em; }
   .fakelink { cursor: pointer; }
   .centered { margin-left: auto; margin-right: auto; }
   .zerosize { font-size: 1px; }
   .underlined { text-decoration: underline; }
   .bolded { font-weight: bold; }
   .vbottom { vertical-align: bottom; }
   .vsub { vertical-align: sub; }
   .h_left { text-align: left; }
   .h_right { text-align: right; }
   .h_center { text-align: center; }
   .v_top { vertical-align: top; }
   .v_bottom { vertical-align: bottom; }
   .v_middle { vertical-align: middle; }
   .w100, .full_w, .full { width: 100%; }
   .h100, .full_h, .full { height: 100%; }
   .cramp, .cramp_w { width: 1px; }
   .cramp, .cramp_h { height: 1px; }
   .ucfirst:first-letter { text-transform: uppercase; }
   .clean { clear: both; }
</style>
<style type="text/css">
   body { background-color: white; margin: 0px; text-align: center; }
   .ramka { border-top: black 1px dashed; border-bottom: black 1px dashed; border-left: black 1px dashed; border-right: black 1px dashed; margin: 0 auto 12mm auto; height: 145mm; }
   .kassir { font-weight: bold; font-size: 10pt; font-family: "Times New Roman", serif; padding: 7mm 0 7mm 0; text-align: center; }
   .cell { font-family: Arial, sans-serif; border-left: black 1px solid; border-bottom: black 1px solid; border-top: black 1px solid; font-weight: bold; font-size: 8pt; line-height: 1.1; height: 4mm; vertical-align: bottom; text-align: center; }
   .cells { border-right: black 1px solid; width: 100%; }
   .subscript { font-size: 6pt; font-family: "Times New Roman", serif; line-height: 1; vertical-align: top; text-align: center; }
   .string, .dstring { font-weight: bold; font-size: 8pt; font-family: Arial, sans-serif; border-bottom: black 1px solid; text-align: center; vertical-align: bottom; }
   .dstring { font-size: 9pt; letter-spacing: 1pt; }
   .floor { vertical-align: bottom; padding-top: 0.5mm; }
   .stext { font-size: 8.5pt; font-family: "Times New Roman", serif; vertical-align: bottom; }
   .stext7 { font-size: 7.5pt; font-family: "Times New Roman", serif; vertical-align: bottom; }
</style>
<style type="text/css">
   input { font-family: Arial, sans-serif; font-size: 9pt; color: black; background-color: white; border: 1px solid #333; margin: 8pt 8pt 8pt 0; }
   a { text-decoration: none; color: #555; }
   a:hover { text-decoration: underline; }
   #toolbox { font-family: Arial, sans-serif; font-size: 9pt; border-bottom: dashed 1pt black; margin-bottom: 0; padding: 2mm 0 0 0; text-align: justify; }
   p { margin: 2pt 0 2pt 0; }
</style>
<style type="text/css" media="print">
   #toolbox { display: none; }
</style>
<style type="text/css">
   #toolbox { width: 180mm; margin-left: auto; margin-right: auto; }
   .topmargin { height: 12mm; }
</style>
<br><br><br>
<table class="ramka" cellspacing="0" style="width: 180mm;">
   <tbody>
      <tr>
         <td style="width: 50mm; height: 65mm; border-bottom: black 1.5px solid;">
            <table style="width: 50mm; height: 100%;" cellspacing="0">
               <tbody>
                  <tr>
                     <td class="kassir" style="vertical-align: top; letter-spacing: 0.2em;"><?=Loc::getMessage("NOTICE")?></td>
                  </tr>
                  <tr>
                     <td class="kassir" style="vertical-align: bottom;"><?=Loc::getMessage("CASHIER")?></td>
                  </tr>
               </tbody>
            </table>
         </td>
         <td style="width: 130mm; height: 65mm; padding: 0mm 4mm 0mm 3mm; border-left: black 1.5px solid; border-bottom: black 1.5px solid;">
            <table cellspacing="0" style="width: 123mm; height: 100%;">
               <tbody>
                  <tr>
                     <td>
                        <table width="100%" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td class="stext" style="height: 5mm;">
                                    <img src="/bitrix/components/simai/sf.sale.payment/templates/.default/receipt/sblogo.png" width="120" height="26" alt="<?=Loc::getMessage("SBERBANK_RUSSIA")?>">
                                 </td>
                                 <td class="stext7" style="text-align: right; vertical-align: middle;">
                                    <i><?=Loc::getMessage("FORM_PD_4")?></i>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="vertical-align: bottom;">
                        <table style="width: 100%;" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td class="string"><span class="nowr"><?=COption::GetOptionString($module, "recipient", "")?></span></td>
                                 <td class="string nowr" style="width: 1mm;">&nbsp;<?=Loc::getMessage("KPP")?>:&nbsp;<?=COption::GetOptionString($module, "kpp", "")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td class="subscript nowr"><?=Loc::getMessage("NAME_RECEIVE_PAID")?></td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td width="30%" class="floor">
                                    <table class="cells" cellspacing="0">
                                       <tbody>
                                          <tr>
										   <?foreach($inn as $elem):?>
                                             <td class="cell" style="width: 10%;"><?=$elem?></td>
											<?endforeach;?>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                                 <td width="10%" class="stext7">&nbsp;</td>
                                 <td width="60%" class="floor">
                                    <table class="cells" cellspacing="0">
                                       <tbody>
                                          <tr>
										   <?foreach($bill as $elem):?>
                                             <td class="cell" style="width: 5%;"><?=$elem?></td>
										   <?endforeach;?>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="subscript nowr"><?=Loc::getMessage("INN_RECEIVE_PAID")?></td>
                                 <td class="subscript">&nbsp;</td>
                                 <td class="subscript nowr"><?=Loc::getMessage("BILL_RECEIVE_PAID")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td width="2%" class="stext"><?=Loc::getMessage("IN")?></td>
                                 <td width="64%" class="string"><span class="nowr"><?=COption::GetOptionString($module, "bank", "")?></span></td>
                                 <td width="7%" class="stext" align="right"><?=Loc::getMessage("BIK")?>&nbsp;</td>
                                 <td width="27%" class="floor">
                                    <table class="cells" cellspacing="0">
                                       <tbody>
                                          <tr>
										   <?foreach($bik as $elem):?>
                                             <td class="cell" style="width: 11%;"><?=$elem?></td>
											<?endforeach;?>
                  
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="subscript">&nbsp;</td>
                                 <td class="subscript nowr"><?=Loc::getMessage("BANK_RECEIVE_PAID")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext7 nowr" width="40%"><?=Loc::getMessage("KOR_RECEIVE_PAID")?></td>
                                 <td width="60%" class="floor">
                                    <table class="cells" cellspacing="0">
                                       <tbody>
                                          <tr>
										   <?foreach($ks as $elem):?>
                                             <td class="cell" style="width: 5%;"><?=$elem?></td>
										   <?endforeach;?>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="string" width="55%"><span class="nowr"><?=$arResult["NAME"]?></span></td>
                                 <td class="stext7" width="5%">&nbsp;</td>
                                 <td class="string" width="40%"><span class="nowr"><?=COption::GetOptionString($module, "bill", "")?></span></td>
                              </tr>
                              <tr>
                                 <td class="subscript nowr"><?=Loc::getMessage("NAME_BILL")?></td>
                                 <td class="subscript">&nbsp;</td>
                                 <td class="subscript nowr"><?=Loc::getMessage("NAME_SCORE")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext" width="1%"><?=Loc::getMessage("FIO")?>&nbsp;<?=Loc::getMessage("PAYER")?>&nbsp;</td>
                                 <td class="string"><span class="nowr"><?=$arResult["REQUISITE"]["FIO"]?></span></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext" width="1%"><?=Loc::getMessage("ADDRESS")?>&nbsp;<?=Loc::getMessage("PAYER")?>&nbsp;</td>
                                 <td class="string"><span class="nowr"><?=$arResult["REQUISITE"]["ADDRESS"]?></span></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext" width="1%"><?=Loc::getMessage("SUM")?>&nbsp;<?=Loc::getMessage("PAYMENTS")?>&nbsp;</td>
                                 <td class="string" width="8%"><?=$arResult["SUM"]?></td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("RUB")?>&nbsp;</td>
                                 <td class="string" width="8%">00</td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("KOP")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=Loc::getMessage("SUM")?>&nbsp;<?=Loc::getMessage("PLATI")?>&nbsp;<?=Loc::getMessage("ZA")?>&nbsp;<?=Loc::getMessage("SERVICE")?>&nbsp;</td>
                                 <td class="string" width="8%"></td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("RUB")?>&nbsp;</td>
                                 <td class="string" width="8%">00</td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("KOP")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext" width="5%"><?=Loc::getMessage("ITOGO")?>&nbsp;</td>
                                 <td class="string" width="8%"></td>
                                 <td class="stext" width="5%">&nbsp;<?=Loc::getMessage("RUB")?>&nbsp;</td>
                                 <td class="string" width="8%">00</td>
                                 <td class="stext" width="5%">&nbsp;<?=Loc::getMessage("KOP")?>&nbsp;</td>
                                 <td class="stext" width="20%" align="right">«&nbsp;</td>
                                 <td class="string" width="8%"></td>
                                 <td class="stext" width="1%">&nbsp;»&nbsp;</td>
                                 <td class="string" width="20%"></td>
                                 <td class="stext" width="3%">&nbsp;20&nbsp;</td>
                                 <td class="string" width="5%"><span class="nowr"></span></td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("YEAR")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td class="stext7" style="text-align: justify"><?=Loc::getMessage("S_USLOVIYAMI")?></td>
                  </tr>
                  <tr>
                     <td style="padding-bottom: 0.5mm;">
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext7" width="50%">&nbsp;</td>
                                 <td class="stext7" width="1%"><b><?=Loc::getMessage("SIGN_PAYER")?></b></td>
                                 <td class="string" width="40%">&nbsp;</td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
      <tr>
         <td style="width: 50mm; height: 80mm; vertical-align: bottom;" class="kassir"><?=Loc::getMessage("RECEIPT")?><br><br><?=Loc::getMessage("CASHIER")?></td>
         <td style="width: 130mm; height: 80mm; padding: 0mm 4mm 0mm 3mm; border-left: black 1.5px solid;">
            <table cellspacing="0" style="width: 123mm; height: 100%;">
               <tbody>
                  <tr>
                     <td style="vertical-align: bottom;">
                        <table style="width: 100%; height: 8mm;" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td class="string"><span class="nowr"><?=COption::GetOptionString($module, "recipient", "")?></span></td>
                                 <td class="string nowr" style="width: 1mm;">&nbsp;<?=Loc::getMessage("KPP")?>:&nbsp;<?=COption::GetOptionString($module, "kpp", "")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td class="subscript nowr"><?=Loc::getMessage("NAME_RECEIVE_PAID")?></td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td width="30%" class="floor">
                                    <table class="cells" cellspacing="0">
                                       <tbody>
                                          <tr>
                                             <?foreach($inn as $elem):?>
                                             <td class="cell" style="width: 10%;"><?=$elem?></td>
											<?endforeach;?>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                                 <td width="10%" class="stext7">&nbsp;</td>
                                 <td width="60%" class="floor">
                                    <table class="cells" cellspacing="0">
                                       <tbody>
                                          <tr>
                                            <?foreach($bill as $elem):?>
                                             <td class="cell" style="width: 5%;"><?=$elem?></td>
											<?endforeach;?>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="subscript nowr"><?=Loc::getMessage("INN_RECEIVE_PAID")?></td>
                                 <td class="subscript">&nbsp;</td>
                                 <td class="subscript nowr"><?=Loc::getMessage("BILL_RECEIVE_PAID")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td width="2%" class="stext"><?=Loc::getMessage("IN")?></td>
                                 <td width="64%" class="string"><span class="nowr"><?=COption::GetOptionString($module, "bank", "")?></span></td>
                                 <td width="7%" class="stext" align="right"><?=Loc::getMessage("BIK")?>&nbsp;</td>
                                 <td width="27%" class="floor">
                                    <table class="cells" cellspacing="0">
                                       <tbody>
                                          <tr>
                                            <?foreach($bik as $elem):?>
                                             <td class="cell" style="width: 11%;"><?=$elem?></td>
											<?endforeach;?>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="subscript">&nbsp;</td>
                                 <td class="subscript nowr"><?=Loc::getMessage("BANK_RECEIVE_PAID")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext7 nowr" width="40%"><?=Loc::getMessage("KOR_RECEIVE_PAID")?></td>
                                 <td width="60%" class="floor">
                                    <table class="cells" cellspacing="0">
                                       <tbody>
                                          <tr>
                                            <?foreach($ks as $elem):?>
                                             <td class="cell" style="width: 5%;"><?=$elem?></td>
											<?endforeach;?>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="string" width="55%"><span class="nowr"><?=$arResult["NAME"]?></span></td>
                                 <td class="stext7" width="5%">&nbsp;</td>
                                 <td class="string" width="40%"><span class="nowr"><?=COption::GetOptionString($module, "bill", "")?></span></td>
                              </tr>
                              <tr>
                                 <td class="subscript nowr"><?=Loc::getMessage("NAME_BILL")?></td>
                                 <td class="subscript">&nbsp;</td>
                                 <td class="subscript nowr"><?=Loc::getMessage("NAME_SCORE")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext" width="1%"><?=Loc::getMessage("FIO")?>&nbsp;<?=Loc::getMessage("PAYER")?>&nbsp;</td>
                                 <td class="string"><span class="nowr"><?=$arResult["REQUISITE"]["FIO"]?></span></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext" width="1%"><?=Loc::getMessage("ADDRESS")?>&nbsp;<?=Loc::getMessage("PAYMENTS")?>&nbsp;</td>
                                 <td class="string"><span class="nowr"><?=$arResult["REQUISITE"]["ADDRESS"]?></span></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext" width="1%"><?=Loc::getMessage("SUM")?>&nbsp;<?=Loc::getMessage("PAYMENTS")?>&nbsp;</td>
                                 <td class="string" width="8%"><?=$arResult["SUM"]?></td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("RUB")?>&nbsp;</td>
                                 <td class="string" width="8%">00</td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("KOP")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=Loc::getMessage("SUM")?>&nbsp;<?=Loc::getMessage("PLATI")?>&nbsp;<?=Loc::getMessage("ZA")?>&nbsp;<?=Loc::getMessage("SERVICE")?>&nbsp;</td>
                                 <td class="string" width="8%"></td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("RUB")?>&nbsp;</td>
                                 <td class="string" width="8%">00</td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("KOP")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext" width="5%"><?=Loc::getMessage("ITOGO")?>&nbsp;</td>
                                 <td class="string" width="8%"></td>
                                 <td class="stext" width="5%">&nbsp;<?=Loc::getMessage("RUB")?>&nbsp;</td>
                                 <td class="string" width="8%">00</td>
                                 <td class="stext" width="5%">&nbsp;<?=Loc::getMessage("KOP")?>&nbsp;</td>
                                 <td class="stext" width="20%" align="right">«&nbsp;</td>
                                 <td class="string" width="8%"></td>
                                 <td class="stext" width="1%">&nbsp;»&nbsp;</td>
                                 <td class="string" width="20%"></td>
                                 <td class="stext" width="3%">&nbsp;20&nbsp;</td>
                                 <td class="string" width="5%"><span class="nowr"></span></td>
                                 <td class="stext" width="1%">&nbsp;<?=Loc::getMessage("YEAR")?></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td class="stext7" style="text-align: justify"><?=Loc::getMessage("S_USLOVIYAMI")?></td>
                  </tr>
                  <tr>
                     <td style="padding-bottom: 0.5mm;">
                        <table cellspacing="0" width="100%">
                           <tbody>
                              <tr>
                                 <td class="stext7" width="50%">&nbsp;</td>
                                 <td class="stext7" width="1%"><b><?=Loc::getMessage("SIGN_PAYER")?></b></td>
                                 <td class="string" width="40%">&nbsp;</td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>