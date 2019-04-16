<?php
    include_once './header.php';
    require_once './classes/Osallistuminen.php';
    require_once './classes/Kisa.php';
    require_once './classes/Sarja.php';
    require_once './classes/haku.php';
	
	$i=0;
	$j=0;
     
    if (!isset($_GET['kisa_id'])) {
        echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa tai sarja id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
        return;
    }
    $kisa = Kisa::haeKisa($_GET['kisa_id']);
    if (!isset($kisa)) {
        echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>Kisa ei ole olemassa</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
        return;
    }
	
	
?>
<section>
	
   <div class="container">
     <div class="row">
       <div class="col-lg-12 mx-auto">
        <a class="btn btn-primary" href="tulosseuranta.php"> < Takaisin </a>
        <br><br>
        <h2 >Tulokset: <?php echo $kisa['nimi'] .' '. $kisa['date'] .' '. $kisa['aika']; ?> </h2>
		
		<?php
		
		 echo '<div class=" rounded table-responsive table-body" style="padding: 1rem; " Content-Type:" text/html; charset=UTF-8">';
               
				$kisanSarjat = Sarja::sarjat($kisa['id']);
                    if ($kisanSarjat) {
                        echo '<p><strong>Sarjat:</strong></p>';
                       
                        foreach ($kisanSarjat as $sarja) {
                            echo '<tr>';
							
							$tiedot = haku::haeTiedot($kisa['id'],$sarja['id']);
							$tite=[];
							$tite2=[];
							
                            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) 
							{
								
								
								echo '<td>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
							  
								// Taulukko alkaa tassa
								echo '<table class="table">';
								// Sarakkeet
								echo '<thead>
								
								<tr>
								<th scope="col">Sija</th>
								<th scope="col">Osallistuja</th>
								<th scope="col">Seura</th>
								<th scope="col">Aika</th>
								
								</tr>
								</thead>';
								
								// Taulukko sisalto alkaa tassa
								echo '<tbody>';
								
								// Uusi rivi, for loopin sisalle
								
								$i=1; //kilpailun sijoitus
								$k=0;
								
								//Lasketaan aika
								foreach($tiedot as $result) {
									
									$tite2[$k]=$result;
									$datetime1 = new DateTime($tite2[$k]['lahtoAika']);
									$datetime2 = new DateTime($tite2[$k]['loppuAika']);
									if ($tite2[$k]['loppuAika'] > $tite2[$k]['lahtoAika'])
									{
									$aika = $datetime1->diff($datetime2);
									$tite2[$k]['loppuAika']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									
									}
									
								
									
									else
									{	
										if ($tite2[$k]['loppuAika'] == $tite2[$k]['lahtoAika'])
										{
										
										$tite2[$k]['loppuAika']='Aikaa ei saatavilla';
									
										}
										else
										{
										$tite2[$k]['loppuAika']='Aikaa ei saatavilla';
										}
									}
									$k++;
								
					
								}

								//järjestää ajan mukaan
								for ($k2=0; $k2<$k; $k2++)
								{
								
									if ($k2!=0 && $tite2[$k2]['loppuAika'] < $tite2[$k2-1]['loppuAika'] )
									{
										$v=$tite2[$k2-1];
										$tite2[$k2-1]=$tite2[$k2];
										$tite2[$k2]=$v;
										$k2=0;
										
									}
									
								}

								//täytetään taulu
								foreach($tite2 as $result) 
								{
									$tite=$result;
									
									echo '<tr>';
									echo '<td>'.$i.'</td>';
									$i++;
								
									//haetaan nimi
									$nimi = haku::haeNimi($result['userId']);
									echo '<td > '. $nimi['etunimi'] .' '. $nimi['sukunimi']. ' </td>';
									
									//haetaan seura
									$seuraid = haku::haeSeuraid($result['userId']);
									$seura = haku::haeSeura($seuraid['seuraId']);
									echo '<td>'. $seura['nimi'] . '</td>';
									
									echo '<td>'.  $result['loppuAika'] . '</td>';
									echo '</tr>';
								
								}
										
								// Taulukko sisalto loppuu tassa
								
								echo '</tbody>';
								
								// Taulukko loppuu tassa
								echo '</table>';
                              
                            } else {
                                echo '<td>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] .' '.  $sarja['id'] .'</td>';
								
								// Taulukko alkaa tassa
								echo '<table class="table">';
								// Sarakkeet
								echo '<thead>
								
								<tr>
								<th scope="col">Sija</th>
								<th scope="col">Osallistuja</th>
								<th scope="col">Seura</th>
								<th scope="col">Aika</th>
								</tr>
								</thead>';
								
								// Taulukko sisalto alkaa tassa
								echo '<tbody>';
								
								// Uusi rivi, for loopin sisalle
								
								$i=1; //sijoitukset
								$k=0;
								
								//Lasketaan aika
								foreach($tiedot as $result) {
									
									$tite2[$k]=$result;
									$datetime1 = new DateTime($tite2[$k]['lahtoAika']);
									$datetime2 = new DateTime($tite2[$k]['loppuAika']);
									if ($tite2[$k]['loppuAika'] > $tite2[$k]['lahtoAika'])
									{
									$aika = $datetime1->diff($datetime2);
									$tite2[$k]['loppuAika']=$aika->format('%H').':'.$aika->format('%I').':'.$aika->format('%S');
									
									}
									
									
									else
									{	
										if ($tite2[$k]['loppuAika'] == $tite2[$k]['lahtoAika'])
										{
										
										$tite2[$k]['loppuAika']='Aikaa ei saatavilla';
									
										}
										else
										{
										$tite2[$k]['loppuAika']='Aikaa ei saatavilla';
										}
									}
									$k++;
								
					
								}
								
								
								//järjestää ajan mukaan
								for ($k2=0; $k2<$k; $k2++)
								{
								
									if ($k2!=0 && $tite2[$k2]['loppuAika'] < $tite2[$k2-1]['loppuAika'] )
									{
										$v=$tite2[$k2-1];
										$tite2[$k2-1]=$tite2[$k2];
										$tite2[$k2]=$v;
										$k2=0;
										
									}
									
								}
								
					
								//täytetään taulu
								foreach($tite2 as $result) 
								{
									$tite=$result;
									
									
									echo '<tr>';
									echo '<td>'.$i.'</td>';
									$i++;
								
									//haetaan nimi
									$nimi = haku::haeNimi($result['userId']);
									echo '<td> '. $nimi['etunimi'] .' '.$nimi['sukunimi']. ' </td>';
									
									
									//haetaan seura
									$seuraid = haku::haeSeuraid($result['userId']);
									$seura = haku::haeSeura($seuraid['seuraId']);
									echo '<td>'. $seura['nimi']. '</td>';
									
									echo '<td>'.  $result['loppuAika'] . '</td>';
									echo '</tr>';
								
								}
								
	
								// Taulukko sisalto loppuu tassa
								echo '</tbody>';
								
								
								// Taulukko loppuu tassa
								echo '</table>';
                                
                            }
                            echo '</tr>';
                        }
                        echo '</tbody></table>';
                    } else {
                        echo 'Sarjoja ei ole vielä lisätty';
                    }
                echo '</div><br>';
				?>
		<br><br>
       </div>
     </div>
   </div>
</section>
<?php
     include_once './footer.php';
?>