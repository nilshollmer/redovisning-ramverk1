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
     * Display the stylechooser with details on current selected style.
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "IP-Validator";

        $page = $this->di->get("page");
        $ip = $this->di->get("request")->getGet("ip", null);
        $ipvalidator = $this->di->get("ipvalidator");
        
        $data = $ipvalidator->validateIP($ip);

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
