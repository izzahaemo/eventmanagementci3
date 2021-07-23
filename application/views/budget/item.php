<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('budget/item'); ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>

    <!--Main Content -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="rab" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
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
                    <tfoot>
                        <tr>
                            <th>ID</th>
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
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($item as $a) : ?>
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
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->