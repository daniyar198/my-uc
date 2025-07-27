<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["FORM_TYPE"] == "login"):?>

    <?if ($arResult["SHOW_ERRORS"] == "Y" && $arResult["ERROR"] === true):?>
        <span class="errortext"><?=(is_array($arResult["ERROR_MESSAGE"]) ? $arResult["ERROR_MESSAGE"]["MESSAGE"] : $arResult["ERROR_MESSAGE"])?></span>
    <?endif?>

    <li id="cache_auth_container" class="aux-languages dropdown animate-hover" data-animate="animated fadeInUp">
        <a href="/auth/" class="btn btn-b-white"><?=GetMessage("AUTH_LOGIN_BUTTON")?></a>
        <?$frame = $this->createFrame("cache_auth_container")->begin();?>
        <ul class="sub-menu animate-wr">
            <li>
                <div class="pop-auth-form">
                    <form method="post" target="_top" role="form" action="<?=$arResult["AUTH_URL"]?>">
                        <?if (strlen($arResult["BACKURL"]) > 0):?>
                            <input type='hidden' name='backurl' value='<?=$arResult["BACKURL"]?>' />
                        <?endif?>
                        <?foreach ($arResult["POST"] as $key => $value):?>
                            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                        <?endforeach?>
                        <input type="hidden" name="AUTH_FORM" value="Y" />
                        <input type="hidden" name="TYPE" value="AUTH" />
                        <div class="form-group">
                            <label class="sr-only" for="auth-user-login"><?=GetMessage("AUTH_LOGIN")?></label>
                            <input type="text" name="USER_LOGIN" id="auth-user-login" value="<?=$arResult["USER_LOGIN"]?>" class="form-control" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="auth-user-login"><?=GetMessage("AUTH_PASSWORD")?></label>
                            <input type="password" name="USER_PASSWORD" class="form-control" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
                        </div>
                        <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" checked="checked" /><?=GetMessage("AUTH_REMEMBER_ME")?>
                                </label>
                            </div>
                        <?endif?>
                        <?if ($arResult["CAPTCHA_CODE"]):?>
                            <div class="form-group">
                                <label class="sr-only"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></label>
                                <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
                                <input type="text" placeholder="<?=GetMessage("AUTH_CAPTCHA_PROMT")?>" class="form-control" name="captcha_word" maxlength="50" value="" />
                            </div>
                        <?endif?>
                        <button type="submit" class="btn btn btn-two"><?=GetMessage("AUTH_LOGIN_BUTTON")?></button>
                    </form>
                </div>
            </li>
            <li><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></li>
            <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
                <li><a href="<?=$arResult["AUTH_REGISTER_URL"]?>"><?=GetMessage("AUTH_REGISTER")?></a></li>
            <?endif?>
            <li>
                <?if($arResult["AUTH_SERVICES"]):?>
                    <div class="pop-auth-form pop-auth-form-social">
                        <div class="bx-auth-lbl"><?=GetMessage("AUTH_SERVICE_FORM")?></div>
                        <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
                            array(
                                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                                "SUFFIX"=>"form",
                            ),
                            $component,
                            array("HIDE_ICONS"=>"Y")
                        );
                        ?>
                    </div>
                    <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                        array(
                            "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                            "AUTH_URL"=>$arResult["AUTH_URL"],
                            "POST"=>$arResult["POST"],
                            "POPUP"=>"Y",
                            "SUFFIX"=>"form",
                        ),
                        $component,
                        array("HIDE_ICONS"=>"Y")
                    );?>
                <?endif?>
            </li>
        </ul>
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
    <li class="aux-languages dropdown animate-hover" data-animate="animated fadeInUp"><a href="<?=$arResult["urlToOwnProfile"]?>" class="btn btn-b-white"><span class="language name"><?=(strlen($arResult["USER_NAME"]) > 0 ? $arResult["USER_NAME"] : $arResult["USER_LOGIN"])?></span></a>
        <ul id="auxLanguages" class="sub-menu animate-wr">
            <?if($arParams["URL_BASKET"]):?><li><a href="<?=$arParams["URL_BASKET"]?>"><span class="language"><?=GetMessage("URL_BASKET")?></span></a></li><?endif?>
            <?if($arParams["URL_ORDER"]):?><li><a href="<?=$arParams["URL_ORDER"]?>"><span class="language"><?=GetMessage("URL_ORDER")?></span></a></li><?endif?>
            <?if($arParams["URL_SUBSCRIBE"]):?><li><a href="<?=$arParams["URL_SUBSCRIBE"]?>"><span class="language"><?=GetMessage("URL_SUBSCRIBE")?></span></a></li><?endif?>
            <?if($arParams["URL_REQUEST"]):?><li><a href="<?=$arParams["URL_REQUEST"]?>"><span class="language"><?=GetMessage("URL_REQUEST")?></span></a></li><?endif?>
            <li><a href="<?=$logoutUrl?>"><span class="language"><?=GetMessage("AUTH_LOGOUT_BUTTON")?></span></a></li>
        </ul>
    </li>
<?endif?>