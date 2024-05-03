<?php ob_start(); ?>

<?php include('dbcon.php'); ?>

<?php

    if(isset($_POST['kirjaudu']))
    {
        $käyttäjätunnus = $_POST['user'];
        $salasana = $_POST['pass'];

        $query = "select * from login where käyttäjätunnus = '$käyttäjätunnus' and salasana = '$salasana'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count == 1)
        {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header("location:kotisivu.php");
        }

        else
        {
            header('location:index.php?viesti=Virheellinen Käyttäjätunnus tai salasana');
        }
    }

?>
    <?php 

        if(isset($_GET['viesti']))
        {
            echo "<h6>".$_GET['viesti']."</h6>";
        }

    ?>