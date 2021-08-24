<?php

class searchCest
{
    public function _before(AcceptanceTester $I)
    {

    }

    // tests
    public function searchMovie(AcceptanceTester $I)
    {
        //use \Codeception\Util\Locator;
        $I->amOnPage('/search');
        $I->fillField('search','lord of the rings');
        $I->click('submit');
        $I->see('The Lord of the Rings: The Two Towers');
        $I->see('Go to movie');
        $I->click(\Codeception\Util\Locator::href('../item/index.php?objectID=121&mediatype=Movie'));
        $I->seeInCurrentUrl('/item/index.php?objectID=121&mediatype=Movie');
    }
    
    public function searchShow(AcceptanceTester $I) {
        $I->amOnPage('/search');
        $I->fillField('search','breaking bad');
        $I->click('submit');
        $I->see('Go to TV Show');
        $I->seeElement('img',['src' => 'https://image.tmdb.org/t/p/original/ggFHVNu6YYI5L9pCfOacjizRGt.jpg']);
        $I->click(\Codeception\Util\Locator::href('../item/index.php?objectID=1396&mediatype=TV Show'));
        $I->seeInCurrentUrl('item/index.php?objectID=1396&mediatype=TV%20Show');
    }
    

}
?>
