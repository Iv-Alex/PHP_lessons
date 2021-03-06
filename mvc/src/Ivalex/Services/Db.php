<?php

namespace Ivalex\Services;

use Ivalex\Exceptions\DbException;

class Db
{
    private static $instance;
    private $pdo;

    /**
     * db creates by the function getInstance
     */
    private function __construct()
    {
        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
            //$this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            //$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new DbException('Database connection error: ' . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * 
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
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
