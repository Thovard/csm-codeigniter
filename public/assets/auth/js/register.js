$(document).ready(function () {
  $("form").on("submit", function (e) {
    e.preventDefault();
    const email = $("#typeEmailX").val();
    const password = $("#typePasswordX").val();
    const confirmPassword = $("#typeConfirmPasswordX").val();

    if (!email || !password || !confirmPassword) {
      Swal.fire({
        icon: "error",
        title: "Erro!",
        text: "Todos os campos precisam ser preenchidos.",
      });
      return;
    }

    if (password !== confirmPassword) {
      Swal.fire({
        icon: "error",
        title: "Erro!",
        text: "As senhas não coincidem.",
      });
      return;
    }

    const formData = $(this).serialize();

    $.ajax({
      url: "/create",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: "success",
            title: response.message,
            showConfirmButton: false,
            timer: 1500,
          }).then(() => {
            window.location.href = "/";
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Erro",
            text: response.message,
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Erro ao enviar o formulário",
          text: "Por favor, tente novamente.",
        });
      },
    });
  });
});
