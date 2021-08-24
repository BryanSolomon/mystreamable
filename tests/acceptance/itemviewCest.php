<?php

class itemviewCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','matt@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');
    }
    
    //  Test add movie to favorites
    public function favoriteMovie(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->click('favorite');
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->see('unfavorite');    
    }
    public function unfavoriteMovie(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->click('unfavorite');
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->see('favorite');    
    }


    // Test add movie to currently watching
    public function currentlywatchingMovie(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->click('Mark Currently Watching');
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->see('Remove from Currently Watching');    
    }
    public function uncurrentlywatchingMovie(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->click('Remove from Currently Watching');
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->see('Mark Currently Watching');    
    }


    // Test add movie to watchlist
    public function watchlistMovie(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->click('Add to Watchlist');
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->see('Remove from Watchlist');    
    }
    public function unwatchlistMovie(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->click('Remove from Watchlist');
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->see('Add to Watchlist');
    }



    // Test add movie to mark complete
    public function markcompleteMovie(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->click('Mark Currently Watching');
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->click('Mark Complete');
        $I->amOnPage('/item/index.php?objectID=738562&mediatype=Movie');
        $I->see('Mark Currently Watching');    
    }



    //  Test add TVSHOW to favorites
    public function favoriteTVSHOW(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->click('favorite');
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->see('unfavorite');    
    }
    public function unfavoriteTVSHOW(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->click('unfavorite');
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->see('favorite');    
    }


    // Test add TVSHOW to currently watching
    public function currentlywatchingTVSHOW(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->click('Mark Currently Watching');
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->see('Remove from Currently Watching');    
    }
    public function uncurrentlywatchingTVSHOW(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->click('Remove from Currently Watching');
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->see('Mark Currently Watching');    
    }


    // Test add TVSHOW to watchlist
    public function watchlistTVSHOW(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->click('Add to Watchlist');
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->see('Remove from Watchlist');    
    }
    public function unwatchlistTVSHOW(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->click('Remove from Watchlist');
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->see('Add to Watchlist');
    }


    // Test add TVSHOW to mark complete
    public function markcompleteTVSHOW(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->click('Mark Currently Watching');
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->click('Mark Complete');
        $I->amOnPage('/item/index.php?objectID=1399&mediatype=TV%20Show');
        $I->see('Mark Currently Watching');    
    }


    // TEST TV DETAILS
    public function tvshowdetails(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=1396&mediatype=TV%20Show');
        $I->see("Overview: When Walter White, a New Mexico chemistry teacher, is diagnosed with Stage III cancer and given a prognosis of only two years left to live. He becomes filled with a sense of fearlessness and an unrelenting desire to secure his family's financial future at any cost as he enters the dangerous world of drugs and crime.");
        $I->see('Number of Seasons: 5');
        $I->see('Number of Episodes: 62');
        $I->see('Genres: Drama');
        $I->see('Available On: Netflix, DIRECTV');
        $I->see('Release Date: 2008-01-20');   
    }
    
    // Test MOVIE DETAILS
    public function moviedetails(AcceptanceTester $I)
    {
        $I->amOnPage('/item/index.php?objectID=299534&mediatype=Movie');
        $I->see('Release Date: 2019-04-24');
        $I->see('Audience Score: 8.3/10');
        $I->see('Duration: 181 minutes');
        $I->see('Genres: Adventure, Science Fiction, Action');
        $I->see('Available On: Disney Plus, Sling TV');
        $I->see('Revenue: $2,797,800,564');   
    }

    // Test TV Show Set Streaming Service
    public function tvSetStreamingService(AcceptanceTester $I) {
        $I->amOnPage('/item/index.php?objectID=387&mediatype=TV%20Show');
        $I->click('Mark Currently Watching');
        $I->amOnPage('/item/index.php?objectID=387&mediatype=TV%20Show');
        $I->selectOption('streamingService', 'Paramount+');
        $I->click('Change Streaming Service');
        $I->amOnPage('/item/index.php?objectID=387&mediatype=TV%20Show');
        $I->seeInField('streamingService', 'Paramount+');

        // Remove from currently watching
        $I->amOnPage('/item/index.php?objectID=387&mediatype=TV%20Show');
        $I->click('Remove from Currently Watching');
    }

    // Test TV Show Set Season and Episode
    public function tvSetSeasonEpisode(AcceptanceTester $I) {
        $I->amOnPage('/item/index.php?objectID=387&mediatype=TV%20Show');
        $I->click('Mark Currently Watching');
        $I->amOnPage('/item/index.php?objectID=387&mediatype=TV%20Show');
        $I->selectOption('season', 2);
        $I->selectOption('episode', 5);
        $I->click('Update Progress');
        $I->amOnPage('/item/index.php?objectID=387&mediatype=TV%20Show');
        $I->seeInField('season', 2);
        $I->seeInField('episode', 5);

        // Remove from currently watching
        $I->amOnPage('/item/index.php?objectID=387&mediatype=TV%20Show');
        $I->click('Remove from Currently Watching');
    }
    
}
