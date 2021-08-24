<?php

class historyCest
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
        $I->amOnPage('/history');
        $I->seeInCurrentUrl('/sign-in');
    }

    public function searchFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/history');
        $I->fillField('searchList', 'Riverdale');
        $I->click('button-search');
        $I->see('Riverdale');
    }

    public function filterTVFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/history');
        $I->selectOption('Item Type', 'TV Show');
        $I->click('Apply Filters');
        $I->see('The Masked Singer');
        $I->see('Riverdale');
    }

    public function filterMovieFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/history');
        $I->selectOption('Item Type', 'Movie');
        $I->click('Apply Filters');
        $I->dontSee('The Masked Singer');
        $I->dontSee('Riverdale');
    }

    public function filterTypeAllFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/history');
        $I->selectOption('Item Type', 'All');
        $I->click('Apply Filters');
        $I->see('The Masked Singer');
        $I->see('Riverdale');
    }

    // public function favoriteTestFunction(AcceptanceTester $I)
    // {
    //    todo: do this if it is able to work on currently watching
    // }

    // public function removeHistoryFunction(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/history');
    //     $I->see('The Masked Singer');
    //     $I->click('Remove from History');
    //     $I->amOnPage('/history');
    //     $I->dontSee('The Masked Singer');
    //     // $I->amOnPage('/item/index.php?objectID=84910&mediatype=TV%20Show');
    //     // $I->click('Mark Currently Watching');
    //     // $I->click('Remove from Currently Watching');
    //     // $I->click('Mark Complete');
    // }
}
