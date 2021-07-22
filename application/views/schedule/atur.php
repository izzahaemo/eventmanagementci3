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

    <?php $totalmhs = 0;
    foreach ($mhs as $m) :
        $totalmhs = $totalmhs + 1;
    endforeach; ?>

    <!--Main Content -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Total Data Mahasiswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalmhs ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        foreach ($divisi as $d) :

            $totaladivisi = 0;

            foreach ($mhs as $m) :

                if ($m['idd'] == $d['id']) {
                    $totaladivisi = $totaladivisi + 1;
                }
            endforeach;
        ?>
            <div class="col-md-3 mb-4">
                <div class="card border-bottom-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-info text-uppercase mb-1">Total Divisi <?= $d['nama'] ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totaladivisi ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-<?= $d['icon'] ?> fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>

        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa <?= $event['nama'] ?></h6>
                <a href="<?= base_url('schedule/printmhs/') . $idevent ?>" class="btn btn-success btn-icon-split ">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print Data Mahasiswa</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="schedule" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Divisi</th>
                            <th>Jadwal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Divisi</th>
                            <th>Jadwal</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mhs as $a) : ?>
                            <tr>
                                <td><?= $i ?></td>
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
                                <td>
                                    <?= $a['nama']; ?>
                                </td>
                                <td><?= $a['class'] == 0 ? "Belum Diatur" : "Sudah Diatur" ?></td>
                                <td>
                                    <a href="" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#edit1<?= $a['id']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-edit"></i>
                                        </span>
                                        <span class="text">Data</span>
                                    </a>
                                    <a href="" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#edit2<?= $a['id']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <span class="text">Jadwal</span>
                                    </a>
                                    <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#delete<?= $a['id']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Hapus</span>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Code Tambah Anggota di Event Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $event['codeanggota'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-code fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <a href="<?= base_url('schedule/addmhs/') . $idevent ?>" class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 text-uppercase font-weight-bold text-success">Tambahkan Data Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- modal editmhs 1-->
<?php
foreach ($mhs as $a) :
?>
    <div class="modal fade" id="edit1<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $a['id']; ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $a['id']; ?>Label">Edit Data Mahasiswa <?= $a['name']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('schedule/editmhs1/') . $idevent ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="<?= $a['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nick</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nick" name="nick" value="<?= $a['nick']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= $a['no_telp']; ?>">
                                <div id="no_telp" class="form-text">81###########</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Divisi</label>
                            <div class="col-sm-10">
                                <select name="idd" class="form-control">
                                    <option selected value="<?= $a['idd']; ?>">
                                        <?php foreach ($divisi as $d) :
                                            if ($d['id'] == $a['idd']) { ?>
                                                <?= $d['nama'] ?>
                                        <?php }
                                        endforeach; ?>
                                    </option>
                                    <?php foreach ($divisi as $d) :
                                        if ($d['id'] != $a['idd']) {
                                    ?>
                                            <option value="<?= $d['id'] ?>"> <?= $d['nama'] ?> </option>
                                    <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idmhs" value="<?= $a['id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- modal editmhs2-->
<?php
foreach ($mhs as $a) :
?>
    <div class="modal fade" id="edit2<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editmhs2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmhs2Label">Edit Data Schedule <?= $a['name']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda Yakin Ubah Schedule akun ini? <?= $a['name']; ?></h5>
                            <h6>Dengan Merubah Data Schedule lama akan di hapus</h6>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a href="<?= base_url('schedule/editmhs2/') . $idevent . "/" . $a['id'] ?>" class="btn btn-primary ">
                            Ubah
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- modal delete-->
<?php
foreach ($mhs as $a) :
?>
    <div class="modal fade" id="delete<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Hapus Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('schedule/deletemhs/' . $idevent) ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda yakin hapus akun ini? <?= $a['name']; ?></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idmhs" value="<?= $a['id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>