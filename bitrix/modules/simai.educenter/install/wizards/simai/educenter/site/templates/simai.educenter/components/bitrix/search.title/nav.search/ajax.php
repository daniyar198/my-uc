<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"])):?>
	<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
		<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<div class="live-search-result nav-live-search">
				<!--<div class="one-category">
					<?//=$arCategory["TITLE"]?>
				</div>-->

				<?if($category_id === "all"):?>
					<div class="category-all">
						<a href="<?echo $arItem["URL"]?>">
							<?echo $arItem["NAME"]?>
						</a>
					</div>
				<?elseif(isset($arItem["ICON"])):?>
					<div class="category-item">
						<a href="<?echo $arItem["URL"]?>">
							<?echo $arItem["NAME"]?>
						</a>
					</div>
				<?else:?>
					<div class="category-more">
						<a href="<?echo $arItem["URL"]?>">
							<?echo $arItem["NAME"]?>
						</a>
					</div>
				<?endif;?>	
			</div>
		<?endforeach?>
	<?endforeach?>		
	<script>
	</script>
<?endif;?>