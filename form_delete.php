<?php
require_once __DIR__. '/Database/DB.php';
use Database\DB;
$id = $_GET['id'];

if($id != ""){
    DB::table('pessoa')
        ->where(['id'=> $id])
        ->delete();
    header('location: pessoa_list.php');
}