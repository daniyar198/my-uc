<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<form action="<?=$arResult["FORM_ACTION"]?>" class="form-horizontal form-light" role="form">
    <div class="input-group">
        <?if($arParams["USE_SUGGEST"] === "Y"):?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:search.suggest.input",
                "",
                array(
                    "NAME" => "q",
                    "VALUE" => "",
                    "INPUT_SIZE" => 15,
                    "DROPDOWN_SIZE" => 10,
                ),
                $component, array("HIDE_ICONS" => "Y")
            );?>
        <?else:?>
            <input type="text" name="q" value="" class="form-control" placeholder="<?=GetMessage("BSF_T_SEARCH_REQUEST");?>"/>
        <?endif;?>
        <span class="input-group-btn">
              <button class="btn btn-base" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>

