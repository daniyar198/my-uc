<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->setFrameMode(true);?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	IncludeTemplateLangFile(__FILE__);
	?>
<footer class="footer <?=$arResult["style_template"]?>" <?=$arResult["styleBackground"]?>>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="col">
					<div class="contacts">
						<h4><?=getMessage("CONTACT_US")?></h4>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", 
							".default", 
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "",
								"AREA_FILE_RECURSIVE" => "",
								"EDIT_MODE" => "",
								"EDIT_TEMPLATE" => "",
								"PATH" => SITE_DIR."include/footer_contacts.php",
								"COMPONENT_TEMPLATE" => ".default"
							),
							false
							);?>
					</div>
					<div class="informer">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="col">
					<h4><?=getMessage("SECTIONS")?></h4>
					<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom", 
	array(
		"ROOT_MENU_TYPE" => "bottom",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "bottom"
	),
	false
);?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="col col-social-icons">
					<h4><?=getMessage("FOLLOW_US")?></h4>
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include", 
						".default", 
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "",
							"AREA_FILE_RECURSIVE" => "",
							"EDIT_MODE" => "",
							"EDIT_TEMPLATE" => "",
							"PATH" => SITE_DIR."include/footer_follow.php",
							"COMPONENT_TEMPLATE" => ".default"
						),
						false
						);?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="col">
					<h4><?=getMessage("FEED_BACK")?></h4>
					<p><?=getMessage("FEED_BACK_TEXT")?>
						<br><br>
						<a class="btn btn-block btn-base" href="<?=SITE_DIR?>contacts/" class="btn btn-two"><span><?=getMessage("FEED_BACK_BUTTON")?></span></a>
					</p>
				</div>
			</div>
		</div>
		<hr>
		<div class="row bottom-row">
			<div class="col-lg-5 copyright">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include", 
					".default", 
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/footer_copyright.php",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
						"COMPONENT_TEMPLATE" => ".default",
						"EDIT_TEMPLATE" => ""
					),
					false,
					array(
						"HIDE_ICONS" => "N"
					)
					);?>
			</div>
			<div id="bx-composite-banner" style="text-align: center;" class="col-lg-3 footer-logo"></div>
			<div class="col-lg-4 developer">
				<?/*?><a target="_blank" class="pull-right" href="https://simai.studio/landing/educenter/"><?=getMessage("SIMAI_WORK")?></a><?*/?>
			</div>
		</div>
	</div>
	<?if($GLOBALS["demo"]==true):?>
	<script data-skip-moving="true"> 
	(function(w,d,u,b){ 
	s=d.createElement('script');r=1*new Date();s.async=1;s.src=u+'?'+r; 
	h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h); 
	})(window,document,'https://portal.simai.ru/upload/crm/site_button/loader_1_dd0iaf.js'); 
	</script>
	<?endif;?>
</footer>