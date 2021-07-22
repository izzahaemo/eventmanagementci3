<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=Data Mahasiswa " . $event['nama'] . ".xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

    <thead>

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Divisi</th>
        </tr>

    </thead>

    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($mhs as $a) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $a['name']; ?></td>
                <td>
                    <?php
                    $handphone = $a['no_telp'];
                    // menghitung jumlah digit nomor handphone tanpa kode negara (+62)
                    $jumlah_digit_handphone = strlen($handphone);
                    // nomor handphone yang ditampilkan jika berjumlah 9 digit
                    if ($jumlah_digit_handphone == 9) {
                        $tampil_handphone = "+62 " . substr($handphone, 0, 3) . "-" . substr($handphone, 3, 3) . "-" . substr($handphone, 6, 3);
                    }
                    // nomor handphone yang ditampilkan jika berjumlah 10 digit
                    if ($jumlah_digit_handphone == 10) {
                        $tampil_handphone = "+62 " . substr($handphone, 3, 3) . "-" . substr($handphone, 6, 4) . "-" . substr($handphone, 10, 3);
                    }
                    // nomor handphone yang ditampilkan jika berjumlah 11 digit
                    if ($jumlah_digit_handphone == 11) {
                        $tampil_handphone = "+62 " . substr($handphone, 0, 3) . "-" . substr($handphone, 3, 4) . "-" . substr($handphone, 7, 3);
                    }
                    // nomor handphone yang ditampilkan jika berjumlah 12 digit
                    if ($jumlah_digit_handphone == 12) {
                        $tampil_handphone = "+62 " . substr($handphone, 3, 3) . "-" . substr($handphone, 6, 4) . "-" . substr($handphone, 10, 5);
                    }
                    if ($jumlah_digit_handphone < 9) {
                        $tampil_handphone = $handphone;
                    }
                    if ($jumlah_digit_handphone > 12) {
                        $tampil_handphone = $handphone;
                    }
                    ?>
                    <?= $tampil_handphone ?>
                </td>
                <td><?= $a['nama']; ?></td>
            </tr>
            <?php $i = $i + 1; ?>
        <?php endforeach; ?>
    </tbody>

</table>