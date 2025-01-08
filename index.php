<?php
include_once('funkcije.php');

$tab = [];
if (isset($_GET['tab'])) {
    $tab = de_kod($_GET['tab']);
}
$encoded_tab = en_kod($tab);
?>

<form action="./prikazi.php" method="GET">
  <input type="hidden" name="vstop" value="1">
  <input type="hidden" name="tab" value="<?php echo $encoded_tab; ?>">
  <input type="text" name="ime" minlength="2"/><br />
  <input type="text" name="pri" minlength="2"/><br />
  <input type="number" name="ids" maxlength="12" minlength="12"/><br />
  <input type="submit" value="Uveljavi"/>
</form>  

Meni:
<ul>
  <li> <a href="./prikazi.php?vstop=1&tab=<?php echo $encoded_tab; ?>">Prikazi</a> </li>
  <li> <a href="./statistika.php?vstop=1&tab=<?php echo $encoded_tab; ?>">Statistika</a> </li>
</ul>