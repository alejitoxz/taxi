var table_vehiculo;
function listar_vehiculo(){
    table_vehiculo = $('#tabla_vehiculo').DataTable( {
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
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            },
            {
                "targets": [ 1 ],
                "visible": false
            }
        ],
        "columns": [
            { "data": "idEntResp" },
            { "data": "idPropietario" },
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
            {"defaultContent":
            "<button style='font-size:13px;' type='button' class='eliminarv btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editarv btn btn-info'><i class='fa fa-edit'></i></button>"}
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
    var entResp = $("#sel_entResp_vehiculo").val();
    var idPropietario = $("#sel_pro").val();
    var nInterno = $("#txt_int").val();
    var vMovilizacion = $("#txt_mov").val();
    var vSoat = $("#txt_soa").val();


    if( placa == '' ||
        marca == '' ||
        modelo == '' ||
        nInterno == '' ||
        vMovilizacion == '' ||
        vSoat == ''
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
            entResp:entResp,
            idPropietario:idPropietario,
            nInterno:nInterno,
            vMovilizacion:vMovilizacion,
            vSoat:vSoat,
            
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
// FUNCION PARA ELIMINAR (ANULAR) REGISTRO
$('#tabla_vehiculo').on('click','.eliminarv',function(){
    if(table_vehiculo.row(this).child.isShown()){
        var idVehiculo = table_vehiculo.row(this).data().id;
    }else{
        var idVehiculo = table_vehiculo.row($(this).parents('tr')).data().id;
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
        modificar_estatusV(idVehiculo,0);
          Swal.fire(
            'Eliminado',
            '¡Tu registro ha sido eliminado!',
            'success'
          )
        }
      })
});

function modificar_estatusV(id,estatus){
    $.ajax({
        "url": "../controlador/vehiculo/controlador_modificar_vehiculo_estatus.php",
        type: "POST",
        data:{
        id:id,
        estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                    listar_vehiculo();
                
            }else{
                Swal.fire("Mensaje De Advertencia",'No se pudo borrar el archivo', "warning")
            }
        }
    })
}



























function AbrirModalEditarV(){
    $("#modal_editar_V").modal({backdrop:'static',keyboard:false})
    $("#modal_editar_V").modal('show');
}

// FUNCION PARA EDITAR REGISTRO
$('#tabla_vehiculo').on('click','.editarv',function(){

    if(table_vehiculo.row(this).child.isShown()){
        var datosVehiculo = table_vehiculo.row(this).data().id;
    }else{
        var datosVehiculo = table_vehiculo.row($(this).parents('tr')).data().id;
    }
    
    var id = datosVehiculo.id;
    var placa = datosVehiculo.placa;
    var marca = datosVehiculo.marca;
    var modelo = datosVehiculo.modelo;
    var idEntResp = datosVehiculo.idEntResp;
    var idPropietario = datosVehiculo;
    var nInterno = datosVehiculo;
    var vMovilizacion = datosVehiculo;
    var vSoat = datosVehiculo;

    //levantar modal
    AbrirModalEditarV();
    //ingresas datos modal
    $("#idVehiculo").val(id);
    $("#txt_pla_edit").val(placa);
    $("#txt_mar_edit").val(marca);
    $("#txt_mod_edit").val(modelo);
    $("#sel_entResp_vehiculo").val(idEntResp).trigger('change');
    $("#sel_pro_edit").val(idPropietario).trigger('change');
    $("#txt_int_edit").val(nInterno);
    $("#txt_mov_edit").val(vMovilizacion);
    $("#txt_soa_edit").val(vSoat);

})
function modificar_vehiculo(){
    var id = $("#idVehiculo").val();
    var placa = $("#txt_pla_edit").val();
    var marca = $("#txt_mar_edit").val();
    var modelo = $("#txt_mod_edit").val();
    var entResp = $("#sel_entResp_vehiculo").val();
    var idPropietario = $("#sel_pro_edit").val();
    var nInterno = $("#txt_int_edit").val();
    var vMovilizacion = $("#txt_mov_edit").val();
    var vSoat = $("#txt_soa_edit").val();

    if( placa == '' ||
        marca == '' ||
        modelo == '' ||
        nInterno == '' ||
        vMovilizacion == '' ||
        vSoat == ''
    ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }if(
            idPropietario == 0 ||
            entResp == 0){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }

    $.ajax({
        "url": "../controlador/vehiculo/controlador_vehiculo_modificar.php",
        "type": "POST",
        data:{
        idEntResp:idEntResp,
        id:id,
        placa:placa,
        marca:marca,
        modelo:modelo,
        entResp:entResp,
        idPropietario:idPropietario,
        nInterno:nInterno,
        vMovilizacion:vMovilizacion,
        vSoat:vSoat,
            
        }
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            $("#modal_editarV").modal('hide');
            Swal.fire("Mensaje De Confirmacion",'Datos Actualizados', "success")
                .then((value)=>{
                table.ajax.reload();
            });
        
        }else{
            Swal.fire("Mensaje De Error",'No se pudo completar la edicion', "error");
        }
    })

}
