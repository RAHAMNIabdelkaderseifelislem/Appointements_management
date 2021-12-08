<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg ='';
if(isset($_GET['id'])){
    if(!empty($_POST)){
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;

        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        $comments = isset($_POST['comments']) ? $_POST['comments'] : '';
        $total = isset($_POST['total']) ? $_POST['total'] : '';
        $payed = isset($_POST['payed']) ? $_POST['payed'] : '';
        $treturn = $total - $payed;
        $etat = isset($_POST['etat']) ? $_POST['etat'] : 'En cours';
        $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d H:i:s');
        $stmt = $pdo->prepare('UPDATE dental_corner.appointements SET id = ?, first_name = ?,last_name = ?, atype = ?,comments = ?,total = ?,payed = ?,treturned = ?, Etat = ?, adate = ? WHERE id = ?');
        $stmt->execute([$id, $first_name, $last_name, $type, $comments, $total, $payed, $treturn, $etat, $date,$_GET['id']]);

        $msg ='Created Successfully!!!';
    }
    $stmt = $pdo->prepare("SELECT * FROM dental_corner.appointements WHERE id = ?");
    $stmt -> execute([$_GET['id']]);
    $appointement = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$appointement){
        exit("Rendez-vous n'existe pas");
    }
}
else{
        exit("ID n'est pas specifié");
    }
?>
<?=template_header('Mise à jour')?>

<div class="content update">
	<h2>Mise à jour le Rendez-vous # <?=$appointement['id']?></h2>
    <form action="update.php?id=<?=$appointement['id']?>" method="post">
        <label for="id">ID</label>
        <label for="type">Type</label>
        <input type="text" name="id" placeholder="26" value="<?=$appointement['id']?>" id="id">
        <input type="text" name="type" placeholder="Soins" id="phone" value="<?=$appointement['atype']?>">
        <label for="last_name">Nom</label>
        <label for="first_name">Prenom</label>
        <input type="text" name="last_name" placeholder="Rahmani" id="name" value="<?=$appointement['last_name']?>">
        <input type="text" name="first_name" placeholder="Abd El Kader" id="email" value="<?=$appointement['first_name']?>" >
        <label for="date">Date</label>
        <label for="total">Total</label>
        <input type="datetime-local" name="date" value="<?=date('Y-m-d\TH:i', strtotime($appointement['adate']))?>" id="title">
        <input type="number" name="total" placeholder="1800" id="total" min="500" step="100" value="<?=$appointement['total']?>">
        <label for="payed">Payé</label>
        <label for="etat">Ètat</label>
        <input type="number" name="payed" placeholder="1800" id="payed" min="500" step="100" value="<?=$appointement['payed']?>">
        <select name="etat" id="etat">
            <option value="En cours">En cours</option>
            <option value="annuler">Annuler</option>
            <option value="retarder">Retarder</option>
            <option value="passer">Passer</option>
        </select>
        <label for="comments">Autre remarque</label>
        <input type="text" name="comments" value="<?=$appointement['comments']?>" id="comments">
        <input type="button" onclick="calcul()" value="Claculer le  reste">
        <input type="submit" value="Mise à jour">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
    <script>
        function calcul() {
            var total = document.getElementById("total").value;
            var payed = document.getElementById("payed").value;
            var rest = total - payed;
            alert("le reste est "+rest)
      }
    </script>
</div>

<?=template_footer()?>
