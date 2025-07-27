<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="mb-25" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	
		<h4 class="mb-10"><?=$arItem["~NAME"]?></h4>
		
		<?if($arItem["~DETAIL_TEXT"]!=""):?>
			<div class="mb-15">
			<?=$arItem["~DETAIL_TEXT"]?>
			</div>
		<?endif;?>
		<!-- документы -->
		
		
		 <div class="doc-list">
			<?foreach($arItem["PROPERTIES"]["DOCS"]["VALUE"] as $doc):?>
			
			<?
			  $arDoc = $arResult["DOCS"][$doc];
			?>
			
			<div class="row mb-20">

				<div class="col-xs-2 col-md-1 text-right">
					<i class="fa fa-<?=$arDoc["ICON"]["TYPE"]?> fa-3x mt-5" style="color:<?=$arDoc["ICON"]["COLOR"]?>"></i>
				</div>
				<div class="col-xs-10 col-md-11">
					<h3 class="section-title">
						<a target="_blank" href="https://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?><?= $arDoc["DOC_SRC"]?>" class="not-accent"><?=$arDoc["NAME"]?></a>
					</h3>
					<div class="mt-0 mb-5">
						<i class="fa fa-download c-base"></i> <a target="_blank" href="<?=$arDoc["DOC_SRC"]?>" class="link_underline"> <?=getMessage("DOWNLOAD")?></a> <?if($arDoc["DOC_SIZE"]):?>(<?=getMessage("SIZE")?> <?=$arDoc["DOC_SIZE"]?> Kb)&nbsp;<?endif?>
						<?if(SITE_SERVER_NAME):?> 
							<i class="fa fa-external-link c-base" aria-hidden="true"></i> <a  target="_blank" class="various download-link link_underline" href="https://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?><?= $arDoc["DOC_SRC"]?>"><?=getMessage("VIEW")?></a>
						<?endif?>
					 
					 
						<?if($arDoc["PROPERTIES"]["SHOW_SIGN"]["VALUE_XML_ID"] == "Y"):?>
									<!-- Button trigger modal -->
								<a style="margin-left:7px" data-toggle="modal" data-target="#signatureModal<?=$arDoc['ID']?>"><i class="fa fa-pencil-square-o" ></i> <?=getMessage("ECP")?></a>
									<!-- modal -->
									<div class="modal fade" id="signatureModal<?=$arDoc['ID']?>" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel<?=$arDoc['ID']?>" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" style="display:inline-block;" id="signatureModalLabel<?=$arDoc['ID']?>">
													 <?if(!empty($arDoc['PROPERTIES']['SIGNATURE_FILE']['CONTENT']) && !empty($idCert = $arDoc['PROPERTIES']['CERTIFICATE']['VALUE'])):?>
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
												 <?if(!empty($arDoc['PROPERTIES']['SIGNATURE_FILE']['CONTENT']) && !empty($idCert = $arDoc['PROPERTIES']['CERTIFICATE']['VALUE'])):?>
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
														<div class="col-md-4"><?= $arDoc['PROPERTIES']['DATE_SIGNED']['VALUE'] ?></div>
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
															<p><a class="" data-toggle="collapse" href="#collapseExample<?=$arDoc['ID']?>" role="button" aria-expanded="false" aria-controls="collapseExample<?=$arDoc['ID']?>"><?=getMessage("VIEW_SIGN")?></a></p>
															<div class="collapse" id="collapseExample<?=$arDoc['ID']?>">
																<div class="card card-body">
																	<textarea class="toggleSign displayBlock" rows="5" cols="75" style="border-radius: 0; border-width: 1px"><?=$arDoc['PROPERTIES']['SIGNATURE_FILE']['CONTENT']?></textarea>
																</div>
															</div>
														</div>
													</div>
													<?else:?>
													
													 <div class="row">
														 <div class="col-md-2"><p class="text-muted"><?=getMessage("SIGNED")?></p></div><div class="col-md-4"><?=$arResult["USER"][$arDoc["CREATED_BY"]]["NAME"]?></div>
													 </div>
													  <div class="row">
														 <div class="col-md-2"><p class="text-muted"><?=getMessage("WORK_POSITION")?></p></div><div class="col-md-4"><?=$arResult["USER"][$arDoc["CREATED_BY"]]["WORK_POSITION"]?></div>
													 </div>
													 
													 <div class="row">
														<div class="col-md-2"><p class="text-muted"><?=getMessage("DATE_CREATE")?></p></div>
														<div class="col-md-4">
														  <?if($arDoc['PROPERTIES']['DATE_SIGNED']['VALUE']):?>
															 <?=$arDoc['PROPERTIES']['DATE_SIGNED']['VALUE']?>
														  <?else:?>
															<?=date("d.m.Y H:i",strtotime($arDoc["DATE_CREATE"]))?>
														  <?endif;?>
														</div>
													 </div>
													 
													 
													 
													 
													 <?if(intval($arDoc["PROPERTIES"]["FILE"]["VALUE"])):?>
													 <div class="row">
														<div class="col-md-12">
															<p><a class="" data-toggle="collapse" href="#collapseExample<?=$arDoc['ID']?>" role="button" aria-expanded="false" aria-controls="collapseExample<?=$arDoc['ID']?>"><?=getMessage("VIEW_SIGN")?></a></p>
															<div class="collapse" id="collapseExample<?=$arDoc['ID']?>">
																<div class="card card-body">
																	<textarea class="toggleSign displayBlock" rows="5" cols="75" style="border-radius: 0; border-width: 1px"><?=$arDoc["CREATED_BY"]?><?=strtotime($arDoc["DATE_CREATE"])?><?=hash_file('md5',$_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arDoc["PROPERTIES"]["FILE"]["VALUE"]))?></textarea>
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
				</div>
			</div>
			<?endforeach?>
		</div>
		
		
		
		
	</div>	
<?endforeach;?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
