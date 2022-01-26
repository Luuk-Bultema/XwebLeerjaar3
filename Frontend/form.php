<!DOCTYPE html>
<html>
    <head>
        <title>Xweb</title>
        <link rel="stylesheet" href="form.css">
    </head>

    <body>
    <form method="POST">
        <input placeholder="Naam" type="text" name="txtNaam"/>
        <input placeholder="Genre" type="text" name="txtGenre"/>
        <input placeholder="Datum" type="date" name="datum"/>
        <input placeholder="Locatie" type="text" name="txtLocatie"/>
        <input placeholder="Tijdsduur" type="time" name="tijdsduur"/>
        <input type="submit" name="btnVerstuur" value="Verstuur"/>
    </form>



<?php

    require ("../Frontend/config.php");
    include ("../Backend/EventController.php");
    if(isset($_POST['btnVerstuur'])) {
        $id = 0;
        $naam = $_POST['txtNaam'];
        $genre = $_POST['txtGenre'];
        $datum = $_POST['datum'];
        $locatie = $_POST['txtLocatie'];
        $tijdsduur = $_POST['tijdsduur'];
        $ec = new EventController();
        $ec->toevoegen($id, $naam, $genre, $datum, $locatie, $tijdsduur);

    }
?>
    <table id = "table">
    <thead>
    <tr>
    <td>Naam</td>
    <td>Genre</td>
    <td>Datum</td>
    <td>Locatie</td>
    <td>Tijdsduur</td>
    <td> </td>
    </tr>
    </thead>
    <tbody>

    <?php
    $ec = new EventController();
    $ec->ophalen();
/*
    //het doorlopen van de resultaten uit de database
    foreach($result as $event)
    {
      echo '<tr>';
      echo '<td>'.$event->naam."</td>";
      echo '<td>'.$event->genre."</td>";
      echo '<td>'.$event->datum."</td>";
      echo '<td>'.$event->locatie."</td>";
      echo '<td>'.$event->tijdsduur."</td>";
      echo '<td><a href="/xweb/edit.php?id=' . $event->id . '">Edit</a></td>"';
      echo '</tr>';


    }
*/

    //if isset wil zeggen als iets bestaat of gevuld is
//linkje altijd via get methode
//als je new ziet staan weet je dat je een object gaat aanmaken


?>

</tbody>
</table>
</body>
</html>



