function VerificarUsuario(){
    var usu = $("#txt_usu").val();
    var con = $("#txt_con").val();

    if(usu.length==0 || con.length==0){
        return Swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
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
        var Id      = resultado[0]['id'];
        var Usuario = resultado[0]['usuario'];
        var Rol     = resultado[0]['idRol'];
        //console.log("Entra usuario",resultado[0]['rol'])
        if(resultado){
            Swal.fire("Mensaje De Confirmacion",'bienvenido al sistema', "success");
            $.ajax({
                url:'../controlador/usuario/controlador_crear_sesion.php',
                type:'post',
                data:{
                    id : Id,
                    usuario : Usuario,
                    rol : Rol
                }
            }).done(function(req){
                let timerInterval
                Swal.fire({
                title: 'Bienvenido a VisualSat',
                html: 'Cargando <b></b> milliseconds.',
                timer: 500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
                })
            });
        }else{
            Swal.fire("Mensaje De Error",'Usuaio y/o contrase\u00f1a incorrecta', "error");
        }
        

    })
}
var table;
function listar_usuario(){
    table = $('#tabla_usuario').DataTable( {
        "ordering":false,
        "paging": false,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": false ,
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
    var id = table.row(this).data().id;
    var nombres = table.row(this).data().nombre;
    var apellidos = table.row(this).data().apellido;
    var telefono = table.row(this).data().telefono;
    var cedula = table.row(this).data().cedula;
    var email = table.row(this).data().email;
    var direccion = table.row(this).data().direccion;
    var usuario = table.row(this).data().usuario;
    var clave = table.row(this).data().clave;
    var idRol = table.row(this).data().idRol;
    var idEntResp = table.row(this).data().idEntResp;
    var idPersona = table.row(this).data().idPersona;
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
    $("#sel_ent_edit").val(idEntResp).trigger('change');
    $("#idPersona").val(idPersona).trigger('change');

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
    var entResp = $("#sel_ent_edit").val();
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
        tipoRol == 0 ||
        entResp == 0){
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
        tipoRol:tipoRol,
        entResp:entResp
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
    var id = table.row(this).data().id;
    
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
        modificar_estatus(id,0);
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
                Swal.fire("Mensaje De Confirmacion",'Registro realizado', "success")
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

function listar_ent(){
    $.ajax({
        "url": "../controlador/usuario/controlador_ent_listar.php",
        "type": "POST"
    }).done(function(resp){
        
        var data = JSON.parse(resp);
        
        var cadena="";
        if(data.length>0){
            cadena+="<option value='0'>Seleccionar</option>"; 
            for(var i=0; i < data.length; i++){
                cadena+="<option value ='"+data[i]['id']+"'>"+data[i]['entResp']+"</option>";
            }
            $("#sel_ent").html(cadena);
            $("#sel_ent_edit").html(cadena);
        }else{
            cadena+="<option value='0'>No se encontraron registros</option>"; 
        }
    })
}


function registrar_usuario(){
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
    var entResp = $("#sel_ent").val();

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
        tipoRol == 0 ||
        entResp == 0){
        return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
    }
    
    if(clave != clave2){
        return Swal.fire("Mensaje De Advertencia", "Las contraseñas no coinciden", "warning");
    }

    $.ajax({
        "url": "../controlador/usuario/controlador_usuario_registro.php",
        "type": "POST",
        data:{
        nombre:nombre,
        apellido:apellido,
        cedula:cedula,
        telefono:telefono,
        email:email,
        direccion:direccion,
        usuario:usuario,
        clave:clave,
        tipoRol:tipoRol,
        entResp:entResp
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
function limpiarRegistro(){
    $("#txt_nom").val("");
    $("#txt_ape").val("");
    $("#txt_ced").val("");
    $("#txt_tel").val("");
    $("#txt_ema").val("");
    $("#txt_dir").val("");
    $("#txt_usu").val("");
    $("#txt_con").val("");
    $("#txt_rol").val("");
    $("#txt_ent").val("");
}


