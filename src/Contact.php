<?php
/**
 * Holds the BigChange contact class
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
 * Defines a class which holds a single BigChange contact
 *
 * @category Contacts
 * @package  BigChange
 * @author   Sam Tarling <sam@samtarling.co.uk>
 * @license  GPL 3.0 or later
 * @link     https://lib.samtarling.co.uk/bigchange
 * @since    Class available since Release 1.0.0
 */
class Contact
{
    public $apiURL;
    public $apiKey;
    private $_basicAuth;

    public $contactId;
    public $groupId;
    public $name;
    public $street;
    public $postcode;
    public $town;
    public $country;
    public $person;
    public $phone;
    public $email;
    public $extra;
    public $lat;
    public $long;
    public $onStop;
    public $creationDate;

    /**
     * Constructs required  variables for use in API calls
     *
     * @param object $auth      BigChange Auth object
     * @param string $contactId The BigChange ID of the contact
     */
    function __construct($auth, $contactId)
    {
        $this->apiURL = $auth->getApiURL();
        $this->apiKey = $auth->getApiKey();
        $this->_basicAuth = $auth->getBasicAuth();

        $this->contactId = $contactId;

        $this->getDetails();
    }

    /**
     * Fills variables with contact details from API
     *
     * @return void
     */
    function getDetails()
    {
        $queryResponse = $this->queryAPI(
            'action=ContactDetail&contactId=' . 
            $this->contactId
        );

        $this->groupId = $queryResponse['Result']['GroupId'];
        $this->name = $queryResponse['Result']['Name'];
        $this->street = $queryResponse['Result']['Street'];
        $this->postcode = $queryResponse['Result']['PostCode'];
        $this->town = $queryResponse['Result']['Town'];
        $this->country = $queryResponse['Result']['Country'];
        $this->person = $queryResponse['Result']['Person'];
        $this->phone = $queryResponse['Result']['Phone'];
        $this->email = $queryResponse['Result']['Email'];
        $this->extra = $queryResponse['Result']['Extra'];
        $this->lat = $queryResponse['Result']['Lat'];
        $this->long = $queryResponse['Result']['Lng'];
        $this->onStop = $queryResponse['Result']['OnStop'];
        $this->creationDate = $queryResponse['Result']['ContactCreationDate'];
    }

    /**
     * List BigChange jobs assigned to this contact
     *
     * @param string $startDate The start date (YYYY-MM-DD)
     * @param string $endDate   The end date (YYYY-MM-DD)
     * 
     * @return array PHP array of response
     */
    public function listJobs($startDate, $endDate)
    {
        $queryResponse = $this->queryAPI(
            'action=Jobslist&Contactid=' . $this->contactId .
            '&Start=' . $startDate .
            '&End=' . $endDate
        );

        return $queryResponse;
    }

    /**
     * Queries the API
     *
     * @param string $query Entire query string - action=x&etc=x
     * 
     * @return array API response as PHP array
     */
    function queryAPI($query)
    {
        //
        // Build request URL
        $requestURL = $this->apiURL.$query;
        //$requestURL = urlencode($requestURL);

        //var_dump($requestURL);

        // Build cURL

        try {
            $ch = curl_init();
        
            if ($ch === false) {
                throw new \Exception('failed to initialize');
            }
        
            curl_setopt($ch, CURLOPT_URL, $requestURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $headers = array(
                'Content-Type:application/json',
                'Authorization: Basic '. $this->_basicAuth,
                'key:' . $this->apiKey
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
            $content = curl_exec($ch);
        
            if ($content === false) {
                throw new \Exception(curl_error($ch), curl_errno($ch));
            } else {
                $content = json_decode($content, true);
                return $content;
            }
        
            // Close curl handle
            curl_close($ch);
        } catch(\Exception $e) {
            trigger_error(
                sprintf(
                    $e->getCode(), $e->getMessage()
                ),
                E_USER_ERROR
            );
        }
    }

    /**
     * Get the value of groupId
     * 
     * @return string
     */ 
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Get the value of name
     * 
     * @return string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of street
     * 
     * @return string
     */ 
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Get the value of postcode
     * 
     * @return string
     */ 
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Get the value of town
     * 
     * @return string
     */ 
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Get the value of country
     * 
     * @return string
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the value of person
     * 
     * @return string
     */ 
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Get the value of phone
     * 
     * @return string
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the value of email
     * 
     * @return string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of extra
     * 
     * @return string
     */ 
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Get the value of lat
     * 
     * @return string
     */ 
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Get the value of long
     * 
     * @return string
     */ 
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Get the value of onStop
     * 
     * @return string
     */ 
    public function getOnStop()
    {
        return $this->onStop;
    }

    /**
     * Get the value of creationDate
     * 
     * @return string
     */ 
    public function getCreationDate()
    {
        return $this->creationDate;
    }
}