<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Client;

class HetznerApiService
{
    protected $client;
    protected $hetznerTokenKey;
    protected $hetznerApiUrl;

    public function __construct()
    {
        $hetznerTokenKey = env('HETZNER_TOKEN_KEY');
        $hetznerApiUrl = env('HETZNER_API_URL');

        $this->hetznerTokenKey = $hetznerTokenKey;
        $this->hetznerApiUrl = $hetznerApiUrl;

        $client = new \CedricZiel\HetznerCloudAPI\Client();
        $this->client = $client->authenticate($hetznerTokenKey);
    }

    // retrieve all SSH Keys
    public function getAllSshKey()
    {
        try {
            return $this->client->ssh_keys->all();
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return false;
        }
        return false;
    }
    // create a SSH Key
    public function createSshKey($userId)
    {
        try {
            $uniqueKey = 'user-nym-' . $userId;

            $path = storage_path('app/hetzner-keys/' . $uniqueKey);
            if (!file_exists($path)) {
                mkdir($path, 0700, true);
            }

            $privateKeyPath = $path . "/id_rsa";
            $publicKeyPath = $privateKeyPath . ".pub";

            // which ssh-keygen
            if (env('HETZNER_TYPE') == "local") {
                $command = 'C:\Windows\System32\OpenSSH\ssh-keygen.exe -t rsa -b 4096 -N "" -C ' . $uniqueKey . ' -f ' . $privateKeyPath;
            } else {
                $command = '/usr/bin/ssh-keygen -t rsa -b 4096 -N "" -C ' . $uniqueKey . ' -f ' . $privateKeyPath;
            }
            exec($command);

            $publicKey = file_get_contents($publicKeyPath);

            $parameters = [
                'name' => $uniqueKey,
                'public_key' => $publicKey,
            ];

            return $this->client->ssh_keys->create($parameters);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }
    // get one SSH Key
    public function showSshKey($keyId)
    {
        try {
            return $this->client->ssh_keys->show($keyId);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }
    // remove a SSH Key
    public function removeSshKey($keyId)
    {
        try {
            return $this->client->ssh_keys->remove($keyId);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }
    // rename a SSH Key
    public function renameSshKey($keyId, $userId)
    {
        try {
            $uniqueKey = 'user-nym-' . $userId;
            return $this->client->ssh_keys->rename($keyId, $uniqueKey);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }

    // retrieve all servers
    public function getAllServers()
    {
        try {
            return $this->client->servers->all();
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }
    // retrieve all server actions
    public function getServerActions($serverId)
    {
        try {
            return $this->client->server_actions->all($serverId);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return false;
        }
        return false;
    }
    // create a server
    public function createServer($parameters)
    {
        try {
            return $this->client->servers->create($parameters);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }
    // remove a server
    public function removeServer($serverId)
    {
        try {
            return $this->client->servers->remove($serverId);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }
    // get one server
    public function viewServer($serverId)
    {
        try {
            return $this->client->servers->show($serverId);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }

    // ServerActions
    // changeDnsPtr server
    public function changeDnsPtr($serverId,$parameters)
    {
        try {
            return $this->client->server_actions->changeDnsPtr($serverId, $parameters);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }

    public function geHetznerApiData($method)
    {
        try {
            $callUrl = $this->hetznerApiUrl . $method;
            $client = new Client();
            $response = $client->request('GET', $callUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->hetznerTokenKey,
                ],
            ]);
            $body = $response->getBody();
            return json_decode($body, true);
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }

    public function geBinancePrice()
    {
        try {
            $client = new Client([
                'base_uri' => 'https://api.binance.com',
            ]);

            $response = $client->get('/api/v3/ticker/price', [
                'query' => [
                    'symbol' => 'EURUSDT',
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return (isset($data['price']))? sprintf("%.2f", $data['price']):0;
        } catch (Exception $e) {
            $message = getErrorMessage($e, $e->getMessage());
            Log::info($message);
            return ['error'=>$message];
        }
        return false;
    }
}
