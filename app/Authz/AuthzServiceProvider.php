<?php namespace Authz;

use Illuminate\Support\ServiceProvider;

class AuthzServiceProvider extends ServiceProvider {

	public function register()
	{
		$app = $this->app;

		$this->app->bind('Authz\Repo\User\UserInterface', function($app)
		{
			return new Repo\User\UserRepo;
		});

		$this->app->bind('Authz\Repo\Profile\ProfileInterface', function($app)
		{
			return new Repo\Profile\ProfileRepo;
		});

		$this->app->bind('Authz\Repo\Session\SessionInterface', function($app)
		{
			return new Repo\Session\SessionRepo($app['auth']);
		});

		$this->app['validatorfactory'] = $this->app->share(function($app)
		{
			return new Services\Validators\ValidatorFactory($app);
		});
	}

	public function boot()
	{
		$this->app['validatorfactory']->register('user', function($input) {
			return new Services\Validators\User($input);
		});

		$this->app['validatorfactory']->register('session', function($input) {
			return new Services\Validators\Session($input);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('validatorfactory', 'SessionInterface');
	}

}