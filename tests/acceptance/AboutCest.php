<?php

use yii\helpers\Url;

class AboutCest
{
    public function ensureThatAboutWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('conta/about'));
        $I->see('About', 'h1');
    }
}
