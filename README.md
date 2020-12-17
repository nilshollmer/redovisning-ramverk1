# Nils Hollmer me-page
[![Build Status](https://travis-ci.org/nilshollmer/redovisning-ramverk1.svg?branch=master)](https://travis-ci.org/nilshollmer/redovisning-ramverk1)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nilshollmer/redovisning-ramverk1/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nilshollmer/redovisning-ramverk1/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/nilshollmer/redovisning-ramverk1/badges/build.png?b=master)](https://scrutinizer-ci.com/g/nilshollmer/redovisning-ramverk1/build-status/master)
[![CircleCI](https://circleci.com/gh/nilshollmer/weather-report.svg?style=svg)](https://app.circleci.com/pipelines/github/nilshollmer/weather-report)

Me-page in Ramverk1 course

## Installation
Run `make install` to install necessary dependencies.


## Configuration

Add file `config/apikey.php` with content of the following format to access ipstack and openweathermap:  
```
<?php

return $apikeys = [
    "ipstack" => "your_apikey",
    "openweathermap" => "your_apikey"
];
```
