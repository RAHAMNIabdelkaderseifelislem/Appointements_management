<?php
    include 'functions.php';
    $pdo = pdo_connect_mysql();
    $page = isset($_GET['page'])&& is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $records_per_page = 5;

    $stmt = $pdo->prepare("SELECT * FROM dental_corner.appointements  ORDER BY id");
    $stmt->execute();
    $appointments = $stmt->fetchAll();
?>
<?=template_header('Les Rendez-vous ')?>

<div class="content read">
	<h2>Les Rendez-vous </h2>
	<a href="create.php" class="create-contact">Ajouter un Rendez-vous</a>
	<table id="dental">
        <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Type</td>
                <td>Date & Temps</td>
                <td>Ètat</td>
                <td>Autre remarque</td>
                <td>Payé</td>
                <td>Total</td>
                <td>Rest</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?=$appointment['id']?></td>
                <td><?=$appointment['last_name']?></td>
                <td><?=$appointment['first_name']?></td>
                <td><?=$appointment['atype']?></td>
                <td><?=$appointment['adate']?></td>
                <td><?=$appointment['Etat']?></td>
                <td><?=$appointment['comments']?></td>
                <td><?=$appointment['payed']?></td>
                <td><?=$appointment['total']?></td>
                <td><?=$appointment['treturned']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$appointment['id']?>" class="edit"><i class="gg-pen"></i></a>
                    <a href="delete.php?id=<?=$appointment['id']?>" class="trash"><i class="gg-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        $(document).ready( function () {
            $('#dental').DataTable();
        } );
    </script>
</div>
<?=template_footer()?>