<?php

namespace Sokolov\Codeception\Tests\Functional;

use app\models\bitrix\user\User;

class RegistrationFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amConnectedToDatabase('mysql');
        $I->amOnRoute('auth/registration');
    }

    public function openRegistrationPage(\FunctionalTester $I)
    {
        $I->see('Регистрация', 'h1');
    }

    public function registrationWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#registry-form', []);
        $I->expectTo('see validations errors');
        $I->see('Email cannot be blank.');
        $I->see('Пароль cannot be blank.');
        $I->see('Подтверждение пароля cannot be blank.');
    }

    public function registrationWithNotSamePasswords(\FunctionalTester $I)
    {
        $I->submitForm('#registry-form', [
            'RegistrationForm[LOGIN]' => 'Stardg@dfhfgdf.ru',
            'RegistrationForm[PASSWORD]' => '123',
            'RegistrationForm[PASSWORD_CONFIRM]' => '1',
        ]);

        $I->expectTo('see validations errors');
        $I->see('Пароли не совпадают.');
    }

    public function registrationAlreadyExists(\FunctionalTester $I)
    {
        $I->submitForm('#registry-form', [
            'RegistrationForm[LOGIN]' => 'Stargorin@rambler.com',
            'RegistrationForm[PASSWORD]' => '1',
            'RegistrationForm[PASSWORD_CONFIRM]' => '1',
        ]);

        $I->expectTo('see validations errors');
        $I->see('Уже зарегистрирован.');
    }

    public function registrationAddRecord()
    {
        $newUser = new User();
        $newUser->LOGIN = 'Test';
        $newUser->PASSWORD = 'hqO6c09Kc918ea054fd6894f865de2017410ebaf';
        $newUser->ACTIVE = 'Y';
        $newUser->EMAIL = 'Test@refdf.ru';

        $date = new \DateTime('now', new \DateTimeZone("UTC"));
        $newUser->DATE_REGISTER = $date->format('Y-m-d H:i:s');

        expect_that($newUser->save());
    }

    public function registrationRemoveRecord()
    {
        $model = User::find()->where(['LOGIN' => 'Test'])->one();
        expect_that($model->delete());
    }
}