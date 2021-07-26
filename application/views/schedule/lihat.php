<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('schedule/view/' . $url); ?>"><?= $title ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?> <?= $event['nama'] ?></li>
        </ol>
    </nav>


    <?php $totalschedule = 0;
    $totalgagal = 0;
    $berhasil = 0;
    foreach ($schedule as $m) :
        $totalschedule = $totalschedule + 1;
        if ($m['is_fine'] != 0) {
            $totalgagal = $totalgagal + 1;
        }
    endforeach;
    if ($totalschedule == 0) {
        $berhasil = 100;
    } else {
        $totalsetelah = $totalschedule - $totalgagal;
        $berhasil = $totalsetelah / $totalschedule * 100;
    }

    ?>

    <!--Main Content -->

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Total Data Schedule</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalschedule ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-success text-uppercase mb-1">Schedule Terploting Seluruh Divisi</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($berhasil); ?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $berhasil . '%' ?>" aria-valuenow="<?= $berhasil ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas  fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>

        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="m-0 font-weight-bold text-primary">Data Schedule <?= $event['nama'] ?></h6>
                <a href="<?= base_url('schedule/printschedulep/') . $idevent ?>" class="btn btn-primary btn-icon-split ">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print Data Schedule</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="schedule" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Schedule</th>
                            <th>Tidak bisa</th>
                            <th>Div 1</th>
                            <th>Div 2</th>
                            <th>Div 3</th>
                            <th>Div 4</th>
                            <th>Div 5</th>
                            <th>Div 6</th>
                            <th>Div 7</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
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
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($schedule as $a) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><a href="" data-toggle="modal" data-target="#schedule<?= $a['id_schedule']; ?>">
                                        <?= $a['schedule']; ?>
                                    </a>
                                </td>
                                <td><?= $a['is_fine']; ?></td>
                                <td>
                                    <?php foreach ($data_mhs as $m) :
                                        if ($a['div_1'] == $m['id']) { ?>
                                            <a href="" data-toggle="modal" data-target="#show<?= $m['id']; ?>">
                                                <?= $m['nick']; ?>
                                            </a>
                                    <?php }
                                    endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($data_mhs as $m) :
                                        if ($a['div_2'] == $m['id']) { ?>
                                            <a href="" data-toggle="modal" data-target="#show<?= $m['id']; ?>">
                                                <?= $m['nick']; ?>
                                            </a>
                                    <?php }
                                    endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($data_mhs as $m) :
                                        if ($a['div_3'] == $m['id']) { ?>
                                            <a href="" data-toggle="modal" data-target="#show<?= $m['id']; ?>">
                                                <?= $m['nick']; ?>
                                            </a>
                                    <?php }
                                    endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($data_mhs as $m) :
                                        if ($a['div_4'] == $m['id']) { ?>
                                            <a href="" data-toggle="modal" data-target="#show<?= $m['id']; ?>">
                                                <?= $m['nick']; ?>
                                            </a>
                                    <?php }
                                    endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($data_mhs as $m) :
                                        if ($a['div_5'] == $m['id']) { ?>
                                            <a href="" data-toggle="modal" data-target="#show<?= $m['id']; ?>">
                                                <?= $m['nick']; ?>
                                            </a>
                                    <?php }
                                    endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($data_mhs as $m) :
                                        if ($a['div_6'] == $m['id']) { ?>
                                            <a href="" data-toggle="modal" data-target="#show<?= $m['id']; ?>">
                                                <?= $m['nick']; ?>
                                            </a>
                                    <?php }
                                    endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($data_mhs as $m) :
                                        if ($a['div_7'] == $m['id']) { ?>
                                            <a href="" data-toggle="modal" data-target="#show<?= $m['id']; ?>">
                                                <?= $m['nick']; ?>
                                            </a>
                                    <?php }
                                    endforeach; ?>
                                </td>
                            </tr>
                            <?php $i = $i + 1 ?>
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


<!-- modal data mhs-->
<?php
foreach ($schedule as $a) :
?>
    <div class="modal fade" id="schedule<?= $a['id_schedule'] ?>" tabindex="-1" role="dialog" aria-labelledby="schedule<?= $a['id_schedule'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="schedule<?= $a['id_schedule'] ?>Label">Data Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action=">" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Schedule</label>
                            <div class="col-sm-8">
                                <?= $a['schedule'] ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Mulai</label>
                            <div class="col-sm-8">
                                <?= $a['mulai'] ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Selesai</label>
                            <div class="col-sm-8">
                                <?= $a['selesai'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- modal data mhs-->
<?php
foreach ($data_mhs as $a) :
?>
    <div class="modal fade" id="show<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="show<?= $a['id'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show<?= $a['id'] ?>Label">Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action=">" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <?= $a['name'] ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nama Panggilan</label>
                            <div class="col-sm-8">
                                <?= $a['nick'] ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Divisi</label>
                            <div class="col-sm-8">
                                <?= $a['nama'] ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">No Telp</label>
                            <div class="col-sm-8">
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
                                ?>
                                <?= $tampil_handphone ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>