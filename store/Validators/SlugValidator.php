<?php


namespace app\store\Validators;


use yii\validators\RegularExpressionValidator;

class SlugValidator extends RegularExpressionValidator
{
	public $pattern = '#^[a-z0-9_-]*$#s';
	public $message = 'Использованы недопусимые символы для Slug. Можно использовать только латинские буквы a - z, цифры 0 - 9 и символы "-" и "_"';
}
