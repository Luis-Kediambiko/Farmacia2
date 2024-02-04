$(document).ready(function(){
    $('#cat_carrinho').show();
    buscar_produto();
    mostrar_lotes_risco()
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
          <h2 class="lead"><b> Código: ${produto.id}</b></h2>
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
         
          <button class="carrinho btn btn-sm btn-primary" type="button">
          <i class="fas fa-plus-square mr-2"></i>Adicionar ao carrinho
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
  });

  function mostrar_lotes_risco() {
    funcao ="buscar";
    $.post('../controlador/LoteController.php', {funcao},(response)=>{
        const lotes = JSON.parse(response);
        let template ='';
        lotes.forEach(lote=>{
            if (lote.estado=='warning') {
                template+=`
                <tr class="table-warning">
                <td>${lote.id}</td>
                <td>${lote.nome}</td>
                <td>${lote.stock}</td>
                <td>${lote.apresentacao}</td>
                <td>${lote.fornecedor}</td>
                <td>${lote.mes}</td>
                <td>${lote.dia}</td>
                </tr>
                `;    
                
            }
            
            if (lote.estado=='danger') {
                template+=`
            <tr class="table-danger">
            <td>${lote.id}</td>
            <td>${lote.nome}</td>
            <td>${lote.stock}</td>
            <td>${lote.apresentacao}</td>
            <td>${lote.fornecedor}</td>
            <td>${lote.mes}</td>
            <td>${lote.dia}</td>
            </tr>
            `;
            }
            
        });
        $('#lotes').html(template);
    })
  }

    
})