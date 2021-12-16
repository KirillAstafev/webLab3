<?php

class DB
{
    private $link;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): DB
    {
            $config = parse_ini_file("config/config.ini");
            $this->link = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
                $config['login'], $config['password']);

            return $this;

    }


    public function execute(string $sql)
    {
        $sth = $this->link->prepare($sql);
        return $sth->execute();
    }

    public function query(string $sql): array
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
         return [];
        }
        return $result;
}

}
