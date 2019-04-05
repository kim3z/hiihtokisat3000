<?php
    include_once './header.php';
    require_once './classes/Osallistuminen.php';
    require_once './classes/Kisa.php';
    require_once './classes/Sarja.php';

    if (!isset($_GET['kisa_id']) || !isset($_GET['sarja_id'])) {
        echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa tai sarja id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
        return;
    }

    $kisa = Kisa::haeKisa($_GET['kisa_id']);

    if (!isset($kisa)) {
        echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Kisa ei ole olemassa</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
        return;
    }

    $sarja = Sarja::haeSarja($_GET['sarja_id']);
              
    if (!isset($sarja)) {
        echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>sarja ei ole olemassa</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
        return;
    }
?>

<section>
   <div class="container">
     <div class="row">
       <div class="col-lg-12 mx-auto">
        <a class="btn btn-primary" href="/"> < Takaisin </a>
        <br><br>
        <h2>Tulosseuranta: 
        <?php 
            echo $kisa['nimi'] .' '. $kisa['date'] .' '. $kisa['aika'] . ', ';
            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                echo 'POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'];
            } else {
                echo 'TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'];
            } 
        ?>
        </h2>
        <div class="table-responsive table-body">
        <?php
            // Taulukko alkaa tassa
            echo '<table class="table">';

            // Sarakkeet
            echo '<thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Osallistuja</th>
                        <th scope="col">Seura</th>
                        <th scope="col">Lähtöaika</th>
                        <th scope="col">Väliaika 1</th>
                        <th scope="col">Väliaika 2</th>
                        <th scope="col">Loppuaika</th>
                    </tr>
                </thead>';

            // Taulukko sisalto alkaa tassa
            echo '<tbody>';

            // Uusi rivi, for loopin sisalle
            echo '<tr>';
            echo '<td>1</td>';
            echo '<td>Meika Meikalainen</td>';
            echo '<td>PieHi</td>';
            echo '<td>00:00:00</td>';
            echo '<td>00:00:00</td>';
            echo '<td>00:00:00</td>';
            echo '<td>00:00:00</td>';
            echo '</tr>';

            // Taulukko sisalto loppuu tassa
            echo '</tbody>';

            // Taulukko loppuu tassa
            echo '</table>';
        ?>
        </div>
       </div>
     </div>
   </div>
</section>

<?php
     include_once './footer.php';
?>