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
            <th>Tidak bisa</th>
            <th>Acara</th>
            <th>Humas</th>
            <th>Keamanan</th>
            <th>Konsumsi</th>
            <th>Logistik</th>
            <th>Publikasi</th>
            <th>Sponsorship</th>
        </tr>

    </thead>

    <tbody>
        <?php $i = 1 ?>
        <?php foreach ($schedule as $a) : ?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <?= $a['schedule']; ?>
                </td>
                <td><?= $a['is_fine']; ?></td>
                <td>
                    <?php foreach ($data_mhs as $m) :
                        if ($a['div_1'] == $m['id']) { ?>
                            <?= $m['name']; ?>
                    <?php }
                    endforeach; ?>
                </td>
                <td>
                    <?php foreach ($data_mhs as $m) :
                        if ($a['div_2'] == $m['id']) { ?>
                            <?= $m['name']; ?>
                    <?php }
                    endforeach; ?>
                </td>
                <td>
                    <?php foreach ($data_mhs as $m) :
                        if ($a['div_3'] == $m['id']) { ?>
                            <?= $m['name']; ?>
                    <?php }
                    endforeach; ?>
                </td>
                <td>
                    <?php foreach ($data_mhs as $m) :
                        if ($a['div_4'] == $m['id']) { ?>
                            <?= $m['name']; ?>
                    <?php }
                    endforeach; ?>
                </td>
                <td>
                    <?php foreach ($data_mhs as $m) :
                        if ($a['div_5'] == $m['id']) { ?>
                            <?= $m['name']; ?>
                    <?php }
                    endforeach; ?>
                </td>
                <td>
                    <?php foreach ($data_mhs as $m) :
                        if ($a['div_6'] == $m['id']) { ?>
                            <?= $m['name']; ?>
                    <?php }
                    endforeach; ?>
                </td>
                <td>
                    <?php foreach ($data_mhs as $m) :
                        if ($a['div_7'] == $m['id']) { ?>
                            <?= $m['name']; ?>
                    <?php }
                    endforeach; ?>
                </td>
            </tr>
            <?php $i = $i + 1 ?>
        <?php endforeach; ?>
    </tbody>
    </tbody>

</table>