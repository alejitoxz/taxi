function VerificarUsuario(){

    var usu = $("#txt_usu").val();
    var con = $("#txt_con").val();

    if(usu.length == '' || con.length == ''){
        Swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        return;
    }
    $.ajax({
        url:'../controlador/usuario/controlador_verificar_usuario.php',
        type:'post',
        data:{
            user:usu,
            pass:con
        }
    }).done(function(req){
		var resultado=eval("("+req+")");
        

        if(resultado.length>0){
            if(resultado[0]['submodulos'].length > 0){
                var Id      = resultado[0]['submodulos'][0]['id'];
                var Usuario = resultado[0]['submodulos'][0]['usuario'];
                var Rol     = resultado[0]['submodulos'][0]['idRol'];
                var Company     = resultado[0]['submodulos'][0]['idCompany'];
                var Ente     = resultado[0]['submodulos'][0]['EntResp'];
            }else if(resultado[1]['submodulos'].length > 0){
                var Id      = resultado[1]['submodulos'][0]['id'];
                var Usuario = resultado[1]['submodulos'][0]['usuario'];
                var Rol     = resultado[1]['submodulos'][0]['idRol'];
                var Company     = resultado[1]['submodulos'][0]['idCompany'];
                var Ente     = resultado[1]['submodulos'][0]['EntResp'];
            }else{
                var Id      = resultado[2]['submodulos'][0]['id'];
                var Usuario = resultado[2]['submodulos'][0]['usuario'];
                var Rol     = resultado[2]['submodulos'][0]['idRol'];
                var Company     = resultado[2]['submodulos'][0]['idCompany'];
                var Ente     = resultado[2]['submodulos'][0]['EntResp'];
            }
            
            let Datos = [];
            Datos = resultado;
//console.log("Prueba",resultado);return;
            
            $.ajax({
                url:'../controlador/usuario/controlador_crear_sesion.php',
                type:'post',
                data:{
                    id : Id,
                    usuario : Usuario,
                    rol : Rol,
                    company : Company,
                    ente : Ente,
                    Datos : Datos
                }
            }).done(function(req){
                location.reload();
            });
        }else{
            Swal.fire("Mensaje De Error",'Usuaio y/o contrase\u00f1a incorrecta', "error");
        }
    })
}

function buscarPersona(valor){
    $.ajax({
        url:'../controlador/usuario/controlador_buscar_persona.php',
        type:'POST',
        data:{
            valor:valor
        }
    }).done(function(resp){
    var data = JSON.parse(resp);
    if(data){
        $("#idPersonaR").val(data.data[0]['id']);
        $("#txt_nom").val(data.data[0]['nombre']);
        $("#txt_ape").val(data.data[0]['apellido']);
        $("#txt_tel").val(data.data[0]['telefono']);
        $("#txt_ema").val(data.data[0]['email']);
        $("#txt_dir").val(data.data[0]['direccion']);
    }else{
        $("#idPersonaR").val("");
        $("#txt_nom").val("");
        $("#txt_ape").val("");
        $("#txt_tel").val("");
        $("#txt_ema").val("");
        $("#txt_dir").val("");
    }
    })
}

var table;
function listar_usuario(){
    table = $('#tabla_usuario').DataTable( {
        "ordering":true,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": true ,
        "processing": true,
        "ajax": {
            "url": "../controlador/usuario/controlador_usuario_listar.php",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            },
            {
                "targets": [ 1 ],
                "visible": false
            },
            {
                "targets": [ 2 ],
                "visible": false
            },
            {
                "targets": [ 11 ],
                "visible": false
            }
        ],
        "columns": [
            { "data": "idRol" },
            { "data": "idEntResp" },
            { "data": "idPersona" },
            { "data": "id" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "cedula" },
            { "data": "telefono" },
            { "data": "email" },
            { "data": "direccion" },
            { "data": "usuario" },
            { "data": "clave" },
            { "data": "tipoRol" },
            { "data": "entResp" },
            {"defaultContent":
            "<button style='font-size:13px;' type='button' class='eliminar btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editar btn btn-info'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
    
}
// FUNCION PARA EDITAR REGISTRO
$('#tabla_usuario').on('click','.editar',function(){

    if(table.row(this).child.isShown()){
        var datosUsuario = table.row(this).data();
    }else{
        var datosUsuario = table.row($(this).parents('tr')).data();
    }

    var id = datosUsuario.id;
    var nombres = datosUsuario.nombre;
    var apellidos = datosUsuario.apellido;
    var telefono = datosUsuario.telefono;
    var cedula = datosUsuario.cedula;
    var email = datosUsuario.email;
    var direccion = datosUsuario.direccion;
    var usuario = datosUsuario.usuario;
    var clave = datosUsuario.clave;
    var idRol = datosUsuario.idRol;
    var idPersona = datosUsuario.idPersona;
    //levantar modal
    AbrirModalEditar();
    //ingresas datos modal
    $("#id").val(id);
    $("#txt_nom_edit").val(nombres);
    $("#txt_ape_edit").val(apellidos);
    $("#txt_ced_edit").val(cedula);
    $("#txt_tel_edit").val(telefono);
    $("#txt_ema_edit").val(email);
    $("#txt_dir_edit").val(direccion);
    $("#txt_usu_edit").val(usuario);
    $("#txt_con_edit").val('');
    $("#txt_con2_edit").val('');
    $("#sel_rol_edit").val(idRol).trigger('change');
    $("#idPersona").val(idPersona);

})
function modificar_usuario(){
    var id = $("#id").val();
    var nombre = $("#txt_nom_edit").val();
    var apellido = $("#txt_ape_edit").val();
    var cedula = $("#txt_ced_edit").val();
    var telefono = $("#txt_tel_edit").val();
    var email = $("#txt_ema_edit").val();
    var direccion = $("#txt_dir_edit").val();
    var usuario = $("#txt_usu_edit").val();
    var clave = $("#txt_con_edit").val();
    var clave2 = $("#txt_con2_edit").val();
    var tipoRol = $("#sel_rol_edit").val();
    var idPersona = $("#idPersona").val();

    if( id == ''||
        nombre == '' ||
        apellido == '' ||
        cedula == '' ||
        telefono == '' ||
        email == '' ||
        direccion == '' ||
        usuario == ''
        ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }
    if(
        tipoRol == 0){
        return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
    }
    
    if(clave != clave2){
        return Swal.fire("Mensaje De Advertencia", "Las contraseñas no coinciden", "warning");
    }

    $.ajax({
        "url": "../controlador/usuario/controlador_usuario_modificar.php",
        "type": "POST",
        data:{
        idPersona:idPersona,
        id:id,
        nombre:nombre,
        apellido:apellido,
        cedula:cedula,
        telefono:telefono,
        email:email,
        direccion:direccion,
        usuario:usuario,
        clave:clave,
        tipoRol:tipoRol
        }
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            $("#modal_editar").modal('hide');
            Swal.fire("Mensaje De Confirmacion",'Datos Actualizados', "success")
                .then((value)=>{
                table.ajax.reload();
            });
        
        }else{
            Swal.fire("Mensaje De Error",'No se pudo completar la edicion', "error");
        }
    })

}

// FUNCION PARA ELIMINAR (ANULAR) REGISTRO
$('#tabla_usuario').on('click','.eliminar',function(){
    if(table.row(this).child.isShown()){
        var idUsuario = table.row(this).data().id;
    }else{
        var idUsuario = table.row($(this).parents('tr')).data().id;
    }
    Swal.fire({
        title: '¿Seguro desea eliminar el registro?',
        text: "Una vez hecho esto, se eliminara del sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
          console.log(result);
        if (result.value) {
        modificar_estatus(idUsuario,0);
          Swal.fire(
            'Eliminado',
            '¡Tu registro ha sido eliminado!',
            'success'
          )
        }
      })
    
})
function modificar_estatus(id,estatus){
    $.ajax({
        "url": "../controlador/usuario/controlador_modificar_usuario_estatus.php",
        type: "POST",
        data:{
        id:id,
        estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                    listar_usuario();
                
            }else{
                Swal.fire("Mensaje De Advertencia",'No se pudo borrar el archivo', "warning")
            }
        }
    })
}

function AbrirModalRegistro(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
}
function AbrirModalEditar(){
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
}

function listar_rol(){
    $.ajax({
        "url": "../controlador/usuario/controlador_rol_listar.php",
        "type": "POST"
    }).done(function(resp){
        
        var data = JSON.parse(resp);
        
        var cadena="";
        if(data.length>0){
            cadena+="<option value='0'>Seleccionar</option>"; 
            for(var i=0; i < data.length; i++){
                cadena+="<option value ='"+data[i]['id']+"'>"+data[i]['tipoRol']+"</option>";
            }
            $("#sel_rol").html(cadena);
            $("#sel_rol_edit").html(cadena);
        }else{
            cadena+="<option value =''>No se encontraron registros</option>"; 
        }
    })
}



function registrar_usuario(){

    var id = $("#idPersonaR").val();
    var nombre = $("#txt_nom").val();
    var apellido = $("#txt_ape").val();
    var cedula = $("#txt_ced").val();
    var telefono = $("#txt_tel").val();
    var email = $("#txt_ema").val();
    var direccion = $("#txt_dir").val();
    var usuario = $("#txt_usu").val();
    var clave = $("#txt_con").val();
    var clave2 = $("#txt_con2").val();
    var tipoRol = $("#sel_rol").val();

    if( nombre == '' ||
        apellido == '' ||
        cedula == '' ||
        telefono == '' ||
        email == '' ||
        direccion == '' ||
        usuario == '' ||
        clave == '' ||
        clave2 == ''


        ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }
    if(
        tipoRol == 0){
        return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
    }
    
    if(clave != clave2){
        return Swal.fire("Mensaje De Advertencia", "Las contraseñas no coinciden", "warning");
    }

    $.ajax({
        "url": "../controlador/usuario/controlador_usuario_registro.php",
        "type": "POST",
        data:{
        id:id,
        nombre:nombre,
        apellido:apellido,
        cedula:cedula,
        telefono:telefono,
        email:email,
        direccion:direccion,
        usuario:usuario,
        clave:clave,
        tipoRol:tipoRol
        }
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            if(resp==1){
            $("#modal_registro").modal('hide');
            Swal.fire("Mensaje De Confirmacion",'Registro realizado', "success").then((value)=>{
                table.ajax.reload();
                limpiarRegistro();
            });
        }else{
            Swal.fire("Mensaje De Advertencia",'El usuario ya se encuentra en uso', "warning");
        }
        }else{
            Swal.fire("Mensaje De Error",'No se pudo completar el Registro', "error");
        }
    })

}

function contarUsuario(){
    $("#contadorUsuario").html(0);
    $.ajax({
        url:'../controlador/usuario/controlador_contador_usuario.php',
        type:'post',
    }).done(function(req){
		var resultado=eval("("+req+")");

        if(resultado.length>0){
            $("#contadorUsuario").html(resultado[0]['contadorUsuario']);
         }else{
            $("#contadorUsuario").html(0);
         }
            
            
    })
}

function limpiarRegistro(){
    $("#txt_nom").val("");
    $("#txt_ape").val("");
    $("#txt_ced").val("");
    $("#txt_tel").val("");
    $("#txt_ema").val("");
    $("#txt_dir").val("");
    $("#txt_usu").val("");
    $("#txt_con").val("");
    $("#txt_con2").val("");
    $("#sel_rol").val(0);
}


