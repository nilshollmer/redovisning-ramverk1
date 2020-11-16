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


        $page->add("nihl/ip-validator/api/index", []);

        return $page->render([
            "title" => $title
        ]);
    }

    /**
     * This is the index post method action, it handles:
     * POST mountpoint
     *
     * @return array
     */
    public function indexActionPost()
    {
        $title = "IP-Validator REST API";
        $ip = $this->di->get("request")->getPost("ip", null);
        $ipvalidator = $this->di->get("ipvalidator");

        $body = $ipvalidator->validateIP($ip);
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
