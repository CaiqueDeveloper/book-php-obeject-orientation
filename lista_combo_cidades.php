<?php

use Database\DB;
require_once __DIR__.'/Database/DB.php';
function lista_combo_cidades($id = null): string
{

     $row = DB::table('cidade')->get();

    $output = '';
    if($row){
        foreach ($row as $r){
            $check = ($r['id'] == $id) ? 'selected=1': '';
            $output .= "<option $check value='{$r['id']}'>{$r['nome']} </option>";
        }
    }
    return $output;
}