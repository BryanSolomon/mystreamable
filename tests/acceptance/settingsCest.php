<?php

class settingsCest
{
    public function _before(AcceptanceTester $I)
    {
        // $I->amOnPage('/sign-in');
        // $I->fillField( 'email','bryan@whatsstreamable.com');
        // $I->fillField('userpassword','@Badger45');
        // $I->click('Sign In');
    }

    // public function _after(AcceptanceTester $I)
    // {
    //     // $I->amOnPage('/settings');
    //     // $I->fillField('floatingName', 'Bryan');
    //     // $I->click('namesubmit');
    //     // $I->amOnPage('/settings');
    //     // $I->checkOption('service[]', 'Netflix');
    //     // $I->checkOption('service[]', 'Hulu');
    //     // $I->click('streamingservicesubmit');
    //     // $I->amOnPage('/settings');
    //     // $I->fillField('email', 'bryan@whatsstreamable.com');
    //     // $I->fillField('emailConfirmation','bryan@whatsstreamable.com');
    //     // $I->click('emailsubmit');
    //     // $I->amOnPage('/settings');
    //     // $I->fillField('passwordOld','$newpassword123');
    //     // $I->fillField('passwordNew','@Badger45');
    //     // $I->fillField('passwordConfirmation','@Badger45');
    //     // $I->click('passwordsubmit');
    //     // $I->amOnPage('/settings');
    //     // $I->selectOption('securityQuestion','What is your favorite place to vacation?');
    //     // $I->fillField('securityAnswer', 'Disney');
    //     // $I->fillField('userPassword', '@Badger45');
    //     // $I->click('securityquestionsubmit');
    // }

    // tests
    public function testRedirectIfNotSignedIn(AcceptanceTester $I) {
        $I->amOnPage('/sign-out.php');
        $I->amOnPage('/settings');
        $I->seeInCurrentUrl('/sign-in');
    }

    public function testIfCanSeePage(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','bryan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');

        $I->amOnPage('/settings');
        $I->seeInTitle('Settings | Streamable');
        $I->seeInCurrentUrl('/settings');
        $I->see('Account Settings');
    }

    public function testChangeName(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','bryan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');

        $I->amOnPage('/settings');
        $I->see('Change Name');
        $I->seeInField('floatingName', 'Bryan');
        $I->fillField('floatingName', 'TEST');
        $I->click('namesubmit');
        $I->see('Your name has been updated.');

        $I->amOnPage('/settings');
        $I->seeInField('floatingName', 'TEST');

        // change name back
        $I->amOnPage('/settings');
        $I->fillField('floatingName', 'Bryan');
        $I->click('namesubmit');
    }

    public function testStreamingServices(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','bryan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');

        $I->amOnPage('/settings');
        $I->see('Update Streaming Services');
        $I->seeCheckboxIsChecked('#ss-primeVideo');
        $I->seeCheckboxIsChecked('#ss-other');

        $I->checkOption('service[]', 'Netflix');
        // $I->checkOption('service[]', 'Hulu');
        $I->click('streamingservicessubmit');
        // $I->see('Your streaming services has been updated.');

        $I->amOnPage('/settings');
        $I->seeCheckboxIsChecked('#ss-netflix');
        // $I->seeCheckboxIsChecked('#ss-hulu');
        $I->seeCheckboxIsChecked('#ss-primeVideo');
        $I->seeCheckboxIsChecked('#ss-other');

        // change back
        $I->amOnPage('/settings');
        $I->uncheckOption('service[]', 'Netflix');
        // $I->uncheckOption('service[]', 'Hulu');
        $I->click('streamingservicessubmit');
    }

    public function testChangeEmail(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','bryan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');

        $I->amOnPage('/settings');
        $I->see('Change Email');
        $I->see('Your current email is bryan@whatsstreamable.com. Once your email changes, you will need to use your new email to sign in to your Streamable account. ');
        $I->fillField('floatingEmail', 'TEST@whatsstreamable.com');
        $I->fillField('emailConfirmation', 'TEST@whatsstreamable.com');
        $I->click('emailsubmit');
        $I->see('Your email has been updated.');

        $I->amOnPage('/settings');
        $I->see('Your current email is TEST@whatsstreamable.com. Once your email changes, you will need to use your new email to sign in to your Streamable account.');

        // change back
        $I->amOnPage('/settings');
        $I->fillField('floatingEmail', 'bryan@whatsstreamable.com');
        $I->fillField('emailConfirmation','bryan@whatsstreamable.com');
        $I->click('emailsubmit');
    }

    public function testPasswordChange(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','bryan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');

        $I->amOnPage('/settings');
        $I->see('Change Password');
        $I->fillField('passwordOld', '@Badger45');
        $I->fillField('passwordNew', '$newpassword123');
        $I->fillField('passwordConfirmation', '$newpassword123');
        $I->click('passwordsubmit');
        $I->see('Your password has been updated.');

        //change back
        $I->amOnPage('/settings');
        $I->fillField('passwordOld','$newpassword123');
        $I->fillField('passwordNew','@Badger45');
        $I->fillField('passwordConfirmation','@Badger45');
        $I->click('passwordsubmit');
    }

    public function testSecurityQuestion(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','bryan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');

        $I->amOnPage('/settings');
        $I->see('What is your favorite place to vacation?');
        $I->selectOption('securityQuestion','In what city were you born?');
        $I->fillField('securityAnswer', 'Madison');
        $I->fillField('userPassword', '@Badger45');
        $I->click('securityquestionsubmit');
        $I->see('Your security question has been updated.');

        $I->amOnPage('/settings');
        $I->see('In what city were you born?');

        // change back
        $I->amOnPage('/settings');
        $I->selectOption('securityQuestion','What is your favorite place to vacation?');
        $I->fillField('securityAnswer', 'Disney');
        $I->fillField('userPassword', '@Badger45');
        $I->click('securityquestionsubmit');
    }
}
