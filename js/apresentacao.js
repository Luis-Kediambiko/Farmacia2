
$(document).ready(function () {
    buscar_apresentacao();
    var funcao;
    var edit=false;
    $('#form-apresentacao').submit(e => {
        let nome_apresentacao = $('#nome-apresentacao').val();
        let id_editado = $('#id_edit_apresentacao').val();
       if(edit==false){
        funcao ='criar';
       }
       else{
        funcao='editar';
       }
        $.post('../controlador/ApresentacaoController.php', {nome_apresentacao,id_editado,funcao },(response)=>{
            console.log(response);
            if (response == 'add') {
                $('#add_apresentacao').hide('slow');
                $('#add_apresentacao').show(1000);
                $('#add_apresentacao').hide(2000);
                $('#form-apresentacao').trigger('reset');
                buscar_apresentacao();
            }
            if(response=='noadd') {
                $('#noadd_apresentacao').hide('slow');
                $('#noadd_apresentacao').show(1000);
                $('#noadd_apresentacao').hide(2000);
                $('#form-apresentacao').trigger('reset');
            }
            if(response=='edit'){
                $('#edit_apresentacao').hide('slow');
                $('#edit_apresentacao').show(1000);
                $('#edit_apresentacao').hide(2000);
                $('#form-apresentacao').trigger('reset');
                buscar_apresentacao();
            }
            edit=false;
            
        })
        e.preventDefault();
    });


    function buscar_apresentacao(consulta) {
        funcao = 'buscar-apresentacao';
        $.post('../controlador/ApresentacaoController.php', { consulta, funcao }, (response) => {

            const apresentacoes = JSON.parse(response);
            let template = '';
            apresentacoes.forEach(apresentacao => {
                template += `
                <tr apreseId="${apresentacao.id}" apreseNome="${apresentacao.nome}">
                <td> 
                    <button class="editar-apresentacao btn btn-success" title="Editar apresentacao" type="button" data-toggle="modal" data-target="#criarapresentacao">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="eliminar-apresentacao btn btn-danger" title="Eliminar apresentacao">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                    <td>${apresentacao.nome}</td>
                </tr>
                `;
            });

            $('#apresentacoes').html(template);


        })
    };

    $(document).on('keyup', '#buscar-apresentacao', function () {
        let valor = $(this).val();
        if (valor != ""){
            buscar_apresentacao(valor);
        }
        else {

            buscar_apresentacao();
        }
    })

   
 
$(document).on('click','.eliminar-apresentacao',(e)=>{
    funcao ="eliminar";
    const elemento= $(this)[0].activeElement.parentElement.parentElement;
    const id =$(elemento).attr('apreseId');
    const nome =$(elemento).attr('apreseNome');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger mr-2'
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: 'Deseja eliminar apresentacao '+nome+' ?',
        text: "Você não poderá reverter isto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Sim, eliminar!",
        cancelButtonText: "Não, cancelar!",
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.post('../controlador/ApresentacaoController.php',{id,funcao},(response)=>{
            edit=false;
            if(response=='eliminado'){
            swalWithBootstrapButtons.fire(
            'Eliminado!',
             'apresentacao eliminado com sucesso.',
             'success'
          )
          buscar_apresentacao();
            } 
        else{
              swalWithBootstrapButtons.fire(
            'Não pode ser eliminado!',
            'apresentacao não pode ser eliminado porque está sendo utilizado.',
            'error'
          );
          buscar_apresentacao();
        }
            
            })
          
        } else if (result.dismiss === Swal.DismissReason.cancel){
          swalWithBootstrapButtons.fire({
            title: "Cancelado",
            text: 'apresentacao não eliminado',
            icon: "error"
          });
        }
      });
})

$(document).on('click','.editar-apresentacao',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id =$(elemento).attr('apreseId');
        const nome =$(elemento).attr('apreseNome');
        $('#id_edit_apresentacao').val(id);
        $('#nome-apresentacao').val(nome);
        edit=true;
       
    })



});
