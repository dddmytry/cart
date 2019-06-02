<?php


namespace app\store\Forms\Product;


use yii\base\Model;
use yii\web\UploadedFile;

class PhotosForm extends Model
{
	/** @var UploadedFile */
	public $files;

	public function rules(): array
	{
		return [
			['files', 'each', 'rule' => ['image']]
		];
	}

	public function attributeLabels(): array
	{
		return [
			'files' => 'Фотографии',
		];
	}

	public function beforeValidate()
	{
		if (parent::beforeValidate()){
			$this->files = UploadedFile::getInstances($this, 'files');
			return true;
		}
		return false;
	}
}
