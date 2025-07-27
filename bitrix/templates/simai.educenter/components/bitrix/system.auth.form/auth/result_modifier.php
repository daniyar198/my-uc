<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($GLOBALS["USER"]->IsAuthorized())
{
	$arResult["urlToOwnProfile"] = CComponentEngine::MakePathFromTemplate($arParams["PROFILE_URL"], array("user_id" => $GLOBALS["USER"]->GetID()));
}
?>