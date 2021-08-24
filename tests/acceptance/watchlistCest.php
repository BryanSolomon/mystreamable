<?php

class watchlistCest
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
        $I->amOnPage('/watchlist');
        $I->seeInCurrentUrl('/sign-in');
    }

    public function searchFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/watchlist');
        $I->fillField('searchList', 'Captain Marvel');
        $I->click('button-search');
        $I->see('Captain Marvel');
    }

    public function filterTVFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/watchlist');
        $I->selectOption('Item Type', 'TV Show');
        $I->click('Apply Filters');
        $I->dontSee('Captain Marvel');
        $I->see('Game of Thrones');
        $I->see("Grey's Anatomy");
    }

    public function filterMovieFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/watchlist');
        $I->selectOption('Item Type', 'Movie');
        $I->click('Apply Filters');
        $I->see('Captain Marvel');
        $I->dontSee('Game of Thrones');
        $I->dontSee("Grey's Anatomy");
    }

    public function filterTypeAllFunction(AcceptanceTester $I)
    {
        $I->amOnPage('/watchlist');
        $I->selectOption('Item Type', 'All');
        $I->click('Apply Filters');
        $I->see('Captain Marvel');
        $I->see('Game of Thrones');
        $I->see("Grey's Anatomy");
    }

    // public function favoriteTestFunction(AcceptanceTester $I)
    // {
    //    todo: do this if it is able to work on currently watching
    // }

    // public function markCurrentlyWatchingFunction(AccpetanceTester $I){
    //     $I->amOnPage('/watchlist');
    //     $I->see('Captain Marvel');
    //     $I->click('299537-watch');
    //     $I->amOnPage('/currently-watching');
    //     $I->see('Captain Marvel');
    //     $I->amOnPage('/item/index.php?objectID=299537&mediatype=Movie');
    //     $I->click('Remove from Currently Watching');
    //     $I->click('Add to Watchlist');
    // }
}
