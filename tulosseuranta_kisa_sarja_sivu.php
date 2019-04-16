<?php
    include_once './header.php';
    require_once './classes/Osallistuminen.php';
    require_once './classes/Kisa.php';
    require_once './classes/Sarja.php';
	require_once './classes/haku.php';
    require_once './classes/haku.php';
    
	// header("refresh: 30;");
    
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
        <h2>Liveseuranta: 
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
						<th scope="col">Maali</th>
                        <th scope="col">Aika</th>
                    </tr>
                </thead>';
            // Taulukko sisalto alkaa tassa
            echo '<tbody>';
								
							$tiedot = haku::haeTiedot($kisa['id'],$sarja['id']);
							$tite=[];
							$tite2=[];
							$maali=[];
								
								
								$i=0; 
								$k=0;
								
								//Lasketaan aika
								foreach($tiedot as $result) {
									
									$tite2[$k]=$result;
									$maali[$k]=$result;
									
								
									$datetime1 = new DateTime($tite2[$k]['lahtoAika']);
									$datetime2 = new DateTime($tite2[$k]['loppuAika']);
									
									if ($tite2[$k]['loppuAika'] > $tite2[$k]['lahtoAika'])
									{
									$aika = $datetime1->diff($datetime2);
									$tite2[$k]['loppuAika']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									
									}
									
									$datetime2 = new DateTime($tite2[$k]['valiAika1']);
									
									if ($tite2[$k]['valiAika1'] > $tite2[$k]['lahtoAika'])
									{
									$aika = $datetime1->diff($datetime2);
									$tite2[$k]['valiAika1']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									$tite2[$k]['loppuAika']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									}
									
									else
									{	
										$tite2[$k]['valiAika1']='---';
									}
									
									$datetime2 = new DateTime($tite2[$k]['valiAika2']);
									
									if ($tite2[$k]['valiAika2'] > $tite2[$k]['lahtoAika'])
									{
									$aika = $datetime1->diff($datetime2);
									$tite2[$k]['valiAika2']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									$tite2[$k]['loppuAika']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									}
									
									else
									{	
										$tite2[$k]['valiAika2']='---';
									}
									
									$datetime1 = new DateTime($maali[$k]['lahtoAika']);
									$datetime2 = new DateTime($maali[$k]['loppuAika']);
									
									if ($maali[$k]['loppuAika'] > $maali[$k]['lahtoAika'])
									{	
									$aika = $datetime1->diff($datetime2);
									$maali[$k]['loppuAika']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									$tite2[$k]['loppuAika']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									}
									
									else
									{	
										$maali[$k]['loppuAika']='---';
									}
									
									$k++;
								
								}
								
								
								
								
					
								//täytetään taulu
								foreach($tite2 as $result) 
								{
									$tite=$result;
	
									echo '<tr>';
									echo '<td>'.$result['jarjestysNumero'].'</td>';
									
								
									//haetaan nimi
									$nimi = haku::haeNimi($result['userId']);
									echo '<td > '. utf8_encode ($nimi['etunimi']) .' '.utf8_encode ($nimi['sukunimi']). ' </td>';
									
									//haetaan seura
									$seuraid = haku::haeSeuraid($result['userId']);
									$seura = haku::haeSeura($seuraid['seuraId']);
									echo '<td>'. utf8_encode ($seura['nimi']). '</td>';
									
								
									echo '<td>'.  $result['lahtoAika'] . '</td>';
									echo '<td>'.  $result['valiAika1'] . '</td>';
									echo '<td>'.  $result['valiAika2'] . '</td>';
									echo '<td>'.  $maali[$i]['loppuAika'] . '</td>';
									echo '<td>'.  $result['loppuAika'] . '</td>';
									echo '</tr>';
									$i++;
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
</section>

<?php
     include_once './footer.php';
?>
