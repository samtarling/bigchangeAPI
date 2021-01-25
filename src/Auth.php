<?php
/**
 * Holds the BigChange Auth class
 * 
 * PHP version 7
 *
 * @category  Files
 * @package   BigChange
 * @author    Sam Tarling <sam@samtarling.co.uk>
 * @copyright 2021 Sam Tarling
 * @license   GPL 3.0 or later
 * @version   GIT:1.0.0
 * @link      https://lib.samtarling.co.uk/bigchange
 * @since     File available since Release 1.0.0
 */
declare(strict_types=1);

namespace samtarling\BigChangeAPI;
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Authenticates on the BigChange API
 *
 * @category Auth
 * @package  BigChange
 * @author   Sam Tarling <sam@samtarling.co.uk>
 * @license  GPL 3.0 or later
 * @link     https://lib.samtarling.co.uk/bigchange
 * @since    Class available since Release 1.0.0
 */
class Auth
{
    public $apiURL = "https://webservice.bigchangeapps.com/v01/services.ashx?";
    public $apiKey;
    public $basicAuth;

    /**
     * Constructs required  variables for use in API calls
     *
     * @param string $apiKey   Your API key
     * @param string $username Your API username
     * @param string $password Your API password
     */
    function __construct($apiKey, $username, $password)
    {
        $this->apiKey = $apiKey;
        $this->basicAuth = base64_encode($username . ":" . $password);
    }


    /**
     * Get the value of apiURL
     * 
     * @return string
     */ 
    public function getApiURL()
    {
        return $this->apiURL;
    }

    /**
     * Get the value of apiKey
     * 
     * @return string
     */ 
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Get the value of basicAuth
     * 
     * @return string
     */ 
    public function getBasicAuth()
    {
        return $this->basicAuth;
    }
}