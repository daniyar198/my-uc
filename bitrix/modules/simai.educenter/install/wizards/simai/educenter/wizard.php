<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/install/wizard_sol/wizard.php");

class SelectSiteStep extends CSelectSiteWizardStep
{
	function InitStep()
	{
		parent::InitStep();

		$wizard =& $this->GetWizard();
		$wizard->solutionName = "simai_educenter";
	}
}


class SelectTemplateStep extends CSelectTemplateWizardStep
{
	function InitStep()
	{
		$this->SetStepID("select_template");
		$this->SetTitle(GetMessage("SELECT_TEMPLATE_TITLE"));
		$this->SetSubTitle(GetMessage("SELECT_TEMPLATE_SUBTITLE"));
		$this->SetNextStep("select_theme");
		$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
	}

	function OnPostForm()
	{
		$wizard =& $this->GetWizard();
		
		if ($wizard->IsNextButtonClick())
		{
			$arTemplates = array("simai.educenter");

			$templateID = $wizard->GetVar("templateID");

			if (!in_array($templateID, $arTemplates))
				$this->SetError(GetMessage("wiz_template"));

		}
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
			
		$arTemplateOrder = array("simai.educenter");

		$defaultTemplateID = COption::GetOptionString("simai.educenter", "templateID", "simai.educenter");
		if (!in_array($defaultTemplateID, array("simai.educenter"))) 
			$defaultTemplateID = "simai.educenter";
		$wizard->SetDefaultVar("templateID", $defaultTemplateID);

		$arTemplateInfo = array(
			"simai.educenter" => array(
				"NAME" => GetMessage("WIZ_TEMPLATE_1"),
				"DESCRIPTION" => "",
				"PREVIEW" => $wizard->GetPath()."/site/templates/simai.educenter/lang/".LANGUAGE_ID."/preview.png",
				"SCREENSHOT" => $wizard->GetPath()."/site/templates/simai.educenter/lang/".LANGUAGE_ID."/screen.png",
			)
		);

		global $SHOWIMAGEFIRST;
		$SHOWIMAGEFIRST = true;

		$this->content .= '<div class="inst-template-list-block">';
		foreach ($arTemplateOrder as $templateID)
		{
			$arTemplate = $arTemplateInfo[$templateID];

			if (!$arTemplate)
				continue;

			$this->content .= '<div class="inst-template-description">';
			$this->content .= $this->ShowRadioField("templateID", $templateID, Array("id" => $templateID, "class" => "inst-template-list-inp"));

			global $SHOWIMAGEFIRST;
			$SHOWIMAGEFIRST = true;

			if ($arTemplate["SCREENSHOT"] && $arTemplate["PREVIEW"])
				$this->content .= CFile::Show2Images($arTemplate["PREVIEW"], $arTemplate["SCREENSHOT"], 218, 150, ' class="inst-template-list-img"');
			else
				$this->content .= CFile::ShowImage($arTemplate["SCREENSHOT"], 218, 150, ' class="inst-template-list-img"', "", true);

			$this->content .= '<label for="'.$templateID.'" class="inst-template-list-label">'.$arTemplate["NAME"]."</label>";
			$this->content .= "</div>";
		}

		$this->content .= "</div>";
		$this->content .= '<script>
			function ImgShw(ID, width, height, alt)
			{
				var scroll = "no";
				var top=0, left=0;
				if(width > screen.width-10 || height > screen.height-28) scroll = "yes";
				if(height < screen.height-28) top = Math.floor((screen.height - height)/2-14);
				if(width < screen.width-10) left = Math.floor((screen.width - width)/2-5);
				width = Math.min(width, screen.width-10);
				height = Math.min(height, screen.height-28);
				var wnd = window.open("","","scrollbars="+scroll+",resizable=yes,width="+width+",height="+height+",left="+left+",top="+top);
				wnd.document.write(
					"<html><head>"+
						"<"+"script type=\"text/javascript\">"+
						"function KeyPress()"+
						"{"+
						"	if(window.event.keyCode == 27) "+
						"		window.close();"+
						"}"+
						"</"+"script>"+
						"<title></title></head>"+
						"<body topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\" onKeyPress=\"KeyPress()\">"+
						"<img src=\""+ID+"\" border=\"0\" alt=\""+alt+"\" />"+
						"</body></html>"
				);
				wnd.document.close();
			}
			window.onload=function(){document.getElementsByName("StepNext")[0].click();}
		</script>';
	}
}

class SelectThemeStep extends CSelectThemeWizardStep
{
	function InitStep()
	{
		$this->SetStepID("select_theme");
		$this->SetTitle(GetMessage("SELECT_THEME_TITLE"));
		$this->SetSubTitle(GetMessage("SELECT_THEME_SUBTITLE"));
		$this->SetPrevStep("select_template");
		$this->SetPrevCaption(GetMessage("PREV_BUTTON"));
		$this->SetNextStep("site_settings");
		$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
	}

	function OnPostForm()
	{			
	}
	
    function ShowStep()
    {
		$wizard =& $this->GetWizard();
        $wizardPath = $wizard->GetPath();
		$templateID = $wizard->GetVar("templateID");
        $wizardTemplatePath = $wizardPath."/site/templates/".$templateID;		
		
		@include_once($_SERVER["DOCUMENT_ROOT"].$wizardTemplatePath."/wizard_template_options.php");

		COption::SetOptionString("simai.educenter", "address", GetMessage("WIZ_COMPANY_ADDRESS"));
		COption::SetOptionString("simai.educenter", "backcolorpicker", '#f7f7f7');
		COption::SetOptionString("simai.educenter", "background", 'body-bg-11');
		COption::SetOptionString("simai.educenter", "backgroundMode", 'Y');
		COption::SetOptionString("simai.educenter", "bottom", ' ');
		COption::SetOptionString("simai.educenter", "boxed", '0');
		COption::SetOptionString("simai.educenter", "colorMode", '');
		COption::SetOptionString("simai.educenter", "copyright", GetMessage("WIZ_COMPANY_COPY"));
		COption::SetOptionString("simai.educenter", "email", 'mail@simai.ru');
		COption::SetOptionString("simai.educenter", "fb_address", '');
		COption::SetOptionString("simai.educenter", "fb_widget", 'N');
		COption::SetOptionString("simai.educenter", "font-size", '16px');
		COption::SetOptionString("simai.educenter", "footer", 'footer-bg-54');
		COption::SetOptionString("simai.educenter", "footercolorpicker", '#2C3944');
		COption::SetOptionString("simai.educenter", "footerlayout", 'repeat');
		COption::SetOptionString("simai.educenter", "footerMode", '');
		COption::SetOptionString("simai.educenter", "footerpath", '');
		COption::SetOptionString("simai.educenter", "header", 'header-bg-34');
		COption::SetOptionString("simai.educenter", "headercolorpicker", '#671513');
		COption::SetOptionString("simai.educenter", "headerlayout", 'no-repeat');
		COption::SetOptionString("simai.educenter", "headerMode", 'EMPTY');
		COption::SetOptionString("simai.educenter", "headerpath", WIZARD_SITE_DIR.'images/bg/header/blackboard.jpg');
		COption::SetOptionString("simai.educenter", "ins_address", 'https://www.instagram.com/websimai/');
		COption::SetOptionString("simai.educenter", "lat", '54.72945925333306');
		COption::SetOptionString("simai.educenter", "layout", 'repeat');
		COption::SetOptionString("simai.educenter", "left_column", '4');
		COption::SetOptionString("simai.educenter", "lng", '55.94140330329538');
		COption::SetOptionString("simai.educenter", "logo", WIZARD_SITE_DIR.'images/logo/site_logo_2.png');
		COption::SetOptionString("simai.educenter", "main_style", '');
		COption::SetOptionString("simai.educenter", "map", '');
		COption::SetOptionString("simai.educenter", "ok_address", 'https://ok.ru/group/57919250497588');
		COption::SetOptionString("simai.educenter", "ok_id", '57919250497588');
		COption::SetOptionString("simai.educenter", "ok_widget", 'Y');
		COption::SetOptionString("simai.educenter", "organization", GetMessage("WIZ_COMPANY_NAME"));
		COption::SetOptionString("simai.educenter", "pastepicker", '#ff3d00');
		COption::SetOptionString("simai.educenter", "path", '');
		COption::SetOptionString("simai.educenter", "phone", '+7 (347) 246-85-00');
		COption::SetOptionString("simai.educenter", "private_key", '');
		COption::SetOptionString("simai.educenter", "public_key", '');
		COption::SetOptionString("simai.educenter", "right_column", '4');
		COption::SetOptionString("simai.educenter", "top", '');
		COption::SetOptionString("simai.educenter", "tw_address", 'https://twitter.com/simai_studio');
		COption::SetOptionString("simai.educenter", "tw_widget", 'Y');
		COption::SetOptionString("simai.educenter", "typepicker", '#0288d1');
		COption::SetOptionString("simai.educenter", "use_google_captcha", 'N');
		COption::SetOptionString("simai.educenter", "use_settings", '');
		COption::SetOptionString("simai.educenter", "vk_address", 'http://vk.com/club10264360');
		COption::SetOptionString("simai.educenter", "vk_id", '10264360');
		COption::SetOptionString("simai.educenter", "vk_widget", 'Y');
		
		
		$this->content .= '<script>
			window.onload=function(){document.getElementsByName("StepNext")[0].click();}
		</script>';
    }	
}

class SiteSettingsStep extends CSiteSettingsWizardStep
{
	function InitStep()
	{
		$this->SetStepID("site_settings");
		$this->SetTitle(GetMessage("SITE_SETTINGS_TITLE"));
		$this->SetSubTitle(GetMessage("SITE_SETTINGS_SUBTITLE"));
		$this->SetNextStep("data_install");
		$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
	
		$wizard =& $this->GetWizard();
		$wizard->solutionName = "simai_educenter";
		parent::InitStep();

		$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
		$this->SetTitle(GetMessage("WIZ_STEP_SITE_SET"));

		$siteID = $wizard->GetVar("siteID");
		
		$templateID = $wizard->GetVar("templateID");
		
		$wizard->SetDefaultVars(Array("siteNameSet" => true));

		$wizard->SetDefaultVars(
			Array(
				"siteInstallPublic" => COption::GetOptionString("simai.educenter", "siteInstallPublic", "Y"),
				"siteInstallDD" => COption::GetOptionString("simai.educenter", "siteInstallDD", "Y"),
			)
		);		
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		$this->content .= '
		<div class="wizard-metadata-title">'.GetMessage("wiz_public_files").'</div>';
		
		$this->content .= '
		<div class="wizard-input-form-block">
			'.$this->ShowCheckboxField(
						"siteInstallPublic", 
						"Y", 
						($wizard->GetVar("siteInstallPublic") == "Y" ? 
							array("id" => "siteInstallPublic", "checked" => "checked") : array("id" => "siteInstallPublic")
						)
					).'
			<label for="siteInstallPublic">'.GetMessage("wiz_public_files_install").'</label>
		</div>';
		
		$this->content .= '
		<div class="wizard-metadata-title">'.GetMessage("wiz_demo_data").'</div>';
		
		$this->content .= '
		<div class="wizard-input-form-block">
			'.$this->ShowCheckboxField(
						"siteInstallDD", 
						"Y", 
						($wizard->GetVar("siteInstallDD") == "Y" ? 
							array("id" => "siteInstallDD", "checked" => "checked") : array("id" => "siteInstallDD")
						)
					).'
			<label for="siteInstallDD">'.GetMessage("wiz_demo_data_install").'</label>
		</div>';
		
		$this->content .= '</div>';
	}
	function OnPostForm()
	{
		$wizard =& $this->GetWizard();
		$res = $this->SaveFile("siteLogo", Array("extensions" => "gif,jpg,jpeg,png", "max_height" => 60, "max_width" => 280, "make_preview" => "Y"));
	}
}

class DataInstallStep extends CDataInstallWizardStep
{
	
}

class FinishStep extends CFinishWizardStep
{
	function InitStep()
	{
		$this->SetStepID("finish");
		$this->SetNextStep("finish");
		$this->SetTitle(GetMessage("FINISH_STEP_TITLE"));
		$this->SetNextCaption(GetMessage("wiz_go"));  
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();		   
		if ($wizard->GetVar("proactive") == "Y")
			COption::SetOptionString("statistic", "DEFENCE_ON", "Y");
		
		$siteID = WizardServices::GetCurrentSiteID($wizard->GetVar("siteID"));
		$rsSites = CSite::GetByID($siteID);
		$siteDir = "/"; 
		if ($arSite = $rsSites->Fetch())
			$siteDir = $arSite["DIR"]; 

		$wizard->SetFormActionScript(str_replace("//", "/", "/bitrix/admin/settings.php?lang=ru&mid=simai.educenter&mid_menu=1"));

		$this->CreateNewIndex();
		
		COption::SetOptionString("main", "wizard_solution", $wizard->solutionName, false, $siteID);

		$this->content .=
			'<table class="wizard-completion-table">
				<tr>
					<td class="wizard-completion-cell">'
						.GetMessage("FINISH_STEP_CONTENT").
					'</td>
				</tr>
			</table>';	
		if ($wizard->GetVar("installDemoData") == "Y")
			$this->content .= GetMessage("FINISH_STEP_REINDEX");		
			
		
	}

}
?>