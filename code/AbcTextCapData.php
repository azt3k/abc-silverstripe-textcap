<?php

class AbcTextCapData {

	public static $questions = array (
		array (
			'q'		=> 'What colour is an orange?',
			'a'		=> array('orange')
		),
		array (
			'q'		=> 'Type the word "toothbrush" into the box provided',
			'a'		=> array('toothbrush')
		),
		array (
			'q'		=> 'Type the word "donkey" into the box provided',
			'a'		=> array('donkey')
		),
		array (
			'q'		=> 'How many fingers does a human have?',
			'a'		=> array('5','five')
		),
		array (
			'q'		=> 'Is ice hot or cold?',
			'a'		=> array('cold')
		),
		array (
			'q'		=> 'Is fire hot or cold?',
			'a'		=> array('hot')
		),
		array (
			'q'		=> 'What is Jeremy\'s name',
			'a'		=> array('jeremy')
		),
		array (
			'q'		=> 'What is Davis\' name',
			'a'		=> array('davis')
		),
		array (
			'q'		=> 'How many apples are in a bag of one hundred apples?',
			'a'		=> array('one hundred', '100')
		),
		array (
			'q'		=> 'How many years has an eight year old been alive?',
			'a'		=> array('eight', '8')
		),
		array (
			'q'		=> 'What does five plus five equal?',
			'a'		=> array('ten', '10')
		),
		array (
			'q'		=> 'What is bigger; an elephant or a mouse?',
			'a'		=> array('elephant','an elephant')
		),
		array (
			'q'		=> 'What is smaller; an elephant or a mouse?',
			'a'		=> array('mouse','a mouse')
		),
		array (
			'q'		=> 'Do fish live on land or in water?',
			'a'		=> array('in water','water')
		)

	);

	public static function getChallenge(){
		$rand = mt_rand(0, 1);
		if ($rand) {
			$data = (object) self::$questions[array_rand(self::$questions)];
		}else {
			$num1 = mt_rand(0, 9);
			$num2 = mt_rand(0, 9);
			$calc = mt_rand(0, 1) ? 'sum' : 'difference' ;
			$total = $calc == 'sum' ? $num1 + $num2 : $num1 - $num2 ;
			$data = (object) array (
				'q'		=> 'What does '.$num1.' '.($calc=='sum' ? '+' : '-').' '.$num2.' equal?',
				'a'		=> array($total)
			);
		}
		return $data;
	}


}