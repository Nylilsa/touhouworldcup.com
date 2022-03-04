<?php
    $title = _('Schedule');
    $description = 'Order and time at which Touhou World Cup matches will happen';
    $keywords = 'touhou, touhou project, 東方, 东方, Тохо, world cup, touhou world cup, twc, 2022 competition, scoring, survival, tournament, schedule, timetable';
    include_once 'php/locale.php';
    include_once 'php/head.php';
?>

<body>
	<?php include_once 'php/body.php' ?>
	<main>
	<h1><?php echo _('Schedule') ?></h1>
    <p><?php echo _('Your time zone was detected as <strong id="timezone">UTC+0000 (Coordinated Universal Time)</strong>.') ?></p>
    <p><?php
        if ($lang == 'en_GB' || $lang == 'en_US' || $lang == 'de_DE') {
            echo _('Daylight Saving Time (also known as Summer Time or DST) is taken into account automatically.');
        }
    ?></p>
    <table id="schedule_table">
        <thead>
            <tr>
                <th rowspan='3'><?php echo _('Date / Time') ?></th>
                <th rowspan='3'><?php echo _('Category') ?></th>
                <th rowspan='3'><?php echo _('Players') ?></th>
                <th rowspan='3'><?php echo _('Reset Time<br>(minutes)') ?></th>
            </tr>
        </thead>
        <tbody id="schedule_tbody">
        <noscript><?php
            $json = file_get_contents('schedule.json');
            $schedule = json_decode($json, true);
            $highlight = false;
            foreach ($schedule as $key => $match) {
                if (!$highlight && $key >= time()) {
                    echo '<tr class="highlight">';
                    $highlight = true;
                } else {
                    echo '<tr>';
                }
                echo '<td>' . gmdate(get_date_format($lang), $key) . '</td>';
                echo '<td class="' . preg_split('/ /', $match['category'])[0] . '">' . $match['category'] . '</td>';
                echo '<td>' . implode('<br>', $match['players']) . '</td>';
                echo '<td>' . ($match['reset'] === 0 ? 'N/A' : $match['reset']) . '</td>';
                echo '</tr>';

            }
        ?></noscript>
        </tbody>
    </table>
	</main>
    <script src="/js/schedule.js" defer></script>
</body>
</html>
