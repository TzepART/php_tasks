<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 03/06/2018
 * Time: 02:21
 */
/**
 * Требования были : Добавить возможность получения данных от стороннего сервиса
 *
 */

namespace src\Integration;

class DataProvider
{
    private $host;
    private $user;
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
        return [];
    }
}