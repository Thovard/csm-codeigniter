<?= $this->extend('layouts/main') ?>

<?= $this->section('links') ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="<?= base_url('templateDash/plugins/fontawesome-free/css/all.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('templateDash/dist/css/adminlte.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('templateDash/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info d-flex align-items-center">
                        <a href="#" class="d-block" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= $name ?>">
                            <?= explode(' ', $name)[0] ?>...
                        </a>
                        <a href="/logout" class="text-danger ml-4" title="Sair">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link <?= uri_string() === 'dashboard' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/users" class="nav-link <?= uri_string() === 'dashboard/users' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Usuarios
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <?= $this->renderSection('content') ?>
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script src=" <?= base_url('templateDash/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('templateDash/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('templateDash/dist/js/adminlte.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('a[href="/logout"]').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Você será desconectado!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, sair!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/logout';
                    }
                });
            });
        });
    </script>
    <?= $this->renderSection('script') ?>
    <?= $this->endSection() ?>