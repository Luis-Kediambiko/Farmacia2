$(document).ready(function(){
    var funcao = '';
    var edit = false;
    var id_usuario =$('#id_usuario').val();
    buscar_usuario(id_usuario);
    function buscar_usuario(dados){
        funcao = 'buscar_usuario';
        $.post('../controlador/UsuarioController.php',{dados,funcao},(response)=>{
            let nome='';
            let apelido='';
            let idade='';
            let dni='';
            let tipo='';
            let telefone='';
            let endereco='';
            let correio='';
            let genero='';
            let adicional='';
            const usuario = JSON.parse(response);
            console.log(response);
            nome+=`${usuario.nome}`;
            apelido+=`${usuario.apelido}`;
            idade+=`${usuario.idade}`;
            dni+=`${usuario.dni}`;
            if (usuario.tipo=='Root') {
                tipo+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
               }
               if (usuario.tipo=='Administrador') {
                tipo+=`<h1 class="badge badge-primary">${usuario.tipo}</h1>`;
               }
               if (usuario.tipo=='Técnico') {
                tipo+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
               }
            telefone+=`${usuario.telefone}`;
            endereco+=`${usuario.endereco}`;
            correio+=`${usuario.correio}`;
            genero+=`${usuario.genero}`;
            adicional+=`${usuario.adicional}`;
            $('#nome_us').html(nome);
            $('#apelido_us').html(apelido);
            $('#idade').html(idade);
            $('#dni_us').html(dni);
            $('#us_tipo').html(tipo);
            $('#telefone_us').html(telefone);
            $('#endereco_us').html(endereco);
            $('#correio_us').html(correio);
            $('#genero_us').html(genero);
            $('#adicional_us').html(adicional);
            $('#avatar2').attr('src',usuario.avatar);
            $('#avatar1').attr('src',usuario.avatar);
            $('#avatar3').attr('src',usuario.avatar);
            $('#avatar4').attr('src',usuario.avatar);   
        });
    }
    $(document).on('click','.edit',(e)=>{
        funcao='capturar_dados';
        edit = true;
        $.post('../controlador/UsuarioController.php',{funcao, id_usuario},(response)=>{
            const usuario = JSON.parse(response);
            $('#telefone').val(usuario.telefone);
            $('#endereco').val(usuario.endereco);
            $('#correio').val(usuario.correio);
            $('#genero').val(usuario.genero);
            $('#adicional').val(usuario.adicional);        
            
    })
    });

    $('#form-usuario').submit(e=>{
        if (edit==true) {
            let telefone = $('#telefone').val();
            let endereco = $('#endereco').val();
            let correio = $('#correio').val();
            let genero = $('#genero').val();
            let adicional = $('#adicional').val();
            funcao ='editar_usuario';
            $.post('../controlador/UsuarioController.php',{id_usuario,funcao,telefone,endereco,correio,genero,adicional},(response)=>{
                if(response=='editado'){
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#form-usuario').trigger('reset');
                }
                edit=false;
                buscar_usuario(id_usuario);

            })

        } else{ 
            $('#naoeditado').hide('slow');
            $('#naoeditado').show(1000);
            $('#naoeditado').hide(2000);
            $('#form-usuario').trigger('reset');
        }
        e.preventDefault();
    });


    $('#form-pass').submit(e=>{
        let oldpass=$('#oldpass').val();
        let newpass=$('#newpass').val();
        funcao ='mudar_senha';
        $.post('../controlador/UsuarioController.php', {id_usuario,funcao,oldpass,newpass},(response)=>{
            if(response=='update'){
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                $('#form-pass').trigger('reset');
            
        }
        else{
                $('#noupdate').hide('slow');
                $('#noupdate').show(1000);
                $('#noupdate').hide(2000);
                $('#form-pass').trigger('reset');
            }
        
        })
        e.preventDefault();


    });

        $('#form-photo').submit(e=>{
                let formData= new FormData($('#form-photo')[0]);
                $.ajax({
                    url:'../controlador/UsuarioController.php',
                    type:'POST',
                    data:formData,
                    cache:false,
                    processData: false,
                    contentType:false
                }).done(function(response){
                    const json = JSON.parse(response);
                    if (json.alert=='edit') {
                        $('#avatar1').attr('src',json.rota);
                        $('#edit').hide('slow');
                        $('#edit').show(1000);
                        $('#edit').hide(2000);
                        $('#form-photo').trigger('reset');  
                        buscar_usuario(id_usuario);
                    } else{
                        $('#noedit').hide('slow');
                        $('#noedit').show(1000);
                        $('#noedit').hide(2000);
                        $('#form-photo').trigger('reset');    
                    }
                    
                  
                });
                e.preventDefault();

        })


})