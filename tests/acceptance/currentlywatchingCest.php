<?php

class currentlywatchingCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        
        $I->fillField( 'email','matthias@whatsstreamable.com');
        $I->fillField('userpassword','#Badger45');
        $I->click('Sign In');

        $I->amOnPage('/item/index.php?objectID=1398&mediatype=TV%20Show');
        $I->selectOption('form select[name=streamingService]', 'Prime Video');
        $I->click('Change Streaming Service');

        $I->amOnPage('/item/index.php?objectID=97546&mediatype=TV%20Show');
        $I->selectOption('form select[name=streamingService]', 'Apple TV+');
        $I->click('Change Streaming Service');
        
        $I->amOnPage('/item/index.php?objectID=14505&mediatype=Movie');
        $I->selectOption('form select[name=streamingService]', 'Prime Video');
        $I->click('Change Streaming Service');
    }

    // tests
    public function testRedirectIfNotSignedIn(AcceptanceTester $I) {
        $I->amOnPage('/sign-out.php');
        $I->amOnPage('/currently-watching');
        $I->seeInCurrentUrl('/sign-in');
    }

    public function searchFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/currently-watching');
        $I->fillField('searchList', 'The Sopranos');
        $I->click('button-search');
        $I->see('The Sopranos');
    }

    public function filterTVFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/currently-watching');
        $I->selectOption('Item Type', 'TV Show');
        $I->click('Apply Filters');
        $I->dontSee('Bachelor Party Vegas');
        $I->see('Ted Lasso');
        $I->see('The Sopranos');
    }

    public function filterMovieFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/currently-watching');
        $I->selectOption('Item Type', 'Movie');
        $I->click('Apply Filters');
        $I->see('Bachelor Party Vegas');
        $I->dontSee('Ted Lasso');
        $I->dontSee('The Sopranos');
    }

    public function filterTypeAllFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/currently-watching');
        $I->selectOption('Item Type', 'All');
        $I->click('Apply Filters');
        $I->see('Bachelor Party Vegas');
        $I->see('Ted Lasso');
        $I->see('The Sopranos');
    }

    public function filterStreamingSelectedFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/currently-watching');
        $I->selectOption('Streaming Service', 'Prime Video');
        $I->click('Apply Filters');
        $I->see('Bachelor Party Vegas');
        $I->see('The Sopranos');
        $I->dontSee('Ted Lasso');
    }

    public function filterStreamingAllFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/currently-watching');
        $I->selectOption('Streaming Service', 'All');
        $I->click('Apply Filters');
        $I->see('Bachelor Party Vegas');
        $I->see('Ted Lasso');
        $I->see('The Sopranos');
    }

    public function filterMultipleFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/currently-watching');
        $I->selectOption('Streaming Service', 'Prime Video');
        $I->selectOption('Item Type', 'TV Show');
        $I->click('Apply Filters');
        $I->dontsee('Bachelor Party Vegas');
        $I->dontSee('Ted Lasso');
        $I->see('The Sopranos');
    }

    // public function favoriteTestFunction(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/favorites');
    //     // $I->dontSee('The Sopranos');
    //     $I->amOnPage('/currently-watching');
    //     $I->click(\Codeception\Util\Locator::contains('a#1398-fav', 'Favorite'));
    //     // $I->amOnPage('/currently-watching');
    //     // $I->see(\Codeception\Util\Locator::contains('a#1398-unfav', 'Unfavorite'));
    //     // $I->click('a#1398-fav');
    //     // $I->amOnPage('/favorites');
    //     // $I->see('The Sopranos');
    //     // $I->amOnPage('/currently-watching');
    //     // $I->click(\Codeception\Util\Locator::elementAt('#1398-unfav', 1));
    //     // // $I->click('a#1398-unfav');
    //     // $I->amOnPage('/favorites');
    //     // $I->dontSee('The Sopranos');
    // }
}
