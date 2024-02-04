$(document).ready(function(){
    var tipo_usuario = $('#tipo_usuario').val();
    if (tipo_usuario == 2) {
      $('#button-criar').hide();
    }
    buscar_dados();
    var funcao;
    function buscar_dados(consulta) {
        funcao='pesquisar_usuario';
        $.post('../controlador/UsuarioController.php',{consulta,funcao,},(response)=>{
        const usuarios = JSON.parse(response);
        let template =''; 
       
        usuarios.forEach(usuario=>{
            template+=`<div usuarioId="${usuario.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <div class="card bg-light">
              <div class="card-header text-muted border-bottom-0">`;
               if (usuario.tipo_usuario==3) {
                template+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
               }
               if (usuario.tipo_usuario==1) {
                template+=`<h1 class="badge badge-primary">${usuario.tipo}</h1>`;
               }
               if (usuario.tipo_usuario==2) {
                template+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
               }
               
                template+=`
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b>${usuario.nome} ${usuario.apelido}</b></h2>
                    <p class="text-muted text-sm"><b>Sobre mim: </b> ${usuario.adicional} </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> DNI Usuário: ${usuario.dni}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Idade: ${usuario.idade}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Endereço: ${usuario.endereco}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefone : ${usuario.telefone}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span>Correio/E-mail: ${usuario.correio}</li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="${usuario.avatar}" alt="" class="rounded-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">`;

                if(tipo_usuario==3){
                
                      if(usuario.tipo_usuario!=3){
                      
                        template+=`
                        <button class="eliminar-usuario btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirmar">
                            <i class="fas fa-window-close mr-1"></i>Eliminar
                        </button>
                      `;
                      } 

                      if (usuario.tipo_usuario==2) {
                        template+=`
                        <button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                            <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                        </button>
                      `;
                      
                      }
                      if(usuario.tipo_usuario==1){

                        template+=`
                        <button class="descender btn btn-secondary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                            <i class="fas fa-sort-amount-down mr-1"></i>Descender
                        </button>
                      `;
                      }
                
                }
                else{
                  if(tipo_usuario==1 && usuario.tipo_usuario!=1 && usuario.tipo_usuario!=3){
                    template+=`
                    <button class="eliminar-usuario btn btn-danger" type="button" data-toggle="modal" data-target="#confirmar">
                        <i class="fas fa-window-close mr-1"></i>Eliminar
                     </button>
                  `;

                  }
                }
                
                template+=`
                </div>
              </div>
            </div>
          </div>
            `;

        })
          
            $('#usuarios').html(template);
             
            
            
            

    });


    }
    
	$(document).on('keyup','#buscar',function(){
	let valor = $(this).val();
	if(valor!=""){
		
        buscar_dados(valor);
	}

else{

	buscar_dados();
}


})

$('#form-criar').submit(e=>{

	let nome =$('#nome').val();
	let apelido=$('#apelido').val();
	let idade=$('#idade').val();
	let dni=$('#dni').val();
	let senha=$('#senha').val();
  funcao ='criar_usuario';
	$.post('../controlador/UsuarioController.php',{nome,apelido,idade,dni,senha,funcao},(response)=>{
    if(response=='add'){
      $('#add').hide('slow');
      $('#add').show(1000);
      $('#add').hide(2000);
      $('#form-criar').trigger('reset'); 
      buscar_dados();
    }
    else
    {
      $('#noadd').hide('slow');
      $('#noadd').show(1000);
      $('#noadd').hide(2000);
      $('#form-criar').trigger('reset'); 
    }
	
});
	e.preventDefault();
});

$(document).on('click','.ascender',(e)=>{
  const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id=$(elemento).attr('usuarioId');
  funcao ='ascender';
  $('#id_user').val(id);
  $('#funcao').val(funcao);
});


$(document).on('click','.descender',(e)=>{
  const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id=$(elemento).attr('usuarioId');
  funcao ='descender';
  $('#id_user').val(id);
  $('#funcao').val(funcao);
});


$(document).on('click','.eliminar-usuario',(e)=>{
  const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id=$(elemento).attr('usuarioId');
  funcao ='eliminar_usuario';
  $('#id_user').val(id);
  $('#funcao').val(funcao);
});

$('#form-confirmar').submit(e=>{
  let pass =$('#oldpass').val();
  let id_usuario =$('#id_user').val();
  funcao =$('#funcao').val();
  $.post('../controlador/UsuarioController.php',{pass,id_usuario,funcao},(response)=>{
  if (response=='ascendido' || response=='descendido' || response=='eliminado') {
      $('#confirmado').hide('slow');
      $('#confirmado').show(1000);
      $('#confirmado').hide(2000);
      $('#form-confirmar').trigger('reset'); 
  }
  else {
    $('#resgatar').hide('slow');
    $('#resgatar').show(1000);
    $('#resgatar').hide(2000);
    $('#form-confirmar').trigger('reset'); 
  }
   

    buscar_dados();

});

  e.preventDefault();
});

})