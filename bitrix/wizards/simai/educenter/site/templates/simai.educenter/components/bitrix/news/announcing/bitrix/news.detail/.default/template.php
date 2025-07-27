<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="post-item">
				<?if($arResult["DISPLAY_ACTIVE_FROM"]):?>
                        <small><b><?=$arResult["DISPLAY_ACTIVE_FROM"]?></b></small><br/>
				<?endif?>

				<?=$arResult["~PREVIEW_TEXT"]?>

        </div>