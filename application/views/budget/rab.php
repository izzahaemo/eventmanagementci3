<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('budget/view/') . $url; ?>"><?= $titlemenu ?> </a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?> <?= $event['nama'] ?></li>
        </ol>
    </nav>

    <!-- Page isi -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?> <?= $event['nama'] ?></h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('budget/rab/' . $idevent); ?>" method="post" enctype="multipart/form-data">
                <?php $i = 1 ?>
                <?php foreach ($divisi as $d) : ?>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Budget <?= $d['nama'] ?></label>
                        <div class="col-sm-10">
                            <input type="number" min=0 max=100 class="form-control" id="budget<?= $i ?>" name="budget<?= $i ?>" value="<?= set_value('budget' . $i); ?>" required>
                            <?= form_error('no', '<a class="text-danger pl-2">', '</a>') ?>
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