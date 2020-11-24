# Nils Hollmer me-page
[![Build Status](https://travis-ci.org/nilshollmer/redovisning-ramverk1.svg?branch=master)](https://travis-ci.org/nilshollmer/redovisning-ramverk1)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nilshollmer/redovisning-ramverk1/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nilshollmer/redovisning-ramverk1/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/nilshollmer/redovisning-ramverk1/badges/build.png?b=master)](https://scrutinizer-ci.com/g/nilshollmer/redovisning-ramverk1/build-status/master)

Me-page in Ramverk1 course

## Installation
Run `make install` to install necessary dependencies.


## Configuration
    
Add file `config/geotag.php` with content of the following format to access ipstack:  
```
<?php

return [
    "url" => "http://api.ipstack.com",
    "apikey" => "your_apikey"
];
```
