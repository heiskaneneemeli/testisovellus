<?php ob_start(); ?>

<?php include('dbcon.php'); ?>

<!-- poistaa datan tietokannasta -->
<?php

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $query = "delete from oppilaat where id = '$id'";

        $result = mysqli_query($connection, $query);

        if(!$result)
        {
            die("query virhe".mysqli_error());
        }

        else
        {
            header('location:kotisivu.php?poista_msg=Oppilas poistettu onnistuneesti');
        }
    }

?>