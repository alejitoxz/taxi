var table;
function listar_home(){
    table = $('#tabla_alerta').DataTable( {
        "ordering":true,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": true ,
        "processing": true,
        "ajax": {
            "url": "../controlador/home/controlador_home_listar.php",
            "type": "POST"
        },"columnDefs": [
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
            }
        ],
        "columns": [
            { "data": "propietario" },
            { "data": "placa" },
            { "data": "conductor" },
            { "data": "email" },
            { "data": "vLicencia" },
            { "data": "vMovilizacion" },
            { "data": "vSoat" },
            { "data": "id" },
            { "data": "propietario"},
            { "data": "placa" },
            { "data": "conductor" },
            { "data": "email" },
            { "data": "Vencimiento" },
            { "data": "Fecha" },
            {"defaultContent":
            "</button><button style='font-size:13px;' type='button' class='enviarCorreo btn btn-success'><i class='fa fa-envelope'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } ); 
    
}

// FUNCION PARA EDITAR REGISTRO
$('#tabla_alerta').on('click','.enviarCorreo',function(){

    if(table.row(this).child.isShown()){
        var datos = table.row(this).data();
    }else{
        var datos = table.row($(this).parents('tr')).data();
    }

    var propietario = datos.propietario;
    var conductor = datos.conductor;
    var placa = datos.placa;
    var email = datos.email;
    var Vencimiento = datos.Vencimiento;
    var Fecha = datos.Fecha;

    Swal.fire({
        title: '¿Seguro desea enviar un email?',
        text: "Una vez hecho esto, se enviará un email con los datos de vencimiento del registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                "url": "../Controlador/home/controlador_home_enviar_vencimiento.php",
                "type": "POST",
                data:{
                Propietario : propietario,
                Conductor    : conductor,
                Vencimiento : Vencimiento,
                Placa       : placa,
                Email       : email,
                Fecha       : Fecha
                }
            }).done(function(resp){
                if(resp > 0){
                    Swal.fire("¡Email enviado con exito!",'Pronto recibira el email', "success")
                }else{
                    Swal.fire("Error",'No se pudo enviar el email, revise su conexion', "error");
                }
            })
        }
      })

})

// FUNCION PARA EXPORTAR REPORTE
function reporte(){
    var url = "../controlador/home/controlador_exportar_reporte.php"
    window.open(url,'_blank');
}