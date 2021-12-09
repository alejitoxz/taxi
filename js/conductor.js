var table;
function listar_conductor(){
    table = $('#tabla_conductor').DataTable( {
        "ordering":true,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": true ,
        "processing": true,
        "ajax": {
            "url": "../controlador/conductor/controlador_conductor_listar.php",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "dueno" },
            { "data": "cedula" },
            { "data": "telefono" },
            { "data": "email" },
            { "data": "direccion" },
            { "data": "eps" },
            { "data": "arl" },
            { "data": "rh" },
            { "data": "fondoPension" },
            { "data": "vLicencia" },
            { "data": "placa" },
            {"defaultContent":
            "<button style='font-size:13px;' type='button' class='eliminar btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editar btn btn-info'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
    
}
function listar_placa(){
    $.ajax({
        "url": "../controlador/conductor/controlador_placa_listar.php",
        "type": "POST"
    }).done(function(resp){
        
        var data = JSON.parse(resp);
        
        var cadena="";
        if(data.length>0){
            cadena+="<option value='0'>Seleccionar</option>"; 
            for(var i=0; i < data.length; i++){
                cadena+="<option value ='"+data[i]['id']+"'>"+data[i]['placa']+"</option>";
            }
            $("#sel_placa_vehiculo").html(cadena);
            $("#sel_placa_vehiculo_edit").html(cadena);
        }else{
            cadena+="<option value =''>No se encontraron registros</option>"; 
        }
    })
}
function AbrirModalRegistroConductor(){
    $("#modal_registro_conductor").modal({backdrop:'static',keyboard:false})
    $("#modal_registro_conductor").modal('show');
}
function buscarPersona(valor){
    $.ajax({
        url:'../controlador/conductor/controlador_buscar_persona.php',
        type:'POST',
        data:{
            valor:valor
        }
    }).done(function(resp){
    var data = JSON.parse(resp);
    if(data){
        $("#idPersonaC").val(data.data[0]['id']);
        $("#txt_nom").val(data.data[0]['nombre']);
        $("#txt_ape").val(data.data[0]['apellido']);
        $("#txt_tel").val(data.data[0]['telefono']);
        $("#txt_ema").val(data.data[0]['email']);
        $("#txt_dir").val(data.data[0]['direccion']);
    }else{
        $("#idPersonaC").val("");
        $("#txt_nom").val("");
        $("#txt_ape").val("");
        $("#txt_tel").val("");
        $("#txt_ema").val("");
        $("#txt_dir").val("");
    }
    })
}
function registrar_conductor(){

    var id = $("#idPersonaC").val();
    var nombre = $("#txt_nom").val();
    var apellido = $("#txt_ape").val();
    var cedula = $("#txt_ced").val();
    var telefono = $("#txt_tel").val();
    var email = $("#txt_ema").val();
    var direccion = $("#txt_dir").val();
    var eps = $("#txt_eps").val();
    var arl = $("#txt_arl").val();
    var rh = $("#txt_rh").val();
    var fondoPension = $("#txt_pen").val();
    var vLicencia = $("#txt_lic").val();
    var placa = $("#sel_placa_vehiculo").val();

    if( nombre == '' ||
        apellido == '' ||
        cedula == '' ||
        telefono == '' ||
        email == '' ||
        direccion == '' ||
        eps == '' ||
        arl == '' ||
        rh == '' ||
        fondoPension == '' ||
        vLicencia == '' 

        ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }
    if(
        placa == 0 ){
        return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
    }

    $.ajax({
        "url": "../controlador/conductor/controlador_conductor_registro.php",
        "type": "POST",
        data:{
        id:id,
        nombre:nombre,
        apellido:apellido,
        cedula:cedula,
        telefono:telefono,
        email:email,
        direccion:direccion,
        eps:eps,
        arl:arl,
        fondoPension:fondoPension,
        vLicencia:vLicencia,
        placa:placa,
        }
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            if(resp==1){
            $("#modal_registro_conductor").modal('hide');
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

function contarConductor(){
    $("#contadorConductor").html(0);
    $.ajax({
        url:'../controlador/conductor/controlador_contador_conductor.php',
        type:'post',
    }).done(function(req){
		var resultado=eval("("+req+")");

        if(resultado.length>0){
            $("#contadorConductor").html(resultado[0]['contadorConductor']);
         }else{
            $("#contadorConductor").html(0);
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
    $("#txt_eps").val("");
    $("#txt_arl").val("");
    $("#txt_rh").val("");
    $("#txt_pen").val("");
    $("#txt_lic").val("");
    $("#sel_placa_vehiculo").val("");
}