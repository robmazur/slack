<?php namespace Maknz\Slack;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as Guzzle;

class SlackServiceProvider extends ServiceProvider {

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
    //$this->package('maknz/slack');
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app['maknz.slack'] = $this->app->share(function($app)
    {
      return new Client(
        $app['config']->get('services.slack.endpoint'),
        [
          'channel' => $app['config']->get('services.slack.channel'),
          'username' => $app['config']->get('services.slack.username'),
          'icon' => $app['config']->get('services.slack.icon')
        ],
        new Guzzle
      );
    });
  }

  /**
  * Get the services provided by the provider.
  *
  * @return array
  */
  public function provides()
  {
    return array('maknz.slack');
  }

}
