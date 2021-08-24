<?php

class homepageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // header
    public function seeheader(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Track all of your');
    }

    public function seesignin(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Sign In');
    }

    public function seeSoManyStreamingServices(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('So. Many. Streaming. Services.');
    }

    public function seeAddToList(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Add it to your list.');
    }

    public function seeManage(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Manage content from any device.');
    }

    public function seeFooter(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Streamable data, images, and item provider information provided by');
    }

    public function actuallySignInAndTestRedirect(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','matt@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');
        $I->amOnPage('/');
        $I->seeInCurrentUrl('/dashboard');
        $I->see('Sign Out');
    }
    

}
