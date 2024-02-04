$(document).ready(function () {
  var edit=false;  
  var funcao;
    buscar_forne();
    $('#form-criar').submit(e => {
        let id = $('#id_edit_forne').val();
        let nome = $('#nome').val();
        let telefone = $('#telefone').val();
        let correio = $('#correio').val();
        let endereco = $('#endereco').val();
        if (edit==true) {
          funcao = "editar";
        }
        else {
          funcao = 'criar';
          
        }
      
        $.post('../controlador/FornecedorController.php', {id,funcao ,nome,telefone, correio, endereco},(response)=>{
      
          if (response == 'add') {
                $('#add').hide('slow');
                $('#add').show(1000);
                $('#add').hide(2000);
                $('#form-criar').trigger('reset');
                buscar_forne();
            }
            if(response=='noadd') {
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form-criar').trigger('reset');
            }
            if(response=='edit'){
                $('#edit_forne').hide('slow');
                $('#edit_forne').show(1000);
                $('#edit_forne').hide(2000);
                $('#form-criar').trigger('reset');
                buscar_forne();
            }
            edit==false;
            

        })
        e.preventDefault();
    });

    function buscar_forne(consulta) {
        funcao = 'buscar';
        $.post('../controlador/FornecedorController.php', { consulta, funcao }, (response) => {
            const fornecedores = JSON.parse(response);
            let template = '';
            fornecedores.forEach(fornecedor => {
                template += `
                <div forneId=${fornecedor.id} forneNome=${fornecedor.nome} forneTelefone=${fornecedor.telefone} forneCorreio=${fornecedor.correio} forneEndereco=${fornecedor.endereco} forneAvatar =${fornecedor.avatar} class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header text-muted border-bottom-0">
                    <h1 class="badge badge-success">Fornecedor</h1>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead">${fornecedor.nome}</h2>
                        
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Endereço: ${fornecedor.endereco}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefone : ${fornecedor.telefone}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correio : ${fornecedor.correio}</li>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="${fornecedor.avatar}" alt="" class="rounded-circle img-fluid ">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <button class="avatar btn btn-sm btn-info" title="Editar imagem" typ="button" data-toggle="modal" data-target="#mudarlogo">
                        <i class="fas fa-image"></i>
                      </button>
                      <button class="editar btn btn-sm btn-success" title="Editar Fornecedor" typ="button" data-toggle="modal" data-target="#criafornecedor">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="eliminar btn btn-sm btn-danger" title="Eliminar imagem" width="70" heigth="70">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  
                    </div>
                  </div>
                </div>
              </div>
                `;
            });

            $('#fornecedores').html(template);
        });
    }
    $(document).on('keyup', '#buscar-fornecedor', function () {
        let valor = $(this).val();
        if (valor != ""){
            buscar_forne(valor);
        }
        else {

            buscar_forne();
        }
    })


    $(document).on('click','.avatar',(e)=>{
        funcao ="mudar_logo";
        const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id =$(elemento).attr('forneId');
        const nome =$(elemento).attr('forneNome');
        const avatar =$(elemento).attr('forneAvatar');
        $('#logoatual').attr('src',avatar);
        $('#nome_logo').html(nome);
        $('#funcao').val(funcao);
        $('#id_logo_forne').val(id);
        $('#avatar').val(avatar);
    });
    
    $(document).on('click','.editar',(e)=>{
      const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id =$(elemento).attr('forneId');
      const nome =$(elemento).attr('forneNome');
      const telefone =$(elemento).attr('forneTelefone');
      const correio =$(elemento).attr('forneCorreio');
      const endereco =$(elemento).attr('forneEndereco');
      $('#id_edit_forne').val(id);
      $('#nome').val(nome);
      $('#telefone').val(telefone);
      $('#correio').val(correio);
      $('#endereco').val(endereco);
      $('#funcao').val(funcao);
      edit=true;
      buscar_forne();
    
  });
  
$('#form-logo').submit(e=>{
    let formData= new FormData($('#form-logo')[0]);
    $.ajax({
        url:'../controlador/FornecedorController.php',
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
        buscar_forne();
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
    const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id =$(elemento).attr('forneId');
    const nome =$(elemento).attr('forneNome');
    const avatar =$(elemento).attr('forneAvatar');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger mr-2'
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: 'Deseja eliminar '+nome+' ?',
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
            $.post('../controlador/FornecedorController.php',{id,funcao},(response)=>{
              console.log(response);
            edit=false;
            if(response=='eliminado'){
            swalWithBootstrapButtons.fire(
            'Eliminado!',
             'Fornecedor eliminado com sucesso.',
             'success'
          )
          buscar_forne();
            } 
        else{
              swalWithBootstrapButtons.fire(
            'Não pode ser eliminado!',
            'Fornecedor '+nome+' não pode ser eliminado porque está sendo utilizado.',
            'error'
          );
          buscar_forne();
        }
            
            })
          
        } else if (result.dismiss === Swal.DismissReason.cancel){
          swalWithBootstrapButtons.fire({
            title: "Cancelado",
            text: 'Fornecedor não eliminado',
            icon: "error"
          });
        }
      });
      
  })


});