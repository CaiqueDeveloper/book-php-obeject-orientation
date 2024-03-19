<?php

namespace Database;
use PDO;

class DB
{
    private static $TABLE = null;
    private static $QUERY = '';
    private static array $PARAMS_QUERY = [];
    private static array $PARAMS_QUERY_UPDATE = [];
    private static  $CONDITIONAL_PARAMS_QUERY = [];
    private  static string $TYPE_QUERY = 'SELECT';
    private  static string $TYPE_CLAUSE_QUERY = 'WHERE';
    public static $db = null;
    public static $drive = 'mysql';
    public static $setting = null;

    private function __construct()
    {
        self::$setting = require_once './config.php';
    }

    /**
     * @return PDO|null
     */
    public static function getInstance(): ?PDO
    {
        if(!self::$db){
            self::$db = new PDO('mysql:host=localhost;dbname=livros;user=root;password=');
        }
        return self::$db;
    }

    /**
     * @param string $table
     * @return DB
     */
    public static function table(string $table): DB
    {
        self::$TABLE = $table;
        return new self;
    }

    /**
     * @param array $params
     * @return DB
     */
    public static function select(array $params): DB
    {
        self::$PARAMS_QUERY = $params;
        return new self;
    }

    /**
     * @param array $params
     * @return DB
     */
    public  static function where(array $params): DB
    {
        self::$CONDITIONAL_PARAMS_QUERY = $params;
        self::$TYPE_CLAUSE_QUERY = 'WHERE';
        return new self;
    }

    /**
     * @return array|false
     */
    public static function get(): bool|array
    {
        return self::prepareSQLQuery()->fetchAll();
    }

    /**
     * @return mixed
     */
    public static function first(): mixed
    {
        return self::prepareSQLQuery()->fetch();
    }

    /**
     * @param array $params
     * @return bool|\PDOStatement|null
     */
    public static function insert(array $params)
    {
        self::$PARAMS_QUERY = $params;
        return self::prepareSQLQuery('INSERT');
    }

    /**
     * @return bool|\PDOStatement|void
     */
    public static function delete()
    {
          if(static::first()){
            return self::prepareSQLQuery( 'DELETE');
          }
    }

    /**
     * @param $params
     * @return void
     */
    public static  function update($params)
    {
        self::$PARAMS_QUERY_UPDATE = $params;

        if(self::first()){
            return self::prepareSQLQuery('UPDATE');
        }
    }
    /**
     * @param $type_query
     * @return bool|\PDOStatement
     */
    private static function prepareSQLQuery(string $type_query = null): bool|\PDOStatement|null
    {
        $TYPE = $type_query ?: self::$TYPE_QUERY;

        return match($TYPE){
            'SELECT' => self::createSelectQuery(),
            'DELETE' => self::createDeleteQuery(),
            'INSERT' => self::createInsertQuery(),
            'UPDATE' => self::createUpdateQuery(),
        };
    }

    /**
     * @return bool|\PDOStatement
     */
    private static function createSelectQuery(): bool|\PDOStatement|null
    {
        if(sizeof(self::$PARAMS_QUERY) > 0  && sizeof(self::$CONDITIONAL_PARAMS_QUERY)  > 0)
        {
            self::$QUERY= self::$TYPE_QUERY.' '
                .implode(' , ', self::$PARAMS_QUERY).' FROM '.
                self::$TABLE. ' '.self::$TYPE_CLAUSE_QUERY.' '.
                implode(' = ', self::$CONDITIONAL_PARAMS_QUERY);

        }elseif(sizeof(self::$CONDITIONAL_PARAMS_QUERY)  > 0){
            self::$QUERY= self ::$TYPE_QUERY.' * FROM ' . self::$TABLE. ' '.self::$TYPE_CLAUSE_QUERY.' '.implode(' = ', self::$CONDITIONAL_PARAMS_QUERY);
        }else{
            self::$QUERY= self ::$TYPE_QUERY.' * FROM ' . self::$TABLE;
        }
        return self::executeQuery();
    }

    /**
     * @return bool|\PDOStatement
     */
    private static function createInsertQuery(): bool|\PDOStatement|null
    {
        $fields = implode(', ', array_keys(self::$PARAMS_QUERY));
        $values =  ':'.implode(', :', array_keys(self::$PARAMS_QUERY));

        self::$QUERY = "INSERT INTO ".self::$TABLE. " ($fields) VALUES ($values)";
        return self::executeQuery('INSERT');
    }

    /**
     * @return void
     */
    private static function createUpdateQuery()
    {
        $params = [];
        foreach (self::$PARAMS_QUERY_UPDATE as $key => $param){
           $params[] = $key.' = :'.$key;
        }

        if(sizeof(self::$CONDITIONAL_PARAMS_QUERY) > 0 && sizeof(self::$PARAMS_QUERY_UPDATE) > 0)
        {
            $field = implode(',', array_keys(self::$CONDITIONAL_PARAMS_QUERY));
            $value = ':'.implode(':', array_keys(self::$CONDITIONAL_PARAMS_QUERY));
            self::$QUERY = 'UPDATE '.self::$TABLE.' SET '.implode(', ',$params).' '.self::$TYPE_CLAUSE_QUERY. ' '.$field.' = '.$value;;
            self::$CONDITIONAL_PARAMS_QUERY = array_merge(self::$CONDITIONAL_PARAMS_QUERY,self::$PARAMS_QUERY_UPDATE);

        }else{
            self::$QUERY = 'UPDATE '.self::$TABLE.' SET '.implode(', ',$params);
        }
        return self::executeQuery('UPDATE');
    }
    /**
     * @return bool|\PDOStatement
     */
    private static function createDeleteQuery(): bool|\PDOStatement|null
    {
        if(sizeof(self::$CONDITIONAL_PARAMS_QUERY) > 0)
        {
            $field = implode(',', array_keys(self::$CONDITIONAL_PARAMS_QUERY));
            $value = ':'.implode(':', array_keys(self::$CONDITIONAL_PARAMS_QUERY));
            self::$QUERY = 'DELETE  from '.self::$TABLE.' '.self::$TYPE_CLAUSE_QUERY. ' '.$field.' = '.$value;
        }else{
            self::$QUERY = 'DELETE  from '.self::$TABLE;
        }

        return self::executeQuery('DELETE');
    }
    /**
     * @param $type_query
     * @return bool|\PDOStatement
     */
    private static function executeQuery(string $type_query = null): bool|\PDOStatement|null
    {
        $TYPE = $type_query ?: self::$TYPE_QUERY;

        if ($TYPE  == 'SELECT') {
          return self::getInstance()
                ->query(self::$QUERY);
        }

        return self::getInstance()
            ->prepare(self::$QUERY)
            ->execute(self::resolveParamsQuery());
    }

    /**
     * @return array
     */
    private static function resolveParamsQuery(): array
    {
        $params = null;
        if(sizeof(self::$CONDITIONAL_PARAMS_QUERY) > 0){
            $params = self::$CONDITIONAL_PARAMS_QUERY;
        }else{
            $params = self::$PARAMS_QUERY;
        }
        return $params != null ? $params: self::$PARAMS_QUERY_UPDATE;
    }


}