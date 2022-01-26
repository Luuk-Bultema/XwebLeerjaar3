<html>
<head>
    <title>evenement inplannen</title>
    <link rel="stylesheet" href="form.css">
</head>

<?php
require("../Frontend/config.php");
require("../Backend/EventController.php");
$ec = new EventController();
if(isset($_POST['btnDelete'])){
    echo "Verwijderen maar!";
    $id = $_POST['txtId'];
    $ec->verwijderen($id);


}

if(isset($_POST['btnVerstuur'])){
    echo "Updaten maar!";

    //Variabelen ophalen
    $id = $_POST["txtId"];
    $naam = $_POST['naam'];
    $genre = $_POST['genre'];
    $datum = $_POST['datum'];
    $locatie = $_POST['locatie'];
    $tijdsduur = $_POST['tijdsduur'];

    $ec->wijzigen($id, $naam, $genre, $datum, $locatie, $tijdsduur);


}



if(isset($_GET['id'])) {
$id = $_GET['id'];

$query = "SELECT * FROM evenementen WHERE id = :id";
//    $query = $conn->prepare("SELECT * FROM evenementen WHERE id = '$id'");
//$query->execute();
//    if ($event = $query->fetch(PDO::FETCH_OBJ)) {
//        echo 'Werkt';
//    }

$stm = $conn->prepare($query);
//STAP 3 - Aliassen koppelen aan waarden
$stm->bindparam(":id", $id);
//STAP 4 - Query uitvoeren op de database
if ($stm->execute() == true)
{


$event = $stm->fetch(PDO::FETCH_OBJ);
if ($event != null)
{

?>

<form method='POST'>
    <div id="form">
        <input value="<?php echo $event->id; ?>" hidden type="text" name="txtId"/>
        Naam van evenement:<input type='text' name='naam' value='<?php echo $event->naam ?>'/><br>
        Genre:<input type='text' name='genre' value='<?php echo $event->genre ?>'/><br><br>
        Datum van evenement:<input type='date' name='datum' value='<?php echo $event->datum ?>'/><br><br>
        Locatie:<input type='text' name='locatie' value='<?php echo $event->locatie ?>'/><br><br>
        Tijdsduur:<input type='time' name='tijdsduur' value='<?php echo $event->tijdsduur ?>'/><br><br>

    </div>
    <input type="submit" class="verstuur" name="btnVerstuur" value="Verstuur"/>
    <input type="submit" class="delete" name="btnDelete" value="Delete"/>

</form>
</body>
</html>

<?php


echo $event->naam;
echo $event->genre;
echo $event->datum;
echo $event->locatie;
echo $event->tijdsduur;
} else Header("Location: frontend/form.php");

} else {
    echo "Query kan niet uitgevoerd worden. Controleer de query!";

}
}
?>