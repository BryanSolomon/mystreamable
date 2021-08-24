<?php

class dashboardCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','bryan@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');
    }

    // tests
    public function testRedirectIfNotSignedIn(AcceptanceTester $I) {
        $I->amOnPage('/sign-out.php');
        $I->amOnPage('/dashboard');
        $I->seeInCurrentUrl('/sign-in');
    }

    public function testCanISeePage(AcceptanceTester $I)
    {
        $I->amOnPage('/dashboard');
        $I->seeInTitle('Dashboard | Streamable');
        $I->seeInCurrentUrl('/dashboard');

        $I->see('What are you watching today?');
        $I->see('Currently Watching');
        $I->see('Watchlist');
        $I->see('Favorites');
        $I->see('History');
        $I->see('See All');
    }

    public function testCurrentlyWatching(AcceptanceTester $I) 
    {
        $I->amOnPage('/dashboard');
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/ePXuKdXZuJx8hHMNr2yM4jY2L7Z.jpg']);
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/6FfCtAuVAW8XJjZ7eWeLibRLWTw.jpg']);
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/ggFHVNu6YYI5L9pCfOacjizRGt.jpg']);
    }

    public function testWatchlist(AcceptanceTester $I)
    {
        $I->amOnPage('/dashboard');
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/57okJJUBK0AaijxLh3RjNUaMvFI.jpg']);
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/Rzope4Pk93Rg1Q2Ae8H0FYwa7n.jpg']);
    }

    public function testFavorites(AcceptanceTester $I) 
    {
        $I->amOnPage('/dashboard');
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/cxCmv23O7p3hyHwqoktHYkZcGsY.jpg']);
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/ggFHVNu6YYI5L9pCfOacjizRGt.jpg']);
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/Rzope4Pk93Rg1Q2Ae8H0FYwa7n.jpg']);
    }

    public function testHistory(AcceptanceTester $I)
    {
        // Switch to a list that has history items
        $I->amOnPage('/sign-out.php');
        $I->amOnPage('/sign-in');
        $I->fillField( 'email','charles@whatsstreamable.com');
        $I->fillField('userpassword','@Badger45');
        $I->click('Sign In');

        // See if history items appear
        $I->amOnPage('/dashboard');
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/sWgBv7LV2PRoQgkxwlibdGXKz1S.jpg']);
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/u3bZgnGQ9T01sWNhyveQz0wH0Hl.jpg']);
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/AtsgWhDnHTq68L0lLsUrCnM7TjG.jpg']);
    }
}
