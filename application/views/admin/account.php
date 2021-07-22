<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>

    <!--Main Content -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Akun</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datanya" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($account as $a) : ?>
                            <?php if ($a['id'] == 1) {
                            } else if ($a['id'] == $user['id']) {
                            } else {
                            ?>
                                <tr>
                                    <td><?= $a['id'] ?></td>
                                    <td><?= $a['email']; ?></td>
                                    <td><?= $a['name']; ?></td>
                                    <td><?= $a['role']; ?></td>
                                    <td><?= $a['is_active'] == 1 ? "Active" : "Off" ?></td>
                                    <td>
                                        <a href="" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#edit<?= $a['id']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#delete<?= $a['id']; ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php $i++; ?>
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
                        <input type="hidden" name="namee" value="<?= $a['name'] ?>">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>