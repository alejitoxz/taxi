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
        },
        "columns": [
            { "data": "id" },
            { "data": "propietario"},
            { "data": "placa" },
            { "data": "conductor" },
            { "data": "cedula" },           
            { "data": "telefono" },
            { "data": "email" },
            { "data": "vLicencia" },
            { "data": "vSoat" },
            { "data": "vMovilizacion" },
            {"defaultContent":
            "<button style='font-size:13px;' type='button' class='eliminarp btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editarp btn btn-info'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
    
}