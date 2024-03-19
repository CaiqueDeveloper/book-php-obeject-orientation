<?php
require_once __DIR__.'/Database/DB.php';
use Database\DB;

$pessoa = DB::table('pessoa')->where(['id' ,$_GET['id']])->first();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/form.css" type="text/css">
    <title>Pessoa Form Insert</title>
</head>
<body>
<form enctype="multipart/form-data" method="post" action="pessoa_save_update.php">
    <label>Código</label>
    <input type="text" name="id" readonly="1" style="30%" value="<?= $pessoa['id']?>">
    <label>Nome</label>
    <input type="text" name="nome" style="50%" value="<?= $pessoa['nome']?>">
    <label>Endereço</label>
    <input type="text" name="endereco" style="50%" value="<?= $pessoa['endereco']?>">
    <label>Bairro</label>
    <input type="text" name="bairro" style="25%" value="<?= $pessoa['bairro']?>">
    <label>Telefone</label>
    <input type="text" name="telefone" style="25%" value="<?= $pessoa['telefone']?>">
    <label>E-mail</label>
    <input type="email" name="email" style="25%" value="<?= $pessoa['email']?>">
    <label>Cidade</label>
    <select name="id_cidade" id="" style="width: 25%">
        <?php
        require_once __DIR__.'/lista_combo_cidades.php';
        print  lista_combo_cidades($pessoa['id_cidade']);
        ?>
    </select>
    <input type="submit" value="Editar">
</form>
</body>
</html>





