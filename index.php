<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/src/favicon.ico" type="image/x-icon">
    <title>Lab 1</title>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css" />
</head>
<body>
    <table class="wrapper">
        <tr class="header">
            <td class="students">P33211 Просолович М.А. Тайц Ю.М.</td>
            <td class="variant">Вариант 1034</td>
        </tr>
        <tr class="content">
            <td colspan="2">
                <h1>Лабораторная работа №1</h1>
                <div class="content-wrapper">
                    <div class="area">
                        <img src="src/area.png" alt="area">
                    </div>

                    <form class="selection" method="post">
                        <div class="x-select">
                            <label class="selection-label">Выберите X
                                <span class="warning" data-validate="Выберите хотя бы 1 значение"></span>
                            </label>
                            <?php for ($i = -4; $i <= 4; $i+=1) {?>
                                <input class="inp-cbx-x" id="x<?=$i?>" type="checkbox" name="x" value="<?=$i/2?>">
                                <label class="cbx-x" for="x<?=$i?>">
                                    <span><?=$i/2?></span>
                                </label>
                            <?php } ?>
                        </div>
                        <div class="y-select">
                            <label class="selection-label" for="Y-select">Выберите Y
                                <span class="warning" data-validate="Y - значение в диапазоне (-5; 5)"></span>
                            </label>
                            <input id="Y-select" type="text" placeholder="-5...5" name="y" autocomplete="off">
                        </div>
                        <div class="r-select">
                            <label class="selection-label">Выберите R
                                <span class="warning" data-validate="Выберите хотя бы 1 значение"></span>
                            </label>
                            <?php for ($i = 1; $i <= 5; $i++) {?>
                            <input class="inp-cbx-r" id="r<?=$i?>" type="checkbox" name="r" value="<?=$i?>">
                            <label class="cbx-r" for="r<?=$i?>">
                                <span><?=$i?></span>
                            </label>
                            <?php } ?>
                        </div>
                        <input class="btn-submit" type="submit" value="Проверить">
                        <div class="clear-cookie">Очистить таблицу</div>
                    </form>

                    <table class="results">
                        <tr>
                            <th>X</th>
                            <th>Y</th>
                            <th>R</th>
                            <th>Попадание</th>
                            <th>Текущее время</th>
                            <th>Время работы скрипта, мкс</th>
                        </tr>
                        <?php
                        if (isset($_COOKIE['entries'])) {
                            $entries = unserialize($_COOKIE['entries']);
                            foreach ($entries as $entry) {
                                $isInside = $entry[3] == 'true' ? '<td class="in">Попадает</td>' : '<td class="out">Не попадает</td>';?>
                                <tr>
                                    <td><?= $entry[0] ?></td>
                                    <td><?= $entry[1] ?></td>
                                    <td><?= $entry[2] ?></td>
                                    <?= $isInside ?>
                                    <td><?= $entry[4] ?></td>
                                    <td><?= $entry[5] ?></td>
                                </tr>
                            <?php }} ?>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="src/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
</body>
</html>