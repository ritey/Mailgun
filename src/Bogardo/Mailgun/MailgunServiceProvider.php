<?php namespace Bogardo\Mailgun;

use Illuminate\Support\ServiceProvider;

class MailgunServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('bogardo.mailgun.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$app = $this->app ?: app();

		$this->app->singleton(Mailgun::class, function($app) {
			return new Mailgun($app['view']);
		});

		$this->app->alias('Mailgun', Mailgun::class);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('mailgun',Mailgun::class);
	}

}
