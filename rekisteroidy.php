<?php ob_start(); ?>
<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

<div class="boxi">
    <h2>REKISTERÖIDY</h2><br></br>
</div>

<form name="form" method="post">
    <div class="form-group">
        <label for="kayttis">Käyttäjätunnus:</label>
        <input type="text" id="kayttis" name="kayttis" class="form-control">
        <label for="salis">Salasana:</label>
        <input type="password" id="salis" name="salis" class="form-control">
    </div>
    <input type="submit" style="margin-top: 10px;" class="btn btn-success" name="success" value="REKISTERÖIDY">
    <input type="button" style="margin-top: 10px;" name="poistu" onclick="location='index.php'" class="btn btn-danger" value="TAKAISIN">
</form>

<?php
if(isset($_POST["success"]))
{
    $kayttis = $_POST['kayttis'];
    $salis = $_POST['salis'];

    // vahvistaa onko annettu kaikki arvot
    if($kayttis == "" || empty ($kayttis))
    {
        header('location:rekisteroidy.php?registermsg=Anna käyttäjätunnus');
    }
    else if($salis == "" || empty ($salis))
    {
        header('location:rekisteroidy.php?registermsg=Anna salasana');
    }
    else
    {
        // Tarkista, onko käyttäjätunnus tai salasana jo olemassa tietokannassa
        $query = "select * from login where käyttäjätunnus = '$kayttis' or salasana = '$salis'";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) > 0)
        {
            header('location:rekisteroidy.php?registermsg=Rekisteröinti epäonnistui. Yritä uudelleen.');
        }
        // lisää käyttäjätunnuksen tietokantaan
        else
        {
            $query = "insert into login (käyttäjätunnus, salasana) values ('$kayttis', '$salis')";
            $result = mysqli_query($connection,$query);

            if(!$result)
            {
                die("Query virhe".mysqli_error());
            }
            else
            {
                header('location:index.php?registermsg2=Käyttäjätunnus lisätty');
            }
        }
    }
}

if(isset($_GET['registermsg']))
{
    echo "<h6>".$_GET['registermsg']."</h6>";
}

include('footer.php'); 
?>