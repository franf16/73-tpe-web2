<?php

require_once './libs/db/Database.class.php';

abstract class Model {

    protected PDO $db;
    protected string $table;
    protected string $defaultView;

    public function __construct(string $table) {
        $this->db = Database::getConnection();
        $this->table = $table;
    }

    /**
     * Definición de los parámetros de la tabla insertados desde el formuario
     * @return Array en formato filter_input_array() definition (https://www.php.net/manual/en/function.filter-input-array.php)
     */
    abstract public function getParamsDefinition(): array;

    /**
     * Columnas requeridas para agregar un elemento 
     * @return Array [ 'col1', 'col2', ... ]
     */
    abstract public function getParamsRequired(): array;

    /** SETTERS */
    protected function setDefaultView(string $view) {
        $this->defaultView = $view;
    }

    /** CONTAINS */

    public function containsId(int $id): bool {
        $query = $this->db->prepare("SELECT EXISTS(SELECT id FROM {$this->table} WHERE id = ?)");
        $query->execute([ $id ]);
        $result = $query->fetch(PDO::FETCH_NUM);
        return $result[ 0 ];
    }
    public function containsColumn($column): bool {
        $table = $this->defaultView ?? $this->table;
        $query = $this->db->prepare("SHOW COLUMNS FROM $table LIKE '$column'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_NUM);
        return $result ? true : false; 
    }

    /** GETTERS */

    public function get(string $column, int $id) {
        $query = $this->db->prepare(
            "SELECT $column
             FROM {$this->table}
             WHERE id = ?"
        );
        $query->execute([ $id ]);
        return $query->fetch(PDO::FETCH_NUM)[0];
    }

    public function getElementById(int $id): array {
        $table = $this->defaultView ?? $this->table;
        $query = $this->db->prepare(
            "SELECT * 
             FROM $table 
             WHERE id = ?"
        );
        $query->execute([ $id ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /** Formateo de query
     *  definición $params: [
     *      'view' => 'view_name',
     *      'where' => [ condicion simple o compuesta ],
     *      'order' => 'columna_de_referencia',
     *      'limit' => int,
     *      'offset' => int 
     *      // TODO: 'select' => [ 'col1', 'col2', ... ] // default * ]
     */
    public function getElements(array $params = []): array {
        // VISTA Y WHERE
        $table = $params[ 'view' ] ?? $this->defaultView ?? $this->table;
        $queryStmt = "SELECT * FROM $table WHERE " . self::formatWhereStmt($params[ 'where' ] ?? null) . ' ';
        // ORDER
        if ($order = $params[ 'order' ] ?? null) {
            $queryStmt .= "ORDER BY $order ";
        }
        // LIMIT Y OFFSET
        $limit = $params[ 'limit' ] ?? PHP_INT_MAX;
        $offset = $params[ 'offset' ] ?? 0;
        $queryStmt .= "LIMIT $limit OFFSET $offset;";

        $query = $this->db->prepare($queryStmt);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($queryStmt);
        // var_dump($result);
        // die();
        return $result;
    }
    public function getElement(array $params = []): array {
        $params[ 'limit' ] = 1;
        return $this->getElements($params)[0] ?? [];
    }

    /** Cantidad de elementos que matchean una query */
    public function count(array $params = []): int {
        $table = $params[ 'view' ] ?? $this->defaultView ?? $this->table;
        $queryStmt = "SELECT COUNT(*) FROM $table WHERE " . self::formatWhereStmt($params[ 'where' ] ?? null) . ' ';
        $query = $this->db->prepare($queryStmt);
        $query->execute();
        return $query->fetch(PDO::FETCH_NUM)[0];
    }

    /** ABM 
     *  definición $data: [ 'nombre_columna1' => valor, ... ]
    */

    public function addElement(array $data): array {
        $keys = implode(',', array_keys($data));
        $params = [];
        $values = implode(',', array_map(function($v) use (&$params) {
            if ($v === NULL) return 'DEFAULT';     
            $params[] = $v;
            return '?';
        }, array_values($data)));
        // var_dump($values);
        // die();
        $query = $this->db->prepare(
            "INSERT INTO {$this->table}($keys)
             VALUES ($values)"
        );
        $query->execute($params);
        $error = $query->errorInfo();

        $result = [];
        if (isset($error[ 1 ])) {
            $result[ 'ok' ] = false;
            $result[ 'error' ] = $error[ 2 ];
        }
        else {
            $result[ 'ok' ] = true;
            $result[ 'id' ] = $this->db->lastInsertId();
        }
        return $result;
    }

    public function editElement(int $id, array $data) {
        $params = [];
        $values = implode(',', array_map(function($v, $k) use (&$params) {
            if ($v === NULL) return "$k = DEFAULT";
            $params[] = $v;
            return "$k = ?";
        }, array_values($data), array_keys($data)));
        // var_dump($values);
        // die();
        $query = $this->db->prepare(
            "UPDATE {$this->table} 
             SET $values
             WHERE id = ?"
        );
        $query->execute([ ...$params, $id ]);
        $error = $query->errorInfo();

        $result = [ 'ok' => true ];
        if (isset($error[ 1 ])) {
            $result[ 'ok' ] = false;
            $result[ 'error' ] = $error[ 2 ];
        }
        return $result;
    }
    
    public function deleteElement(int $id): array {
        $query = $this->db->prepare(
            "DELETE FROM {$this->table}
             WHERE id=?"
        );
        $affected = $query->execute([ $id ]);
        $result = [
            'ok' => $affected ? true : false,
            'log' => "$affected rows affected" // siempre 1
        ];
        return $result;
    }

    /** STATIC */
    
    /** Formateo de query
     * Opción : 'where' 
     * 'where' => [ 'id', '=', 5 ] // condicion simple -> where id = 5
     * 'where' => [ 
     *      [ 'id', '=', 5 ],
     *      [ 'titulo', 'like', '%el%' ],
     *      'strict' => false // si AND o OR (default es true (AND))
     * ] // condicion compuesta -> where id = 5 or titulo like '%el%'
     */
    private static function formatWhereStmt(?array $filter): string {
        return $filter === null ? '1' :
            (is_array($filter[0]) ? self::formatComplexWhereStmt($filter) :
                self::formatSimpleWhereStmt($filter));
    }
    /** Formatea una definición compleja (array de definiciones simples/complejas) */
    private static function formatComplexWhereStmt(array $filter): string {
        $strict = $filter[ 'strict' ] ?? true; // define el join de las querys (default AND-true)
        unset($filter[ 'strict' ]);
        $join = $strict ? ' AND ' : ' OR ';
        $whereStmt = '(' . implode($join, array_map(fn ($f) => is_array($f[0]) ? self::formatComplexWhereStmt($f) : self::formatSimpleWhereStmt($f), $filter)) . ')';
        // por cada (array) definicion simple/compuesta, concatenar las querys formateadas de forma compleja o simple
        return $whereStmt;
    }
    /** Formatea una definición simple (col1, operador, col2) -> 'col1 operador col2'*/
    private static function formatSimpleWhereStmt(array $filter): string {
        return "{$filter[0]} {$filter[1]} " . (is_string($filter[2]) ? "'{$filter[2]}'" : "{$filter[2]}");
    }

    /** CONTROL */
    public static function validateTable(&$table): void {
        $table = filter_var($table, FILTER_SANITIZE_STRING);
        if (!$table) throw new Exception("Invalid table: $table"); 
        if (!Model::hasTable($table)) throw new Exception("No existe una tabla con nombre $table"); 
    }
    private static function hasTable(string $table): bool {
        $query = Database::getConnection()->prepare("SHOW TABLES LIKE '$table'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_NUM);
        return $result ? true : false; 
    }
}