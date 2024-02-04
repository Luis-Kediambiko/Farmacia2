
$(document).ready(function () {
    buscar_tipo();
    var funcao;
    var edit=false;
    $('#form-tipo').submit(e => {
        let nome_tipo = $('#nome-tipo').val();
        let id_editado = $('#id_edit_tipo').val();
       if(edit==false){
        funcao ='criar';
       }
       else{
        funcao='editar';
       }
        $.post('../controlador/TipoController.php', {nome_tipo,id_editado,funcao },(response)=>{
            if (response == 'add') {
                $('#add_tipo').hide('slow');
                $('#add_tipo').show(1000);
                $('#add_tipo').hide(2000);
                $('#form-tipo').trigger('reset');
                buscar_tipo();
            }
            if(response=='noadd') {
                $('#noadd_tipo').hide('slow');
                $('#noadd_tipo').show(1000);
                $('#noadd_tipo').hide(2000);
                $('#form-tipo').trigger('reset');
            }
            if(response=='edit'){
                $('#edit_tipo').hide('slow');
                $('#edit_tipo').show(1000);
                $('#edit_tipo').hide(2000);
                $('#form-tipo').trigger('reset');
                buscar_tipo();
            }
            edit=false;
            
        })
        e.preventDefault();
    });


    function buscar_tipo(consulta) {
        funcao = 'buscar-tipo';
        $.post('../controlador/TipoController.php', { consulta, funcao }, (response) => {

            const tipos = JSON.parse(response);
            let template = '';
            tipos.forEach(tipo => {
                template += `
                <tr tipId="${tipo.id}" tipNome="${tipo.nome}">
                <td> 
                    <button class="editar-tip btn btn-success" title="Editar tipo" type="button" data-toggle="modal" data-target="#criartipo">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="eliminar-tipo btn btn-danger" title="Eliminar tipo">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                    <td>${tipo.nome}</td>
                </tr>
                `;
            });

            $('#tipos').html(template);


        })
    };

    $(document).on('keyup', '#buscar-tipo', function () {
        let valor = $(this).val();
        if (valor != ""){
            buscar_tipo(valor);
        }
        else {

            buscar_tipo();
        }
    })

   
 
$(document).on('click','.eliminar-tipo',(e)=>{
    funcao ="eliminar";
    const elemento= $(this)[0].activeElement.parentElement.parentElement;
    const id =$(elemento).attr('tipId');
    const nome =$(elemento).attr('tipNome');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger mr-2'
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: 'Deseja eliminar tipo '+nome+' ?',
        text: "Você não poderá reverter isto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Sim, eliminar!",
        cancelButtonText: "Não, cancelar!",
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.post('../controlador/TipoController.php',{id,funcao},(response)=>{
            edit=false;
            if(response=='eliminado'){
            swalWithBootstrapButtons.fire(
            'Eliminado!',
             'Tipo eliminado com sucesso.',
             'success'
          )
          buscar_tipo();
            } 
        else{
              swalWithBootstrapButtons.fire(
            'Não pode ser eliminado!',
            'Tipo não pode ser eliminado porque está sendo utilizado.',
            'error'
          );
          buscar_tipo();
        }
            
            })
          
        } else if (result.dismiss === Swal.DismissReason.cancel){
          swalWithBootstrapButtons.fire({
            title: "Cancelado",
            text: 'Tipo não eliminado',
            icon: "error"
          });
        }
      });
})

$(document).on('click','.editar-tip',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id =$(elemento).attr('tipId');
        const nome =$(elemento).attr('tipNome');
        $('#id_edit_tipo').val(id);
        $('#nome-tipo').val(nome);
        edit=true;
       
    })



});
