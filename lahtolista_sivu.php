<?php
    /**
     * @author Kim
    */

	/**
	 * Yksittäisen sarjan lahtolista sivu.
	 */

    include_once './header.php';
    require_once './classes/User.php';
    require_once './classes/Osallistuminen.php';
    require_once './classes/Kisa.php';
    require_once './classes/Sarja.php';
    require_once './classes/haku.php';
    require_once './classes/Seura.php';

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
        <?php
            echo "<a class=\"btn btn-primary\" href=\"javascript:history.go(-1)\"> < Takaisin </a>";
        ?>
        <?php
            $pdfTitle = 'lahtolista';
            
            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                $pdfTitle = 'lahtolista-'.$kisa['nimi'].'-'.$kisa['date'].'-'.$kisa['aika'].'-miehet-'.$sarja['min_ika'].'-'.$sarja['max_ika'];
            } else {
                $pdfTitle = 'lahtolista-'.$kisa['nimi'].'-'.$kisa['date'].'-'.$kisa['aika'].'-naiset-'.$sarja['min_ika'].'-'.$sarja['max_ika'];
            }
        ?>
        <div id="lahtolista-pdf-title" style="display: none;"><?php echo $pdfTitle; ?></div>
        <br><br>
        <button class="btn btn-success" id="generate-lahtolista-pdf">PDF</button><br>
		<div id="lahtolista-pdf-area">
            <h2>Lähtölista: 
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
                        </tr>
                    </thead>';
                // Taulukko sisalto alkaa tassa
                echo '<tbody>';

                $osallistujatLahtolista = Osallistuminen::kisaSarjaOsallistujatLahtolista($kisa['id'], $sarja['id']);
                
                if (sizeof($osallistujatLahtolista) === 0) {
                    echo '<tr><td>Osallistujia ei vielä ole</td></tr>';
                    return;
                }

                $index = 0;
                foreach ($osallistujatLahtolista as $osallistuja) {
                    $index++;
                    $user = User::getUserById($osallistuja['userId']);
                    $nimi = haku::haeNimi($osallistuja['userId']);
                    $seura = Seura::seuraNimi($user['seuraId']);
                    echo '<tr>';
                    echo '<td>' . $index . '</td>';
                    echo '<td>' . $nimi['etunimi'] .' '. $nimi['sukunimi'] . '</td>';
                    echo '<td>' . $seura . '</td>';
                    echo '</tr>';
                }
                // Taulukko sisalto loppuu tassa
                echo '</tbody>';
                // Taulukko loppuu tassa
                echo '</table>';
            ?>
            </div>
        </div>
       </div>
     </div>
   </div>
</section>

<?php
     include_once './footer.php';
?>
