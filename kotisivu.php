<?php ob_start(); ?>
<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

       <?php

        session_start(); // Toivottaa käyttäjän tervetulleeksi

                if(isset($_SESSION['username'])) 
                {
                    echo '<div class="header" style="font-size: 30px; text-align: center;">';
                    echo 'Tervetuloa, ' . $_SESSION['username'];
                    echo '</div>';
                }
        ?>

        <div class="boxi">
            <h2>OPPILAAT</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">LISÄÄ OPPILAS</button>
            <form method="post">
                 <input type="submit" style="margin-left: 10px;" class="btn btn-danger" name="logout" value="KIRJAUDU ULOS">
            </form>
        </div>

        <!-- taulukko -->
        <table class="table table-hover table-bordered tabel-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Etunimi</th>
                    <th>Sukunimi</th>
                    <th>Ikä</th>
                    <th>Muokkaa</th>
                    <th>Poista</th>
                </tr>
            </thead>
            <tbody>

                <!-- tietokanta -->
                <?php

                $query = "select * from oppilaat";

                $result = mysqli_query($connection, $query);

                if(!$result)
                {
                    die("query virhe".mysqli_error());
                }
                
                else
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['etunimi']; ?></td>
                        <td><?php echo $row['sukunimi']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><a href="muokkaa_sivu_1.php?id=<?php echo $row['id']; ?>" class="btn btn-success">MUOKKAA</a></td>
                        <td><a href="poista_sivu.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">POISTA</a></td>
                    </tr>

                        <?php
                    }
                }

                ?>
            </tbody>
        </table>

        <!-- virhe viestit ja onnistumis viestit -->
        <?php 

                if(isset($_GET['message']))
                {
                    echo "<h6>".$_GET['message']."</h6>";
                }

        ?>

        <?php 

                if(isset($_GET['insert_msg']))
                {
                    echo "<h5>".$_GET['insert_msg']."</h5>";
                }

        ?>

        <?php

                if(isset($_GET['muokkaa_msg']))
                {
                    echo "<h5>".$_GET['muokkaa_msg']."</h5>";
                }

        ?>

        <?php

                if(isset($_GET['poista_msg']))
                {
                    echo "<h5>".$_GET['poista_msg']."</h5>";
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

        <?php

        session_start(); // Ulos kirjautuminen

               if(isset($_POST['logout']))
               {
                    session_destroy();
                    header('Location: index.php');
                    exit();
               }
         
         ?>



    <!-- Bootstrap modal popup -->
    <form action="insert_data.php" method="post">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">LISÄÄ OPPILAS</h5>
                        </button>
                    </div>
                    
                <!-- Bootstrap taulukko -->
                <div class="modal-body">
                        <div class="form-group">
                            <label for="e_nimi">Etunimi</label>
                            <input type="text" name="e_nimi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="s_nimi">Sukunimi</label>
                            <input type="text" name="s_nimi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ika">Ikä</label>
                            <input type="text" name="ika" class="form-control">
                        </div>
                </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" name="lisää_oppilas" value="LISÄÄ">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php include('footer.php'); ?>