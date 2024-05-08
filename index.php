<?php ob_start(); ?>
<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('login.php'); ?>


    <div class="boxi">
        <h2>KIRJAUDU SISÄÄN</h2><br></br>
    </div>
    
    <form name="form" method="post">
        <div class="form-group">
            <label for="user">Käyttäjätunnus:</label>
            <input type="text" id="user" name="user" class="form-control">
            <label for="pass">Salasana:</label>
            <input type="password" id="pass" name="pass" class="form-control">
        </div>
        <input type="submit" style="margin-top: 10px;" class="btn btn-success" name="kirjaudu" value="KIRJAUDU SISÄÄN">
        <input type="button" style="margin-top: 10px;" class="btn btn-primary" onclick="location='sample_page.php'" value="JATKA KIRJAUTUMATTA">
        <input type="button" style="margin-top: 10px;" name="rekisteroidy" onclick="location='rekisteroidy.php'" class="btn btn-success" value="REKISTERÖIDY">
    </form>

    <?php

    if(isset($_GET['registermsg2']))
    {
        echo "<h5>".$_GET['registermsg2']."</h5>";
    }
    
    ?>

    <?php 

    if(isset($_GET['viesti']))
    {
        echo "<h6>".$_GET['viesti']."</h6>";
    }

    ?>

<?php include('footer.php'); ?>