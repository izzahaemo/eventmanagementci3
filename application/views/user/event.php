<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('user/event/') ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>

    <div class="row d-flex justify-content-center">
        <div class="col-md-3 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <a href="" data-toggle="modal" data-target="#buat">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" font-weight-bold text-primary text-uppercase mb-1">Buat Event Baru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-plus fa-2x "></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($event as $a) :
            if ($a['idu'] == $user['id']) { ?>
                <div class="col-xl-6 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $a['nama'] ?></h6>
                            <a href="" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#edit<?= $a['id'] ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>

                            <a href="" class="btn btn-danger btn-icon-split " data-toggle="modal" data-target="#delete<?= $a['id'] ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                                <span class="text">Hapus</span>
                            </a>
                        </div>


                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $a['penyelenggara']; ?></h5>
                                        <p class="card-text"><?= $a['tempat']; ?></p>
                                        <?php if ($a['inorout'] == 0) {
                                            $dimana = "Outdoor";
                                        } elseif ($a['inorout'] == 1) {
                                            $dimana = "Indoor";
                                        } else {
                                            $dimana = "Outdoor & Indoor";
                                        } ?>
                                        <p class="card-text"><?= $dimana; ?></p>
                                        <p class="card-text">Target Peserta <?= $a['target']; ?></p>
                                        <p class="card-text">Budget
                                            <?php $hasil_r = "Rp " . number_format($a['budget'], 2, ',', '.'); ?>
                                            <?= $hasil_r ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endforeach; ?>
    </div>
</div>
<!-- /.container-fluid -->

</div>

<!-- End of Main Content -->

<!-- modal buat event -->
<?php foreach ($event as $a) : ?>
    <div class="modal fade" id="buat" tabindex="-1" role="dialog" aria-labelledby="buatLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buatLabel">Buat Event Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('user/addevent/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nama Event</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Penyelenggara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" value="<?= set_value('penyelenggara'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tempat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tempat" name="tempat" value="<?= set_value('tempat'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Lokasi Event</label>
                            <div class="col-sm-10">
                                <select name="inorout" class="form-control">
                                    <option value="0">Outdoor</option>
                                    <option value="1">Indoor</option>
                                    <option value="2">Outdoor & Indoor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Target Peserta</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="target" name="target" value="<?= set_value('target'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Budget</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="budget" name="budget" value="<?= set_value('budget'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Event Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="eventcode" name="eventcode" value="<?= set_value('eventcode'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- modal edit event -->
<?php foreach ($event as $a) : ?>
    <div class="modal fade" id="edit<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Buat Event Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('user/editevent/') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Nama Event</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= ($a['nama']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Penyelenggara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" value="<?= ($a['penyelenggara']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tempat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tempat" name="tempat" value="<?= ($a['tempat']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Lokasi Event</label>
                            <div class="col-sm-10">
                                <select name="idd" class="form-control">
                                    <option selected value="<?= $a['inorout']; ?>">
                                        <?php if ($a['inorout'] == 0) {
                                            $dimana = "Outdoor";
                                        } elseif ($a['inorout'] == 1) {
                                            $dimana = "Indoor";
                                        } else {
                                            $dimana = "Outdoor & Indoor";
                                        } ?>
                                        <?= $dimana ?>
                                    </option>
                                    <option value="0">Outdoor</option>
                                    <option value="1">Indoor</option>
                                    <option value="2">Outdoor & Indoor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Target Peserta</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="target" name="target" value="<?= ($a['target']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Budget</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="budget" name="budget" value="<?= ($a['budget']); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ide" value="<?= $a['id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- modal delete-->
<?php
foreach ($event as $a) :
?>
    <div class="modal fade" id="delete<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Hapus Event <?= $a['nama'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('user/deleteevent/') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda yakin hapus event ini? <?= $a['nama']; ?></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ide" value="<?= $a['id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>