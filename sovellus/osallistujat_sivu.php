<?php
    require_once './onko_admin_kayttaja.php';
    include_once './sovellus_header.php';
    require_once '../classes/Osallistuminen.php';
    require_once '../classes/Kisa.php';
    require_once '../classes/Sarja.php';
    include_once '../classes/User.php';
    include_once '../classes/Seura.php';

    if (!isset($_GET['kisa_id']) || !isset($_GET['sarja_id'])) {
        return;
    }

    $kisa = Kisa::haeKisa($_GET['kisa_id']);

    if (!isset($kisa)) {
        echo 'Kisa ei löydetty';
        return;
    }

    $sarja = Sarja::haeSarja($_GET['sarja_id']);
              
    if (!isset($sarja)) {
        echo 'Sarja ei löydetty';
        return;
    }
?>

<section>
   <div class="container">
     <div class="row">
       <div class="col-lg-8 mx-auto">
        <a class="btn btn-primary" href="../sovellus"> < Takaisin </a>
        <br><br>
        <h2>Osallistujat</h2>
        <?php echo '<div><strong>Kisa: </strong>' . $kisa['nimi'] .' '. $kisa['date'] .' '. $kisa['aika'] . '</div>'; ?>
        <?php 
            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                echo '<div><strong>Sarja: </strong>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</div>';
            } else {
                echo '<div><strong>Sarja: </strong>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</div>';
            }
        ?>
        <?php
            $osallistujat = Osallistuminen::kisaSarjaOsallistujat($kisa['id'], $sarja['id']);
            
            if (sizeof($osallistujat) === 0) {
                echo '<div>Ei löytynyt</div>';
                return;
            }


            echo '<div class="border rounded table-responsive table-body" style="padding: 1rem;">';
            
            if (sizeof($osallistujat) === 1) {
                echo '<table class="table table-borderless">';
            } else {
                echo '<table class="table">';
            }

            echo '<tbody>';

            echo '<thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nimi</th>
                        <th scope="col">Seura</th>
                        <th scope="col">Jarjestysnumero</th>
                        <th scope="col"></th>
                    </tr>
                </thead>';

            foreach ($osallistujat as $osallistuja) {
                $user = User::getUserById($osallistuja['userId']);
                $seura = Seura::seuraNimi($user['seuraId']);
                echo '<tr>';
                echo '<td>' . $osallistuja['id'] . '</td>';
                echo '<td>' . $user['etunimi'] . ' ' . $user['sukunimi'] . '</td>';
                echo '<td>' . $seura . '</td>';
                echo '<td>' . $osallistuja['jarjestysNumero'] . '</td>';
                echo '<td>' . '<a href="poista_osallistuja.php?id='. $osallistuja['id'] . '" class="btn btn-danger">Poista</a>' . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
            echo '</div>';
        ?>
       </div>
     </div>
   </div>
</section>

<?php
     include_once './sovellus_footer.php';
?>