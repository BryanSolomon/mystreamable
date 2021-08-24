<?php

class SigninCest
{
    public function _before(AcceptanceTester $I)
    {
            $I->amOnPage('/sign-in');
    }

    // tests
    public function validInput(AcceptanceTester $I)
    {
        $I->fillField( 'email','nathan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');
        $I->see('What are you watching today?');
    }
    
    public function noPassword(AcceptanceTester $I)
    {
        $I->fillField('email','nathan@whatsstreamable.com');
        $I->click('Sign In');
        $I->see('*Invalid Password Format: Password must be between 8 and 255 characters inclusive and contain at least one letter, one number, and one special character.');
    }
    
    public function invalidEmailForm(AcceptanceTester $I)
    {
        $I->fillField('email','nathan');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');
        $I->see('*Invalid Email Format: Email format must match user@website.com.');
        
    }
    
    public function badEmail(AcceptanceTester $I)
    {
        $I->fillField('email','nvsmith@wis.edu');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');
        $I->see('Incorrect email or password.');
        
    }
    
    public function badPassFewChars(AcceptanceTester $I)
    {
        $I->fillField('email','nathan@whatsstreamable.com');
        $I->fillField('userpassword','aaa');
        $I->click('Sign In');
        $I->see('*Invalid Password Format: Password must be between 8 and 255 characters inclusive and contain at least one letter, one number, and one special character.');
    }
    
    public function badPass(AcceptanceTester $I)
    {
        $I->fillField('email','nathan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger43');
        $I->click('Sign In');
        $I->see('Incorrect email or password.');
        
    }
    
        public function badPassNoNum(AcceptanceTester $I)
    {
        $I->fillField('email','nathan@whatsstreamable.com');
        $I->fillField('userpassword','@Badgerrrr');
        $I->click('Sign In');
        $I->see('*Invalid Password Format: Password must be between 8 and 255 characters inclusive and contain at least one letter, one number, and one special character.');
        
    }
    
        public function badPassNoSpecChar(AcceptanceTester $I)
    {
        $I->fillField('email','nathan@whatsstreamable.com');
        $I->fillField('userpassword','BBadgerrrr');
        $I->click('Sign In');
        $I->see('*Invalid Password Format: Password must be between 8 and 255 characters inclusive and contain at least one letter, one number, and one special character.');
        
    }
    
    public function clickForgotPass(AcceptanceTester $I)
    {
        $I->click('Forgot Password?');
        $I->see('Forgot your Streamable password?');
    }
    
    public function clickCreateAccount(AcceptanceTester $I)
    {
        $I->click('Create an Account');
        $I->see('Create your Streamable account');
    }
    
   
}
