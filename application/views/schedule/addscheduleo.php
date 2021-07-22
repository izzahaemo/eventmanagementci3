<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('schedule/view/' . $url); ?>"><?= $title ?> </a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('schedule/buat/' . $idevent); ?>"><?= $title ?> <?= $event['nama'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambahkan <?= $title ?> <?= $event['nama'] ?></li>
        </ol>
    </nav>

    <!-- Page isi -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambahkan <?= $title ?> <?= $event['nama'] ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('schedule/addscheduleo/' . $idevent); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="nick" class="col-sm-2 col-form-label">Schedule </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="scheduleo" name="scheduleo" value="<?= set_value('scheduleo'); ?>" required>
                        <div id="scheduleo" class="form-text">Hari ####</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Mulai</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="mulai" name="mulai" value="<?= set_value('mulai'); ?>" required>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Selesai</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="selesai" name="selesai" value="<?= set_value('selesai'); ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
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