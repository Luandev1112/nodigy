<?php

declare(strict_types=1);

namespace CedricZiel\HetznerCloudAPI;

use CedricZiel\HetznerCloudAPI\Api\AbstractApi;
use CedricZiel\HetznerCloudAPI\Api\Actions;
use CedricZiel\HetznerCloudAPI\Api\DataCenters;
use CedricZiel\HetznerCloudAPI\Api\Images;
use CedricZiel\HetznerCloudAPI\Api\Pricing;
use CedricZiel\HetznerCloudAPI\Api\ServerActions;
use CedricZiel\HetznerCloudAPI\Api\Servers;
use CedricZiel\HetznerCloudAPI\Api\ServerTypes;
use CedricZiel\HetznerCloudAPI\Api\SSHKeys;
use CedricZiel\HetznerCloudAPI\HttpClient\Builder;
use CedricZiel\HetznerCloudAPI\HttpClient\Plugin\ApiVersion;
use CedricZiel\HetznerCloudAPI\HttpClient\Plugin\Authentication;
use CedricZiel\HetznerCloudAPI\HttpClient\Plugin\History;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\HttpClient;
use Http\Discovery\UriFactoryDiscovery;

/**
 * @property Actions       $actions
 * @property DataCenters   $data_centers
 * @property Images        $images
 * @property Pricing       $pricing
 * @property Servers       $servers
 * @property ServerActions $server_actions
 * @property ServerTypes   $server_types
 * @property SSHKeys       $ssh_keys
 */
class Client
{
    public const AUTH_HTTP_TOKEN = 'http_token';

    /**
     * @var History
     */
    private $responseHistory;

    /**
     * @var Builder
     */
    private $httpClientBuilder;

    /**
     * Instantiate a new Gitlab client.
     *
     * @param Builder $httpClientBuilder
     */
    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->responseHistory = new History();

        $this->httpClientBuilder = $httpClientBuilder ?: new Builder();
        $this->httpClientBuilder->addPlugin(new HistoryPlugin($this->responseHistory));
        $this->httpClientBuilder->addPlugin(new ApiVersion('v1'));
        $this->httpClientBuilder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'php-hetzner-cloud-api (https://github.com/cedricziel/php-hetzner-cloud-api)',
        ]));

        $this->setUrl('https://api.hetzner.cloud');
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->httpClientBuilder->removePlugin(AddHostPlugin::class);
        $this->httpClientBuilder->addPlugin(new AddHostPlugin(UriFactoryDiscovery::find()->createUri($url)));

        return $this;
    }

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->httpClientBuilder->removePlugin(ApiVersion::class);
        $this->httpClientBuilder->addPlugin(new ApiVersion($version));

        return $this;
    }

    /**
     * Create a Hetzner\Client using an url.
     *
     * @param string $url
     * @param string $version
     *
     * @return Client
     */
    public static function create($url = 'https://api.hetzner.cloud', $version = 'v1')
    {
        $client = new self();
        $client->setUrl($url);
        $client->setVersion($version);

        return $client;
    }

    /**
     * Create a Gitlab\Client using an HttpClient.
     *
     * @param HttpClient $httpClient
     *
     * @return Client
     */
    public static function createWithHttpClient(HttpClient $httpClient)
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /**
     * Authenticate a user for all next requests.
     *
     * @param string $token      Gitlab private token
     * @param string $authMethod One of the AUTH_* class constants
     *
     * @return $this
     */
    public function authenticate($token, $authMethod = self::AUTH_HTTP_TOKEN)
    {
        $this->httpClientBuilder->removePlugin(Authentication::class);
        $this->httpClientBuilder->addPlugin(new Authentication($authMethod, $token));

        return $this;
    }

    public function api(string $api): AbstractApi
    {
        switch ($api) {
            case 'actions':
                return new Actions($this);
            case 'data_centers':
                return new DataCenters($this);
            case 'images':
                return new Images($this);
            case 'pricing':
                return new Pricing($this);
            case 'servers':
                return new Servers($this);
            case 'server_actions':
                return new ServerActions($this);
            case 'server_types':
                return new ServerTypes($this);
            case 'ssh_keys':
                return new SSHKeys($this);
        }

        throw new \InvalidArgumentException(sprintf('No API %s available', $api));
    }

    /**
     * @param string $api
     *
     * @return AbstractApi
     */
    public function __get($api)
    {
        return $this->api($api);
    }

    /**
     * @return HttpMethodsClient
     */
    public function getHttpClient()
    {
        return $this->httpClientBuilder->getHttpClient();
    }

    /**
     * @return History
     */
    public function getResponseHistory()
    {
        return $this->responseHistory;
    }
}
