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
// FUNCION PARA EXPORTAR REPORTE
    function reporte(){
    
    var datosConductor = table.row().data();
        
    
    var nombres = datosConductor.nombres;
    var placa = datosConductor.placa;
    var conductor = datosConductor.conductor;
    var vLicencia = datosConductor.vLicencia;
    var vMovilizacion = datosConductor.vMovilizacion;
    var vSoat = datosConductor.vSoat;

    var url = "../controlador/REPORTE/controlador_exportar_reporte.php?nombres="+nombres+"&placa="+placa
    +"&placa="+placa
    +"&vLicencia="+vLicencia
    +"&vMovilizacion="+vMovilizacion
    +"&vSoat="+vSoat
    +"&conductor="+conductor
    window.open(url,'_blank');
}