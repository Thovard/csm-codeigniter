<?= $this->extend('layouts/dashboard/index') ?>

<?= $this->section('content') ?>
<div class="content-wrapper d-flex align-items-center justify-content-center mt-5">
    <div class="container ">
        <div class="card p-3" >
            <h5 class="font-weight-bold mb-4">Cadastro por Segmento</h5>
            <canvas id="segmentChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    const dataFromPHP = <?php echo json_encode($data); ?>;
    const labels = dataFromPHP.map(item => item.segmento);
    const data = dataFromPHP.map(item => parseInt(item.total));


    const backgroundColors = [
        "rgba(75, 192, 192, 0.2)",
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 206, 86, 0.2)",
        "rgba(54, 162, 235, 0.2)"
    ];

    const borderColors = [
        "rgba(75, 192, 192, 1)",
        "rgba(255, 99, 132, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(54, 162, 235, 1)"
    ];


    const ctx = document.getElementById("segmentChart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Cadastros por Segmento",
                data: data,
                backgroundColor: backgroundColors.slice(0, labels.length),
                borderColor: borderColors.slice(0, labels.length),
                borderWidth: 1,
            }, ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>
<?= $this->endSection() ?>