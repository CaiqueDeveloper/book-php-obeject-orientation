<?php
function lista_combo_cidades($id = null): string
{
    $conn = new PDO('mysql:host=localhost;dbname=livros;', 'root', '');
    $sth = $conn->query('select id, nome from cidade');
    $row = $sth->fetchAll();

    $output = '';
    if($row){
        foreach ($row as $r){
            $check = ($r['id'] == $id) ? 'selected=1': '';
            $output .= "<option $check value='{$r['id']}'>{$r['nome']} </option>";
        }
    }
    return $output;
}