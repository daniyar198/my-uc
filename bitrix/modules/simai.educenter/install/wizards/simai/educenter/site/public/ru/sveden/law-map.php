<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Законодательная карта");
?><h4></h4>
<h4>Таблица 1 – Структура раздела «Основные сведения об образовательной организации» </h4>
<p style="text-align: center;">
</p>
<div style="overflow: auto">
	<table class="table table-bordered">
	<tbody>
	<tr>
		<td style="text-align: center;">
			 Название подраздела
		</td>
		<td style="text-align: center;">
			 Адресная ссылка на подраздел Сайта в сети Интернет
		</td>
	</tr>
	<tr>
		<td>
			 Основные сведения
		</td>
		<td>
 <a href="#SITEDIR#sveden/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/</a>
		</td>
	</tr>
	<tr>
		<td>
			 Структура и органы управления образовательной организацией
		</td>
		<td>
 <a href="#SITEDIR#sveden/struct/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/struct/</a>
		</td>
	</tr>
	<tr>
		<td>
			 Документы
		</td>
		<td>
 <a href="#SITEDIR#sveden/document/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/document/</a>
		</td>
	</tr>
	<tr>
		<td>
			 Образование
		</td>
		<td>
 <a href="#SITEDIR#sveden/education/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/education/</a>
		</td>
	</tr>
	<tr>
		<td>
			 Образовательные стандарты
		</td>
		<td>
 <a href="#SITEDIR#sveden/eduStandarts/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/eduStandarts/</a>
		</td>
	</tr>
	<tr>
		<td>
			 Руководство. Педагогический состав.
		</td>
		<td>
 <a href="#SITEDIR#sveden/employees/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/employees/</a>
		</td>
	</tr>
	<tr>
		<td>
			 Материально-техническое <br>
			 обеспечение и оснащенность образовательного процесса
		</td>
		<td>
 <a href="#SITEDIR#sveden/objects/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/objects/</a>
		</td>
	</tr>
	<tr>
		<td>
			 Стипендии и иные виды материальной поддержки
		</td>
		<td>
 <a href="#SITEDIR#sveden/grants/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/grants/</a>
		</td>
	</tr>
	<tr>
		<td colspan="1">
			 Платные образовательные услуги
		</td>
		<td colspan="1">
 <a href="#SITEDIR#sveden/paid_edu/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/paid_edu/</a>
		</td>
	</tr>
	<tr>
		<td colspan="1">
			 Финансово-хозяйственная деятельность
		</td>
		<td colspan="1">
 <a href="#SITEDIR#sveden/budget/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/budget/</a>
		</td>
	</tr>
	<tr>
		<td colspan="1">
			 Вакантные места для приема (перевода)
		</td>
		<td colspan="1">
 <a href="#SITEDIR#sveden/vacant/" target="_blank"><?=$_SERVER["SERVER_NAME"]?>#SITEDIR#sveden/vacant/</a>
		</td>
	</tr>
	</tbody>
	</table>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>