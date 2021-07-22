<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('schedule/view/' . $url); ?>"><?= $title ?></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('schedule/atur/' . $idevent); ?>"><?= $title ?> <?= $event['nama'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data Mahasiswa <?= $mhs['name'] ?></li>
        </ol>
    </nav>

    <!-- Page isi -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Mahasiswa <?= $mhs['name'] ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('schedule/editmhs2/' . $idevent . "/" . $mhs['id']); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $mhs['name']; ?>" readonly>
                        <?= form_error('no', '<a class="text-danger pl-2">', '</a>') ?>
                    </div>
                </div>
                <?php $i = 1 ?>
                <?php foreach ($schedule as $s) : ?>
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label"><?= $s['schedule'] ?></label>
                        <div class="col-sm-2">
                            <label for="name" class="">Bisa</label>
                            <input type="radio" class="form-control" id="bi<?= $i ?>" name="bi<?= $i ?>" value="1">
                            <?= form_error('bi' . $i, '<small class="text-danger pl-2">', '</small>') ?>
                        </div>
                        <div class="col-sm-2">
                            <label for="name" class="">Tidak</label>
                            <input type="radio" class="form-control" id="bi<?= $i ?>" name="bi<?= $i ?>" value="0">
                        </div>
                    </div>
                    <?php $i++ ?>
                <?php endforeach; ?>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Input
                    </button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->