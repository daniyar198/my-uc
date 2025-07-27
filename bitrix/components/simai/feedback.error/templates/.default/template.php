<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<!-- MODAL WINDOW -->
 <div class="modal-window-home" id="modal-window-home-id" params="close" onload="text">
	<form method="POST" name="helpForm">
<!-- CONTENT MODAL -->
		<div class="content-modal-window">
<!-- HEADER -->
			<div class="header-modal-window">
				<span class="header-modal-window-text"><?=getMessage('SITE_ERROR');?></span>
				<div class="close-icon-button-block over-mask">
					<div class='over-mask but-close-over-mask' params="close"></div>
					<svg width="18" height="18" viewBox="0 0 512 512">
						<line x1="5" y1="5" x2="510" y2="510" stroke="#000000" stroke-width="20"/>
						<line x1="5" y1="510" x2="510" y2="5" stroke="#000000" stroke-width="20"/>
					</svg>
				</div>
			</div>
<!-- CONTENT BLOCK -->
			<div class="content-modal-window-message-submit">
				<p><?=getMessage('TEXT_WITH_MISTAKE');?></p>
				<div id="mess" class="text-error"></div>
				<div id='elem-form'></div>
			</div>
<!-- FOOTER -->
			<div class="footer-modal-window">
				<input type="submit" value="<?=getMessage('SEND');?>"  id='send'
					class="but-sm but-sm-submit btn-button-modal-window m-20">
			</div>
		</div>
	</form>
</div>