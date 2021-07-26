<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('budget/view/') . $url; ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>



    <!--Main Content -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Budget Event</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $hasil_r = "Rp " . number_format($event['budget'], 2, ',', '.'); ?>
                                <?= $hasil_r ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $x = 1;
        foreach ($divisi as $d) :
            $i = 0;
            foreach ($rab as $r) :
                if ($d['id'] == $r['divisi']) {
                    $i = $i + $r['total_harga'];
                }
            endforeach;
            $bu = 0;
            foreach ($budget as $b) :
                if ($d['id'] == $b['idd']) {
                    $bu = $b['budget'];
                }
            endforeach;
        ?>
            <?php $hasil_r = "Rp " . number_format($i, 2, ',', '.');
            $hasil_b = "Rp " . number_format($bu, 2, ',', '.');
            ?>
            <div class="col-md-3 mb-4">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">

                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Budget <?= $d['nama'] ?></div>
                            <div class="mb-0 font-weight-bold text-gray-800">
                                <p class="h5 font-weight-bold"><?= $hasil_r ?> / </p>
                                <p class="h6"><?= $hasil_b ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php $x = $x + 1;
        endforeach; ?>

    </div>
    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?> <?= $event['nama'] ?></h6>
                <a href="<?= base_url('budget/printrab/') . $idevent ?>" class="btn btn-primary btn-icon-split ">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print Data RAB</span>
                </a>
            </div>
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
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->