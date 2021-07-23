<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('budget/view/') . $url; ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>

    <!--Main Content -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?> <?= $event['nama'] ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="rab" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Divisi</th>
                            <th>Persentase</th>
                            <th>Budget</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Divisi</th>
                            <th>Persentase</th>
                            <th>Budget</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($budget as $a) :
                            if ($a['ide'] == $idevent) {
                        ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $a['nama'] ?></td>
                                    <td><?= $a['persentase'] ?></td>
                                    <td>
                                        <?php $hasil_r = "Rp " . number_format($a['budget'], 2, ',', '.'); ?>
                                        <?= $hasil_r ?>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            <?php } ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <a href="" data-toggle="modal" data-target="#buat" class="btn btn-primary btn-lg btn-block">
                    Buat
                </a>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php foreach ($budget as $a) : ?>

    <div class="modal fade" id="buat" tabindex="-1" role="dialog" aria-labelledby="buatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buatLabel">Buat Schedule Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action=">" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda yakin membuat Budget Baru?</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a href="http://127.0.0.1:5001/generate/<?= $idevent ?>" class="btn btn-primary ">
                            Buat
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>