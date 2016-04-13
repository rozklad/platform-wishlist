<?php namespace Sanatorium\Wishlist\Providers;

use Cartalyst\Cart\Cart;
use Cartalyst\Cart\Storage\IlluminateSession;
use Cartalyst\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class WishlistServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register all the default hooks
        $this->registerHooks();

		// Register wishlist package
		$this->registerCartalystWishlistPackage();
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		$this->registerSession();

        $this->registerCart();
	}

	/**
     * Register the session driver used by the Wishlist.
     *
     * @return void
     */
    protected function registerSession()
    {
        $this->app['wishlist.storage'] = $this->app->share(function($app)
        {
            $config = $app['config']->get('cartalyst/cart::config');

            return new IlluminateSession($app['session.store'], 'wishlist', $config['session_key']);
        });
    }

    /**
     * Register the Wishlist.
     *
     * @return void
     */
    protected function registerCart()
    {
        $this->app['wishlist'] = $this->app->share(function($app)
        {
            return new Cart($app['wishlist.storage'], $app['events']);
        });
    }

    public function registerCartalystWishlistPackage()
    {
		AliasLoader::getInstance()->alias('Wishlist', 'Sanatorium\Wishlist\Facades\Wishlist');
    }

    /**
     * Register all hooks.
     *
     * @return void
     */
    protected function registerHooks()
    {
        $hooks = [
            [
                'position' => 'wishlist.show',
                'hook' => 'sanatorium/wishlist::hooks.wishlist'
            ],
            [
                'position' => 'catalog.product.bottom',
                'hook' => 'sanatorium/wishlist::hooks.add',
            ],
        ];

        $manager = $this->app['sanatorium.hooks.manager'];

        foreach ($hooks as $item) {
            extract($item);
            $manager->registerHook($position, $hook);
        }
    }

}
