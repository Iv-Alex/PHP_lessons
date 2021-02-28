<?php

namespace Ivalex\Services;

class Db
{

    private $pdo;

    /**
     * 
     */
    public function __construct()
    {
        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    /**
     * 
     */
    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute($params);

        if ($result === false) {
            return null;
        }

        return $statement->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}
