<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?> <?= $event['nama'] ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Timline view -->
    <link href="<?= base_url('assets/vendor/jquerytimeline/'); ?>jquery.roadmap.min.css" rel="stylesheet">
    <!-- Include jQuery Roadmap Plugin -->
    <script src="<?= base_url('assets/'); ?>js/timeline.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

    <link href="<?= base_url('assets/img/logoweb.png'); ?>" rel="shortcut icon">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow d-flex flex-row align-items-center justify-content-between">


                    <h6 class="ml-md-3 font-weight-bold text-primary">Event Management APP</h6>
                    <h6 class="ml-md-3 font-weight-bold text-primary"><?= $title ?> <?= $event['nama'] ?></h6>
                    <h6 class="ml-md-3 font-weight-bold text-primary">
                        <a>Pukul : </a>
                        <b id="jam"></b>
                        <b>:</b>
                        <b id="menit"></b>
                        <b>:</b>
                        <b id="detik"></b>
                        <a>|</a>
                        <?php $tanggal = mktime(date('m'), date("d"), date('Y'));
                        echo "Tanggal : <b> " . date("d-m-Y", $tanggal) . "</b>";
                        ?>
                    </h6>



                </nav>
                <!-- End of Topbar -->