<?php

class favoritesCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        
        $I->fillField( 'email','matthias@whatsstreamable.com');
        $I->fillField('userpassword','#Badger45');
        $I->click('Sign In');
    }

    // tests
    public function testRedirectIfNotSignedIn(AcceptanceTester $I) {
        $I->amOnPage('/sign-out.php');
        $I->amOnPage('/favorites');
        $I->seeInCurrentUrl('/sign-in');
    }

    public function searchFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/favorites');
        $I->fillField('searchList', 'Ted Lasso');
        $I->click('button-search');
        $I->see('Ted Lasso');
    }

    public function filterTVFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/favorites');
        $I->selectOption('Item Type', 'TV Show');
        $I->click('Apply Filters');
        $I->dontSee('Captain Marvel');
        $I->see('Ted Lasso');
        $I->see('Riverdale');
    }

    public function filterMovieFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/favorites');
        $I->selectOption('Item Type', 'Movie');
        $I->click('Apply Filters');
        $I->see('Captain Marvel');
        $I->dontSee('Ted Lasso');
        $I->dontSee('Riverdale');
    }

    public function filterTypeAllFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/favorites');
        $I->selectOption('Item Type', 'All');
        $I->click('Apply Filters');
        $I->see('Captain Marvel');
        $I->see('Ted Lasso');
        $I->see('Riverdale');
    }

    // public function favoriteTestFunction(AcceptanceTester $I)
    // {
    //    todo: do this if it is able to work on currently watching
    // }

}
