<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadFile;

/**
 * Signup form
 */
class usrBalance extends ActiveRecord
{

public static function tableName(){
    return 'balances';
}

public function rules (){
    return [
        [['sum'], 'string', 'max' => 25],
        [['sum'], 'match' ,'pattern'=>'/^[0-9]+$/u', 'message'=> 'Contact No can Contain only numeric characters.'], 
       
    ];
}
public static function primaryKey()
{
    return ['balances'];
}
}
?>