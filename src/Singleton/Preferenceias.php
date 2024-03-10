<?php

namespace Caiqu\BookPhpObjectOrientation\Singleton;

class Preferenceias
{
    private ?array $data;
    private static ?object $instance;
    private function __construct()
    {
        $this->data = parse_ini_file('application.ini');
    }
   public static function getInstance(): ?object
    {
        if(empty(self::$instance)){
            self::$instance = new self;
        }
        return self::$instance;
    }
    public function setData($key, $value): void
    {
        $this->data[$key] = $value;
    }
    public function getData($key): mixed
    {
        return $this->data[$key];
    }
    public function save(): void
    {
        $string = '';
        if($this->data){
            foreach ($this->data as $key => $value){
                $string .="{$key} = \{$value}\" \n";
            }
        }
        file_put_contents('application.ini', $string);

    }
}