<?php

class CreateAccountCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/create-account');
    }

    // tests
    public function titleText(AcceptanceTester $I)
    {
        $I->see("Create your Streamable account");
    }
    
    public function subheadingText(AcceptanceTester $I) {
        $I->see("Account Information");
        $I->see("Select streaming services");
    }

    public function defaultPasswordRequirementsDisplay(AcceptanceTester $I) {
        $I->see("*Must contain at least 1 number.");
        $I->see("*Must contain at least 1 special character.");
        $I->see("*Must be at least 8 but less than 255 characters.");
    }

    public function signInLink(AcceptanceTester $I) {
        $I->see("Already have an account? Sign In");
        $I->click("Already have an account? Sign In");
        $I->seeInCurrentUrl('/sign-in');
    }

    public function nameInvalidNumber(AcceptanceTester $I) {
        $I->fillField('name', '2');
        $I->click('submit');
        $I->see("*Invalid Name Format: Only alphabets allowed, minimum of 2 characters, maximum of 25 characters.");
    }

    public function nameInvalidSymbol(AcceptanceTester $I) {
        $I->fillField('name', '&');
        $I->click('submit');
        $I->see("*Invalid Name Format: Only alphabets allowed, minimum of 2 characters, maximum of 25 characters.");
    }

    public function nameInvalidTooFewCharacters(AcceptanceTester $I) {
        $I->fillField('name', 'a');
        $I->click('submit');
        $I->see("*Invalid Name Format: Only alphabets allowed, minimum of 2 characters, maximum of 25 characters.");
    }

    public function nameInvalidTooManyCharacters(AcceptanceTester $I) {
        $I->fillField('name', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        $I->click('submit');
        $I->see("*Invalid Name Format: Only alphabets allowed, minimum of 2 characters, maximum of 25 characters.");
    }

    public function nameInvalidNoInput(AcceptanceTester $I) {
        $I->fillField('name', '');
        $I->click('submit');
        $I->see("*Invalid Name Format: Only alphabets allowed, minimum of 2 characters, maximum of 25 characters.");
    }

    public function emailInvalidWrongFormat(AcceptanceTester $I) {
        $I->fillField('email', 'a');
        $I->click('submit');
        $I->see("*Invalid Email Format: Email format must match user@website.com.");
    }

    public function emailInvalidNoInput(AcceptanceTester $I) {
        $I->fillField('email', '');
        $I->click('submit');
        $I->see("*Invalid Email Format: Email format must match user@website.com.");
    }

    public function passwordInvalidTooFewCharacters(AcceptanceTester $I) {
        $I->fillField('userpassword', 'a1#');
        $I->click('submit');
        $I->see("*Must be at least 8 but less than 255 characters.");
    }

    public function passwordInvalidNoNumber(AcceptanceTester $I) {
        $I->fillField('userpassword', 'abcdefgh#');
        $I->click('submit');
        $I->see("*Must contain at least 1 number.");
    }

    public function passwordInvalidNoSpecialCharacter(AcceptanceTester $I) {
        $I->fillField('userpassword', 'abcdefgh1');
        $I->click('submit');
        $I->see("*Must contain at least 1 special character.");
    }

    public function passwordInvalidNoInput(AcceptanceTester $I) {
        $I->fillField('userpassword', '');
        $I->click('submit');
        $I->see("*Must contain at least 1 number.");
        $I->see("*Must contain at least 1 special character.");
        $I->see("*Must be at least 8 but less than 255 characters.");
    }

    public function passwordConfirmInvalidConfirmPassDoesntMatch(AcceptanceTester $I) {
        $I->fillField('userpassword', '@Badger45');
        $I->fillField('confirmpassword', 'abcdef123#');
        $I->click('submit');
        $I->see("*The Confirm Password does not match.");
    }

    public function passwordConfirmInvalidNoInput(AcceptanceTester $I) {
        $I->fillField('userpassword', '@Badger45');
        $I->fillField('confirmpassword','');
        $I->click('submit');
        $I->see("*The Confirm Password does not match.");
    }

    // public function securityNoQuestionChosen(AcceptanceTester $I) {
    //     $I->click('submit');
    //     $I->see("*Select Security Question");
    // }

    public function securityNoAnswerProvided(AcceptanceTester $I) {
        $I->fillField('securityanswer', '');
        $I->click('submit');
        $I->see("*The Security Answer field must be at least 1 character.");
    }

    public function streamingServicesNoneSelected(AcceptanceTester $I) {
        $I->click('submit');
        $I->see("*Select at least one streaming service.");
    }

    public function validInput(AcceptanceTester $I) {
        $I->fillField('name', 'Adil');
        $I->fillField('email', 'adil@whatsstreamable.com');
        $I->fillField('userpassword', '@Badger45');
        $I->fillField('confirmpassword', '@Badger45');
        $I->selectOption('securityquestion', 'pet');
        $I->fillField('securityanswer', 'Bucky');
        $I->checkOption('service[]', 'Netflix');
        $I->click('submit');
        $I->amOnPage('/sign-in');
        $I->fillField('email', 'adil@whatsstreamable.com');
        $I->fillField('userpassword', '@Badger45');
        $I->click('submit');
        // $I->seeInCurrentUrl('/dashboard');
        $I->amOnPage('/settings');
        $I->see('adil@whatsstreamable.com');
    }
}
