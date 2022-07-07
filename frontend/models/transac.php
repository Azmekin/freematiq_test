<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadFile;

/**
 * Signup form
 */
class transac extends ActiveRecord
{

public static function tableName(){
    return 'operations';
}

public function rules (){
    return [

    ];
}

}
//public function upload(){
//    if ($this->validate()){
//        $this->avatar->
//    }
//}

