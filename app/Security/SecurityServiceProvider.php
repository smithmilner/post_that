<?php namespace Security;

use Illuminate\Support\ServiceProvider;

class SecurityServiceProvider extends ServiceProvider {

	public function register()
	{
		$app = $this->app;

		$this->app->bind('Security\Repo\Session\SessionInterface', function($app)
		{
			return new Repo\Session\SentrySessionRepo($app['sentry']);
		});

		$this->app->bind('Security\Repo\User\UserInterface', function($app)
		{
			return new Repo\User\SentryUserRepo($app['sentry']);
		});

		// $this->app->bind('Security\Repo\Group\GroupInterface', function($app)
		// {
		// 	return new User;
		// });
	}

	public function boot()
	{
		// 
	}
}