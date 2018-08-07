<?php

namespace app\models\bitrix\user;

use \yii\db\ActiveRecord;

/**
 * This is the model class for table "b_uts_user".
 *
 * @property integer $VALUE_ID
 * @property string $UF_IM_SEARCH
 * @property string $UF_LANG
 * @property integer $UF_WALLET
 * @property integer $UF_RATING
 * @property integer $UF_STATUS_ID
 * @property integer $UF_PARTNER_ID
 * @property string $UF_PHONE_CONFIRM
 * @property integer $UF_FEDERAL_AREA
 * @property string $UF_INN
 * @property integer $UF_FAKE_POINTS
 * @property string $UF_WHERE_FROM_CAME
 * @property integer $UF_IS_SHOP_SELLER
 * @property integer $UF_IS_WATCH_SELLER
 * @property string $UF_PERSONAL_CURRENCY
 * @property string $UF_PERSONAL_LANGUAGE
 * @property string $UF_B2B_WORK_TYPE
 * @property string $UF_B2B_USER_CODE_1C
 * @property string $UF_B2B_USER_CONTACT
 * @property string $UF_B2B_COPY_EMAILS
 * @property string $UF_B2B_WORK_INN
 * @property string $UF_B2B_WORK_OGRN
 * @property string $UF_B2B_WORK_KPP
 * @property string $UF_LAST_BROWSER
 * @property string $UF_LAST_IP_ADDRESS
 * @property string $UF_LAST_OS
 * @property string $UF_LAST_DEVICE
 * @property string $UF_DATE_EMAIL_CNFRM
 * @property integer $UF_APPEALS
 * @property string $UF_COUNTRY_REGISTER
 * @property string $UF_PHONE_CNFRM_DATE
 * @property string $UF_SHOP_XML_ID
 * @property string $UF_B2B_PARTNER_CODE
 * @property string $UF_EMAIL_DADATA
 * @property string $UF_EMAIL_QC_DADATA
 * @property string $UF_NEWS_SUBSCRB_SEND
 */
class UtsUser extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_uts_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VALUE_ID'], 'required'],
            [
                [
                    'VALUE_ID',
                    'UF_WALLET',
                    'UF_RATING',
                    'UF_STATUS_ID',
                    'UF_PARTNER_ID',
                    'UF_FEDERAL_AREA',
                    'UF_FAKE_POINTS',
                    'UF_IS_SHOP_SELLER',
                    'UF_IS_WATCH_SELLER',
                    'UF_APPEALS'
                ],
                'integer'
            ],
            [
                [
                    'UF_IM_SEARCH',
                    'UF_LANG',
                    'UF_PHONE_CONFIRM',
                    'UF_INN',
                    'UF_WHERE_FROM_CAME',
                    'UF_PERSONAL_CURRENCY',
                    'UF_PERSONAL_LANGUAGE',
                    'UF_B2B_WORK_TYPE',
                    'UF_B2B_USER_CODE_1C',
                    'UF_B2B_USER_CONTACT',
                    'UF_B2B_COPY_EMAILS',
                    'UF_B2B_WORK_INN',
                    'UF_B2B_WORK_OGRN',
                    'UF_B2B_WORK_KPP',
                    'UF_LAST_BROWSER',
                    'UF_LAST_IP_ADDRESS',
                    'UF_LAST_OS',
                    'UF_LAST_DEVICE',
                    'UF_COUNTRY_REGISTER',
                    'UF_SHOP_XML_ID',
                    'UF_B2B_PARTNER_CODE',
                    'UF_EMAIL_DADATA',
                    'UF_EMAIL_QC_DADATA',
                    'UF_NEWS_SUBSCRB_SEND'
                ],
                'string'
            ],
            [['UF_DATE_EMAIL_CNFRM', 'UF_PHONE_CNFRM_DATE'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VALUE_ID' => 'Value  ID',
            'UF_IM_SEARCH' => 'Uf  Im  Search',
            'UF_LANG' => 'Uf  Lang',
            'UF_WALLET' => 'Uf  Wallet',
            'UF_RATING' => 'Uf  Rating',
            'UF_STATUS_ID' => 'Uf  Status  ID',
            'UF_PARTNER_ID' => 'Uf  Partner  ID',
            'UF_PHONE_CONFIRM' => 'Uf  Phone  Confirm',
            'UF_FEDERAL_AREA' => 'Uf  Federal  Area',
            'UF_INN' => 'Uf  Inn',
            'UF_FAKE_POINTS' => 'Uf  Fake  Points',
            'UF_WHERE_FROM_CAME' => 'Uf  Where  From  Came',
            'UF_IS_SHOP_SELLER' => 'Uf  Is  Shop  Seller',
            'UF_IS_WATCH_SELLER' => 'Uf  Is  Watch  Seller',
            'UF_PERSONAL_CURRENCY' => 'Uf  Personal  Currency',
            'UF_PERSONAL_LANGUAGE' => 'Uf  Personal  Language',
            'UF_B2B_WORK_TYPE' => 'Uf  B2 B  Work  Type',
            'UF_B2B_USER_CODE_1C' => 'Uf  B2 B  User  Code 1 C',
            'UF_B2B_USER_CONTACT' => 'Uf  B2 B  User  Contact',
            'UF_B2B_COPY_EMAILS' => 'Uf  B2 B  Copy  Emails',
            'UF_B2B_WORK_INN' => 'Uf  B2 B  Work  Inn',
            'UF_B2B_WORK_OGRN' => 'Uf  B2 B  Work  Ogrn',
            'UF_B2B_WORK_KPP' => 'Uf  B2 B  Work  Kpp',
            'UF_LAST_BROWSER' => 'Uf  Last  Browser',
            'UF_LAST_IP_ADDRESS' => 'Uf  Last  Ip  Address',
            'UF_LAST_OS' => 'Uf  Last  Os',
            'UF_LAST_DEVICE' => 'Uf  Last  Device',
            'UF_DATE_EMAIL_CNFRM' => 'Uf  Date  Email  Cnfrm',
            'UF_APPEALS' => 'Uf  Appeals',
            'UF_COUNTRY_REGISTER' => 'Uf  Country  Register',
            'UF_PHONE_CNFRM_DATE' => 'Uf  Phone  Cnfrm  Date',
            'UF_SHOP_XML_ID' => 'Uf  Shop  Xml  ID',
            'UF_B2B_PARTNER_CODE' => 'Uf  B2 B  Partner  Code',
            'UF_EMAIL_DADATA' => 'Uf  Email  Dadata',
            'UF_EMAIL_QC_DADATA' => 'Uf  Email  Qc  Dadata',
            'UF_NEWS_SUBSCRB_SEND' => 'Uf  News  Subscrb  Send',
        ];
    }
}
