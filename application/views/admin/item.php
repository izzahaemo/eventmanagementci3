<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('budget/item'); ?>"><?= $titlemenu ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </nav>

    <!--Main Content -->

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="rab" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Lokasi</th>
                            <th>Item Kategori</th>
                            <th>Divisi</th>
                            <th>Item</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Lokasi</th>
                            <th>Item Kategori</th>
                            <th>Divisi</th>
                            <th>Item</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>value</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($item as $a) : ?>
                            <tr>
                                <td><?= $a['id'] ?></td>
                                <td>
                                    <?php if ($a['in_or_outdoor'] == 0) { ?>
                                        Outdoor
                                    <?php } elseif ($a['in_or_outdoor'] == 1) { ?>
                                        Indoor
                                    <?php } elseif ($a['in_or_outdoor'] == 2) { ?>
                                        In / Outdoor
                                    <?php } ?>
                                </td>
                                <td><?= $a['item_kategori'] ?></td>
                                <td>
                                    <?php foreach ($divisi as $d) :
                                        if ($d['id'] == $a['divisi']) { ?>
                                            <?= $d['nama'] ?>
                                    <?php }
                                    endforeach; ?>
                                </td>
                                <td><?= $a['item'] ?></td>
                                <td><?= $a['jumlah'] ?></td>
                                <td><?= $a['satuan'] ?></td>
                                <td>
                                    <?php $hasil_r = "Rp " . number_format($a['harga'], 2, ',', '.'); ?>
                                    <?= $hasil_r ?>
                                </td>
                                <td>
                                    <?php $hasil_r = "Rp " . number_format($a['total_harga'], 2, ',', '.'); ?>
                                    <?= $hasil_r ?>
                                </td>
                                <td><?= $a['value'] ?></td>
                                <td>
                                    <a href="" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#edit<?= $a['id']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#delete<?= $a['id']; ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete</span>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++ ?>
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


<?php
foreach ($item as $a) :
?>
    <div class="modal fade" id="edit<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit1Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit1Label">Edit Data Item <?= $a['item']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('admin/itemedit/'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Lokasi Event</label>
                            <div class="col-sm-10">
                                <input type="number" min=0 max=2 class="form-control" id="in_or_outdoor" name="in_or_outdoor" value="<?= $a['in_or_outdoor']; ?>">
                                <div id="in_or_outdoor" class="form-text">0 = Outdoor, 1 = Indoor, 2 = In/Outdoor</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Item Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="item_kategori" name="item_kategori" value="<?= $a['item_kategori']; ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Divisi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="divisi" name="divisi" value="<?= $a['divisi']; ?>">
                                <div id="emailHelp" class="form-text">
                                    <?php $i = 1 ?>
                                    <?php foreach ($divisi as $d) : ?>
                                        <?= $i ?> = <?= $d['nama'] ?>,
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Item</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="item" name="item" value="<?= $a['item']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">jumlah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $a['jumlah']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $a['satuan']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="harga" name="harga" value="<?= $a['harga']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Total Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="total_harga" name="total_harga" value="<?= $a['total_harga']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Value</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="value" name="value" value="<?= $a['value']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_item" value="<?= $a['id']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php
foreach ($item as $a) :
?>
    <div class="modal fade " id="delete<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Hapus Data <?= $a['item'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= base_url('admin/itemhapus') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Anda yakin hapus data ini? <?= $a['item']; ?></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_item" value="<?= $a['id']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>