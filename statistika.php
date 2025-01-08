<?php
include_once('funkcije.php');

$st = "";
if (!isset($_GET['vstop']) || $_GET['vstop'] != 1) {
    if (isset($_GET['tab'])) $st = '?tab=' . $_GET['tab'];
    header('location:./index.php' . $st);
    exit();
}

$tab = de_kod($_GET['tab']);

$t = [];
foreach ($tab as $el) {
    if (isset($t[$el['ime']])) {
        $t[$el['ime']]++;
    } else {
        $t[$el['ime']] = 1;
    }
}

echo '<table>';
foreach ($t as $pri => $st) {
    echo '<tr>' . '<td>' . $pri . '</td><td>' . $st . '</td>' . '</tr>';
}
echo '</table>';
?>

<ul>
  <li> <a href="./index.php<?php echo $st; ?>">Index-vnos</a> </li>
</ul>