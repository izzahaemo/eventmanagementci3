<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=Data Schedule Event " . $event['nama'] . ".xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

    <thead>

        <tr>
            <th>No</th>
            <th>Schedule</th>
            <th>Mulai</th>
            <th>Selesai</th>
        </tr>

    </thead>

    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($schedule as $s) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $s['schedule']; ?></td>
                <td><?= date("H:i", strtotime($s['mulai'])); ?></td>
                <td><?= date("H:i", strtotime($s['selesai'])); ?></td>
            </tr>
            <?php $i = $i + 1; ?>
        <?php endforeach; ?>
    </tbody>

</table>