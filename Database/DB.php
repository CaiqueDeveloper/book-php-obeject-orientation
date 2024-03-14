<?php

namespace Database;
use PDO;

class DB
{
    private static $table = null;
    private static array $params = [];
    public static $db = null;
    public static $setting = null;

    private function __construct()
    {
        //self::$setting = require_once '../config.php';
    }
    public static function getInstance(): ?PDO
    {
        if(!self::$db){
            self::$db = new PDO('mysql:host=localhost;dbname=livros;user=root;password=');
        }
        return self::$db;
    }
    public static function table(string $table): DB
    {
        self::$table = $table;
        return new self;
    }
    public static function select(array $params): DB
    {
        self::$params = $params;
        return new self;
    }
    public static function get(): bool|array|null
    {
        return self::verifyHasFieldInSelect(static::$params);
    }
    public static function insert(array $params): void
    {
        $fields = implode(', ', array_keys($params));
        $values =  ':'.implode(', :', array_keys($params));

        self::getInstance()
            ->prepare("INSERT INTO ".self::$table. " ($fields) VALUES ($values)")
            ->execute($params);
    }
    private static function verifyHasFieldInSelect(array $params): bool|array
    {
        if(sizeof(self::$params) > 0){
            return self::creatQueryWithParams();
        }
        return self::createBasicQuery();
    }
    private static function creatQueryWithParams(): bool|array
    {
        return DB::getInstance()
            ->query('select '.implode(',', self::$params).' from ' .self::$table)
            ->fetchAll();
    }
    private static function createBasicQuery(): bool|array
    {
        return DB::getInstance()->query(
            'select * from '.self::$table)
            ->fetchAll();
    }
}