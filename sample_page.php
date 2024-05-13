<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>

        <div class="boxi">
            <h2>OPPILAAT</h2>
            <button class="btn btn-success" onclick="location='index.php'">KIRJAUDU SISÄÄN</button>
        </div>

        <!-- taulukko -->
        <table class="table table-hover table-bordered tabel-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Etunimi</th>
                    <th>Sukunimi</th>
                    <th>Ikä</th>
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
                    </tr>

                        <?php
                    }
                }

                ?>
            </tbody>
        </table>

<?php include('footer.php'); ?>