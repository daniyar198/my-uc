<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);?>
<?
if (count($arResult) < 1)
	return;
$bManyIblock = array_key_exists("IBLOCK_ROOT_ITEM", $arResult[0]["PARAMS"]);

$curRand = rand();
?>



<div class="catalog_menu hidden-sm hidden-xs">
<ul class="nav">
<?
	$previousLevel = 0;
	foreach($arResult as $key => $arItem):

	/*echo '<pre>';
	print_r($arItem["DEPTH_LEVEL"]);
	echo '</pre>';*/

		if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): 
			echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		endif;

		if ($arItem["IS_PARENT"]): 
			$i = $key;
			$bHasSelected = $arItem['SELECTED'];
			$childSelected = false;
			//if (!$bHasSelected)         
			//{
				while ($arResult[++$i]['DEPTH_LEVEL'] > $arItem['DEPTH_LEVEL'])
				{
					if ($arResult[$i]['SELECTED'])
					{
						//$bHasSelected = 
						$childSelected = true; break;   
					}
				}
			//}

?>
		<? if ($arItem['DEPTH_LEVEL'] > 1 && !$childSelected && $bHasSelected) :?>
			<li class="current selected lvl<?=$arItem['DEPTH_LEVEL']?>">
				<span class="header-left-menu-content">
					<span class="aligment-nav-left-menu showchild_menu_<?=$curRand?> showchild" style="height: 100%!important;">
						<span class="sheath-aligment-left-menu">
							<span class="arrow fa fa-angle-<?=($className = $bHasSelected ? 'down' : 'right');?> fa-1x"
								style="margin-top: auto !important;">
							</span>
						</span>
					</span>
					<a <?if($bHasSelected):?>class="width-item-left-menu not-accent base"<?endif;?> href="<?=$arItem["LINK"]?>">
						<i class="fa fa-angle-right" aria-hidden="true"></i> <?=$arItem["TEXT"]?>
					</a>
				</span>
			<ul>

		<? else:?>
			<?
			$className = $bHasSelected ? 'current selected' : '';
			$className.= " lvl".$arItem['DEPTH_LEVEL'];?>
			<li<?=$className ? ' class="'.$className.'"' : ''?>>
				<span class="header-left-menu-content">
					<span class="aligment-nav-left-menu showchild_menu_<?=$curRand?> showchild" style="height: 100%!important;">
						<span class="sheath-aligment-left-menu">
							<span class="arrow fa fa-angle-<?=($className = $bHasSelected ? 'down' : 'right');?> fa-1x" style="margin-top: auto !important;">
							</span>
						</span>
					</span>
					<a class="width-item-left-menu not-accent  <?if($bHasSelected):?> spun<?if($childSelected):?> selectedparent_menu<?else: ?> base<?endif; else: ?> selectedparent_menu<? endif;?>" href="<?=$arItem["LINK"]?>"><?=($arItem['DEPTH_LEVEL'] > 1 ? '<i class="fa fa-angle-right" aria-hidden="true"></i> ' : '')?><?=$arItem["TEXT"]?></a>
					
				</span>
				<ul<?=$bHasSelected || ($bManyIblock && $arItem['DEPTH_LEVEL'] <= 1) ? '' : ' style="display: none;"'?>>
		<? endif?>

<?
		else:  // no childs
			if ($arItem["PERMISSION"] > "D"):
				$className = $arItem['SELECTED'] ? 'current selected' : '';
			/*if ($arItem['DEPTH_LEVEL'] > 1)*/ $className.= " lvl".$arItem['DEPTH_LEVEL'];
?>
			<li<?=$className ? ' class="'.$className.'"' : ''?>>
				<span class="header-left-menu-content">
					<a class="width-item-left-menu not-accent<?=($arItem['SELECTED'] ? " base" : "")?>"
						href="<?=$arItem["LINK"]?>"><?=($arItem['DEPTH_LEVEL'] > 1 ? '<i class="fa fa-angle-right" aria-hidden="true"></i> ' : '')?><?=$arItem["TEXT"]?>
					</a>
				</span>
			</li>
			<?endif;
		endif;

		$previousLevel = $arItem["DEPTH_LEVEL"];
	endforeach;

	if ($previousLevel > 1)://close last item tags
		echo str_repeat("</ul></li>", ($previousLevel-1) );
	endif;
?>
</ul>
</div>
<script type="text/javascript">
$(function(){
	$('.catalog_menu .nav li span.aligment-nav-left-menu').on("click",function(){
		attrClass = $(this).find('span.arrow').attr("class");

		if(attrClass=="arrow fa fa-angle-down fa-1x")
		{
			$(this).find('span.arrow').attr("class","arrow fa fa-angle-right fa-1x");
		}
		else
		{
			$(this).find('span.arrow').attr("class","arrow fa fa-angle-down fa-1x");
		}
		$(this).closest("li").children("ul").toggle();
	});
});
</script>
