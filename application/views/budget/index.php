<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('budget/view/') . $id; ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>

    <div class="row">
        <?php foreach ($event as $a) :
            if ($a['idu'] == $user['id']) { ?>
                <div class="col-xl-6 col-lg-7">
                    <a href="<?= base_url('budget/') . $url . '/' . $a['id']; ?>" ?>
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary"><?= $a['nama'] ?></h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row no-gutters">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $a['penyelenggara']; ?></h5>
                                            <p class="card-text"><?= $a['tempat']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        <?php endforeach; ?>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->