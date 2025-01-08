/**
*   koda v datotekah je bila namenoma okvarjena do mere, da ni uporabna; 
*   cilj:
*        razhroščiti, preveriti, spraviti v produkcijo
*/

<!-- index.php -->
<?php
   /**
      index.php
   */
   
   /* include_once('funkcije.php');*/
   /* alineja 2 : 4t 
      alineja 3 : 6t
      alineja 5 : 2t
   */
   $tab=[]; $tab=en_kod($tab);
   if ( isset($_GET['tab'])) $_GET['tab'];
?>

<form action="./prikazi.php?vstop=1&tab=<?php echo $tab; ?>">  <!-- 4. vrstica besedila: action -->
  <input type="text" name="ime"  minlength="2"/><br />
  <input type="text" name="pri"  minlength="2"/><br />
  <input type="number" name="ids"  maxlength="12" minlength="12"/><br />

  <input type="submit"  value="Uveljavi"/>
</form>  


Meni:
<ul>
  <li> <a href="./prikazi.php?vstop=1&tab=<?php echo $tab; ?>">Prikazi</a> </li>
  <li> <a href="./statistika.php?vstop=1&tab=<?php echo $tab; ?>">Statistika</a> </li>
</ul>

<!--    konec index.php -->


<!-- prikazi.php -->
<?php
 /** prikazi.php */
 /*
    alineja 3 : 6t
    alineja 5 : 1t
    alineja 6 : 6t
 */

 /* include_once('funkcije.php'); */
 $st=""; $tab=[];
 if ( !isset($_GET['vstop']) || $_GET['vstop']!=1 ){              // zavrni dostop alineja5: 1t
    if ( isset($_GET['tab']) ) { $st = '?tab='.$_GET['tab']; $tab=de_kod($_GET['tab']);}
     header('location:./index.php'.$st);  
 }


 /* pišmeuhovstvo : 
            - urejanje zgolj znotraj skripte, ids ali karkoli drugega
            - urejanje ali dodajanje novega zapisa */
 if ( isset($_GET['uredi']) ) {                                
   if ( $_GET['uredi']=='ids' ) 
        uasort($tab,'komp_ids');         // alineja 6 : 2t    /(u+a,komp)
      else 
         uasort($tab,'komp_pri');        // alineja 6 : 2t
  }  
   else { 

    /* dodajanje */
    $ime="";$pri="";$ids=0;
    if ( isset($_GET['ime']) ) $ime=$_GET['ime'];                   //  alineja 3 : 6t
    if ( isset($_GET['pri']) ) $pri=$_GET['pri'];
    if ( isset($_GET['ids']) ) $ids=$_GET['ids'];

    if (mb_strlen($ime)<2 || mb_strlen($pri)<2 || mb_strlen($ids)!=12)
        header('location:./index.php'.$st);

    /* doda osebo v tabelo tab, če v tabeli novi ids še ne obstaja  */    
    if ( !isset($tab[$ids]) ){
        $tab[$ids]=['ime'=>$ime,'pri'=>$pri,'ids'=>$ids];
    }
 
 $st = '?vstop=1&tab='.en_kod($tab);

/* vizualizacija  s povezavama za sortiraje*/                                  // 2t - 1t
  echo '<table>';
  echo '<tr>'.'<td><a href="">ime</a></td>
               <td><a href="'.$st.'&uredi=pri'.'">pri</a></td>
               <td><a href="'.$st.'&uredi=ids'.'">ids</a></td>'.'</tr>';
  foreach($tab as $inde=>$oseba)
    echo '<tr>'.'<td>'.$oseba['ime'].'</td><td>'.$oseba['pri'].'</td><td>'.$oseba['ids'].'</td>'.'</tr>';
  echo '</table>';

 
 ?>


 
<ul>
  <li> <a href="./index.php<?php echo $st; ?>">Index-vnos</a> </li>
</ul>
 

<!--    statistika.php   -->
<?php
 /** statistika.php */
 /*
    alineja 5 : 1t
    alineja 4 : 4t
 */

/*include_once('funkcije.php');*/
 
 $st="";
 if ( !isset($_GET['vstop']) || $_GET['vstop']!=1 ){              // zavrni dostop alineja5: 1t
    if ( isset($_GET['tab']) ) $st = '?$tab='.$_GET['tab'];
    header('location:./index.php'.$st);  
 }
  /* include_once('funkcije.php');*/
  $tab = de_kod($_GET['tab']);  //??popravi!

  /* logic: 'count' names */                           // 2t + 1t
  $t=[];
  foreach($tab as $el)
    if ( isset($t[$el['ime']]) ) $t[$el['ime']]++; else $t[$el['ime']]=1;

  /* vizualizacija */                                  // 2t - 1t
  echo '<table>';
  foreach($t as $pri=>$st)
    echo '<tr>'.'<td>'.$pri.'</td><td>'.$st.'</td>'.'</tr>';
  echo '</table>';

?>
<ul>
  <li> <a href="./index.php<?php echo $st; ?>">Index-vnos</a> </li>
</ul>

<!--    konec statistika.php -->



<!-- funkcije.php -->
<?php
 /**   funkcije.php
 */
function en_kod(array $t) :string{
  return base64_encode(json_encode($t));
}

function de_kod(string $t) :array{
  return json_decode(base64_decode($t),true);
}

function komp_pri($a,$b){                       // alineja 6 : 3t
    return str_cmp($a['pri'],$b['pri']);
}

function komp_ids($a,$b){
    // return $a['ids']-$b['ids'];
    return str_cmp($a['ids'],$b['ids']);      // lineja 6 : 3t
}



?>
