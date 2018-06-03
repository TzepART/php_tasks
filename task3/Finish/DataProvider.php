<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 03/06/2018
 * Time: 02:21
 */


namespace src\Integration;

/**
 * Class DataProvider
 * @package src\Integration
 */
class DataProvider
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $request
     * @return array
     */
    public function get(array $request)
    {
        // returns a response from external service
        return [];
    }
}