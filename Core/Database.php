<?php

namespace Core;

use PDO;

class Database 
{
    private $db;

    public function __construct($config)
    {        
        $dsn = $this->getDsn($config);
        $this->db = new PDO($dsn, $config['user'], $_ENV['DB_PASSWORD']);
    }

    public function query(string $query, string $class = null, array $params = [])
    {
        $prepare = $this->db->prepare($query);

        if ($class) {
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }
        $prepare->execute($params);

        return $prepare;
    }

    private function getDsn($config) {
        $driver = $config['driver'];
        unset($config['driver']);

        $dsn = $driver.':'.http_build_query($config, '', ';');

        if ($driver == 'sqlite') {
            $dsn = $driver.':'.$config['database'];
        }

        return $dsn;
    }
}
