<?php

date_default_timezone_set('Europe/Moscow');
$currentTime = date("H:i:s");
$startTime = microtime(true);

$x = (float)$_POST['x'];
$yStr = substr($_POST['yStr'], 0, 45);
$y = $_POST['yVal'];
$r = (float)$_POST['r'];

if ($y < -5 || $y > 5) {
    http_response_code(400);
    return;
}

$isEntry = checkEntry($x, $y, $r);
$scriptTime = round(microtime(true) - $startTime, 9) * 1000000;

$result = array($x, $yStr, $r, $isEntry, $currentTime, $scriptTime);

if (isset($_COOKIE['entries'])) {
    $entries = unserialize($_COOKIE['entries']);
} else {
    $entries = array();
}
array_push($entries, $result);

setcookie('entries', serialize($entries), time() + (3600 * 24 * 7));

$tdEntry = $result[3] == 'true' ? '<td class="in">Попадает</td>' : '<td class="out">Не попадает</td>';

$response = "<tr>
        <td>$result[0]</td>
        <td>$result[1]</td>
        <td>$result[2]</td>
        $tdEntry
        <td>$result[4]</td>
        <td>$result[5]</td>
    </tr>";

echo $response;

function checkEntry($x, $y, $r)
{
    if (($y <= $x + $r / 2 && $x <= 0 && $y >= 0) || ($y <= 0 && $y >= -$r && $x >= 0 && $x <= $r / 2)
        || ($x <= 0 && $y <= 0 && $x >= -sqrt($r * $r - $y * $y))) {
        return 'true';
    } else {
        return 'false';
    }
}