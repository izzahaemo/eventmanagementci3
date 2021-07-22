<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?> <?= $kelas['name']; ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/account'); ?>"><?= $title ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $kelas['name'] ?></li>
        </ol>
        <?= $this->session->flashdata('message'); ?>
    </nav>

    <!--Main Content -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Akun <?= $kelas['name'] ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataakun" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Last Login</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Last Active</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($account as $a) : ?>
                            <tr>
                                <td><?= $a['no_absen'] ?></td>
                                <td><?= $a['email']; ?></td>
                                <td><?= $a['name']; ?></td>
                                <td><?= $a['role']; ?></td>
                                <?php if ($a['is_active'] == 0) {
                                    $status = "Off";
                                } else if ($a['is_vote'] == 1) {
                                    $status = "Sudah Vote";
                                } else {
                                    $status = "Aktif";
                                }
                                ?>
                                <td><?php if (date('d-m-y') != date('d-m-y', strtotime($a['last_login']))) : ?>
                                        <?= date('d-m-y', strtotime($a['last_login'])) ?>
                                    <?php else : ?>
                                        <?= date('H:i:s', strtotime($a['last_login'])) ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= $status ?></td>
                                <td>
                                    <?php if ($a['is_active'] != 1) { ?>
                                        <a href="" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#aktif<?= $a['id']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Aktifkan</span>
                                        </a>
                                        <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#delete<?= $a['id']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Informasi Total-->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Akun</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kelas['total'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
        $belum = $kelas['total'] - $kelas['aktif'];
        $totalp = $kelas['total'];
        if ($totalp == 0) {
            $aktifp = 100;
            $belump = 0;
        } else {
            $aktifp = $kelas['aktif'] / $totalp * 100;
            $belump = $belum / $totalp * 100;
        }
        ?>
        <div class="col-md-3 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Akun Aktif</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($aktifp); ?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $aktifp . '%' ?>" aria-valuenow="<?= $aktifp ?>" aria-valuemin="0" aria-valuemax="100"></div>
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

        <div class="col-md-3 mb-4">
            <div class="card border-bottom-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Akun Belum Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $belum ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-minus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Akun Sudah Vote</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kelas['done'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- modal aktif-->
<?php
foreach ($account as $a) :
?>
    <div class="modal fade" id="aktif<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="aktifLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aktifLabel">Aktifkan Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('admin/aktif/') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda yakin Aktifkan akun ini? <?= $a['name']; ?></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="iduser" value="<?= $a['id'] ?>">
                        <input type="hidden" name="idkelas" value="<?= $kelas['idkelas'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Aktifkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- modal edit-->
<?php
foreach ($account as $a) :
?>
    <div class="modal fade" id="edit<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $a['id']; ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $a['id']; ?>Label">Edit Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('admin/edit_user/') ?>" method="post">
                    <div class="modal-body">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?= base_url(('assets/img/profile/') . $a['image']) ?>" class="card-img">
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>
                                        Edit Akun <?= $a['name']; ?>
                                    </label>
                                </div>
                                <div class="form-grup">
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $a['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select id="edit_role" name="edit role" class="form-control">
                                        <option value="<?= $a['role_id']; ?>"><?= $a['role']; ?></option>
                                        <?php foreach ($role as $r) : ?>
                                            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-grup">
                                    <label>Active</label>
                                    <select name="edit_active" class="form-control">
                                        <option selected value="<?= $a['is_active']; ?>"> <?= $a['is_active'] == 1 ? "Active" : "Off" ?></option>
                                        <option value="0">Off</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="iduser" value="<?= $a['id'] ?>">
                        <input type="hidden" name="idkelas" value="<?= $kelas['idkelas'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- modal delete-->
<?php
foreach ($account as $a) :
?>
    <div class="modal fade" id="delete<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Hapus Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('admin/delete/') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda yakin hapus akun ini? <?= $a['name']; ?></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="iduser" value="<?= $a['id'] ?>">
                        <input type="hidden" name="idkelas" value="<?= $kelas['idkelas'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>