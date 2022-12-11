// src/Factory/PostFactory.php

namespace App\Factory;

use App\Entity\Post;
use App\Repository\PostRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Post>
 *
 * @method static Post|Proxy createOne(array $attributes = [])
 * @method static Post[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Post[]&Proxy[] createSequence(array|callable $sequence)
 * @method static Post|Proxy find(object|array|mixed $criteria)
 * @method static Post|Proxy findOrCreate(array $attributes)
 * @method static Post|Proxy first(string $sortedField = 'id')
 * @method static Post|Proxy last(string $sortedField = 'id')
 * @method static Post|Proxy random(array $attributes = [])
 * @method static Post|Proxy randomOrCreate(array $attributes = []))
 * @method static Post[]|Proxy[] all()
 * @method static Post[]|Proxy[] findBy(array $attributes)
 * @method static Post[]|Proxy[] randomSet(int $number, array $attributes = []))
 * @method static Post[]|Proxy[] randomRange(int $min, int $max, array $attributes = []))
 * @method static PostRepository|RepositoryProxy repository()
 * @method Post|Proxy create(array|callable $attributes = [])
 */
final class PostFactory extends ModelFactory
{
    /**
     * @see https://github.com/zenstruck/foundry#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://github.com/zenstruck/foundry#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
    return [
        'firstname' => self::faker()->sentence(),
        'lastname' => self::faker()->sentence(),
	'email' => self::faker()->unique()->sentence(),
	'password' => self::faker()->sentence(),
	'telUtil' => self::faker()->unique()->sentence(),
	'dateNais' => self::faker()->sentence(),
    ];'
    }

    /**
     * @see https://github.com/zenstruck/foundry#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Post $post) {})
        ;
    }

    protected static function getClass(): string
    {
        return Post::class;
    }
}
