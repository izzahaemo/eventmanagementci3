<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h5 class="m-0 font-weight-bold text-primary">Manual Book Event Management APP</h5>
                <a href="<?= base_url('assets/files/MANUALBOOKSISUKA.pdf') ?>" class="btn btn-success btn-icon-split ">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Download</span>
                </a>
            </div>

        </div>
        <div class="card-body">
            <style>
                .container {
                    position: relative;
                    overflow: hidden;
                    width: 100%;
                    padding-top: 100%;
                    padding-top: 56.25%;
                }

                .responsive-iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    right: 0;
                    width: 100%;
                    height: 100%;
                }
            </style>
            <div class="container">
                <iframe class="responsive-iframe" src="https://online.fliphtml5.com/llcbw/idgg/" seamless="seamless" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true"></iframe>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->