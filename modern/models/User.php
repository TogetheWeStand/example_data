<?php

namespace app\models;

use \yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\db\PushUserToken;

/**
 * Class User
 * @package app\models
 *
 * @property integer $id
 * @property string $timestamp_x
 * @property string $login
 * @property string $password
 * @property string $checkword
 * @property string $active
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $last_login
 * @property string $date_register
 * @property string $lid
 * @property string $personal_profession
 * @property string $personal_www
 * @property string $personal_icq
 * @property string $gender
 * @property string $personal_birthdate
 * @property integer $personal_photo
 * @property string $personal_phone
 * @property string $personal_fax
 * @property string $personal_mobile
 * @property string $personal_pager
 * @property string $personal_street
 * @property string $personal_mailbox
 * @property string $personal_city
 * @property string $personal_state
 * @property string $personal_zip
 * @property string $personal_country
 * @property string $personal_notes
 * @property string $work_company
 * @property string $work_department
 * @property string $work_position
 * @property string $work_www
 * @property string $work_phone
 * @property string $work_fax
 * @property string $work_pager
 * @property string $work_street
 * @property string $work_mailbox
 * @property string $work_city
 * @property string $work_state
 * @property string $work_zip
 * @property string $work_country
 * @property string $work_profile
 * @property integer $work_logo
 * @property string $work_notes
 * @property string $admin_notes
 * @property string $stored_hash
 * @property string $xml_id
 * @property string $birthday
 * @property string $external_auth_id
 * @property string $checkword_time
 * @property string $patronymic
 * @property string $confirm_code
 * @property integer $login_attempts
 * @property string $last_activity_date
 * @property string $auto_time_zone
 * @property string $time_zone
 * @property integer $time_zone_offset
 * @property string $title
 * @property string $language_id
 * @property boolean $push_subscription
 * @property string $confirmation_hash
 * @property string $confirmed
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 'N';
    const STATUS_ACTIVE = 'Y';

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToken()
    {
        return $this->hasMany(PushUserToken::className(),['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my.user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'timestamp_x',
                    'lats_login',
                    'date_register',
                    'birthday',
                    'checkword_time',
                    'last_activity_date'
                ],
                'safe'
            ],
            [['login', 'password', 'date_register'], 'required'],
            [['personal_photo', 'work_logo', 'login_attempts', 'time_zone_offset'], 'integer'],
            [
                [
                    'personal_street',
                    'personal_notes',
                    'work_street',
                    'work_profile',
                    'work_notes',
                    'admin_notes'
                ],
                'string'
            ],
            [
                [
                    'login',
                    'password',
                    'checkword',
                    'name',
                    'surname',
                    'personal_birthdate',
                    'patronymic',
                    'time_zone'
                ],
                'string',
                'max' => 50
            ],
            [['active', 'gender', 'auto_time_zone', 'confirmed'], 'string', 'max' => 1],
            [
                [
                    'email',
                    'personal_profession',
                    'personal_www',
                    'personal_icq',
                    'personal_phone',
                    'personal_fax',
                    'personal_mobile',
                    'personal_pager',
                    'personal_mailbox',
                    'personal_city',
                    'personal_state',
                    'personal_zip',
                    'personal_country',
                    'work_company',
                    'work_department',
                    'work_position',
                    'work_www',
                    'work_phone',
                    'work_fax',
                    'work_pager',
                    'work_mailbox',
                    'work_city',
                    'work_state',
                    'work_zip',
                    'work_country',
                    'xml_id',
                    'external_auth_id',
                    'title',
                    'confirmation_hash'
                ],
                'string',
                'max' => 255
            ],
            [['lid', 'language_id'], 'string', 'max' => 2],
            [['stored_hash'], 'string', 'max' => 32],
            [['confirm_code'], 'string', 'max' => 8],
            [
                ['login', 'external_auth_id'],
                'unique',
                'targetAttribute' => ['login', 'external_auth_id'],
                'message' => 'The combination of Login and External  Auth  ID has already been taken.'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'timestamp_x' => 'Timestamp  X',
            'login' => 'Login',
            'password' => 'Password',
            'checkword' => 'Checkword',
            'active' => 'Active',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'last_login' => 'Last Login',
            'date_register' => 'Date Register',
            'lid' => 'Lid',
            'personal_profession' => 'Personal Profession',
            'personal_www' => 'Personal Www',
            'personal_icq' => 'Personal Icq',
            'gender' => 'Gender',
            'personal_birthdate' => 'Personal Birthdate',
            'personal_photo' => 'Personal Photo',
            'personal_phone' => 'Personal Phone',
            'personal_fax' => 'Personal Fax',
            'personal_mobile' => 'Personal Mobile',
            'personal_pager' => 'Personal Pager',
            'personal_street' => 'Personal Street',
            'personal_mailbox' => 'Personal Mailbox',
            'personal_city' => 'Personal City',
            'personal_state' => 'Personal State',
            'personal_zip' => 'Personal Zip',
            'personal_country' => 'Personal Country',
            'personal_notes' => 'Personal Notes',
            'work_company' => 'Work Company',
            'work_department' => 'Work Department',
            'work_position' => 'Work Position',
            'work_www' => 'Work Www',
            'work_phone' => 'Work Phone',
            'work_fax' => 'Work Fax',
            'work_pager' => 'Work Pager',
            'work_street' => 'Work Street',
            'work_mailbox' => 'Work Mailbox',
            'work_city' => 'Work City',
            'work_state' => 'Work State',
            'work_zip' => 'Work Zip',
            'work_country' => 'Work Country',
            'work_profile' => 'Work Profile',
            'work_logo' => 'Work Logo',
            'work_notes' => 'Work Notes',
            'admin_notes' => 'Admin Notes',
            'stored_hash' => 'Stored Hash',
            'xml_id' => 'Xml ID',
            'birthday' => 'Birthday',
            'external_auth_id' => 'External Auth  ID',
            'checkword_time' => 'Checkword Time',
            'patronymic' => 'Patronymic',
            'confirm_code' => 'Confirm Code',
            'login_attempts' => 'Login Attempts',
            'last_activity_date' => 'Last Activity Date',
            'auto_time_zone' => 'Auto Time Zone',
            'time_zone' => 'Time Zone',
            'time_zone_offset' => 'Time Zone Offset',
            'title' => 'Title',
            'language_id' => 'Language ID',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'active' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByLogin(string $login)
    {
        return static::findOne(['login' => $login, 'active' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $salt = $this->getCurrentPasswordSalt();

        return $this->password === $salt . md5($salt . $password);
    }

    /**
     * source code from /bitrix/modules/main/classes/general/user.php:Update()
     *
     * @param array $password
     * @return string
     * @throws \Exception
     */
    public static function generatePasswordHash(array $password) : string
    {
        $salt = self::randString(8, [
            'abcdefghijklnmopqrstuvwxyz',
            'ABCDEFGHIJKLNMOPQRSTUVWXYZ',
            '0123456789',
            ",.<>/?;:[]{}\\|~!@#\$%^&*()-_+=",
        ]);

        return $salt . md5($salt . $password['password']);
    }

    /**
     * Password salt generator
     * @param int $stringLength
     * @param mixed $characters
     * @return bool|string
     * @throws \Exception
     */
    public static function randString($stringLength = 10, $characters = false)
    {
        $allChars = 'abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789';

        $string = '';
        if (\is_array($characters)) {
            while (\strlen($string) < $stringLength) {
                if (\function_exists('shuffle')) {
                    shuffle($characters);
                }

                foreach ($characters as $chars) {
                    $n = \strlen($chars) - 1;
                    $string .= $chars[random_int(0, $n)];
                }
            }

            if (\strlen($string) > \count($characters)) {
                $string = substr($string, 0, $stringLength);
            }
        } else {
            if ($characters !== false) {
                $chars = $characters;
                $n = \strlen($characters) - 1;
            } else {
                $chars = $allChars;
                $n = 61; //strlen($allChars)-1;
            }

            for ($i = 0; $i < $stringLength; $i++) {
                $string .= $chars[random_int(0, $n)];
            }
        }

        return $string;
    }

    /**
     * @return bool|string
     */
    private function getCurrentPasswordSalt()
    {
        $salt = '';

        if (\strlen($this->password) > 32) {
            $salt = substr($this->password, 0, -32);
        }

        return $salt;
    }

    /**
     * @return bool
     */
    public function isActive() : bool
    {
        return $this->active === self::STATUS_ACTIVE;
    }
}
