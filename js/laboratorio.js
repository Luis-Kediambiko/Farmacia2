
$(document).ready(function () {
    buscar_lab();
    var funcao;
    var edit=false;
    $('#form-laboratorio').submit(e => {
        let nome_laboratorio = $('#nome-laboratorio').val();
        let id_editado = $('#id_edit_lab').val();
       if(edit==false){
        funcao ='criar';
       }
       else{
        funcao='editar';
       }
        $.post('../controlador/LaboratorioController.php', {nome_laboratorio,id_editado,funcao },(response)=>{
            if (response == 'add') {
                $('#add_lab').hide('slow');
                $('#add_lab').show(1000);
                $('#add_lab').hide(2000);
                $('#form-laboratorio').trigger('reset');
                buscar_lab();
            }
            if(response=='noadd') {
                $('#noadd_lab').hide('slow');
                $('#noadd_lab').show(1000);
                $('#noadd_lab').hide(2000);
                $('#form-laboratorio').trigger('reset');
            }
            if(response=='edit'){
                $('#edit_lab').hide('slow');
                $('#edit_lab').show(1000);
                $('#edit_lab').hide(2000);
                $('#form-laboratorio').trigger('reset');
                buscar_lab();
            }
            edit=false;
            
        })
        e.preventDefault();
    });


    function buscar_lab(consulta) {
        funcao = 'buscar';
        $.post('../controlador/LaboratorioController.php', { consulta, funcao }, (response) => {
            
            const laboratorios = JSON.parse(response);
            let template = '';
            laboratorios.forEach(laboratorio => {
                template += `
                <tr labId="${laboratorio.id}" labNome="${laboratorio.nome}" labAvatar="${laboratorio.avatar}">
                <td> 
                    <button class="avatar btn btn-info" title="Alterar a imagem" typ="button" data-toggle="modal" data-target="#mudarlogo">
                    <i class="far fa-image"></i>
                    </button>
                    <button class="editar btn btn-success" title="Editar laboratorio" typ="button" data-toggle="modal" data-target="#criarlaboratorio">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="eliminar btn btn-danger" title="Eliminar laboratorio">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    <img src="${laboratorio.avatar}" class="img-fluid ronded" width="70" heigth="70">
                </td>
                    <td>${laboratorio.nome}</td>
                </tr>
                `;
            });

            $('#laboratorios').html(template);


        })
    };

    $(document).on('keyup', '#buscar-laboratorio', function () {
        let valor = $(this).val();
        if (valor != ""){
            buscar_lab(valor);
        }
        else {

            buscar_lab();
        }
    })

    $(document).on('click','.avatar',(e)=>{
        funcao ="mudar_logo";
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id =$(elemento).attr('labId');
        const nome =$(elemento).attr('labNome');
        const avatar =$(elemento).attr('labAvatar');
        $('#logoatual').attr('src',avatar);
        $('#nome_logo').html(nome);
        $('#funcao').val(funcao);
        $('#id_logo_lab').val(id);
    })
    $('#form-logo').submit(e=>{
        let formData= new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/LaboratorioController.php',
            type:'POST',
            data:formData,
            cache:false,
            processData: false,
            contentType:false
        }).done(function(response){
           const json=JSON.parse(response);
           if (json.alert=='edit') {
            $('#logoatual').attr('src',json.rota);
            $('#edit').hide('slow');
            $('#edit').show(1000);
            $('#edit').hide(2000);
            $('#form-logo').trigger('reset');
            buscar_lab();
           }
            else{
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(2000);
                $('#form-photo').trigger('reset');  
           }
          
        });
        e.preventDefault();

})

$(document).on('click','.eliminar',(e)=>{
    funcao ="eliminar";
    const elemento= $(this)[0].activeElement.parentElement.parentElement;
    const id =$(elemento).attr('labId');
    const nome =$(elemento).attr('labNome');
    const avatar =$(elemento).attr('labAvatar');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger mr-2'
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: 'Deseja eliminar laboratório '+nome+' ?',
        text: "Você não poderá reverter isto!",
        imageUrl:''+avatar+'',
        imageWidth:'100',
        imageHeight:'100',
        showCancelButton: true,
        confirmButtonText: "Sim, eliminar!",
        cancelButtonText: "Não, cancelar!",
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.post('../controlador/LaboratorioController.php',{id,funcao},(response)=>{
            edit=false;
            if(response=='eliminado'){
            swalWithBootstrapButtons.fire(
            'Eliminado!',
             'Laboratório eliminado com sucesso.',
             'success'
          )
          buscar_lab();
            } 
       else{
              swalWithBootstrapButtons.fire(
            'Não pode ser eliminado!',
            'Laboratório não pode ser eliminado porque está sendo utilizado.',
            'error'
          );
          buscar_lab();
        }
            
            })
          
        } else if (result.dismiss === Swal.DismissReason.cancel){
          swalWithBootstrapButtons.fire({
            title: "Cancelado",
            text: 'Laboratório não eliminado',
            icon: "error"
          });
        }
      });
      
})

$(document).on('click','.editar',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id =$(elemento).attr('labId');
        const nome =$(elemento).attr('labNome');
        $('#id_edit_lab').val(id);
        $('#nome-laboratorio').val(nome);
        edit=true;
       
    })



});
