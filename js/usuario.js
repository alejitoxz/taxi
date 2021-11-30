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
function listar_usuario(){
    $('#tabla_usuario').DataTable( {
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
        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "cedula" },
            { "data": "telefono" },
            { "data": "email" },
            { "data": "usuario" },
            { "data": "clave" },
            { "data": "tipoRol" },
            { "data": "entResp" },
            {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
    
}
function AbrirModalRegistro(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
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
        usuario:usuario,
        clave:clave,
        tipoRol:tipoRol,
        entResp:entResp
        }
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            if(resp==0){
            $("#modal_registro").modal('hide');
            Swal.fire("Mensaje De Confirmacion",'Registro realizado', "success").then((value)=>{
                table.ajax.reload();
            })
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
    $("#txt_usu").val("");
    $("#txt_con").val("");
    $("#txt_rol").val("");
    $("#txt_ent").val("");
}

