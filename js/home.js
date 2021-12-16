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