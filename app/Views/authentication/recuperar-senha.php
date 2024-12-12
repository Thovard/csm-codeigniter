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
                                <h2 class="fw-bold mb-2 text-uppercase">Esqueceu sua Senha?</h2>
                                <p class="text-white-50 mb-5">Insira o seu e-mail abaixo para receber as instruções de recuperação.</p>

                                <form action="/forgot-password" method="POST">
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <input type="email" id="typeEmailX" name="email" class="form-control" required />
                                    </div>
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Enviar Instruções</button>
                                </form>
                            </div>

                            <div>
                                <p class="mb-0">Lembrou sua senha? <a href="/" class="text-white-50 fw-bold">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Aguarde',
                text: 'Email de recuperação em criação.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/login';
            });;
        });
    </script>
</body>
<?= $this->endSection() ?>