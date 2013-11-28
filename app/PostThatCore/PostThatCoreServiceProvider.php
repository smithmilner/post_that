<?php namespace PostThatCore;

use Illuminate\Support\ServiceProvider;

class PostThatCoreServiceProvider extends ServiceProvider {

	public function register()
	{
		$app = $this->app;

		$this->app->bind('PostThatCore\Repo\Post\PostInterface', function($app)
		{
			return new Repo\Post\PostRepo($app['sentry']);
		});
	}

	public function boot()
	{
		$this->app['validatorfactory']->register('post', function($input) {
			return new Services\Validators\Post($input);
		});
	}
}