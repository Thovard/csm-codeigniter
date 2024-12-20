<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/auth/css/style.css') ?>">

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Por favor insira seu login e senha!!</p>
                                <form action="/login" method="POST">
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">Senha</label>
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                                    </div>
                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="/forgot-password">Esqueceu sua senha?</a></p>
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                </form>
                            </div>

                            <div>
                                <p class="mb-0">Não tenho uma conta? <a href="/register" class="text-white-50 fw-bold">Cadastrar</a></p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="<?= base_url('assets/auth/js/login.js') ?>"></script>
<?= $this->endSection() ?>