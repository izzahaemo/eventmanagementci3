<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page isi -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?> <?= $event['nama'] ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('outside/isianggota/' . $eventcode); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>" required autofocus>
                        <?= form_error('no', '<a class="text-danger pl-2">', '</a>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nick" class="col-sm-2 col-form-label">Nick</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nick" name="nick" value="<?= set_value('nick'); ?>" required>
                        <?= form_error('no', '<a class="text-danger pl-2">', '</a>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">No Telp</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= set_value('no_telp'); ?>" required>
                        <div id="no_telp" class="form-text">81###########</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Divisi</label>
                    <div class="col-sm-10">
                        <select name="idd" class="form-control">
                            <?php foreach ($divisi as $d) : ?>
                                <option value="<?= $d['id'] ?>"> <?= $d['nama'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php $i = 1 ?>
                <?php foreach ($schedule as $s) : ?>
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label"><?= $s['schedule'] ?></label>
                        <label for="name" class="col-sm-4 col-form-label">Mulai <?= date("H:i", strtotime($s['mulai'])); ?> Selesai <?= date("H:i", strtotime($s['selesai'])); ?></label>
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
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        Input
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group row">
                <a href="<?= base_url("auth") ?>" class="btn btn-secondary btn-lg btn-block">
                    Home
                </a>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->