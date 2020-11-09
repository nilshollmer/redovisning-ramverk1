<?php

namespace Nihl\IPValidator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IPValidatorControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;


    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new IPValidatorController();
        $this->controller->setDI($this->di);
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionWithNoIP()
    {
        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertStringContainsString("IP-validator", $body);
    }

    /**
     * Test the route "index".
     */
    public function testInvalidRouteAction()
    {
        $res = $this->controller->catchAll();
        $body = $res->getBody();
        $this->assertStringContainsString("Route not found", $body);
    }



    /**
     * Test index route with get parameter ip set to a valid ipv4 address
     */
    public function testIndexActionWithValidIP4()
    {
        $this->di->get("request")->setGet("ip", "172.15.255.255");

        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertStringContainsString("Adressen är en giltig ip4-adress!", $body);
    }


    /**
     * Test index route with get parameter ip set to a valid ipv6 address
     */
    public function testIndexActionWithValidIP6()
    {
        $this->di->get("request")->setGet("ip", "2001:0db8:85a3:0000:0000:8a2e:0370:7334");

        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertStringContainsString("Adressen är en giltig ip6-adress!", $body);
    }

    /**
     * Test index route with get parameter ip set to a valid ipv6 address
     */
    public function testIndexActionWithInvalidIP()
    {
        $this->di->get("request")->setGet("ip", "12001:0db8:85a3:0000:0000:8a2e:0370:7334");

        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertStringContainsString("Adressen är ogiltig!", $body);
    }

}
