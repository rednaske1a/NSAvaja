<?php
function en_kod(array $t): string {
    return base64_encode(json_encode($t));
}

function de_kod(string $t): array {
    return json_decode(base64_decode($t), true);
}

function komp_pri($a, $b) {
    return strcmp($a['pri'], $b['pri']);
}

function komp_ids($a, $b) {
    return strcmp($a['ids'], $b['ids']);
}
?>