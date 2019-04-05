<?php
  require_once './onko_tavallinen_kayttaja.php';
  include_once './sovellus_header.php';
  include_once '../classes/Kisa.php';
  include_once '../classes/Sarja.php';

  if (!isset($_GET['id'])) {
      echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa id parametri puuttuu</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
      return;
    }

  $kisa = Kisa::haeKisa($_GET['id']);

  if ($kisa == null){
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>kisa ei löydetty</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    return;
  }

  $ika = $_SESSION['user']['syntymaAika'];
  $date = new DateTime($ika);
  $now = new DateTime();
  $interval = $now->diff($date);
  $ika = (int)$interval->y;

  $sarja = Sarja::haeSopivaSarja($kisa['id'], $ika, $_SESSION['user']['sukupuoli']);

  if ($sarja == null){
    echo '<div style="margin-top: 120px; text-align: center;"><h1>Error:</h1> <p>ei löydetty sopivaa sarjaa</p><br> <a class="btn btn-primary" href="../sovellus"> < Takaisin</a><br><br></div>';
    return;
  }

 ?>

 <section >
   <div class="container">
     <div class="row">
       <div class="col-lg-8 mx-auto">
         <h2>Ilmoittaudu kilpailuun</h2>
         <form method="post" action="tallenna_ilmoittautuminen.php">
         <ul class="list-group">
           <li class="list-group-item"><?php echo $kisa['nimi'] .'   '.$kisa['date'].'   '.$kisa['aika']; ?></li>
           <li class="list-group-item">
             <?php
             if ($sarja['sukupuoli'] === Sarja::$SUKUPUOLI_MIES) {
                 echo '<div>POJAT/MIEHET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</div>';
             } else {
                 echo '<div>TYTÖT/NAISET ' .  $sarja['min_ika'] . '-' . $sarja['max_ika'] . '</div>';
             }
              ?>
           </li>
           <li class="list-group-item">Morbi leo risus</li>
           <li class="list-group-item">Porta ac consectetur ac</li>
           <li class="list-group-item">Vestibulum at eros</li>
         </ul>
         <input type="hidden" name="kisa_Id" value="<?php echo $kisa['id']; ?>">
         <input type="hidden" name="sarja_Id" value="<?php echo $sarja['id']; ?>">
         <input type="hidden" name="user_Id" value="<?php echo $_SESSION['user']['id']; ?>">
         <input type="submit" class="btn btn-primary" value="Submit" />
       </form>
       </div>
     </div>
   </div>
 </section>

 <?php
     include_once './sovellus_footer.php';
 ?>
