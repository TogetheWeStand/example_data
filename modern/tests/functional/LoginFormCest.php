<?php

namespace Sokolov\Codeception\Tests\Functional;

class LoginFormCest
{
    const USER_ID_ADMIN = 1;

    public function _before(\FunctionalTester $I)
    {
        $I->amConnectedToDatabase('mysql');
        $I->amOnRoute('auth/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I)
    {
        $I->amLoggedInAs(self::USER_ID_ADMIN);
        $I->amOnPage('/');
        $I->see('Logout (admin)');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByLogin('admin'));
        $I->amOnPage('/');
        $I->see('Logout (admin)');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Login cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[login]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect login or password.');
    }

    /**
     * No fake user yet
     */
//    public function loginSuccessfully(\FunctionalTester $I)
//    {
//        $I->submitForm('#login-form', [
//            'LoginForm[username]' => 'admin',
//            'LoginForm[password]' => 'admin',
//        ]);
//        $I->see('Logout (admin)');
//        $I->dontSeeElement('form#login-form');
//    }
}