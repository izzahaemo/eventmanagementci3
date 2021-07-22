<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page isi -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?> <?= $event['nama'] ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('outside/isifeedback/' . $eventcode); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" required autofocus>
                        <?= form_error('no', '<a class="text-danger pl-2">', '</a>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nick" class="col-sm-2 col-form-label">Institusi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="institusi" name="institusi" value="<?= set_value('institusi'); ?>" required>
                        <?= form_error('no', '<a class="text-danger pl-2">', '</a>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Feedback</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="feedback" name="feedback" value="<?= set_value('feedback'); ?>" required autofocus>
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
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