<?php
    include_once './header.php';
    require_once './classes/Osallistuminen.php';
    require_once './classes/Kisa.php';
    require_once './classes/Sarja.php';
    
?>    
  
    <section id="tiedot">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
			 <?php 
			 
			//päivämäärä 
			$pvm = date("Y-m-d");  //pvm tänään
			//$pvm = date("2019-04-29"); //esimerkki1
			// $pvm = date("2019-05-05"); //esimerrki2
			//$pvm = date("2019-08-05"); //esimerrki3
			 ?>
		
          <h2>Kisat  <?php echo $pvm ?> </h2>
		  
		   <?php
				//haetaan kisat
                $kisat = Kisa::kaikkiKisat();
				$i=0;
				$j=0;
				  
				foreach ($kisat as $kisa)
				{
				$i++; 
				$j++; 
				
				//tämän päivän kisat
				if ($pvm == $kisa['date'])
				{
					
                //ruutu + tiedot
                echo '<div class="border rounded table-responsive table-body" style="padding: 1rem;">';
                echo '<h4>' . utf8_encode ($kisa['nimi']).'   '.$kisa['date'].'   '.$kisa['aika'] .  '</h4><br>';
				
				echo '<td>' . '<a href="tulosseuranta_kisa_sivu.php?kisa_id='. $kisa['id'] . '" class="btn btn-primary">Liveseuranta (kaikki sarjat)</a>' .'</td>';
				echo "\t";
				echo '<td>' .'<a href="Tulokset.php?kisa_id='. $kisa['id'] . '" class="btn btn-primary">Tulokset (kaikki sarjat)</a>' . '</td>';
				$kisanSarjat = Sarja::sarjat($kisa['id']);
                    if ($kisanSarjat) {
                        echo '<p><strong>Sarjat:</strong></p>';
                        echo '<table class="table"><tbody>';
                        foreach ($kisanSarjat as $sarja) {
                            echo '<tr>';
                            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                              echo '<td>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
                              echo '<td>' . '<a href="tulosseuranta_kisa_sarja_sivu.php?kisa_id='. $kisa['id'] .'&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Liveseuranta</a>' ."\t".'<a href="TuloksetSarja.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] .'" class="btn btn-primary">Tulokset</a>' . "\t" . '<a href="lahtolista_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Lahtolista</a></td>';
                            } else {
                                echo '<td>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</td>';
                                echo '<td>' . '<a href="tulosseuranta_kisa_sarja_sivu.php?kisa_id='. $kisa['id'] .'&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Liveseuranta</a>' ."\t".'<a href="TuloksetSarja.php?kisa_id='. $kisa['id'] .'&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Tulokset</a>' . "\t" . '<a href="lahtolista_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Lahtolista</a></td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody></table>';
                    } else {
                        echo '<div><br>Sarjoja ei ole vielä lisätty</div>';
                    }
                echo '</div><br>';
				$i=0;
					
                }
				  
				}
				  
				if ($i==$j) 
				{
					   echo 'Tänään ei ole kilpailuja.';
				}
               
			?>
			
			<br><br>
			
			<h3> Tulevat kilpailut: </h3>
			<?php
				
                $kisat = Kisa::kaikkiKisat();
				$i=0;
				$j=0;
				  
				foreach ($kisat as $kisa)
				{
				$i++; 
				$j++; 
				
				//tulevat kisat luokkineen, jos luokat lisätty
				if ($pvm < $kisa['date'])
				{
				//ruutu + tiedot 
                echo '<div class="border rounded table-responsive table-body" style="padding: 1rem;">';
                echo '<h4>' . utf8_encode ($kisa['nimi']) .'   '.$kisa['date'].'   '.$kisa['aika'] . ' </h4><br>';
				$kisanSarjat = Sarja::sarjat($kisa['id']);
                    if ($kisanSarjat) {
                        echo '<p><strong>Sarjat:</strong></p>';
                        echo '<table class="table"><tbody>';
                        foreach ($kisanSarjat as $sarja) {
                            echo '<tr>';
                            if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                              echo '<td>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . ' ' . '<a href="lahtolista_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Lahtolista</a></td>';
                              
                            } else {
                                echo '<td>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . ' ' . '<a href="lahtolista_sivu.php?kisa_id='. $kisa['id'] . '&sarja_id=' . $sarja['id'] . '" class="btn btn-primary">Lahtolista</a></td>';
                                
                            }
                            echo '</tr>';
                        }
                        echo '</tbody></table>';
                    } else {
                        echo 'Sarjoja ei ole vielä lisätty';
                    }
                echo '</div><br>';
				$i=0;
					
                }
				  
				}
				  
				if ($i==$j) 
				{
					   echo 'Ei tulevia kilpailuja.';
				}
               
			?>
			
			<br><br>
			<h4> Menneet kilpailut: </h4>
			<?php
		   
                $kisat = Kisa::kaikkiKisat();
				$i=0;
				$j=0;
				  
				foreach ($kisat as $kisa)
				{
					$i++; 
					$j++; 
				
					//menneet kisat ja niiden tulokset
					if ($pvm > $kisa['date'])
					{
						//ruutu + tiedot 
						echo '<div class="border rounded table-responsive table-body" style="padding: 1rem;">';
						echo '<h4>' . utf8_encode ($kisa['nimi']) .'   '.$kisa['date'].'   '.$kisa['aika'] . ' ' . '<a href="Tulokset.php?kisa_id='. $kisa['id'] . '" class="btn btn-primary">Tulokset</a>' . '</h4><br>';
						echo '</div><br>';
						$i=0;
					
					}
				  
				}
				  
				if ($i==$j) 
				{
					   echo 'Ei vanhoja kilpailuja.';
				}
               
			?>
          
         
        </div>
      </div>
    </div>
  </section>
    

	<?php
    include_once './footer.php';
?>
