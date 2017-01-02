<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the base-model class for table "contact".
 *
 * @property integer $id
 * @property string $email_from
 * @property string $name_from
 * @property string $ip_address_from
 * @property string $subject
 * @property string $body
 * @property string $created_at
 * @property string $phone_number
 * @property string $aliasModel
 */
abstract class Contact extends \yii\db\ActiveRecord
{


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'Contacts');
        }else{
            return Yii::t('app', 'Contact');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_from', 'name_from', 'subject', 'body', 'phone_number'], 'required'],
            [['body'], 'string'],
            [['email_from'], 'email'],
            [['created_at'], 'safe'],
            [['email_from', 'name_from', 'ip_address_from'], 'string', 'max' => 255],
            [['subject', 'phone_number'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email_from' => Yii::t('app', 'E-mail'),
            'name_from' => Yii::t('app', 'Nome'),
            'ip_address_from' => Yii::t('app', 'Endereço IP'),
            'subject' => Yii::t('app', 'Assunto'),
            'body' => Yii::t('app', 'Mensagem'),
            'created_at' => Yii::t('app', 'Criado em'),
            'phone_number' => Yii::t('app', 'Telefone'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'ID'),
            //'email_from' => Yii::t('app', 'Email From'),
            // 'name_from' => Yii::t('app', 'Name From'),
            // 'ip_address_from' => Yii::t('app', 'Ip Address From'),
            // 'subject' => Yii::t('app', 'Subject'),
            // 'body' => Yii::t('app', 'Body'),
            // 'created_at' => Yii::t('app', 'Created At'),
            // 'phone_number' => Yii::t('app', 'Phone Number'),
            ]);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\query\ContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ContactQuery(get_called_class());
    }


}