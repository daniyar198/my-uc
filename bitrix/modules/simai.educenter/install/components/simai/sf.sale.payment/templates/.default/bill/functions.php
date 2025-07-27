<?
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

function num2str($num) {
	$nul=Loc::getMessage('ZERO');
	$ten=array(
		array('',Loc::getMessage('ONE'),Loc::getMessage('TWO'),Loc::getMessage('THREE'),Loc::getMessage('FOUR'),Loc::getMessage('FIVE'),Loc::getMessage('SIX'),Loc::getMessage('SEVEN'), Loc::getMessage('EACH'),Loc::getMessage('NINE')),
		array('',Loc::getMessage('ONE1'),Loc::getMessage('TWO1'),Loc::getMessage('THREE'),Loc::getMessage('FOUR'),Loc::getMessage('FIVE'),Loc::getMessage('SIX'),Loc::getMessage('SEVEN'), Loc::getMessage('EACH'),Loc::getMessage('NINE')),
	);
	$a20=array(Loc::getMessage('TEN'),Loc::getMessage('ELEVEN'),Loc::getMessage('TWELWE'),Loc::getMessage('THEETEEN'),Loc::getMessage('FOURTEEN') ,Loc::getMessage('FIVETEEN'),Loc::getMessage('SIXTEEN'),Loc::getMessage('SEVENTEEN'),Loc::getMessage('EACHTEEN'),Loc::getMessage('NINETEEN'));
	$tens=array(2=>Loc::getMessage('TWENTY'),Loc::getMessage('THIRTY'),Loc::getMessage('FOURTY'),Loc::getMessage('FIVETY'),Loc::getMessage('SIXTY'),Loc::getMessage('SEVENTY') ,Loc::getMessage('EIGHTY'),Loc::getMessage('NINETY'));
	$hundred=array('',Loc::getMessage('HUNDRED'),Loc::getMessage('TWOHUNDRED'),Loc::getMessage('THREEHUNDRED'),Loc::getMessage('FOURHUNDRED'),Loc::getMessage('FIVEHUNDRED'),Loc::getMessage('SIXHUNDRED'), Loc::getMessage('SEVENHUNDRED'),Loc::getMessage('EACHHUNDRED'),Loc::getMessage('NINEHUNDRED'));
	$unit=array( // Units
		array(Loc::getMessage('KOPECK') ,Loc::getMessage('KOPECKI'),Loc::getMessage('KOPEECK'),	 1),
		array(Loc::getMessage('RUBLE')   ,Loc::getMessage('RUBLYA')   ,Loc::getMessage('RUBLEI')    ,0),
		array(Loc::getMessage('THOUSAND')  ,Loc::getMessage('THOUSANDS')  ,Loc::getMessage('THOUSANDES')     ,1),
		array(Loc::getMessage('MILLION') ,Loc::getMessage('MILLIONA'),Loc::getMessage('MILLIONOV') ,0),
		array(Loc::getMessage('MILLIARD'),Loc::getMessage('MILLIARDA'),Loc::getMessage('MILLIARDOV'),0),
	);
	//
	list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
	$out = array();
	if (intval($rub)>0) {
		foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
			if (!intval($v)) continue;
			$uk = sizeof($unit)-$uk-1; // unit key
			$gender = $unit[$uk][3];
			list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
			// mega-logic
			$out[] = $hundred[$i1]; # 1xx-9xx
			if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
			else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
			// units without rub & kop
			if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
		} //foreach
	}
	else $out[] = $nul;
	$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
	$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
	return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}

/**
 * Склоняем словоформу
 * @ author runcore
 */
function morph($n, $f1, $f2, $f5) {
	$n = abs(intval($n)) % 100;
	if ($n>10 && $n<20) return $f5;
	$n = $n % 10;
	if ($n>1 && $n<5) return $f2;
	if ($n==1) return $f1;
	return $f5;
}
?>
