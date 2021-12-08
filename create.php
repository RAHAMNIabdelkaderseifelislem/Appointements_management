<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg ='';
if(!empty($_POST)){
    //generate automatic ID 
    //spagheti code i know but old method didn't work
    if($connection = new mysqli('127.0.0.1','root','','dental_corner')){

    }else{
        echo "Erreur de connexion";
    }
    $req = "SELECT COUNT(*) FROM appointements";
    $res = $connection -> query($req);
    $new_id;
    while ($row = $res->fetch_assoc()) {
        $new_id = $row['COUNT(*)'] + 1;
    }
    
    //echo $new_id;
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : $new_id;

    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $comments = isset($_POST['comments']) ? $_POST['comments'] : '';
    $total = isset($_POST['total']) ? $_POST['total'] : '';
    $payed = isset($_POST['payed']) ? $_POST['payed'] : '';
    $treturn = $total - $payed;
    $etat = "En Cours";
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $stmt = $pdo->prepare('INSERT INTO dental_corner.appointements VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $first_name, $last_name, $type, $comments, $total, $payed, $treturn, $etat, $date]);

    $msg ='Created Successfully!!!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Ajouter Un Rendez-vous</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="type">Type</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="type" placeholder="Soins" id="phone">
        <label for="last_name">Nom</label>
        <label for="first_name">Prenom</label>
        <input type="text" name="last_name" placeholder="Rahmani" id="name">
        <input type="text" name="first_name" placeholder="Abd El Kader" id="email">
        <label for="date">Date</label>
        <label for="total">Total</label>
        <input type="datetime-local" name="date" value="<?=date('Y-m-d\TH:i')?>" id="title">
        <input type="number" name="total" placeholder="1800" id="total" min="500" step="100">
        <label for="payed">Payé</label>
        <label for="comments">Autre remarque</label>
        <input type="number" name="payed" placeholder="1800" id="payed" min="500" step="100">
        <input type="text" name="comments" id="comments">
        <input type="submit" value="Create">
        <input type="button" onclick="calcul()" value="Claculer le  reste">
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