<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=RAB Event " . $event['nama'] . ".xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

    <thead>

        <tr>
            <th>No</th>
            <th>Lokasi</th>
            <th>Item Kategori</th>
            <th>Divisi</th>
            <th>Item</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Total Harga</th>
            <th>value</th>
        </tr>

    </thead>

    <tbody>
        <?php $i = 1 ?>
        <?php foreach ($rab as $a) : ?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <?php if ($a['in_or_outdoor'] == 0) { ?>
                        Outdoor
                    <?php } elseif ($a['in_or_outdoor'] == 1) { ?>
                        Indoor
                    <?php } elseif ($a['in_or_outdoor'] == 2) { ?>
                        In / Outdoor
                    <?php } ?>
                </td>
                <td><?= $a['item_kategori'] ?></td>
                <td>
                    <?php foreach ($divisi as $d) :
                        if ($d['id'] == $a['divisi']) { ?>
                            <?= $d['nama'] ?>
                    <?php }
                    endforeach; ?>
                </td>
                <td><?= $a['item'] ?></td>
                <td><?= $a['jumlah'] ?></td>
                <td><?= $a['satuan'] ?></td>
                <td>
                    <?php $hasil_r = "Rp " . number_format($a['harga'], 2, ',', '.'); ?>
                    <?= $hasil_r ?>
                </td>
                <td>
                    <?php $hasil_r = "Rp " . number_format($a['total_harga'], 2, ',', '.'); ?>
                    <?= $hasil_r ?>
                </td>
                <td><?= $a['value'] ?></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
    </tbody>
    </tbody>

</table>