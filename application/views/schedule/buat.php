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
    foreach ($schedule as $m) :
        $totalschedule = $totalschedule + 1;
    endforeach; ?>

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
                <a href="<?= base_url('schedule/addscheduleo/') . $idevent ?>" class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 text-uppercase font-weight-bold text-success">Tambahkan Schedule</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!--Main Content -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>


        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="m-0 font-weight-bold text-primary">Data Schedule Event <?= $event['nama'] ?></h6>
                <a href="<?= base_url('schedule/printscheduleo/') . $idevent ?>" class="btn btn-success btn-icon-split ">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print Data Schedule Event</span>
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
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Schedule</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($schedule as $s) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $s['schedule']; ?></td>
                                <td><?= date("H:i", strtotime($s['mulai'])); ?></td>
                                <td><?= date("H:i", strtotime($s['selesai'])); ?></td>
                                <td>
                                    <a href="" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#edit<?= $s['id']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#delete<?= $s['id']; ?>">
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
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- modal editschedule-->
<?php
foreach ($schedule as $s) :
?>
    <div class="modal fade" id="edit<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $s['id']; ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit<?= $s['id']; ?>Label">Edit Data Schedule <?= $s['schedule']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('schedule/editscheduleo/') . $idevent ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nama Schedule</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="scheduleo" name="scheduleo" value="<?= $s['schedule']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Mulai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="mulai" name="mulai" value="<?= $s['mulai']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Selesai</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="selesai" name="selesai" value="<?= $s['selesai']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ids" value="<?= $s['id'] ?>">
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
foreach ($schedule as $s) :
?>
    <div class="modal fade" id="delete<?= $s['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Hapus Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('schedule/deletescheduleo/' . $idevent) ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda Yakin Hapus Schedule Event <?= $s['schedule']; ?> ?</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ids" value="<?= $s['id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>