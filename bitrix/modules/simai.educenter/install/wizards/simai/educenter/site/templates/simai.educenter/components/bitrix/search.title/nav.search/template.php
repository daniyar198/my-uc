<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
$INPUT_ID = "title-search-input";
$CONTAINER_ID = "title-search";

if($arParams["SHOW_INPUT"] !== "N"):?>
		<div class="nav-search">
			<form action="<?echo $arResult["FORM_ACTION"]?>" class="search-form w-100 h-100 align-items-center justify-content-between m-0 mb-0" style="display: none;">
				<div id="<?echo $CONTAINER_ID?>" class="inner-search d-block w-100 h-100">
					<div class="d-flex align-items-center justify-content-center h-100 w-100">
						<input id="<?echo $INPUT_ID?>" class="input-search d-block p-2 m-0" style="width:inherit" type="search" name="q" placeholder="<?=getMessage('CT_BST_SEARCH_BUTTON')?>" autocomplete="off"/>
					</div>
					<button class="sf-close t-1 sf-close-center"></button>
				</div>
			</form>
			<div class="btn-search b-0 <?=$arParams["SF_NAVBAR_PADDING_ONE_LEVEL"];?>">
				<i class="fa fa-search fa-lg" aria-hidden="true"></i>
			</div>
		</div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
