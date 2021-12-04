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
            {"defaultContent":"<button style='font-size:13px;' type='button' class='eliminar btn btn-danger'><i class='fa fa-trash'></i></button>"}
        ],
        "language":idioma_espanol,
        
       select: true
    } );
    
}
function AbrirModalRegistroVehiculo(){
    $("#modal_registro_vehiculo").modal({backdrop:'static',keyboard:false})
    $("#modal_registro_vehiculo").modal('show');
}