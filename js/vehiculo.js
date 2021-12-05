var tableV;
function listar_vehiculo(){
    tableV = $('#tabla_vehiculo').DataTable( {
        "ordering":false,
        "paging": false,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "processing": true,
        "ajax": {
            "url": "../controlador/vehiculo/controlador_listar_vehiculo.php",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "placa" },
            { "data": "marca" },
            { "data": "modelo" },
            { "data": "entResp" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "nInterno" },
            { "data": "vMovilizacion" },
            { "data": "vSoat" },
            {"defaultContent":"<button style='font-size:13px;' type='button' class='eliminar btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editar btn btn-info'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
        
       select: true
    } );
    
}
function AbrirModalRegistroVehiculo(){
    $("#modal_registro_vehiculo").modal({backdrop:'static',keyboard:false})
    $("#modal_registro_vehiculo").modal('show');
}
function listar_ent_vehiculo(){
    $.ajax({
        "url": "../controlador/vehiculo/controlador_ent_listar.php",
        "type": "POST"
    }).done(function(resp){
        
        var data = JSON.parse(resp);
        
        var cadena="";
        if(data.length>0){
            cadena+="<option value='0'>Seleccionar</option>"; 
            for(var i=0; i < data.length; i++){
                cadena+="<option value ='"+data[i]['id']+"'>"+data[i]['entResp']+"</option>";
            }
            $("#sel_entResp_vehiculo").html(cadena);
        }else{
            cadena+="<option value='0'>No se encontraron registros</option>"; 
        }
    })
}
function listar_pro(){
    
    $.ajax({
        "url": "../controlador/vehiculo/controlador_listar_propietario.php",
        "type": "POST"
    }).done(function(resp){
        
        var data = JSON.parse(resp);
        
        var cadena="";
        
        if(data.length>0){
            cadena+="<option value='0'>Seleccionar</option>"; 
            for(var i=0; i < data.length; i++){
                cadena+="<option value ='"+data[i]['id']+"'>"+data[i]['dueno']+"</option>";
            }
            
            $("#sel_pro").html(cadena);
        }else{
            cadena+="<option value='0'>No se encontraron registros</option>"; 
        }
    })
}
function registrar_vehiculo(){
    var placa = $("#txt_pla").val();
    var marca = $("#txt_mar").val();
    var modelo = $("#txt_mod").val();
    var nInterno = $("#txt_int").val();
    var vMovilizacion = $("#txt_mov").val();
    var vSoat = $("#txt_soa").val();
    var entResp = $("#sel_entResp_vehiculo").val();
    var idPropietario = $("#sel_pro").val();

    if( placa == '' ||
        marca == '' ||
        modelo == '' ||
        nInterno == '' ||
        vMovilizacion == '' ||
        vSoat == '' ||
        entResp == '' ||
        idPropietario == ''
    ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }if(
            idPropietario == 0 ||
            entResp == 0){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }

    $.ajax({
        "url": "../controlador/vehiculo/controlador_vehiculo_registrar.php",
        "type": "POST",
        data:{
            placa:placa,
            marca:marca,
            modelo:modelo,
            nInterno:nInterno,
            vMovilizacion:vMovilizacion,
            vSoat:vSoat,
            entResp:entResp,
            idPropietario:idPropietario,
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



























function AbrirModalEditarV(){
    $("#modal_editar_V").modal({backdrop:'static',keyboard:false})
    $("#modal_editar_V").modal('show');
}

// FUNCION PARA EDITAR REGISTRO
$('#tabla_vehiculo').on('click','.editar',function(){
    var id = table.row(this).data().id;
    var placa = table.row(this).data().placa;
    var marca = table.row(this).data().marca;
    var modelo = table.row(this).data().modelo;
    var idCompañia = table.row(this).data().idCompañia;
    var idPropietario = table.row(this).data().idPropietario;
    var nInterno = table.row(this).data().nInterno;
    var vMovilizacion = table.row(this).data().vMovilizacion;
    var vSoat = table.row(this).data().vSoat;
    //levantar modal
    AbrirModalEditarV();
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
