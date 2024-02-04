$(document).ready(function () {
  RecuperarLS_carrinho();
$(document).on('click','.carrinho', (e)=>{
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('proId');
    const nome = $(elemento).attr('proNome');
    const concentracao = $(elemento).attr('proConcentracao');
    const adicional = $(elemento).attr('proAdicional');
    const preco = $(elemento).attr('proPreco');
    const laboratorio = $(elemento).attr('proLaboratorio');
    const tipo = $(elemento).attr('proTipo');
    const apresentacao = $(elemento).attr('proApresentacao');
    const avatar = $(elemento).attr('proAvatar');
    const produto={
        id: id,
        nome: nome,
        concentracao: concentracao,
        adicional: adicional,
        preco: preco,
        laboratorio: laboratorio,
        tipo: tipo,
        apresentacao: apresentacao,
        avatar: avatar,
        quantidade:1


    }
    template=`
    
            <tr prodId=${produto.id}>
            <td>${produto.id}</td>
            <td>${produto.nome}</td>
            <td>${produto.concentracao}</td>
            <td>${produto.adicional}</td>
            <td>${produto.preco}</td>
            <td><button class="eliminar-produto btn btn-danger"><i class="fas fa-times-circle"></i></button>
            </tr>
            `;
            $('#lista').append(template);
            adicionarLS(produto);
  });
  $(document).on('click','.eliminar-produto', (e)=>{
    const elemento = $(this)[0].activeElement.parentElement.parentElement;
    const id=$(elemento).attr('prodId');
     elemento.remove();
     eliminar_produto_LS(id);
  });


  $(document).on('click','#esvaziar_carrinho', (e)=>{
   $('#lista').empty();
   EliminarLS();
  });

function RecuperarLS() {
  let produtos;
  if (localStorage.getItem('produtos')===null) {
    produtos=[];
  }
  else{
    produtos= JSON.parse(localStorage.getItem('produtos'));
  }
  return produtos; 
  
}

function adicionarLS(produto) {
  let produtos;
  produtos = RecuperarLS();
  produtos.push(produto);
  localStorage.setItem('produtos', JSON.stringify(produtos));
}

function RecuperarLS_carrinho() {
  let produtos;
  produtos = RecuperarLS();
  produtos.forEach(produto => {
    template=`
  
            <tr prodId=${produto.id}>
            <td>${produto.id}</td>
            <td>${produto.nome}</td>
            <td>${produto.concentracao}</td>
            <td>${produto.adicional}</td>
            <td>${produto.preco}</td>
            <td><button class="eliminar-produto btn btn-danger"><i class="fas fa-times-circle"></i></button>
            </tr>
            `;
            $('#lista').append(template);
  });
}
function eliminar_produto_LS(id){
  let produtos;
  produtos = RecuperarLS();
  produtos.forEach(function(produto,indice){
    if (produto.id===id) {
      produtos.splice(indice,1);
    }

  });
  localStorage.setItem('produtos', JSON.stringify(produtos));
}

function EliminarLS(){
  
}



})