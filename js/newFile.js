$(document).ready(function () {
    $('#form-laboratorio').submit(e => {
        let nome_laboratorio = $('#nome-laboratorio').val();
        funcao = 'criar';
        $.post('../controlador/LaboratorioController.php', { nome_laboratorio, funcao }, (response) => {
            if (response == 'add') {
                $('#add_lab').hide('slow');
                $('#add_lab').show(1000);
                $('#add_lab').hide(2000);
                $('#form-laboratorio').trigger('reset');

            }
            else {
                $('#noadd_lab').hide('slow');
                $('#noadd_lab').show(1000);
                $('#noadd_lab').hide(2000);
                $('#form-laboratorio').trigger('reset');

            }


        });
        e.preventDefault();
    });


    function buscar_lab(consulta) {
        funcao = 'buscar';
        $.post('../controlador/LaboratorioController.php', { consulta, funcao }, (response) => {

            console.log(response);

        });
    };

    $(document).on('keyup', 'buscar-laboratorio', function () {

        let valor = $(this).val();
        if (valor != '') {
            buscar_lab(valor);
        }
        else {

            buscar_lab();
        }



    });




});
