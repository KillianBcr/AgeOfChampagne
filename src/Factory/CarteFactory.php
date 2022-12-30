<?php

namespace App\Factory;

use App\Entity\Carte;
use App\Repository\CarteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Carte>
 *
 * @method        Carte|Proxy                     create(array|callable $attributes = [])
 * @method static Carte|Proxy                     createOne(array $attributes = [])
 * @method static Carte|Proxy                     find(object|array|mixed $criteria)
 * @method static Carte|Proxy                     findOrCreate(array $attributes)
 * @method static Carte|Proxy                     first(string $sortedField = 'id')
 * @method static Carte|Proxy                     last(string $sortedField = 'id')
 * @method static Carte|Proxy                     random(array $attributes = [])
 * @method static Carte|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CarteRepository|RepositoryProxy repository()
 * @method static Carte[]|Proxy[]                 all()
 * @method static Carte[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Carte[]|Proxy[]                 createSequence(array|callable $sequence)
 * @method static Carte[]|Proxy[]                 findBy(array $attributes)
 * @method static Carte[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Carte[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CarteFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $imageCarte = self::faker()->image();
        $qrCode = self::faker()->numerify('###');
        $name = self::faker()->sentence(1);
        $description = self::faker()->sentence(5);

        return [
            'imageCarte' => $imageCarte,
            'qrCode' => $qrCode,
            'name' => $name,
            'description' => $description,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Carte $carte): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Carte::class;
    }
}
