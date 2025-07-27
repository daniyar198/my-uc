<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$countItems=count($arResult["ITEMS"]);
if($countItems<1 && !$arResult["DESCRIPTION"])return;?>
<?if($arResult["DESCRIPTION"]):?>
<p><?=$arResult["DESCRIPTION"]?></p>
<?endif?>

<script>
$(document).ready(function() {
	$(".f-g").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
    <div class="doc-list">
    <?foreach($arResult["ITEMS"] as $cell=>$arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], 
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], 
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), 
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="row mb-20">
        
        <div class="col-xs-1 text-center">
        <?if($arItem['PROPERTIES']['LINKS_FILE']['VALUE']):?>
            <i class="fa fa-file fa-3x" style="color:#607D8B"></i>
        <?else:?>
            <i class="fa fa-<?=$arItem["ICON"]["TYPE"]?> fa-3x" style="color:<?=$arItem["ICON"]["COLOR"]?>"></i>
        <?endif?>
        </div>
        <div class="col-xs-11">
            <?if($arItem['PROPERTIES']['LINKS_FILE']['VALUE']):?>
                <h4 class="section-title no-border-header-doc">
                    <a target="_blank"
                        href="<?=$arItem['PROPERTIES']['LINKS_FILE']['VALUE']?>" 
                        class="link_underline dark">
                            <?=$arItem["NAME"]?>
                    </a>
                </h4>
                <p><?=$arItem["~PREVIEW_TEXT"]?></p>
                <div class="mt-5 mb-20">
                    
                    <?if(SITE_SERVER_NAME):?> 
                        <i class="fa fa-external-link c-base" aria-hidden="true"></i>
                        <a  target="_blank" class="various download-link link_underline" 
                        href="<?=$arItem['PROPERTIES']['LINKS_FILE']['VALUE']?>"><?=getMessage("VIEW")?></a>
                    <?endif?>
                </div>
            <?else:?>
                <h4 class="section-title no-border-header-doc">
                    <a target="_blank"
                        href="https://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?>
                        <?= $arItem["DOC_SRC"]?>" 
                        class="link_underline dark">
                            <?=$arItem["NAME"]?>
                    </a>
                </h4>
                <p><?=$arItem["~PREVIEW_TEXT"]?></p>
                
                <div class="mt-0 mb-5">
                    <i class="fa fa-download c-base"></i>
                    <a target="_blank" href="<?=$arItem["DOC_SRC"]?>" class="link_underline"> <?=getMessage("DOWNLOAD")?></a> 
                    <?if($arItem["DOC_SIZE"]):?>
                        (<?=getMessage("SIZE")?> <?=$arItem["DOC_SIZE"]?> Kb)&nbsp;
                    <?endif?>
                    <?if(SITE_SERVER_NAME):?> 
                        <i class="fa fa-external-link c-base" aria-hidden="true"></i>
                        <?$typeFile = $arItem["TYPE"];?>
                        <?if(($typeFile == "jpg") || ($typeFile == 'jpeg') || ($typeFile == 'bmp') || ($typeFile == 'png') || ($typeFile == 'gif')):?>
                            <a class="f-g" rel="group" href="<?=$arItem["DOC_SRC"]?>">
                                <img src="<?=$arItem["DOC_SRC"]?>" style="display: none"/>
                                <?=getMessage("VIEW")?>
                            </a>
                        <?else:?>
                            <a target="_blank" 
                                class="various download-link link_underline" 
                                href="https://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?><?=$arItem["DOC_SRC"]?>">
                                    <?=getMessage("VIEW")?>
                            </a>
                        <?endif?>
                    <?endif?>
					
					<?if($arItem["PROPERTIES"]["SHOW_SIGN"]["VALUE_XML_ID"] == "Y"):?>
                            <!-- Button trigger modal -->
                        <a style="margin-left:7px" data-toggle="modal" data-target="#signatureModal<?=$arItem['ID']?>"><i class="fa fa-pencil-square-o" ></i> <?=getMessage("ECP")?></a>
                            <!-- modal -->
                            <div class="modal fade" id="signatureModal<?=$arItem['ID']?>" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel<?=$arItem['ID']?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="display:inline-block;" id="signatureModalLabel<?=$arItem['ID']?>">
											 <?if(!empty($arItem['PROPERTIES']['SIGNATURE_FILE']['CONTENT']) && !empty($idCert = $arItem['PROPERTIES']['CERTIFICATE']['VALUE'])):?>
											   <?=getMessage("DOCUMENT_SIGN_QUALIFICATION")?>
											 <?else:?>
											   <?=getMessage("DOCUMENT_SIGN_SIMPLE")?>
											 <?endif;?>
											</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body container">
										 <?if(!empty($arItem['PROPERTIES']['SIGNATURE_FILE']['CONTENT']) && !empty($idCert = $arItem['PROPERTIES']['CERTIFICATE']['VALUE'])):?>
                                            <div class="row">
                                                <div class="col-md-2"><p class="text-muted"><?=getMessage("SIGNED")?></p></div><div class="col-md-4"><?= $arResult['CERTIFICATES'][$idCert]['NAME']?></div>
                                            </div>
											 <div class="row">
                                                <div class="col-md-2"><p class="text-muted"><?=getMessage("WORK_POSITION")?></p></div>
                                                <div class="col-md-4"><?= $arResult['CERTIFICATES'][$idCert]['PROPERTY_WORK_POSITION_VALUE']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2"><p class="text-muted"><?=getMessage("ORGANIZATION")?></p></div>
                                                <div class="col-md-4"><?= $arResult['CERTIFICATES'][$idCert]['PROPERTY_ORGANIZATION_VALUE']?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2"><p class="text-muted"><?=getMessage("DATE_CREATE")?></p></div>
                                                <div class="col-md-4"><?= $arItem['PROPERTIES']['DATE_SIGNED']['VALUE'] ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2"><p class="text-muted"><?=getMessage("CERTIFICATE")?></p></div>
                                                <div class="col-md-4"><?= $arResult['CERTIFICATES'][$idCert]['PROPERTY_SERIAL_VALUE'] ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2"><p class="text-muted"><?=getMessage("ISSUED_BY")?></p></div>
                                                <div class="col-md-4"><?= $arResult['CERTIFICATES'][$idCert]['PROPERTY_RELEASED_BY_VALUE'] ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2"><p class="text-muted"><?=getMessage("PERIOD_ACT_CERTIFICATE")?></p></div>
                                                <div class="col-md-4"><?= $arResult['CERTIFICATES'][$idCert]['PROPERTY_DATE_VALIDITY_BEGIN_VALUE'] ?> - <?= $arResult['CERTIFICATES'][$idCert]['PROPERTY_DATE_VALIDITY_END_VALUE'] ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><a class="" data-toggle="collapse" href="#collapseExample<?=$arItem['ID']?>" role="button" aria-expanded="false" aria-controls="collapseExample<?=$arItem['ID']?>"><?=getMessage("VIEW_SIGN")?></a></p>
                                                    <div class="collapse" id="collapseExample<?=$arItem['ID']?>">
                                                        <div class="card card-body">
                                                            <textarea class="toggleSign displayBlock" rows="5" cols="75" style="border-radius: 0; border-width: 1px"><?=$arItem['PROPERTIES']['SIGNATURE_FILE']['CONTENT']?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<?else:?>
											
											 <div class="row">
                                                 <div class="col-md-2"><p class="text-muted"><?=getMessage("SIGNED")?></p></div><div class="col-md-4"><?=$arResult["USER"][$arItem["CREATED_BY"]]["NAME"]?></div>
                                             </div>
											  <div class="row">
                                                 <div class="col-md-2"><p class="text-muted"><?=getMessage("WORK_POSITION")?></p></div><div class="col-md-4"><?=$arResult["USER"][$arItem["CREATED_BY"]]["WORK_POSITION"]?></div>
                                             </div>
											 
                                             <div class="row">
                                                <div class="col-md-2"><p class="text-muted"><?=getMessage("DATE_CREATE")?></p></div>
                                                <div class="col-md-4">
												  <?if($arItem['PROPERTIES']['DATE_SIGNED']['VALUE']):?>
												     <?=$arItem['PROPERTIES']['DATE_SIGNED']['VALUE']?>
												  <?else:?>
												    <?=date("d.m.Y H:i",strtotime($arItem["DATE_CREATE"]))?>
												  <?endif;?>
												</div>
                                             </div>
											 
											 
											 
											 
											 <?if(intval($arItem["PROPERTIES"]["FILE"]["VALUE"])):?>
											 <div class="row">
                                                <div class="col-md-12">
                                                    <p><a class="" data-toggle="collapse" href="#collapseExample<?=$arItem['ID']?>" role="button" aria-expanded="false" aria-controls="collapseExample<?=$arItem['ID']?>"><?=getMessage("VIEW_SIGN")?></a></p>
                                                    <div class="collapse" id="collapseExample<?=$arItem['ID']?>">
                                                        <div class="card card-body">
                                                            <textarea class="toggleSign displayBlock" rows="5" cols="75" style="border-radius: 0; border-width: 1px"><?=$arItem["CREATED_BY"]?><?=strtotime($arItem["DATE_CREATE"])?><?=hash_file('md5',$_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"]))?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
										    <?endif;?>
											
											<?endif;?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal"><?=getMessage("CLOSE")?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal-->
                        <?endif ?>
                </div>   
            <?endif?>  
						
        </div>
		
		 
    </div>
    <?endforeach?>
</div>
<?=$arResult["NAV_STRING"]?>