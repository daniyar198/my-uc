<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->setFrameMode(true);
	?>
<div class="post-item">
	<?if(isset($arResult["YOUTUBE_IDENTIFIER"]) && is_array($arResult["MORE_PHOTO"])):?>
	<div class="tabs-framed">
		<ul class="tabs clearfix">
			<li class="active"><a href="#tab-1" data-toggle="tab"><?=getMessage("TITLE_VIDEO")?></a></li>
			<li class=""><a href="#tab-2" data-toggle="tab"><?=getMessage("TITLE_PHOTO")?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="tab-1">
				<div class="tab-body">
					<iframe width="718" height="410" src="//www.youtube.com/embed/<?=$arResult["YOUTUBE_IDENTIFIER"]?>" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
			<div class="tab-pane fade" id="tab-2">
				<div class="tab-body">
					<div style="position: relative;" >
						<a class="theater hidden-xs" id="big-photo" title="<?=$arResult["MORE_PHOTO"][0]["DESCRIPTION"]?$arResult["MORE_PHOTO"][0]["DESCRIPTION"]:$arResult["NAME"]?>" href="<?=$arResult["MORE_PHOTO"][0]["OLD_LINK"]?>"><img class="img-responsive" alt="<?=$arResult["NAME"]?>" src="<?=$arResult["MORE_PHOTO"][0]["SRC_BIG"]?>"></a>
						<script type="text/javascript">
							$(function(){
							    $(".carousel .change-photo").on("click",function(){
							        var photo=$(this).attr("data-big");
							        var href=$(this).attr("href");
							        if(typeof photo !=="undefined" && typeof href !=="undefined")
							        {
							            $(this).addClass("active").parents(".carousel").find(".change-photo.active").not($(this)).removeClass("active");
							            $("#big-photo").attr("href", href).children().attr("src", photo);
							        }
							        return false;
							    });
							});
						</script>
						<?if(count($arResult["MORE_PHOTO"])>1):?>
						<div id="carouselDetail" style="position: absolute;bottom: 15px;" class="carousel carousel-3 slide animate-hover-slide hidden-xs">
							<?if(count($arResult["MORE_PHOTO"])>6 || (count($arResult["MORE_PHOTO"])>5 && is_array($arResult["PREVIEW_IMG"]))):?>
							<div class="carousel-nav slider">
								<a data-slide="prev" class="left color-two" href="#carouselDetail"><i class="fa fa-angle-left"></i></a>
								<a data-slide="next" class="right color-two" href="#carouselDetail"><i class="fa fa-angle-right"></i></a>
							</div>
							<?endif?>
							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<div class="item active">
									<?
										$i=0;
										foreach($arResult["MORE_PHOTO"] as $arPhoto):
										    if($i && $i%6==0) echo"</div><div class='item'>";
										    ?>
									<div class="col-xs-2">
										<a class="change-photo<?if(!$i){?> active<?}?>" data-big="<?=$arPhoto["SRC_BIG"]?>" rel="group" title="<?=$arPhoto["DESCRIPTION"]?$arPhoto["DESCRIPTION"]:$arResult["NAME"]?>" href="<?=$arPhoto["OLD_LINK"]?>" ><img class="img-responsive" src="<?=$arPhoto["SRC"]?>" alt="<?=$arResult["NAME"]?>"></a>
									</div>
									<?
										$i++;
										endforeach?>
								</div>
							</div>
						</div>
						<?endif?>
						<div class="visible-xs">
							<?
								foreach($arResult["MORE_PHOTO"] as $arPhoto):
								    ?>
							<img class="img-responsive" src="<?=$arPhoto["SRC"]?>" alt="<?=$arResult["NAME"]?>">
							<?
								endforeach?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?else:?>
	<div class="row">
		<?if(isset($arResult["YOUTUBE_IDENTIFIER"])):?>
		<iframe width="750" height="420" src="//www.youtube.com/embed/<?=$arResult["YOUTUBE_IDENTIFIER"]?>" frameborder="0" allowfullscreen></iframe>
		<?endif?>
		<?if(!empty($arResult["MORE_PHOTO"])):?>
		<div class="col-md-6">
			<a class="theater hidden-xs" id="big-photo" title="<?=$arResult["MORE_PHOTO"][0]["DESCRIPTION"]?$arResult["MORE_PHOTO"][0]["DESCRIPTION"]:$arResult["NAME"]?>" href="<?=$arResult["MORE_PHOTO"][0]["OLD_LINK"]?>">
			<img class="img-responsive" alt="<?=$arResult["NAME"]?>" src="<?=$arResult["MORE_PHOTO"][0]["SRC_BIG"]?>">
			</a>
			<?if(count($arResult["MORE_PHOTO"])>1):?>
			<script type="text/javascript">
				$(function(){
				    $(".carousel .change-photo").on("click",function(){
				        var photo=$(this).attr("data-big");
				        var href=$(this).attr("href");
				        if(typeof photo !=="undefined" && typeof href !=="undefined")
				        {
				            $(this).addClass("active").parents(".carousel").find(".change-photo.active").not($(this)).removeClass("active");
				            $("#big-photo").attr("href", href).children().attr("src", photo);
				        }
				        return false;
				    });
				});
			</script>
			<div id="carouselDetail" style="position: absolute;bottom: 15px;" class="carousel carousel-3 slide animate-hover-slide hidden-xs">
				<?if(count($arResult["MORE_PHOTO"])>6 || (count($arResult["MORE_PHOTO"])>5 && is_array($arResult["PREVIEW_IMG"]))):?>
				<div class="carousel-nav slider">
					<a data-slide="prev" class="left color-two" href="#carouselDetail"><i class="fa fa-angle-left"></i></a>
					<a data-slide="next" class="right color-two" href="#carouselDetail"><i class="fa fa-angle-right"></i></a>
				</div>
				<?endif?>
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<?
							$i=0;
							foreach($arResult["MORE_PHOTO"] as $arPhoto):
							    if($i && $i%6==0) echo"</div><div class='item'>";
							    ?>
						<div class="col-xs-2">
							<a class="change-photo<?if(!$i){?> active<?}?>" data-big="<?=$arPhoto["SRC_BIG"]?>" rel="group" title="<?=$arPhoto["DESCRIPTION"]?$arPhoto["DESCRIPTION"]:$arResult["NAME"]?>" href="<?=$arPhoto["OLD_LINK"]?>" ><img class="img-responsive" src="<?=$arPhoto["SRC"]?>" alt="<?=$arResult["NAME"]?>"></a>
						</div>
						<?
							$i++;
							endforeach?>
					</div>
				</div>
			</div>
			<?endif?>
			<div class="visible-xs">
				<?
					foreach($arResult["MORE_PHOTO"] as $arPhoto):
					    ?>
				<img class="img-responsive" src="<?=$arPhoto["SRC"]?>" alt="<?=$arResult["NAME"]?>">
				<?
					endforeach?>
			</div>
		</div>
		<div class="col-md-6">
			<?if($arResult["DISPLAY_ACTIVE_FROM"]&& $arParams["DISPLAY_DATE"] =="Y"):?>
				<p><i class="fa fa-calendar"></i> <?=$arResult["DISPLAY_ACTIVE_FROM"]?></p>
			<?endif?>
			<?if($arResult["SHOW_COUNTER"]):?>
				<p><i class="fa fa-eye"></i> <?=getMessage("WATCH");?>: <?=$arResult["SHOW_COUNTER"]?></p>
			<?endif?>
		</div>
		<?endif?>
	</div>
	<?endif?>
	<p class="mt-20"><?=$arResult["~DETAIL_TEXT"]?$arResult["~DETAIL_TEXT"]:$arResult["~PREVIEW_TEXT"]?></p>
	<table class="detail-page-info">
		<tr>
			<td><a target="_blank" class="social_share vk" href="http://vk.com/share.php?url=http://<?=SITE_SERVER_NAME.$arResult["DETAIL_PAGE_URL"]?>" target="_blank"><i class="fa fa-vk"></i></a></td>
			<td><a target="_blank" class="social_share facebook" href="http://facebook.com/share.php" data-url="http://<?=SITE_SERVER_NAME.$arResult["DETAIL_PAGE_URL"]?>"><i class="fa fa-facebook"></i></a></td>
			<td><a target="_blank" class="social_share twitter" href="http://twitter.com/share?url=http://<?=SITE_SERVER_NAME.$arResult["DETAIL_PAGE_URL"]?>&text=<?=$arResult["NAME"]?>"><i class="fa fa-twitter"></i></a></td>
			<td><a target="_blank" class="social_share ok" href="https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&amp;st.shareUrl=http://<?=SITE_SERVER_NAME.$arResult["DETAIL_PAGE_URL"]?>&text=<?=$arResult["NAME"]?>"><i class="fa fa-odnoklassniki"></i></a></td>
		</tr>
	</table>
	

	
	
		<div class="doc-list">
		<?foreach($arResult["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"] as $arItem):?>

		<div class="row">
			<div class="col-xs-1">
				<a class="main-icon grey" target="_blank" href="<?=$arItem["SRC"]?>"><i class="fa fa-<?=$arItem["ICON"]?>"></i></a>
			</div>

        <div class="col-xs-11">
            <h3 class="section-title">
				<a target="_blank" href="http://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?><?= $arItem["SRC"]?>" class="not-accent"><?=$arItem["FILE_NAME"]?></a>
			</h3>
			<div class="mt-0 mb-20">
				<i class="fa fa-download c-base"></i> <a target="_blank" href="<?=$arItem["SRC"]?>" class="link_underline"> <?=getMessage("DOWNLOAD")?></a> <?if($arItem["DOC_SIZE"]):?>(<?=getMessage("SIZE")?> <?=$arItem["DOC_SIZE"]?> Kb)&nbsp;<?endif?>
				<?if(SITE_SERVER_NAME):?> 
					<i class="fa fa-external-link c-base" aria-hidden="true"></i> <a  target="_blank" class="various download-link link_underline" href="http://docs.google.com/viewer?url=http://<?=SITE_SERVER_NAME?><?= $arItem["SRC"]?>"><?=getMessage("VIEW")?></a>
				<?endif?>
 			</div>       
        </div>
	 </div>
		<hr/>
		<?endforeach?>
	</div>
	
	
<?if(is_array($arResult["NAVIGATION"])):?>	
	<?if(count($arResult["NAVIGATION"])==3):?>
	<div class="news-detail-nav">
		<div class="pull-right"><a href="<?=$arResult["NAVIGATION"][0]["DETAIL_PAGE_URL"]?>"><b><?=GetMessage("NEXT_NEWS")?></b> <i class="fa fa-angle-right"></i></a></div>
		<div class="pull-left"><a href="<?=$arResult["NAVIGATION"][2]["DETAIL_PAGE_URL"]?>"><i class="fa fa-angle-left"></i> <b><?=GetMessage("PREV_NEWS")?></b></a></div>
	</div>
	<?elseif(count($arResult["NAVIGATION"])==2):?>
	<?if($arResult["NAVIGATION"][0]["ID"]==$arResult["ID"]):?>
	<div class="news-detail-nav">
		<div class="pull-right"><span><?=GetMessage("NEXT_NEWS")?> <i class="fa fa-angle-right"></i></span></div>
		<div class="pull-left"><a href="<?=$arResult["NAVIGATION"][1]["DETAIL_PAGE_URL"]?>"><i class="fa fa-angle-left"></i> <b><?=GetMessage("PREV_NEWS")?></b></a></div>
	</div>
	<?elseif($arResult["NAVIGATION"][1]["ID"]==$arResult["ID"]):?>
	<div class="news-detail-nav">
		<div class="pull-right"><a href="<?=$arResult["NAVIGATION"][0]["DETAIL_PAGE_URL"]?>"><b><?=GetMessage("NEXT_NEWS")?></b> <i class="fa fa-angle-right"></i></a></div>
		<div class="pull-left"><span><i class="fa fa-angle-left"></i> <?=GetMessage("PREV_NEWS")?></span></div>
	</div>
	<?endif?>
	<?endif?>
<?endif?>
</div>