<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");?>
<script type="text/javascript">
$(function(){
    $("section.slice:first").css("padding", "0").find(".container:first").attr("class","");
    var block404='<section class="slice" style="padding:90px 0;" id="id404"><div class="wp-section"><div class="text-center"><h2>Запрашиваемая страница отсутствует</h2><h1 class="font-xl c-base">4<i class="fa fa-times-circle-o"></i>4</h1><p>Возможно вы неправильно набрали адрес страницы либо страница была перенесена по-другому адресу.<br>Вы можете перейти на <a class="white" style="text-decoration: underline;"  href="<?=SITE_DIR?>">главную страницу</a> или по одной из ссылок в меню.</p><span class="clearfix"></span></div></div></section>';
    $("section.slice:first").html("").append(block404);
});
</script>
    <section class="slice bg-base" style="padding:90px 0;" id="id404">
        <div class="wp-section">

                        <div class="text-center">
                            <h2>Запрашиваемая страница отсутствует</h2>
                            <h1 class="font-xl">
                                4<i class="fa fa-times-circle-o"></i>4
                            </h1>
                            <p>
                                Возможно вы неправильно набрали адрес страницы либо страница была перенесена по-другому адресу.
                                <br>
                                Вы можете перейти на <a class="white" style="text-decoration: underline;"  href="<?=SITE_DIR?>">главную страницу</a> или по одной из ссылок в меню.
                            </p>
                            <span class="clearfix"></span>


            </div>
        </div>
    </section>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>