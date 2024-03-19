<?php
require_once __DIR__.'/Database/DB.php';
use Database\DB;
$dados = $_POST;

if($dados['id'] != ""){
   $pessoa =  DB::table('pessoa')
        ->where(['id' => $dados['id']])
        ->update($dados);
    header('location: pessoa_list.php');
}