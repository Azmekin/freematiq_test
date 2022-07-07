<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class EntryForm extends ActiveRecord
{

    public static function tableName(){
        return 'operations';
    }

    public function rules (){
        return [
      
        ];
    }


}
?>