<?php


class EventController
{
    private $conn;
    function __construct()
    {
        $host = "localhost";
        $dbnaam = "xweb";
        $gebruiker = "root";
        $ww = "";

        //this verwijst naar jouw variabele
        $this->conn = new PDO("mysql:host=$host;dbname=$dbnaam;",
            $gebruiker, $ww);

    }

    function geefKlantBijId($id){

    }

    function verwijderen ($id)
    {
        //STAP 1 - Query schrijven
        $query = "DELETE FROM evenementen WHERE id = :id";
        //STAP2  - Query inlezen
        $stm = $this->conn->prepare($query);
        //STAP 3 - Aliassen koppelen aan waarden
        $stm->bindparam(":id", $id);
        //STAP 4 - Uitvoeren naar de database
        if($stm->execute() == true)
        {
            echo "Query DELETE gelukt!!";
            Header("Location: form.php");

        }

    }

    function wijzigen($id, $naam, $genre, $datum, $locatie, $tijdsduur){

        //STAP 1 - Query schrijven
        $query = "UPDATE evenementen SET naam = :naam,
			 genre = :genre, datum = :datum,
			 locatie = :locatie, tijdsduur = :tijdsduur WHERE id = :id";
        //STAP 2 - query inlezen
        $stm = $this->conn->prepare($query);
        //STAP 3 - Aliassen koppelen aan waarden
        $stm->bindparam(":id", $id);
        $stm->bindparam(":naam", $naam);
        $stm->bindparam(":genre", $genre);
        $stm->bindparam(":datum", $datum);
        $stm->bindparam(":locatie", $locatie);
        $stm->bindparam(":tijdsduur", $tijdsduur);

        //STAP 4 - Query uitvoeren naar de database
        if($stm->execute() == true)
        {
            echo "Update sucessvol!!";
            Header("Location: ../frontend/form.php");
        }

    }


    function toevoegen($id, $naam, $genre, $datum, $locatie, $tijdsduur)
    {
        $query = "INSERT into evenementen VALUES (:id,
                                                  :naam,
                                                  :genre,
                                                  :datum,
                                                  :locatie,
                                                  :tijdsduur)";

        $stm = $this->conn->prepare($query);
        //Koppelen van aliassen aan waarden
        $stm->bindparam(":id", $id);
        $stm->bindparam(":naam", $naam);
        $stm->bindparam(":genre", $genre);
        $stm->bindparam(":datum", $datum);
        $stm->bindparam(":locatie", $locatie);
        $stm->bindparam(":tijdsduur", $tijdsduur);
        if ($stm->execute() == true) {
            echo "<b>Gegevens succesvol opgeslagen!!</b>";

        } else echo "Geen gegevens verstuurd!!";


    }

    function ophalen()
    {
        //query schrijven
        $query = "SELECT * FROM evenementen ORDER BY datum";

        //inlezen query
        $stm = $this->conn->prepare($query);

        //statement uitvoeren
        if($stm->execute())

            //ophalen resultaten
            $result = $stm->fetchAll(PDO::FETCH_OBJ);

        //het doorlopen van de resultaten uit de database
        foreach($result as $event)
        {
            echo '<tr>';
            echo '<td>'.$event->naam."</td>";
            echo '<td>'.$event->genre."</td>";
            echo '<td>'.$event->datum."</td>";
            echo '<td>'.$event->locatie."</td>";
            echo '<td>'.$event->tijdsduur."</td>";
            echo '<td><a href="/xweb3/frontend/details.php?id=' . $event->id . '">Edit</a></td>"';
            echo '</tr>';


        }
    }



}