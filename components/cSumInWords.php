<?php
namespace app\components\helpers;

/**
 * Класс генерурется сумму прописью (в UTF-8) по заданному числу.
 * Пока умеет работать только с рублями и русским языком.
 * Есть внутренне ограничение, cумма без учёта копеек должна умещаться в INT.
 */
class cSumInWords {
	/**
	 * Склонения для разрядов и валют.
	 * @var int
	 */
	const DECLENSION_1 = 1, DECLENSION_2 = 2, DECLENSION_3 = 3;
	/**
	 * Сотни прописью
	 * @var array
	 */
	protected static $aHundreds = array(
		1 => 'сто', 'двести', 'триста', 'четыреста', 'пятьсот',
			'шестьсот', 'семьсот', 'восемьсот', 'девятьсот',
	);
	/**
	 * Десятки прописью
	 * @var array
	 */
	protected static $aTens = array(
		2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят',
			'шестьдесят', 'семьдесят', 'восемдесят', 'девяносто',
	);
	/**
	 * Все числа прописью
	 * @var array
	 */
	protected static $aNumbers = array(
		1 => 'один', 'два', 'три', 'четыре', 'пять',
			'шесть', 'семь', 'восемь', 'девять', 'десять',
			'одиннацать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать',
			'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать',
	);
	/**
	 * Числа прописью, которые бывают женского рода.
	 * @var array
	 */
	protected static $aFemaleNumbers = array(1 => 'одна', 'две', );
	/**
	 * Написание разрядов и валют для разных склонений
	 * @var array
	 */
	protected static $aNames = array(
		1000000000 =>	array(self::DECLENSION_1 => 'миллиард', self::DECLENSION_2 => 'миллиарда', 	self::DECLENSION_3 => 'миллиардов'),
		1000000 =>		array(self::DECLENSION_1 => 'миллион', 	self::DECLENSION_2 => 'миллиона', 	self::DECLENSION_3 => 'миллионов'),
		1000 =>			array(self::DECLENSION_1 => 'тысяча', 	self::DECLENSION_2 => 'тысячи', 	self::DECLENSION_3 => 'тысяч'),
		1 =>			array(self::DECLENSION_1 => 'рубль', 	self::DECLENSION_2 => 'рубля', 		self::DECLENSION_3 => 'рублей'),
		0 =>			array(self::DECLENSION_1 => 'копейка', 	self::DECLENSION_2 => 'копейки', 	self::DECLENSION_3 => 'копеек'),
	);
	/**
	 * Приводим к прописному виду числа от 1 до 999
	 * @param int $i			- число которое нужно преобразовать
	 * @param int $iDeclension	- склонение валюты или разрядов
	 * @param boolean $bFemale	- число должно быть женского рода
	 * @return string			- сгенерированное число прописью
	 */
	protected static function sSemantic($i, &$iDeclension, $bFemale)
	{
		$sWords='';
		
		if($i >= 100){
			// преобразуем сотни
			$idx = intval($i / 100);
			$sWords .= self::$aHundreds[$idx].' ';
			$i %= 100;
		}
		if($i >= 20){
			// преобразуем десятки
			$idx = intval($i / 10);
			$sWords .= self::$aTens[$idx].' ';
			$i %= 10;
		}
		
		// по единицам определим склонение валюты либо больших разрядов (тысячи, миллионы, ...)
		switch($i){
			case 1:  $iDeclension = self::DECLENSION_1; break;
			case 2:
			case 3:
			case 4:  $iDeclension = self::DECLENSION_2; break;
			default: $iDeclension = self::DECLENSION_3; break;
		}
		
		if( $i ){
			// преобразуем единицы
			$sWords .= ($i < 3 && $bFemale) ? self::$aFemaleNumbers[$i].' ' : self::$aNumbers[$i].' ';
		}
		return $sWords;
	}
	/**
	 * Генерируем число прописью
	 * @param string $sNumber		- число 
	 * @param string $sDecimalPoint	- десятичный разделитель 
	 * @param boolean $bAbbCurrency	- добавлять ли валюту и копейки
	 * @return string
	 */
	protected static function sNum2Str($sNumber, $sDecimalPoint = '.', $bAbbCurrency = true)
	{
		// отделяем копейки
		@list($iNumber, $iPenny) = explode($sDecimalPoint, (string)$sNumber, 2);
		// приводим к целым числам
		$iNumber = intval($iNumber);
		$iPenny = intval(str_pad(substr($iPenny, 0, 2), 2, '0'));
		
		$sCurrency = 'рублей';	// 0 или миллион или тысяча "рублей"
		if (0 == $iNumber) {
			$sNumber = '0 ';
		}
		else {
			$sNumber = '';
			// преобразуем разряды - миллиарды, миллионы, тысячи
			$aRanges = array(1000000000 => false, 1000000 => false, 1000 => true);
			foreach ($aRanges as $iRange => $bFemale) {
				if ($iNumber >= $iRange) {
					$sSubNumber = self::sSemantic(intval($iNumber/$iRange), $iDeclension, $bFemale);
					$sNumber .= $sSubNumber.self::$aNames[$iRange][$iDeclension].' ';
					$iNumber %= $iRange;
				}
			}
			// преобразуем число от 1 до 999
			if($iNumber > 0){
				$sSubNumber = self::sSemantic($iNumber, $iDeclension, false);
				$sNumber .= $sSubNumber;
				// валюта указывается с нужным склонением
				$sCurrency = self::$aNames[1][$iDeclension];
			}
		}
		
		if ($bAbbCurrency) {
			$sNumber .= $sCurrency.' ';
		
			// копейки прописью
			if($iPenny > 0){
				$sSubNumber = self::sSemantic($iPenny, $iDeclension, true);
				$sNumber .= $sSubNumber.self::$aNames[0][$iDeclension];
			}
			else {
				//$sNumber .= '00 копеек';
			}
		}
	
		return trim($sNumber);
	}
	/**
	 * Преобразует сумму заданную числом (включая копейки) в сумму прописью с указымием валюты рубль.
	 * @param string $sNumber		- сумма
	 * @param string $sDecimalPoint	- разделитель копеек
	 * @return string
	 */
	public static function sRubles($sNumber, $sDecimalPoint = '.')
	{
		return self::sNum2Str($sNumber, $sDecimalPoint, true);
	}
	/**
	 * Преобразует сумму заданную числом (без копеек) в сумму прописью без указания валюты и копеек.
	 * @param string $sNumber		- сумма
	 * @param string $sDecimalPoint	- разделитель копеек
	 * @return string
	 */
	public static function sPlain($sNumber, $sDecimalPoint = '.')
	{
		return self::sNum2Str($sNumber, $sDecimalPoint, false);
	}
}
?>