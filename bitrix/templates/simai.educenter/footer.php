<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>

<?if($GLOBALS["show_left_column"] || $GLOBALS["show_right_column"]):?>
	</div>
<?endif;?>

<?if($GLOBALS["show_right_column"]):?>
	<div class="col-md-<?=$GLOBALS["right_column_width"]?>">
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "page","AREA_FILE_SUFFIX" => "right_inc","AREA_FILE_RECURSIVE" => "N","EDIT_MODE" => "html","EDIT_TEMPLATE" => "page_right_inc.php"));?> 
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "sect","AREA_FILE_SUFFIX" => "right_inc","AREA_FILE_RECURSIVE" => "Y","EDIT_MODE" => "html","EDIT_TEMPLATE" => "sect_right_inc.php"));?>		
	<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "page","AREA_FILE_SUFFIX" => "inc","AREA_FILE_RECURSIVE" => "N","EDIT_MODE" => "html","EDIT_TEMPLATE" => "page_inc.php"));?>
	<?$APPLICATION->IncludeComponent("bitrix:main.include",".default",Array("AREA_FILE_SHOW" => "sect","AREA_FILE_SUFFIX" => "inc","AREA_FILE_RECURSIVE" => "Y","EDIT_TEMPLATE" => "sect_inc.php"),false);?>
	</div>
<?endif;?>

<?if($GLOBALS["show_left_column"] || $GLOBALS["show_right_column"]):?>
	</div>
<?endif;?>

</div>
</div>
</section>

<?$APPLICATION->IncludeComponent("simai:template.footer",$GLOBALS["moduleName"],Array());?>
<?$APPLICATION->IncludeComponent("simai:feedback.error",".default",array("IBLOCK_ID" => "44","IBLOCK_TYPE" => "forms","COMPONENT_TEMPLATE" => ".default"),false);?>

</div>
<script>
	$(function(){
		$("#layerslider").layerSlider({
			pauseOnHover: true,
			autoPlayVideos: false,
			skinsPath: '/bitrix/templates/<?=$GLOBALS["moduleName"]?>/framework/include/02_assets/layerslider/_skins/',
			responsive: true,
			responsiveUnder: 1920,
			layersContainer: 1920,
			skin: 'fullwidth',
			hoverPrevNext: true,
			thumbnailNavigation: 'disabled',
			navButtons: true,
			imgPreload: false,
			showBarTimer : false,
			showCircleTimer : false,
			navStartStop: false
		});
	});
</script>
<div class="sf-service-bottom-area">
<div class="sf-modal-container"></div></div>
<?=COption::GetOptionString($GLOBALS["moduleName"], "bottom", "");?>
</body>
</html>