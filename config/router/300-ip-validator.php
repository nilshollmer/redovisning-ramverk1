<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "mount" => "ipvalidator",

    "routes" => [
        [
            "info" => "IP-Validator Rest API",
            "mount" => "api",
            "handler" => "\Nihl\IPValidator\IPValidatorAPIController",
        ],
        [
            "info" => "IP-Validator",
            "mount" => "",
            "handler" => "\Nihl\IPValidator\IPValidatorController",
        ],
    ]
];
