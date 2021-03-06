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
                "targets": [ 3 ],
                "visible": false
            },
            {
                "targets": [ 4 ],
                "visible": false
            },
            {
                "targets": [ 5 ],
                "visible": false
            },
            {
                "targets": [ 6 ],
                "visible": false
            },
            {
                "targets": [ 7 ],
                "visible": false
            },
            {
                "targets": [ 8 ],
                "visible": false
            },
            {
                "targets": [ 9 ],
                "visible": false
            },
            {
                "targets": [ 10 ],
                "visible": false
            },{
                "targets": [ 11 ],
                "visible": false
            } ,
            {
                "targets": [ 12 ],
                "visible": false
            },
            {
                "targets": [ 13 ],
                "visible": false
            }
            ,
            {
                "targets": [ 14 ],
                "visible": false
            }
            ,
            {
                "targets": [ 15 ],
                "visible": false
            },
            {
                "targets": [ 16 ],
                "visible": false
            }
        ],
       /* "createdRow": function( row, data, dataIndex){
            if( data[2] == ){
                $(row).addClass('table-danger');
            }
        },*/
        "columns": [
            { "data": "codigo_bar" },
            { "data": "vTecnomecanica" },
            { "data": "url_foto" },
            { "data": "nInterno" },
            { "data": "nMovilizacion" },
            { "data": "vMovilizacion" },
            { "data": "vSoat" },
            { "data": "vLicencia" },
            { "data": "eps" },
            { "data": "nit" },
            { "data": "arl" },
            { "data": "rh" },
            { "data": "entResp" },
            { "data": "fondoPension" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "idVehiculo" },
            { "data": "id" },
            { "data": "conductor" },
            { "data": "cedula" },
            { "data": "telefono" },
            { "data": "direccion" },
            { "data": "email" },
            { "data": "eps" },
            { "data": "vSeguridad" },
            { "data": "arl" },
            { "data": "rh" },
            { "data": "fondoPension" },
            { "data": "vLicencia" },
            { "data": "placa" },
            {"defaultContent":
            "<button style='font-size:13px;' type='button' class='eliminar btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editar btn btn-info'><i class='fa fa-edit'></i></button><button style='font-size:13px;' type='button' class='tarjeton btn btn-success'><i class='fa fa-file-pdf'></i></button><button style='font-size:13px;' type='button' class='barras btn btn-warning'><i class='fa fa-barcode'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
    
}
function AbrirModalEditarCon(){
    $("#modal_editar_conductor").modal({backdrop:'static',keyboard:false})
    $("#modal_editar_conductor").modal('show');
}

// FUNCION PARA EDITAR REGISTRO
$('#tabla_conductor').on('click','.editar',function(){
    
    if(table.row(this).child.isShown()){
        var datosConductor = table.row(this).data();
    }else{
        var datosConductor = table.row($(this).parents('tr')).data();
    }
    //levantar modal
    AbrirModalEditarCon();
    var id = datosConductor.id;
    var idPersonaC = datosConductor.idPersonaC;
    var nombre = datosConductor.nombre;
    var apellido = datosConductor.apellido;
    var idVehiculo = datosConductor.idVehiculo;
    var cedula = datosConductor.cedula;
    var telefono = datosConductor.telefono;
    var direccion = datosConductor.direccion;
    var email = datosConductor.email;
    var eps = datosConductor.eps;
    var vSeguridad = datosConductor.vSeguridad;
    var arl = datosConductor.arl;
    var rh = datosConductor.rh;
    var fondoPension = datosConductor.fondoPension;
    var vLicencia = datosConductor.vLicencia;
    var url_foto = datosConductor.url_foto;

    if(url_foto){
        var imagen = "imagenes/foto/foto-"+id+"."+url_foto;
    }else{
        var imagen = "imagenes/avatar.jpg";
    }
    
    //ingresas datos modal
    $("#id").val(id);
    $("#idPersonaC").val(idPersonaC);
    $("#txt_nom_edit").val(nombre);
    $("#txt_ape_edit").val(apellido);
    $("#sel_placa_vehiculo_edit").val(idVehiculo).trigger('change');
    $("#txt_ced_edit").val(cedula);
    $("#txt_tel_edit").val(telefono);
    $("#txt_dir_edit").val(direccion);
    $("#txt_ema_edit").val(email);
    $("#txt_eps_edit").val(eps);
    $("#txt_vSeguridad_edit").val(vSeguridad);
    $("#txt_arl_edit").val(arl);
    $("#txt_rh_edit").val(rh);
    $("#txt_pen_edit").val(fondoPension);
    $("#txt_lic_edit").val(vLicencia);
    $('#imagenPrevisualizacionedit').prop("src",imagen);

    
})
function modificar_datos_conductor(){

    var len = document.getElementById("fotoedit").files.length;
    lista_img = new FormData();

        for(i=0 ; i < len; i++){
        img = document.getElementById('fotoedit').files[i];
        if(!!img.type.match(/image.*/)){
            if(window.FileReader){
            img_leida = new FileReader();
            img_leida.readAsDataURL(img);
            }
        lista_img.append('img_extra[]', img);
        }
    }
    var fechaActual = moment().format('YYYY-MM-DD');

    var id = $("#id").val()
    var idPersonaC =  $("#idPersonaC").val();
    var nombre = $("#txt_nom_edit").val();
    var apellido = $("#txt_ape_edit").val();
    var idVehiculo =  $("#sel_placa_vehiculo_edit").val();
    var cedula = $("#txt_ced_edit").val();
    var telefono = $("#txt_tel_edit").val();
    var direccion = $("#txt_dir_edit").val();
    var email =  $("#txt_ema_edit").val();
    var eps = $("#txt_eps_edit").val();
    var vSeguridad = $("#txt_vSeguridad_edit").val();
    var arl = $("#txt_arl_edit").val();
    var rh = $("#txt_rh_edit").val();
    var fondoPension = $("#txt_pen_edit").val();
    var vLicencia = $("#txt_lic_edit").val();
    

    vLicenca = moment(vLicencia).format('YYYY-MM-DD');
    vSeguridad = moment(vSeguridad).format('YYYY-MM-DD');
    console.log(fechaActual+" - "+vLicenca+" - "+vSeguridad)
    if( 
        nombre == '' ||
        apellido == '' ||
        cedula == '' ||
        telefono == '' ||
        direccion == '' ||
        email == '' ||
        eps == '' ||
        arl == '' ||
        vSeguridad == '' ||
        rh == '' ||
        fondoPension == ''||
        vLicencia == ''
    ){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }if(
            idVehiculo == 0){
            return swal.fire("Mensaje De Advertencia", "llene los campos vacios", "warning");
        }
        if(email.indexOf('@', 0) == -1 || email.indexOf('.', 0) == -1) {
            $("#btnGuardarSol").prop('disabled', false);
            swal.fire("Correo no valido", "Por favor utilice un correo valido", "warning");
            return;
        }if (vLicencia < fechaActual )  {
            swal.fire("Mensaje De Advertencia", "Por favor modifique la fecha de la licencia", "warning");
            return;
        }if(vSeguridad < fechaActual )  {
            swal.fire("Mensaje De Advertencia", "Por favor modifique la fecha de seguridad", "warning");
            return;        
        }
    

    lista_img.append('id', id);
    lista_img.append('idPersonaC', idPersonaC);
    lista_img.append('nombre', nombre);
    lista_img.append('apellido', apellido);
    lista_img.append('cedula', cedula);
    lista_img.append('telefono', telefono);
    lista_img.append('email', email);
    lista_img.append('idVehiculo', idVehiculo);
    lista_img.append('eps', eps);
    lista_img.append('vSeguridad', vSeguridad);
    lista_img.append('vLicencia', vLicencia);
    lista_img.append('arl', arl);
    lista_img.append('rh', rh);
    lista_img.append('fondoPension', fondoPension);
    lista_img.append('vLicencia', vLicencia);
    lista_img.append('direccion', direccion);

  /* */

   /* $.ajax({
        "url": "../controlador/conductor/controlador_conductor_modificar.php",
        "type": "POST",
        data:{
        id:id,
        idPersonaC:idPersonaC,
        nombre:nombre,
        apellido:apellido,
        cedula:cedula,
        telefono:telefono,
        direccion:direccion,
        email:email,
        idVehiculo:idVehiculo,
        eps:eps,
        vSeguridad:vSeguridad,
        arl:arl,
        rh:rh,
        fondoPension:fondoPension,
        vLicencia:vLicencia
        }
    }).done(function(resp){*/
        $.ajax({
            "url": "../controlador/conductor/controlador_conductor_modificar.php",
            "type": "POST",
            data:lista_img,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(resp){
        if(resp > 0){
            $("#modal_editar_conductor").modal('hide');
            Swal.fire("Mensaje De Confirmacion",'Datos Actualizados', "success")
                .then((value)=>{
                $("#imagenPrevisualizacionedit").prop("src","imagenes/avatar.jpg");
                $('#fotoedit').val("");
                table.ajax.reload();
            });
        
        }else{
            Swal.fire("Mensaje De Error",'No se pudo completar la edicion', "error");
        }
    })

}

// FUNCION PARA EDITAR REGISTRO
$('#tabla_conductor').on('click','.tarjeton',function(){
    
    if(table.row(this).child.isShown()){
        var datosConductor = table.row(this).data();
    }else{
        var datosConductor = table.row($(this).parents('tr')).data();
    }
    
    var fechaActual = moment().format('YYYY-MM-DD');
    
    var dueno = datosConductor.dueno;
    var conductor = datosConductor.conductor;
    var placa = datosConductor.placa;
    var nInterno = datosConductor.nInterno;
    var nMovilizacion = datosConductor.nMovilizacion;
    var vLicencia = datosConductor.vLicencia;
    var vMovilizacion = datosConductor.vMovilizacion;
    var vSoat = datosConductor.vSoat;
    var eps = datosConductor.eps;
    var rh = datosConductor.rh;
    var arl = datosConductor.arl;
    var vSeguridad = datosConductor.vSeguridad;
    var fondoPension = datosConductor.fondoPension;
    var entResp = datosConductor.entResp;
    var nit = datosConductor.nit;
    var cedula = datosConductor.cedula;
    var cedulap = datosConductor.cedulap;
    var id = datosConductor.id;
    var url_foto = datosConductor.url_foto;
    var direccion = datosConductor.direccion;
    var tel = datosConductor.telefono;
    var vTecnomecanica = datosConductor.vTecnomecanica;
    
    // VALIDAMOS POR ROL
    if(entResp == 'INDEPENDIENTE' || entResp == 'ALCALDIA'){
        var documentito = cedulap;
    }else{
        var documentito = nit;
    }

    vLicencia = moment(vLicencia).format('YYYY-MM-DD');
    vSoat = moment(vSoat).format('YYYY-MM-DD');
    vMovilizacion = moment(vMovilizacion).format('YYYY-MM-DD');
    vSeguridad = moment(vSeguridad).format('YYYY-MM-DD');

    if (vLicencia < fechaActual )  {
        swal.fire("Mensaje De Advertencia", "Su Licencia se encuentra vencida, por favor est?? al d??a", "warning");
        return;
    } else if(vSoat < fechaActual )  {
        swal.fire("Mensaje De Advertencia", "Su Soat se encuentra vencido, por favor est?? al d??a", "warning");
        return;        
    }else if(vSeguridad < fechaActual )  {
        swal.fire("Mensaje De Advertencia", "Su Seguridad se encuentra vencido, por favor est?? al d??a", "warning");
        return;        
    }

    console.log("tel",tel);

    var url = "../controlador/tarjeton/controlador_exportar.php?dueno="+dueno+"&conductor="+conductor+"&placa="+placa
    +"&nInterno="+nInterno
    +"&nMovilizacion="+nMovilizacion
    +"&vLicencia="+vLicencia
    +"&vMovilizacion="+vMovilizacion
    +"&vSoat="+vSoat
    +"&eps="+eps
    +"&rh="+rh
    +"&arl="+arl
    +"&fondoPension="+fondoPension
    +"&entResp="+entResp
    +"&nit="+documentito
    +"&control="+cedula
    +"&id="+id
    +"&ext="+url_foto
    +"&tele="+tel
    +"&dir="+direccion
    +"&vTecnomecanica="+vTecnomecanica
    ;
    window.open(url,'_blank');
})

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

    var len = document.getElementById("foto").files.length;
    lista_img = new FormData();

        for(i=0 ; i < len; i++){
        img = document.getElementById('foto').files[i];
        if(!!img.type.match(/image.*/)){
            if(window.FileReader){
            img_leida = new FileReader();
            img_leida.readAsDataURL(img);
            }
        lista_img.append('img_extra[]', img);
        }
    }

    var id = $("#idPersonaC").val();
    var nombre = $("#txt_nom").val();
    var apellido = $("#txt_ape").val();
    var cedula = $("#txt_ced").val();
    var telefono = $("#txt_tel").val();
    var email = $("#txt_ema").val();
    var direccion = $("#txt_dir").val();
    var eps = $("#txt_eps").val();
    var vSeguridad = $("#txt_vSeguridad").val();
    var arl = $("#txt_arl").val();
    var rh = $("#txt_rh").val();
    var fondoPension = $("#txt_pen").val();
    var vLicencia = $("#txt_lic").val();
    var placa = $("#sel_placa_vehiculo").val();
    var fechaActual = moment().format('YYYY-MM-DD');
    lista_img.append('id', id);
    lista_img.append('nombre', nombre);
    lista_img.append('apellido', apellido);
    lista_img.append('cedula', cedula);
    lista_img.append('telefono', telefono);
    lista_img.append('email', email);
    lista_img.append('eps', eps);
    lista_img.append('vSeguridad', vSeguridad);
    lista_img.append('vLicencia', vLicencia);
    lista_img.append('arl', arl);
    lista_img.append('rh', rh);
    lista_img.append('placa', placa);
    lista_img.append('fondoPension', fondoPension);
    lista_img.append('vLicencia', vLicencia);
    lista_img.append('direccion', direccion);

    vLicencia = moment(vLicencia).format('YYYY-MM-DD');
    vSeguridad = moment(vSeguridad).format('YYYY-MM-DD');

   if( nombre == '' ||
        apellido == '' ||
        cedula == '' ||
        telefono == '' ||
        email == '' ||
        direccion == '' ||
        eps == '' ||
        vSeguridad == '' ||
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
    if(email.indexOf('@', 0) == -1 || email.indexOf('.', 0) == -1) {
        $("#btnGuardarSol").prop('disabled', false);
        swal.fire("Correo no valido", "Por favor utilice un correo valido", "warning");
        return;
    }if (vLicencia < fechaActual )  {
            swal.fire("Mensaje De Advertencia", "Por favor modifique la fecha de la licencia", "warning");
            return;
        }if(vSeguridad < fechaActual )  {
            swal.fire("Mensaje De Advertencia", "Por favor modifique la fecha de seguridad", "warning");
            return;        
        }


    $.ajax({
        "url": "../controlador/conductor/controlador_conductor_registro.php",
        "type": "POST",
        data:lista_img,
        cache: false,
        contentType: false,
        processData: false
    }).done(function(resp){
        console.log(resp);
        if(resp > 0){
            if(resp==1){
            $("#modal_registro_conductor").modal('hide');
            Swal.fire("Mensaje De Confirmacion",'Registro realizado', "success").then((value)=>{
                $("#imagenPrevisualizacion").prop("src","imagenes/avatar.jpg");
                $('#foto').val("");
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
    $("#txt_vSeguridad").val("");
    $("#txt_rh").val("");
    $("#txt_pen").val("");
    $("#txt_lic").val("");
    $("#sel_placa_vehiculo").val(0).trigger('change');
}
// FUNCION PARA ELIMINAR (ANULAR) REGISTRO
$('#tabla_conductor').on('click','.eliminar',function(){
    if(table.row(this).child.isShown()){
        var idConductor = table.row(this).data().id;
    }else{
        var idConductor = table.row($(this).parents('tr')).data().id;
    }
    Swal.fire({
        title: '??Seguro desea eliminar el registro?',
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
        modificar_estatus(idConductor,0);
          Swal.fire(
            'Eliminado',
            '??Tu registro ha sido eliminado!',
            'success'
          )
        }
      })
    
})
function modificar_estatus(id,estatus){
    $.ajax({
        "url": "../controlador/conductor/controlador_modificar_conductor_estatus.php",
        type: "POST",
        data:{
        id:id,
        estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                    listar_conductor();
                
            }else{
                Swal.fire("Mensaje De Advertencia",'No se pudo borrar el archivo', "warning")
            }
        }
    })
}

function editarVencimiento(){
    $("#modal_editar_vencimientos").modal({backdrop:'static',keyboard:false})
    $("#modal_editar_vencimientos").modal('show');
}

function listar_con(){
    
    $.ajax({
        "url": "../controlador/conductor/controlador_listar_conductor.php",
        "type": "POST"
    }).done(function(resp){
        
        var data = JSON.parse(resp);
        
        var cadena="";
        
        if(data.length>0){
            cadena+="<option value='0'>Seleccionar</option>"; 
            for(var i=0; i < data.length; i++){
                cadena+="<option value ='"+data[i]['id']+"'>"+data[i]['dueno']+"</option>";
            }
            
            $("#sel_conductor").html(cadena);
        }else{
            cadena+="<option value='0'>No se encontraron registros</option>"; 
        }
    })
}
// FUNCION PARA EDITAR REGISTRO
$('#tabla_conductor').on('click','.barras',function(){
    
    if(table.row(this).child.isShown()){
        var datosConductor = table.row(this).data();
    }else{
        var datosConductor = table.row($(this).parents('tr')).data();
    }
    
    var fechaActual = moment().format('YYYY-MM-DD');
    var vLicencia = datosConductor.vLicencia;
    var vMovilizacion = datosConductor.vMovilizacion;
    var vSoat = datosConductor.vSoat;
    var vSeguridad = datosConductor.vSeguridad;
    var codigo_bar = datosConductor.codigo_bar;

    vLicencia = moment(vLicencia).format('YYYY-MM-DD');
    vSoat = moment(vSoat).format('YYYY-MM-DD');
    vMovilizacion = moment(vMovilizacion).format('YYYY-MM-DD');
    vSeguridad = moment(vSeguridad).format('YYYY-MM-DD');

    if (vLicencia < fechaActual )  {
        swal.fire("Mensaje De Advertencia", "Su Licencia se encuentra vencida, por favor est?? al d??a", "warning");
        return;
    } else if(vSoat < fechaActual )  {
        swal.fire("Mensaje De Advertencia", "Su Soat se encuentra vencido, por favor est?? al d??a", "warning");
        return;        
    }else if(vMovilizacion < fechaActual )  {
        swal.fire("Mensaje De Advertencia", "Su Movilizacion se encuentra vencido, por favor est?? al d??a", "warning");
        return;        
    }

    var url = "../controlador/barras/controlador_exportar_barras.php?vSeguridad="+vSeguridad
    +"&fechaActual="+fechaActual
    +"&codigo_bar="+codigo_bar
    ;
    window.open(url,'_blank');
})

function mayus(e) {
    e.value = e.value.toUpperCase();
    //e.value = e.value.toLowerCase(); minuscula
  }