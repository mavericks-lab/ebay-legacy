<?php namespace Maverickslab\Ebay;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class EbayServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //Ebay resolution
        $this->app->bind('Ebay', function () {
            $client = new Client();
            $requester = new APIRequester($client);
            return new Ebay($requester);
        });
    }

    public function boot()
    {
        //publish configuration files
        $this->publishes([
            __DIR__ . "/../../config/ebay.php" => config_path('ebay.php'),
        ]);

        //load routes
        include __DIR__ . '/routes/routes.php';

        //Set up an alias
        AliasLoader::getInstance()->alias('Ebay', 'Maverickslab\Ebay');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
