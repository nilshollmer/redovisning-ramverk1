<?php
/**
 * Configuration file for DI container.
 */
return [
    // Services to add to the container.
    "services" => [
        "curl" => [
            // Is the service shared, true or false
            // Optional, default is true
            "shared" => true,

            // Is the service activated by default, true or false
            // Optional, default is false
            "active" => false,

            // Callback executed when service is activated
            // Create the service, load its configuration (if any)
            // and set it up.
            "callback" => function () {
                $curl = new \Nihl\RemoteService\Curl();

                // $cfg = $this->get("configuration");
                // $config = $cfg->load("geotag.php");
                // $settings = $config["config"] ?? null;
                //
                // if ($settings["url"] ?? null) {
                //     $geotag->setUrl($settings["url"]);
                // }
                //
                // if ($settings["apikey"] ?? null) {
                //     $geotag->setApikey($settings["apikey"]);
                // }
                return $curl;
            }
        ],
    ],
];
