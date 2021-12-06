var table;
function listar_company(){
    table = $('#tabla_company').DataTable( {
        "ordering":false,
        "paging": false,
        "searching": { "regex": true },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "processing": true,
        "ajax": {
            "url": "../controlador/company/controlador_company_listar.php",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "entResp" },
            { "data": "nit" },
            {"defaultContent":
            "<button style='font-size:13px;' type='button' class='eliminar btn btn-danger'><i class='fa fa-trash'></i></button><button style='font-size:13px;' type='button' class='editar btn btn-info'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
    
}
function AbrirModalRegistroCompany(){
    $("#modal_registro_vehiculo").modal({backdrop:'static',keyboard:false})
    $("#modal_registro_vehiculo").modal('show');
}