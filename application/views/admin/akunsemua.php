<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?> All</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/account'); ?>"><?= $title ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Akun Semua</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataakun" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Role</th>
                            <th>Last Login</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Role</th>
                            <th>Last Active</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($all as $a) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $a['email']; ?></td>
                                <td><?= $a['name']; ?></td>
                                <td><?= $a['class']; ?></td>
                                <td><?= $a['role']; ?></td>
                                <td><?= date('d-m-y H:i:s', strtotime($a['last_login'])) ?></td>
                                <?php if ($a['is_active'] == 0) {
                                    $status = "Off";
                                } else if ($a['is_vote'] == 1) {
                                    $status = "Sudah Vote";
                                } else {
                                    $status = "Aktif";
                                }
                                ?>
                                <td><?= $status ?></td>
                            </tr>
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