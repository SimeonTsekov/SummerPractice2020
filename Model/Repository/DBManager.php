<?php

namespace Model\Repository;

use PDO;
require "config.php";

class DBManager
{
    private $connection;
    private static $instance = null;

    private function __construct() {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        $this->connection = new PDO('mysql:host='.DB_HOST. ":" . DB_PORT . ';dbname='.DB_NAME , DB_USER, DB_PASS, $options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static  function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}

    public function getConnection() {
        return $this->connection;
    }
}