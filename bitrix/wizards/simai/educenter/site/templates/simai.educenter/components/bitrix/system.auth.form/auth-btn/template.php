<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["FORM_TYPE"] == "login"):?>

    <?if ($arResult["SHOW_ERRORS"] == "Y" && $arResult["ERROR"] === true):?>
        <!-- <span class="errortext"><?=(is_array($arResult["ERROR_MESSAGE"]) ? $arResult["ERROR_MESSAGE"]["MESSAGE"] : $arResult["ERROR_MESSAGE"])?></span> -->
    <?endif?>

    <li id="cache_auth_container" class="aux-languages dropdown animate-hover" data-animate="animated fadeInUp">
        <a href="<?=SITE_DIR?>auth/" class="btn btn-b-white"><?=GetMessage("AUTH_LOGIN_BUTTON")?></a>
        <?$frame = $this->createFrame("cache_auth_container")->begin();?>

        <?$frame->end();?>
    </li>

<?else:

    $isNTLM = false;
    if (COption::GetOptionString("ldap", "use_ntlm", "N") == "Y")
    {
        $ntlm_varname = trim(COption::GetOptionString("ldap", "ntlm_varname", "REMOTE_USER"));
        if (array_key_exists($ntlm_varname, $_SERVER) && strlen($_SERVER[$ntlm_varname]) > 0)
            $isNTLM = true;
    }

    $params = DeleteParam(array("logout", "login", "back_url_pub"));
    $logoutUrl = $APPLICATION->GetCurPage()."?logout=yes".htmlspecialchars($params == ""? "":"&".$params);
    ?>
    <li class="aux-languages">
        <a href="<?=$logoutUrl?>" class="btn btn-b-white" style="padding: 10px 15px;">
            <span class="language"><?=GetMessage("AUTH_LOGOUT_BUTTON")?></span>
        </a>
    </li>

<?endif?>