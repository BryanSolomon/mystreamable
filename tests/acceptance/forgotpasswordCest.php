<?php

class forgotpasswordCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // Email(Valid Input)
    public function testValidEmail(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','dongwook@whatsstreamable.com');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','spot');
        $I->click('Verify Account');
        $I->seeInCurrentUrl('forgot-password');
    }

    // Email(Invalid Input: no matching account)
    public function testNoMatchingEmail(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','wook@whatsstreamable.com');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','spot');
        $I->click('Verify Account');
        $I->see('Account not found.');
    }

    // Email(Invalid Input: deos not match user@website.com)
    public function testNotMatchEmail(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','dcha6@wis.edu');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','spot');
        $I->click('Verify Account');
        $I->see('Account not found.');
    }

    // Email(Invalid Input: no email provided)
    public function testEmptyEmail(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','spot');
        $I->click('Verify Account');
        $I->see('Forgot your Streamable password?');
    }

    // Security Question(valid input)
    public function testValidSecurityQuestion(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','dongwook@whatsstreamable.com');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','spot');
        $I->click('Verify Account');
        $I->seeInCurrentUrl('/forgot-password');
    }

    //Security Question (Invalid Input: wrong security question for this account)
    public function testWrongSecurityQuestion(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','dongwook@whatsstreamable.com');
        $I->selectOption('securityquestion','city');
        $I->fillField('securityanswer','spot');
        $I->click('Verify Account');
        $I->see('Incorrect security question or answer.');
    }

    // Security Question (Invalid Input: no security question provided)
    // looks impossible!
    // public function testEmptySecurityQuestion(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');

    //     $I->fillField('email','dongwook@whatsstreamable.com');
    //     // $I->selectOption('securityquestion', arra);
    //     $I->fillField('securityanswer','spot');
    //     $I->click('Verify Account');
    //     $I->see('Incorrect security question or answer.');
    // }

    // Security Answer (Valid Input)
    public function testValidSecurityAnswer(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','dongwook@whatsstreamable.com');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','spot');
        $I->click('Verify Account');
        $I->seeInCurrentUrl('/forgot-password');
    }

    // Security Answer (Invalid Input: wrong security answer for this account)
    public function testWrongSecurityAnswer(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','dongwook@whatsstreamable.com');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','abc');
        $I->click('Verify Account');
        $I->see('Incorrect security question or answer.');
    }

    // Security Answer (Invalid Input: no security answer provided)
    public function testEmptySecurityAnswer(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','dongwook@whatsstreamable.com');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','');
        $I->click('Verify Account');
        $I->see('Incorrect security question or answer.');
    }

    // Click Sign In && Click Verify Account
    public function testClickVerifyAccount(AcceptanceTester $I)
    {
        $I->amOnPage('/forgot-password');

        $I->fillField('email','dongwook@whatsstreamable.com');
        $I->selectOption('securityquestion','pet');
        $I->fillField('securityanswer','spot');
        $I->click('Verify Account');
        $I->seeInCurrentUrl('/forgot-password');
    }

    // Iteration3

    // Password (Valid Input)
    // public function testValidPassword(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');
    //     $I->fillField('email','dongwook@whatsstreamable.com');
    //     $I->selectOption('securityquestion','pet');
    //     $I->fillField('securityanswer','spot');
    //     $I->click('Verify Account');

    //     $I->seeInCurrentUrl('/forgot-password/index.php');
    //     $I->wait(3);
        
    //     $I->fillField('userpassword','@Badger46');
    //     $I->fillField('confirmpassword','@Badger46');
    //     $I->click('Change Password');
    //     $I->seeInCurrentUrl('/sign-in');
    // }

    // Password (Invalid Input: no number)
    // public function testNoNumberPassword(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');

    //     $I->fillField('userpassword','@Badger');
    //     $I->fillField('confirmpassword','@Badger');
    //     $I->click('Change Password');
    //     $I->see('*Invalid Password Format:');
    // }

    // Password (Invalid Input: too few characters)
    // public function testTooFewCharPassword(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');

    //     $I->fillField('userpassword','@Ba45');
    //     $I->fillField('confirmpassword','@Ba45');
    //     $I->click('Change Password');
    //     $I->see('*Invalid Password Format:');
    // }

    // Password (Invalid Input: no special character)
    // public function testNoSpecialCharPassword(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');

    //     $I->fillField('userpassword','Badger46');
    //     $I->fillField('confirmpassword','Badger46');
    //     $I->click('Change Password');
    //     $I->see('*Invalid Password Format:');
    // }

    // Password (Invalid Input: no password provided)
    // public function testEmptyPassword(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');

    //     $I->fillField('userpassword','');
    //     $I->fillField('confirmpassword','');
    //     $I->click('Change Password');
    //     $I->see('*Invalid Password Format:');
    // }

    // Confirm Password (Invalid Input: does not match password)
    // public function testNotMatchPassword(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');

    //     $I->fillField('userpassword','@Badger46');
    //     $I->fillField('confirmpassword','@Badger47');
    //     $I->click('Change Password');
    //     $I->see('Password does not match with Confirm Password');
    // }

    // Confirm Password (Invalid Input: no password confirmation provided)
    // public function testEmptyConfirmationPassword(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');

    //     $I->fillField('userpassword','@Badger46');
    //     $I->fillField('confirmpassword','');
    //     $I->click('Change Password');
    //     $I->see('no password confirmation provided');
    // }

    // Click Change Password
    // public function testClickChangePassword(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/forgot-password');

    //     $I->fillField('userpassword','@Badger46');
    //     $I->fillField('confirmpassword','@Badger46');
    //     $I->click('Change Password');
    //     $I->seeInCurrentUrl('/sign-in');
    // }
}
