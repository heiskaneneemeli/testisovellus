<?php ob_start(); ?>

<?php
include 'dbcon.php';

if(isset($_POST['lisää_oppilas']))
{
    $e_nimi = $_POST['e_nimi'];
    $s_nimi = $_POST['s_nimi'];
    $ika = $_POST['ika'];
    
    // vahvistaa onko annettu kaikki arvot
    if($e_nimi == "" || empty ($e_nimi))
    {
        header('location:kotisivu.php?message=Anna etunimi');
    }

    else if($s_nimi == "" || empty ($s_nimi))
    {
        header('location:kotisivu.php?message=Anna sukunimi');
    }

    else if($ika == "" || empty ($ika))
    {
        header('location:kotisivu.php?message=Anna ikä');
    }

    // tarkista että ikä on välillä 1-99
    else if(!filter_var($ika, FILTER_VALIDATE_INT, array("options" => array("min_range"=>1, "max_range"=>99))))
    {
        header('location:kotisivu.php?message=Iän täytyy olla 1-99');
    }
        
    // tarkista että nimi on muodossa "Etunimi Sukunimi"
    else if(!preg_match("/^[A-Z][a-z]* [A-Z][a-z]*$/", $e_nimi . " " . $s_nimi))
    {
        header('location:kotisivu.php?message=Nimen täytyy olla muodossa "Etunimi Sukunimi"');
    }


    // lisää oppilaan tietokantaan
    else
    {
        $query = "insert into oppilaat (etunimi, sukunimi, age) values ('$e_nimi','$s_nimi', '$ika')";

        $result = mysqli_query($connection,$query);

        if(!$result)
        {
            die("Query virhe".mysqli_error());
        }

        else
        {
            header('location:kotisivu.php?insert_msg=Oppilas lisätty onnistuneesti');
        }
    }
}

?>