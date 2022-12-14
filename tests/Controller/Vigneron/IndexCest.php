<?php


namespace App\Tests\Controller\Vigneron;
use App\Factory\VigneronFactory;
use App\Tests\ControllerTester;

class IndexCest
{
    public function showList(ControllerTester $I): void
    {
        $vigneron = VigneronFactory::createMany(5);

        $I->amOnPage('/vigneron');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Liste des vignerons');
        $I->see('Liste des vignerons', 'h1');
        $I->seeNumberOfElements('ul.vigneron > li', 0);
    }

    public function clickOnLink(ControllerTester $I): void
    {
        VigneronFactory::createMany(5);
        $joe = VigneronFactory::createOne(['nom' => 'Aaaaaaaaaaaaaaa', 'prenom' => 'Joe']);

        $I->amOnPage('/vigneron');
        $I->click('Aaaaaaaaaaaaaaa, Joe');
        $I->seeResponseCodeIsSuccessful();
    }

    public function filter(ControllerTester $I): void
    {
        VigneronFactory::createOne(['nom' => 'Aaaaaaaaaaaaaaa', 'prenom' => 'Joe']);
        VigneronFactory::createOne(['nom' => 'Bbbbbbbbbbbbbbb', 'prenom' => 'Bob']);
        VigneronFactory::createOne(['nom' => 'Ccccccccccccccc', 'prenom' => 'Jean']);

        $I->amOnPage('/vigneron');
        $I->grabMultiple('Aaaaaaaaaaaaaaa, Joe');
        $I->seeResponseCodeIsSuccessful();
    }

    public function search(ControllerTester $I): void
    {
        VigneronFactory::createMany(2);
        VigneronFactory::createOne(['nom' => 'video', 'prenom' => 'ezrgrrrrr']);
        VigneronFactory::createOne(['nom' => 'gdsff', 'prenom' => 'video']);
        $I->amOnPage('/vigneron?search=Pinpon');
        $I->seeResponseCodeIsSuccessful();
        $I->seeNumberOfElements('ul.vigneron >li', 0);
    }
}

