<?php
require_once __DIR__.'/Database/DB.php';
use Database\DB;

DB::table('pessoa')
    ->insert($_POST);