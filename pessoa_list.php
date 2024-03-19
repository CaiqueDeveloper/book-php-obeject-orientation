<?php
    require __DIR__.'/Database/DB.php';
    use Database\DB;

    $pessoas = DB::table('pessoa')->get();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de pessoas</title>
    <link rel="stylesheet" href="css/list.css">
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Id</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Bairro</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pessoas as $pessoa): ?>
                <tr>
                    <td>
                        <a href="form_edit.php?id=<?= $pessoa['id']; ?>">Editar</a>
                    </td>
                    <td>
                        <a href="form_delete.php?id=<?= $pessoa['id']; ?>">Deletar</a>
                    </td>
                    <td><?= $pessoa['id']; ?></td>
                    <td><?= $pessoa['nome']; ?></td>
                    <td><?= $pessoa['endereco']; ?></td>
                    <td><?= $pessoa['bairro']; ?></td>
                    <td><?= $pessoa['telefone']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<button onclick="window.location='pessoa_form_insert.php'">
    Inserir
</button>
</body>
</html>
