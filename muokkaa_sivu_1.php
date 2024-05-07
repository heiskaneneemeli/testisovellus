<?php ob_start(); ?>
<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<?php

    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $id = $_GET['id'];
    
        
                $query = "select * from oppilaat where id = '$id'";

                $result = mysqli_query($connection, $query);

                if(!$result)
                {
                    die("query virhe".mysqli_error());
                }
                
                else
                {
                    $row = mysqli_fetch_assoc($result);
                }
    }

?>
    <!-- päivittää datan tietokannassa -->
    <?php

        if(isset($_POST['muokkaa_oppilas']))
        {
            if(isset($_GET['id_new']))
            {
                $idnew = $_GET['id_new'];
            }
             
            else
            {
                $idnew = $id;
            }

            $e_nimi = $_POST['e_nimi'];
            $s_nimi = $_POST['s_nimi'];
            $ika = $_POST['ika'];

            // vahvistaa onko annettu kaikki arvot
            if($e_nimi == "" || empty ($e_nimi))
            {
                header('location:muokkaa_sivu_1.php?id=' . $idnew . '&virhe=Anna etunimi');
            }

            else if($s_nimi == "" || empty ($s_nimi))
            {
                header('location:muokkaa_sivu_1.php?id=' . $idnew . '&virhe=Anna sukunimi');
            }

            else if($ika == "" || empty ($ika))
            {
                header('location:muokkaa_sivu_1.php?id=' . $idnew . '&virhe=Anna ikä');
            }

            // tarkista että ikä on välillä 1-99
            else if(!filter_var($ika, FILTER_VALIDATE_INT, array("options" => array("min_range"=>1, "max_range"=>99))))
            {
                header('location:muokkaa_sivu_1.php?id=' . $idnew . '&virhe=Iän täytyy olla 1-99');
            }
        
            // tarkista että nimi on muodossa "Etunimi Sukunimi"
            else if(!preg_match("/^[A-ZÄÖÅ][a-zäöå]* [A-ZÄÖÅ][a-zäöå]*$/u", $e_nimi . " " . $s_nimi))
            {
                header('location:muokkaa_sivu_1.php?id='. $idnew .'&virhe=Nimen täytyy olla muodossa "Etunimi Sukunimi"');
            }
                
            else
            {
                $query = "update oppilaat set etunimi = '$e_nimi', sukunimi = '$s_nimi', age = '$ika' where id = '$idnew'";

                $result = mysqli_query($connection, $query);

                if(!$result)
                {
                        die("query virhe".mysqli_error());
                }

                else
                {
                    header('location:kotisivu.php?muokkaa_msg=Oppilaan muokkaus onnistui');
                }
            }
        }

    ?>

    <?php

        session_start(); // tarkistaa onko käyttäjä kirjautunut sisään

               if(!isset($_SESSION['user_id']))
               {
                     header('Location: index.php');
                     exit();
               }

    ?>
    
    <!-- Muokkaus sivun kaavake -->
    <form action="muokkaa_sivu_1.php?id_new=<?php echo $id; ?>" method="post">
        <div class="form-group">
            <label for="e_nimi">Etunimi</label>
            <input type="text" name="e_nimi" class="form-control" value="<?php echo $row['etunimi'] ?>">
        </div>
        <div class="form-group">
            <label for="s_nimi">Sukunimi</label>
            <input type="text" name="s_nimi" class="form-control" value="<?php echo $row['sukunimi'] ?>">
        </div>
        <div class="form-group">
            <label for="ika">Ikä</label>
            <input type="text" name="ika" class="form-control" value="<?php echo $row['age'] ?>">
        </div>
        <input type="submit" style="margin-top: 10px;" class="btn btn-success" name="muokkaa_oppilas" value="MUOKKAA">
    </form>

    <?php 

                if(isset($_GET['virhe']))
                {
                    echo "<h6>".$_GET['virhe']."</h6>";
                }

     ?>

<?php include('footer.php'); ?>