$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();

        const email = $('#typeEmailX').val();
        const password = $('#typePasswordX').val();

        if (email === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O campo de e-mail é obrigatório.',
            });
            return;
        }

        if (password === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O campo de senha é obrigatório.',
            });
            return;
        }

        const formData = {
            email: email,
            password: password
        };

        $.ajax({
            url: '/auth',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '/dashboard';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: response.message,
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao enviar o formulário',
                    text: 'Por favor, tente novamente.',
                });
            }
        });
    });
});
