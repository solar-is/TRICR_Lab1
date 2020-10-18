<?php

date_default_timezone_set('Europe/Moscow');
$currentTime = date("H:i:s");
$startTime = microtime(true);

$x = (float)$_GET['x'];
$y = (float)str_replace(",", ".", $_GET['y']);
$r = (float)$_GET['r'];

if (!isValid($x, $y, $r)) {
    http_response_code(400);
    return;
}

$isEntry = checkEntry($x, $y, $r);
$scriptTime = round(microtime(true) - $startTime, 9) * 1000000;

$result = array($x, $y, $r, $isEntry, $currentTime, $scriptTime);

if (isset($_COOKIE['entries'])) {
    $entries = unserialize($_COOKIE['entries']);
} else {
    $entries = array();
}
array_push($entries, $result);

setcookie('entries', serialize($entries), time() + (3600 * 24 * 7));

$tdEntry = $result[3] == 'true' ? '<td class="green-color">Входит</td>' : '<td class="red-color">Не входит</td>';

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

function isValid($x, $y, $r)
{
    return true;
    /*in_array($x, array(-4, -3, -2, -1, 0, 1, 2, 3, 4)) && is_numeric($y) && $y >= -5 && $y <= 5 && in_array($r, array(1, 1.5, 2, 2.5, 3));*/
}

