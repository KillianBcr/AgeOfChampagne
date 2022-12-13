<?php

namespace App\Factory;

use App\Entity\Vigneron;
use App\Repository\VigneronRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Vigneron>
 *
 * @method        Vigneron|Proxy create(array|callable $attributes = [])
 * @method static Vigneron|Proxy createOne(array $attributes = [])
 * @method static Vigneron|Proxy find(object|array|mixed $criteria)
 * @method static Vigneron|Proxy findOrCreate(array $attributes)
 * @method static Vigneron|Proxy first(string $sortedField = 'id')
 * @method static Vigneron|Proxy last(string $sortedField = 'id')
 * @method static Vigneron|Proxy random(array $attributes = [])
 * @method static Vigneron|Proxy randomOrCreate(array $attributes = [])
 * @method static VigneronRepository|RepositoryProxy repository()
 * @method static Vigneron[]|Proxy[] all()
 * @method static Vigneron[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Vigneron[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Vigneron[]|Proxy[] findBy(array $attributes)
 * @method static Vigneron[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Vigneron[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class VigneronFactory extends ModelFactory
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
        $firstname = self::faker()->firstNameMale();
        $lastname = self::faker()->lastName();
        $domain = self::faker()->domainName();
        $email = mb_strtolower($firstname.'.'.$lastname.'@'.$domain);
        return [
            'description' => self::faker()->sentence(10),
            'nom' => $firstname,
            'prenom' => $lastname,
            'telephone' => self::faker()->unique()->phoneNumber(),
            'email' => $email,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Vigneron $vigneron): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Vigneron::class;
    }
}
