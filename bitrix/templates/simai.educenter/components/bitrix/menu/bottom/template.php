<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div id="bottom-menu-block">
<?if (!empty($arResult)):
    $col=ceil(count($arResult)/2);
    ?>
    <div class="bottom-menu">
        <ul class="nav col-md-6">
            <li>
            <?
            $i=0;
            foreach($arResult as $arItem):
                if($i && $i%$col==0)echo "</ul><ul class=\"nav col-md-6\">";
                ?>
                <li class="<?if ($arItem["SELECTED"]):?>active<?endif;if($arItem["DEPTH_LEVEL"]<2):?> first-level<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?
            $i++;
            endforeach?>
            </li>
        </ul>
    </div>
<?endif?>
</div>