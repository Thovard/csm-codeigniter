<?= $this->extend('layouts/dashboard/index') ?>

<?= $this->section('content') ?>
<div class="content-wrapper d-flex pt-5 justify-content-center mt-5">
    <div class="container card py-3 px-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Clientes de <?= esc($name) ?></h3>
            <button class="btn btn-primary" data-toggle="modal" data-target="#customerModal" data-action="create">Cadastrar Novo Cliente</button>
        </div>

        <table class="table">
            <thead class=" thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Segmento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customers)): ?>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= esc($customer['id']) ?></td>
                            <td><?= esc($customer['nome']) ?></td>
                            <td><?= esc($customer['email']) ?></td>
                            <td><?= esc($customer['phone']) ?></td>
                            <td><?= esc($customer['segmento']) ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm edit-customer-btn" data-action="edit" data-id="<?= esc($customer['id']) ?>">Editar</a>
                                <a href="/dashboard/users/delete-customer/<?= esc($customer['id']) ?>" class="btn btn-danger btn-sm delete-customer" data-id="<?= esc($customer['id']) ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Nenhum cliente encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Formulário de Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" id="customerId">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="segmento">Segmento</label>
                            <select class="form-select" name="segmento" id="segmento" required>
                                <option value="Tecnologia">Tecnologia</option>
                                <option value="Alimentação">Alimentação</option>
                                <option value="Saúde">Saúde</option>
                                <option value="Transporte">Transporte</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $('.edit-customer-btn').click(function(event) {
        event.preventDefault();
        var action = $(this).data('action');
        var customerId = $(this).data('id');
        var form = $('#customerModal form');

        if (action === 'edit' && customerId) {
            $.get('/dashboard/users/edit-customer/' + customerId, function(data) {
                if (data && !data.error) {
                    form.attr('action', '/dashboard/users/update-customer/' + customerId);
                    form.find('input[name="nome"]').val(data.nome);
                    form.find('input[name="email"]').val(data.email);
                    form.find('input[name="phone"]').val(data.phone);
                    form.find('select[name="segmento"]').val(data.segmento);
                    $('#customerModal').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: data.error || "Erro ao buscar dados do cliente."
                    });
                }
            }, "json").fail(function(jqxhr, textStatus, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: "Erro na requisição: " + error
                });
                console.log(error)
            });
        }
    });
    $('#customerModal').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var form = $(this).find('form');

        if (action === 'create') {
            form.attr('action', '/dashboard/users/store-customer')
                .find('input[name="name"], input[name="email"], input[name="phone"], select[name="segmento"]').val('');
        }
    });

    $('#customerModal form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var action = form.attr('action');
        var formData = form.serialize();

        $.post(action, formData, function(data) {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: data.success
                });
                $('#customerModal').modal('hide');
                location.reload();
            } else if (data.errors) {
                var errorsMsg = '';
                if (typeof data.errors === 'object') {
                    for (var key in data.errors) {
                        errorsMsg += data.errors[key] + '\n';
                    }
                } else {
                    errorsMsg = data.errors;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: errorsMsg
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: "Erro ao salvar os dados."
                });
            }
        }, "json").fail(function(jqxhr, textStatus, error) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: "Erro na requisição: " + error
            });
        });
    });
    $(document).ready(function() {
        $('.delete-customer').click(function(event) {
            event.preventDefault(); // Prevent default link action

            var deleteUrl = $(this).attr('href');

            // Show confirmation dialog
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter essa ação!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete URL if confirmed
                    window.location.href = deleteUrl;
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>