<?php
include_once('funkcije.php');

$st = "";
$tab = [];
if (!isset($_GET['vstop']) || $_GET['vstop'] != 1) {
    if (isset($_GET['tab'])) {
        $st = '?tab=' . $_GET['tab'];
        $tab = de_kod($_GET['tab']);
    }
    header('location:./index.php' . $st);
    exit();
}

if (isset($_GET['uredi'])) {
    if ($_GET['uredi'] == 'ids') {
        uasort($tab, 'komp_ids');
    } else {
        uasort($tab, 'komp_pri');
    }
} else {
    $ime = $_GET['ime'] ?? "";
    $pri = $_GET['pri'] ?? "";
    $ids = $_GET['ids'] ?? "";

    if (mb_strlen($ime) >= 2 && mb_strlen($pri) >= 2 && mb_strlen($ids) == 12) {
        if (!isset($tab[$ids])) {
            $tab[$ids] = ['ime' => $ime, 'pri' => $pri, 'ids' => $ids];
        }
    }
}

$st = '?vstop=1&tab=' . en_kod($tab);

echo '<table>';
echo '<tr>' . '<td><a href="' . $st . '&uredi=ime">ime</a></td>
               <td><a href="' . $st . '&uredi=pri">pri</a></td>
               <td><a href="' . $st . '&uredi=ids">ids</a></td>' . '</tr>';
foreach ($tab as $inde => $oseba) {
    echo '<tr>' . '<td>' . $oseba['ime'] . '</td><td>' . $oseba['pri'] . '</td><td>' . $oseba['ids'] . '</td>' . '</tr>';
}
echo '</table>';
?>

<ul>
  <li> <a href="./index.php<?php echo $st; ?>">Index-vnos</a> </li>
</ul>