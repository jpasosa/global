<?php


function month_to_letter($month)
{

	switch ($month)
	{
		case '1':
			$word_month = 'Ene';
			break;
		case '2':
			$word_month = 'Feb';
			break;
		case '3':
			$word_month = 'Mar';
			break;
		case '4':
			$word_month = 'Abr';
			break;
		case '5':
			$word_month = 'May';
			break;
		case '6':
			$word_month = 'Jun';
			break;
		case '7':
			$word_month = 'Jul';
			break;
		case '8':
			$word_month = 'Ago';
			break;
		case '9':
			$word_month = 'Sept';
			break;
		case '10':
			$word_month = 'Oct';
			break;
		case '11':
			$word_month = 'Nov';
			break;
		case '12':
			$word_month = 'Dic';
			break;
		default:
			$word_month = '';
			break;
	}

	return $word_month;

}

?>