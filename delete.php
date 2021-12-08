<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM dental_corner.appointements WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $appointement = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$appointement) {
        exit("'Il n'y a pas un Rendez-vous avec ce ID!'");
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM dental_corner.appointements WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Le Rendez-vous est supprimé';
        } else {
            header('Location: index.php');
            exit;
        }
    }
} else {
    exit("ID n'est pas specifié");
}
?>
<?=template_header('Supprimer')?>

<div class="content delete">
	<h2>Supprimer le Rendez-vous #<?=$appointement['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Etes-vous sûr que vous voulez supprimer le Rendez-vous #<?=$appointement['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$appointement['id']?>&confirm=yes">Oui</a>
        <a href="delete.php?id=<?=$appointement['id']?>&confirm=no">Non</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>