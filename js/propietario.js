var table;
function listar_propietario(){
    table = $('#tabla_propietario').DataTable( {
        "ordering":true,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": true ,
        "processing": true,
        "ajax": {
            "url": "../controlador/propietario/controlador_propietario_listar.php",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            }
        ],
        "columns": [
            { "data": "idPersona" },
            { "data": "id" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "cedula" },
            { "data": "telefono" },
            { "data": "email" },
            { "data": "direccion" },
            {"defaultContent":
            "<button style='font-size:13px;' type='button' class='eliminarp btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editarp btn btn-info'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
    
}

function AbrirModalRegistroPropietario(){
    $("#modal_registro_P").modal({backdrop:'static',keyboard:false})
    $("#modal_registro_P").modal('show');
}

function buscarPersonaP(valor){
    $.ajax({
        url:'../controlador/propietario/controlador_buscar_personaP.php',
        type:'POST',
        data:{
            valor:valor
        }
    }).done(function(resp){
    var data = JSON.parse(resp);
    if(data){
        $("#idPersona").val(data.data[0]['id']);
        $("#txt_nomp").val(data.data[0]['nombre']);
        $("#txt_apep").val(data.data[0]['apellido']);
        $("#txt_telp").val(data.data[0]['telefono']);
        $("#txt_emap").val(data.data[0]['email']);
        $("#txt_dirp").val(data.data[0]['direccion']);
    }else{
        $("#idPersona").val("");
        $("#txt_nomp").val("");
        $("#txt_apep").val("");
        $("#txt_telp").val("");
        $("#txt_emap").val("");
        $("#txt_dirp").val("");
    }
    })
}

function registrar_propietario(){

    var id = $("#idPersona").val();
    var nombre = $("#txt_nomp").val();
    var apellido = $("#txt_apep").val();
    var cedula = $("#txt_cedp").val();
    var telefono = $("#txt_telp").val();
    var email = $("#txt_emap").val();
    var direccion = $("#txt_dirp").val();

    if( nombre == '' ||
        apellido == '' ||
        cedula == '' ||
        telefono == '' ||
        email == '' ||
        direccion == '' 

        ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }
    

    $.ajax({
        "url": "../controlador/propietario/controlador_propietario_registro.php",
        "type": "POST",
        data:{
        id:id,
        nombre:nombre,
        apellido:apellido,
        cedula:cedula,
        telefono:telefono,
        email:email,
        direccion:direccion,
        }
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            if(resp==1){
                limpiarRegistro();
            $("#modal_registro_P").modal('hide');
            Swal.fire("Mensaje De Confirmacion",'Registro realizado', "success").then((value)=>{
                table.ajax.reload();
                
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
    $("#idPersonaP").val("");
    $("#txt_cedp").val("");
    $("#txt_nomp").val("");
    $("#txt_apep").val("");
    $("#txt_telp").val("");
    $("#txt_emap").val("");
    $("#txt_dirp").val("");
    console.log("prueba");
}
// FUNCION PARA ELIMINAR (ANULAR) REGISTRO
$('#tabla_propietario').on('click','.eliminarp',function(){
    if(table.row(this).child.isShown()){
        var idPropietario = table.row(this).data().id;
    }else{
        var idPropietario = table.row($(this).parents('tr')).data().id;
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
        modificar_estatus(idPropietario,0);
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
        "url": "../controlador/propietario/controlador_modificar_propietario_estatus.php",
        type: "POST",
        data:{
        id:id,
        estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                    listar_propietario();
                
            }else{
                Swal.fire("Mensaje De Advertencia",'No se pudo borrar el archivo', "warning")
            }
        }
    })
}

function AbrirModalEditarP(){
    $("#modal_editar_P").modal({backdrop:'static',keyboard:false})
    $("#modal_editar_P").modal('show');
}

// FUNCION PARA EDITAR REGISTRO
$('#tabla_propietario').on('click','.editarp',function(){

    if(table.row(this).child.isShown()){
        var datosPropietario = table.row(this).data();
    }else{
        var datosPropietario = table.row($(this).parents('tr')).data();
    }

    var id = datosPropietario.id;
    var nombres = datosPropietario.nombre;
    var apellidos = datosPropietario.apellido;
    var telefono = datosPropietario.telefono;
    var cedula = datosPropietario.cedula;
    var email = datosPropietario.email;
    var direccion = datosPropietario.direccion;
    var idPersona = datosPropietario.idPersona;
    //levantar modal
    AbrirModalEditarP();
    //ingresas datos modal
    $("#id").val(id);
    $("#txt_nomp_edit").val(nombres);
    $("#txt_apep_edit").val(apellidos);
    $("#txt_cedp_edit").val(cedula);
    $("#txt_telp_edit").val(telefono);
    $("#txt_emap_edit").val(email);
    $("#txt_dirp_edit").val(direccion);
    $("#idPersona").val(idPersona);

})
function modificar_propietario(){
    var id = $("#id").val();
    var nombre = $("#txt_nomp_edit").val();
    var apellido = $("#txt_apep_edit").val();
    var cedula = $("#txt_cedp_edit").val();
    var telefono = $("#txt_telp_edit").val();
    var email = $("#txt_emap_edit").val();
    var direccion = $("#txt_dirp_edit").val();
    var idPersona = $("#idPersona").val();

    if( id == ''||
        nombre == '' ||
        apellido == '' ||
        cedula == '' ||
        telefono == '' ||
        email == '' ||
        direccion == ''
        ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }
    $.ajax({
        "url": "../controlador/propietario/controlador_propietario_modificar.php",
        "type": "POST",
        data:{
        idPersona:idPersona,
        id:id,
        nombre:nombre,
        apellido:apellido,
        cedula:cedula,
        telefono:telefono,
        email:email,
        direccion:direccion
        }
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            $("#modal_editar_P").modal('hide');
            Swal.fire("Mensaje De Confirmacion",'Datos Actualizados', "success")
                .then((value)=>{
                table.ajax.reload();
            });
        
        }else{
            Swal.fire("Mensaje De Error",'No se pudo completar la edicion', "error");
        }
    })
}

function contarPropietario(){
    $("#contadorPropietario").html(0);
    $.ajax({
        url:'../controlador/propietario/controlador_contador_propietario.php',
        type:'post',
    }).done(function(req){
		var resultado=eval("("+req+")");

        if(resultado.length>0){
            $("#contadorPropietario").html(resultado[0]['contadorPropietario']);
         }else{
            $("#contadorPropietario").html(0);
         }
            
            
    })
}