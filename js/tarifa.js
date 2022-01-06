var table;
function listar_tarifa(){
    table = $('#tabla_tarifa').DataTable( {
        "ordering":true,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": true ,
        "processing": true,
        "ajax": {
            "url": "../controlador/tarifa/controlador_tarifa_listar.php",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "concepto" },
            { "data": "tarifa" },
            {"defaultContent":
            "<button style='font-size:13px;' type='button' class='eliminarc btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editarc btn btn-info'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
    
}
function AbrirModalRegistroTarifa(){
    $("#modal_registro_tarifa").modal({backdrop:'static',keyboard:false})
    $("#modal_registro_tarifa").modal('show');
}

function registrar_tarifa(){

    var concepto = $("#txt_con").val();
    var tarifa = $("#txt_tar").val();

    if( concepto == '' ||
        tarifa == ''

        ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }

    $.ajax({
        "url": "../controlador/tarifa/controlador_tarifa_registro.php",
        "type": "POST",
        data:{
        concepto:concepto,
        tarifa:tarifa,
        }
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            if(resp==1){
            $("#modal_registro_tarifa").modal('hide');
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
    $("#txt_con").val("");
    $("#txt_tar").val("");
}
// FUNCION PARA ELIMINAR (ANULAR) REGISTRO
$('#tabla_tarifa').on('click','.eliminarc',function(){
    if(table.row(this).child.isShown()){
        var idtarifa = table.row(this).data().id;
    }else{
        var idtarifa = table.row($(this).parents('tr')).data().id;
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
        modificar_estatus(idtarifa,0);
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
        "url": "../controlador/tarifa/controlador_modificar_tarifa_estatus.php",
        type: "POST",
        data:{
        id:id,
        estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                    listar_tarifa();
                
            }else{
                Swal.fire("Mensaje De Advertencia",'No se pudo borrar el archivo', "warning")
            }
        }
    })
}