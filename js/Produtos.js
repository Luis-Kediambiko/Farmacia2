$(document).ready(function () {
  var funcao;
  var edit=false;
  $(".select2").select2();
  encher_lab_prod();
  encher_tipo_prod();
  encher_aprese_prod();
  buscar_produto();
  encher_fornecedores();
  function encher_fornecedores() {
    funcao = "encher_fornecedores";
    $.post('../controlador/FornecedorController.php', { funcao }, (response) => {
      const fornecedores = JSON.parse(response);
      let template = '';
      fornecedores.forEach(fornecedor => {
        template += `
           <option value="${fornecedor.id}">${fornecedor.nome}</option>
        `;
      });
      $('#fornecedor').html(template);
    })
  }
  function encher_lab_prod() {
    funcao = "encher_lab_prod";
    $.post('../controlador/LaboratorioController.php', { funcao }, (response) => {
      const laboratorios = JSON.parse(response);
      let template = '';
      laboratorios.forEach(laboratorio => {
        template += `
           <option value="${laboratorio.id}">${laboratorio.nome}</option>
        `;
      });
      $('#laboratorio').html(template);
    })
  }


  encher_tipo_prod();
  function encher_tipo_prod() {
    funcao = "encher_tipo_prod";
    $.post('../controlador/TipoController.php', { funcao }, (response) => {
      const tipos = JSON.parse(response);
      let template = '';
      tipos.forEach((tipo) => {
        template += `
           <option value="${tipo.id}">${tipo.nome}</option>
        `;
      });
      $('#tipo').html(template);
    });
  }


  encher_aprese_prod();
  function encher_aprese_prod() {
    funcao = "encher_aprese_prod";
    $.post('../controlador/ApresentacaoController.php', { funcao }, (response) => {
      const apresentacoes = JSON.parse(response);
      let template = '';
      apresentacoes.forEach((apresentacao) => {
        template += `
           <option value="${apresentacao.id}">${apresentacao.nome}</option>
        `;
      });
      $('#apresentacao').html(template);
    });
  }

  $('#form-criar').submit(e => {
    let id =$('#id_edit_prod').val();
    let nome = $('#nome_produto').val();
    let concentracao = $('#concentracao').val();
    let adicional = $('#adicional').val();
    let preco = $('#preco').val();
    let laboratorio = $('#laboratorio').val();
    let tipo = $('#tipo').val();
    let apresentacao = $('#apresentacao').val();
    if (edit==true) {
      funcao = "editar";
    }
    else {
      funcao = "criar";
    }
  
    $.post('../controlador/ProdutoController.php', { funcao,id, nome, concentracao, adicional, preco, laboratorio, tipo, apresentacao }, (response) => {
      if (response == 'add') {
        $('#add').hide('slow');
        $('#add').show(1000);
        $('#add').hide(2000);
        $('#form-criar').trigger('reset');
        buscar_produto();
      }
      if (response == 'edit') {
        $('#edit_prod').hide('slow');
        $('#edit_prod').show(1000);
        $('#edit_prod').hide(2000);
        $('#form-criar').trigger('reset');
        buscar_produto();
      }
      if (response == 'noadd'){
        $('#noadd').hide('slow');
        $('#noadd').show(1000);
        $('#noadd').hide(2000);
        $('#form-criar').trigger('reset');
      }
      edit=false;
      buscar_produto();
    });
    e.preventDefault();
  });

  function buscar_produto(consulta) {
    funcao = 'buscar';
    $.post('../controlador/ProdutoController.php', { consulta, funcao }, (response) => {
      const produtos = JSON.parse(response);
      let template = '';
      produtos.forEach(produto => {
        template += `
        
        <div proId="${produto.id}" proNome="${produto.nome}" proPreco="${produto.preco}" proConcentracao="${produto.concentracao}" proAdicional="${produto.adicional}" prolaboratorio="${produto.laboratorio_id}" proTipo="${produto.tipo_id}" proApresentacao="${produto.apresentacao_id}" proAvatar="${produto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
          <div class="card bg-light">
          <div class="card-header text-muted border-bottom-0">
          <i class="fas fa-lg fa-cubes m-1"></i>${produto.stock}
          </div>
          <div class="card-body pt-0">
          <div class="row">
          <div class="col-7">
          <h2 class="lead"><b>${produto.nome}</b></h2>
          <h4 class="lead"><i class="fas fa-lg fa-dollar-sign m-1"></i><b>${produto.preco}</b><b ml-1>KZ</b></h4>
          <ul class="ml-4 mb-0 fa-ul text-muted">
          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span>Concentração: ${produto.concentracao}</li>
          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span>Adicional: ${produto.adicional}</li>
          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span>Laboratório: ${produto.laboratorio}</li>
          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span>Tipo: ${produto.tipo}</li>
          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span>Apresentação:<b> ${produto.apresentacao}</b></li>
          </ul>
          </div>
          <div class="col-5 text-center">
          <img src="${produto.avatar}" alt="" class="img-circle img-fluid" style="width:300px light:300px ">
          </div>
          </div>
          </div>
          <div class="card-footer">
          <div class="text-light">
          <button class="avatar btn btn-sm bg-teal type="button" data-toggle="modal" data-target="#mudarlogo">
          <i class="fas fa-image"></i>
          </button>
          <button class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#criarproduto">
          <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="lote btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#criarlote">
          <i class="fas fa-plus-square"></i>
          </button>
          <button class="eliminar btn btn-sm btn-danger">
          <i class="fas fa-trash-alt"></i>
          </button>
          </div>
          </div>
          </div>
          </div>
        
        
        `;
      });
      $('#produtos').html(template);
    });
  }

  $(document).on('keyup', '#buscar-produto', function () {
    let valor = $(this).val();
    if (valor != "") {
      buscar_produto(valor);
    }
    else {

      buscar_produto();
    }
  })

$(document).on('click','.avatar', (e)=>{
      funcao ="mudar_avatar";
      const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id = $(elemento).attr('proId');
      const avatar = $(elemento).attr('proAvatar');
      const nome = $(elemento).attr('proNome');
      $('#funcao').val(funcao);
      $('#id_logo_prod').val(id);
      $('#avatar').val(avatar);
      $('#logoatual').attr('src',avatar);
      $('#nome_logo').html(nome);
});

$(document).on('click','.lote', (e)=>{
  const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id = $(elemento).attr('proId');
  const nome = $(elemento).attr('proNome');
  $('#id_lote_prod').val(id);
  $('#nome_produto_lote').html(nome);
});

$('#form-logo').submit(e=>{
  let formData= new FormData($('#form-logo')[0]);
  $.ajax({
      url:'../controlador/ProdutoController.php',
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
      buscar_produto();
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

$(document).on('click','.editar', (e)=>{
  const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id = $(elemento).attr('proId');
  const nome = $(elemento).attr('proNome');
  const concentracao = $(elemento).attr('proConcentracao');
  const adicional = $(elemento).attr('proAdicional');
  const preco = $(elemento).attr('proPreco');
  const laboratorio = $(elemento).attr('proLaboratorio');
  const tipo = $(elemento).attr('proTipo');
  const apresentacao = $(elemento).attr('proApresentacao');
    
    $('#id_edit_prod').val(id);
    $('#nome_produto').val(nome);
    $('#concentracao').val(concentracao);
    $('#adicional').val(adicional);
    $('#preco').val(preco);
    $('#laboratorio').val(laboratorio).trigger('change');
    $('#tipo').val(tipo).trigger('change');
    $('#apresentacao').val(apresentacao).trigger('change');
    edit = true; 
 
});


$(document).on('click','.eliminar',(e)=>{
  funcao ="eliminar";
  const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id =$(elemento).attr('proId');
  const nome =$(elemento).attr('proNome');
  const avatar =$(elemento).attr('proAvatar');
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
          $.post('../controlador/ProdutoController.php',{id,funcao},(response)=>{
          edit=false;
          if(response=='eliminado'){
          swalWithBootstrapButtons.fire(
          'Eliminado!',
           'Produto eliminado com sucesso.',
           'success'
        )
        buscar_produto();
          } 
      else{
            swalWithBootstrapButtons.fire(
          'Não pode ser eliminado!',
          'Produto '+nome+' não pode ser eliminado porque está sendo usado em um lote.',
          'error'
        );
        buscar_produto();
      }
          
          })
        
      } else if (result.dismiss === Swal.DismissReason.cancel){
        swalWithBootstrapButtons.fire({
          title: "Cancelado",
          text: 'Produto não eliminado',
          icon: "error"
        });
      }
        });
    
      })


$('#form-criar-lote').submit(e=>{
  let id_produto = $('#id_lote_prod').val();
  let fornecedor = $('#fornecedor').val();
  let stock = $('#stock').val();
  let vencimento = $('#vencimento').val();
  funcao ='criar';
  $.post('../controlador/LoteController.php', {funcao,vencimento,stock,fornecedor,id_produto},(response)=>{
    if (response=='add') {
      $('#add-lote').hide('slow');
          $('#add-lote').show(1000);
          $('#add-lote').hide(2000);
          $('#form-criar-lote').trigger('reset');  
          buscar_produto();
    }
    if (response=='Data_invalida') {
          $('#noadd-lote').hide('slow');
          $('#noadd-lote').show(1000);
          $('#noadd-lote').hide(2000);
          $('#form-criar-lote').trigger('reset');  
    }

  });

 e.preventDefault();

})


});
