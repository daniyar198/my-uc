<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="bx-auth-profile">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<form method="post" name="form1" class="sky-form" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
    
<div class="profile-block-<?=strpos($arResult["opened"], "reg") === false ? "hidden" : "shown"?>" id="user_div_reg">

	<?
	if($arResult["ID"]>0)
	{
	?>
		<?
		if (strlen($arResult["arUser"]["TIMESTAMP_X"])>0)
		{
		?>

			<p><?=GetMessage('LAST_UPDATE')?> <?=$arResult["arUser"]["TIMESTAMP_X"]?></p>
		<?
		}
		?>
		<?
		if (strlen($arResult["arUser"]["LAST_LOGIN"])>0)
		{
		?>
            <p><?=GetMessage('LAST_LOGIN')?> <?=$arResult["arUser"]["LAST_LOGIN"]?></p>
		<?
		}
		?>
	<?
	}
	?>
    <div class="form-group">
        <label class="control-label min-w300"><?=GetMessage('NAME')?></label>
        <label class="input"><input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /></label>
	</div>
    <div class="form-group">
        <label class="control-label min-w300"><?=GetMessage('LAST_NAME')?></label>
        <label class="input"><input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></label>
	</div>
    <div class="form-group">
        <label class="control-label min-w300"><?=GetMessage('SECOND_NAME')?></label>
        <label class="input"><input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></label>
	</div>
    <div class="form-group">
        <label class="control-label min-w300"><?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></label>
        <label class="input"><input type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" /></label>
	</div>
    <div class="form-group">
        <label class="control-label min-w300"><?=GetMessage('LOGIN')?><span class="starrequired">*</span></label>
        <label class="input"><input type="text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" /></label>
	</div>
    <div class="form-group">
        <label class="control-label min-w300"><?=GetMessage('USER_PHOTO')?></label>
        <label class="input photo"><input name="PERSONAL_PHOTO" class="typefile" size="20" type="file"></label>
        <input type="checkbox" name="PERSONAL_PHOTO_del" value="Y" id="PERSONAL_PHOTO_del"> <label for="PERSONAL_PHOTO_del"><?=getMessage("DELETE_FILE")?></label>
        <div>
        <?
        if (strlen($arResult["arUser"]["PERSONAL_PHOTO"])>0)
        {
            ?>
            <?=$arResult["arUser"]["PERSONAL_PHOTO_HTML"]?>
        <?
        }
        ?>
        </div>
	</div>
<?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
    <div class="form-group">
    <label class="control-label min-w300"><?=GetMessage('NEW_PASSWORD_REQ')?></label>
    <label class="input"><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" /></label>
        <?if($arResult["SECURE_AUTH"]):?>
        <script type="text/javascript">
        document.getElementById('bx_auth_secure').style.display = 'inline-block';
        </script>

        <?endif?>
    </div>
    <div class="form-group">
        <label class="control-label min-w300"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
        <label class="input"><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></label>
	</div>
<?endif?>
<?if($arResult["TIME_ZONE_ENABLED"] == true):?>
    <div class="form-group">
        <label class="control-label min-w300"><?echo GetMessage("main_profile_time_zones")?></label>
        <label class="control-label min-w300"><?echo GetMessage("main_profile_time_zones_auto")?></label>
        <label class="select">
			<select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
				<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
				<option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
				<option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
			</select>
		</label>
	</div>
    <div class="form-group">
        <label class="control-label min-w300"><?echo GetMessage("main_profile_time_zones_zones")?></label>
        <label class="select">
			<select name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?>>
<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
				<option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
<?endforeach?>
			</select>
		</label>
	</div>
<?endif?>
</div>

	<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
	<p><input type="submit" class="btn btn-base btn" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">&nbsp;&nbsp;<input class="btn btn-base btn" type="reset" value="<?=GetMessage('MAIN_RESET');?>"></p>
</form>
<?
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}
?>
</div>