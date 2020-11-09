<?php

namespace Nihl\IPValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * IP-Validator analyzes ip-adresses according to ip4 and ip6
 *
 */
class IPValidatorController implements ContainerInjectableInterface
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
     * Display the stylechooser with details on current selected style.
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "IP-Validator";

        $page = $this->di->get("page");
        $ip = $this->di->get("request")->getGet("ip", null);
        $data = self::validateIP($ip);

        $page->add("nihl/ip-validator/index", $data);

        return $page->render([
            "title" => $title
        ]);
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
        $title = "IP-Validator | Route not found";
        $page = $this->di->get("page");
        $path = $this->di->get("request")->getRoute();
        $page->add("nihl/ip-validator/error", [
            "path" => $path
        ]);

        return $page->render([
            "title" => $title
        ]);
    }

}
