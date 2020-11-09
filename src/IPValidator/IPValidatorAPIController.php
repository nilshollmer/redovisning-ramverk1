<?php

namespace Nihl\IPValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * IP-Validator analyzes ip-adresses according to ip4 and ip6
 *
 */
class IPValidatorAPIController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * Use regular expression to check if input matches ip4 or ip6 syntax
     *
     * @param string
     *
     * @return string
     */
    public static function pregMatchIP($ip)
    {
        $ip4regex = "((^\s*((([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))\s*$))";
        $ip6regex = "((^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$))";

        // Check if $ip matches ip4 syntax
        if (preg_match($ip4regex, $ip)) {
            return "ip4";
        }

        // Check if $ip matches ip6 syntax
        if (preg_match($ip6regex, $ip)) {
            return "ip6";
        }

        return "";
    }

    /**
     * Check if incomping IP-address is valid
     *
     * @param string
     *
     * @return array
     */
    public static function validateIP($ip)
    {
        $match = self::pregMatchIP($ip);
        $domain = $match ? gethostbyaddr($ip) : null;
        return $body = [
            "ip" => $ip,
            "match" => $match ? "Adressen är en giltig ${match}-adress!" : "Adressen är ogiltig!",
            "domain" => $domain
        ];
    }


    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return array
     */
    public function indexActionGet()
    {
        $title = "IP-Validator REST API";
        $page = $this->di->get("page");


        $page->add("nihl/ip-validator/api/index",[ ]);

        return $page->render([
            "title" => $title
        ]);
    }

    /**
     * This is the index method action, it handles:
     * POST mountpoint
     * POST mountpoint/
     * POST mountpoint/index
     *
     * @return array
     */
    public function indexActionPost()
    {
        $title = "IP-Validator REST API";
        $ip = $this->di->get("request")->getPost("ip", null);
        $body = self::validateIP($ip);
        return [$body];
    }



    /**
     * Adding an optional catchAll() method will catch all actions sent to the
     * router. You can then reply with an actual response or return void to
     * allow for the router to move on to next handler.
     * A catchAll() handles the following, if a specific action method is not
     * created:
     * ANY METHOD mountpoint/**
     *
     * @param array $args as a variadic parameter.
     *
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function catchAll(...$args)
    {
        $data = [
            "error" => "Bad request. Invalid url."
        ];

        return [$data, 400];
    }

}
