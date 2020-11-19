<?php

namespace Nihl\RemoteService;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Nihl\RemoteService\Curl;

/**
 *
 */
class GeoTag implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * $url         Url to access
     * $apikey      Apikey for ipstack
     *
     */
    private $url;
    private $apikey;
    private $curl;

    public function setUrl(string $url): void {
        $this->url = $url;
    }

    public function setApikey(string $key): void {
        $this->apikey = $key;
    }

    public function getIPData() {
        $curl = $this->di->get("curl");

        return [
            "url" => $this->url,
            "apikey" => $this->apikey
        ];
    }
}
