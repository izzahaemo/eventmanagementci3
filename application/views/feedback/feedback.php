<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('feedback/view/1'); ?>"><?= $titlemenu ?> </a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?> <?= $event['nama'] ?></li>
        </ol>
    </nav>
    <!-- Page isi -->
    <?php if ($ada == true) { ?>
        <?php

        $positif = $feedback['positif'] / $total * 100;
        $negatif = $feedback['negatif'] / $total * 100;

        ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
            <div class="col-xl-6 mb-4">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body d-flex align-items-start flex-column bd-highlight">
                        <div class="row no-gutters  align-items-center mb-auto bd-highlight">
                            <div class="col mr-2">
                                
                                <div class="text-md font-weight-bold text-success text-uppercase mb-1">Total Feedback Positif</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($positif); ?>%</div>
                            </div>
                        </div>
                        <div class="row no-gutters align-items-center bd-highlight">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-danger text-uppercase mb-1">Total Feedback Negatif</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($negatif); ?>%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Summary Feedback</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="charttotal"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <?php } ?>

    <div class="card shadow mb-4">
        <?= $this->session->flashdata('message'); ?>

        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?> <?= $event['nama'] ?></h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="rab" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Institusi</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Institusi</th>
                            <th>Feedback</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 1; ?>
                        <?php foreach ($komentar as $a) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $a['nama'] ?></td>
                                <td><?= $a['institusi'] ?></td>
                                <td><?= $a['feedback'] ?></td>
                            </tr>
                            <?php
                            $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6 mb-4 ">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Code Menambah Feedback di Event Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $event['codefeedback'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-code fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4 ">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Total Feedback</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comment-dots fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.js"></script>



<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    var ctx = document.getElementById("charttotal");
    var chartakhwat = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Positif", "Negatif"],
            datasets: [{
                data: [<?= $feedback['positif']  ?>, <?= $feedback['negatif']  ?>],
                backgroundColor: ['#1cc88a', '#f08080'],
                hoverBackgroundColor: ['#2e59d9', '#17a673'],
                hoverBorderColor: "rgba(234, 236, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 80,
        },
    });
</script>