$(document).ready(function () {
    var funcao;
    
    buscar_lote();
   
  
    function buscar_lote(consulta) {
      funcao = 'buscar';
      $.post('../controlador/LoteController.php', { consulta, funcao }, (response) => {
      //console.log(response);
        const lotes = JSON.parse(response);
        let template = '';
        lotes.forEach(lote => {
          template += `
          
          <div loteId=${lote.id} loteStock=${lote.stock} class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">`;
          if (lote.estado=='light') {
            template += `<div class="card bg-light">`
          }
          if (lote.estado=='warning') {
            template += `<div class="card bg-warning">`
          }
          if (lote.estado=='danger') {
            template += `<div class="card bg-danger">`
          }
          template +=  ` <div class="card-header text-muted border-bottom-0">
          <h6 class="lead">Código: ${lote.id}</h6>
            <i class="fas fa-lg fa-cubes m-1"></i>${lote.stock}
            </div>
            <div class="card-body pt-0">
            <div class="row">
            <div class="col-7">
            <h2 class="lead"><b>${lote.nome}</b></h2>
          
            <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span>Concentração: ${lote.concentracao}</li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span>Adicional: ${lote.adicional}</li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span>Laboratório: ${lote.laboratorio}</li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span>Tipo: ${lote.tipo}</li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span>Apresentação:<b> ${lote.apresentacao}</b></li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span>Fornecedor: ${lote.fornecedor}</li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-times"></i></span>Data de vencimento:<b> ${lote.vencimento}</b></li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span>Mês: ${lote.mes}</li>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-day"></i></span>Dia: ${lote.dia}</li>
            </ul>
            </div>
            <div class="col-5 text-center">
            <img src="${lote.avatar}" alt="" class="img-circle img-fluid">
            </div>
            </div>
            </div>
            <div class="card-footer">
            <div class="text-light">
            
            <button class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#editarlote">
            <i class="fas fa-pencil-alt"></i>
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
        $('#lotes').html(template);
      });
    }
  
    $(document).on('keyup', '#buscar-lote', function () {
      let valor = $(this).val();
    
      if (valor != "") {
        buscar_lote(valor);
      }
      else {
  
        buscar_lote();
      }
    })
  

    $(document).on('click','.editar', (e)=>{
      const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id = $(elemento).attr('loteId');
      const stock = $(elemento).attr('loteStock');
     
        $('#id_lote_prod').val(id);
        $('#stock').val(stock);
        $('#codigo_lote').html(id);
    });
    

    $('#form-editar-lote').submit(e=>{ 
      let id = $('#id_lote_prod').val();
      let stock = $('#stock').val();
      funcao ='editar';
      $.post('../controlador/LoteController.php', {funcao,id,stock},(response)=>{
        console.log(response);
        if (response=='edit') {
              $('#edit-lote').hide('slow');
              $('#edit-lote').show(1000);
              $('#edit-lote').hide(2000);
              $('#form-editar-lote').trigger('reset'); 
              buscar_lote();
            
        }
        if (response=='noedit') {
              $('#noedit-lote').hide('slow');
              $('#noedit-lote').show(1000);
              $('#noedit-lote').hide(2000);
              $('#form-editar-lote').trigger('reset');  
        }
    
      });
    
     e.preventDefault();
    
    })


    $(document).on('click','.eliminar',(e)=>{
      funcao ="eliminar";
      const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      const id =$(elemento).attr('loteId');
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2'
          },
          buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
          title: 'Deseja eliminar lote código '+id+' ?',
          text: "Você não poderá reverter isto!",
          showCancelButton: true,
          confirmButtonText: "Sim, eliminar!",
          cancelButtonText: "Não, cancelar!",
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
              $.post('../controlador/LoteController.php',{id,funcao},(response)=>{
              edit=false;
              if(response=='eliminado'){
              swalWithBootstrapButtons.fire(
              'Eliminado!',
               'Lote '+id+' eliminado com sucesso.',
               'success'
            )
            buscar_lote();
              } 
          else{
                swalWithBootstrapButtons.fire(
              'Não pode ser eliminado!',
              'Lote '+id+' não pode ser eliminado porque está sendo usado.',
              'error'
            );
            buscar_lote();
          }
              
              })
            
          } else if (result.dismiss === Swal.DismissReason.cancel){
            swalWithBootstrapButtons.fire({
              title: "Cancelado",
              text: 'Lote não eliminado',
              icon: "error"
            });
          }
            });
        
          })
    

  
  });
  