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

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>

        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?> <?= $event['nama'] ?></h6>
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
        <div class="card-body">
            <div class="form-group row">
                <a href="" data-toggle="modal" data-target="#buat" class="btn btn-primary btn-lg btn-block" class="btn btn-primary btn-lg btn-block">
                    Buat
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <a href="" class="btn btn-success btn-lg btn-block " data-toggle="modal" data-target="#simpan" class="btn btn-primary btn-lg btn-block">
                    Simpan
                </a>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php foreach ($rab as $a) : ?>
    <div class="modal fade" id="buat" tabindex="-1" role="dialog" aria-labelledby="buatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buatLabel">Buat RAB Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action=">" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda yakin membuat RAB Baru?</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a href="http://127.0.0.1:5001/generate/<?= $idevent ?>" class="btn btn-primary ">
                            Buat
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="simpan" tabindex="-1" role="dialog" aria-labelledby="simpanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="simpanLabel">Simpan RAB Baru <?= $event['nama'] ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action=">" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <h5>Anda yakin menyimpan RAB Baru?</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('budget/updaterab/') . $idevent ?>" class="btn btn-success ">
                        Simpan
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>