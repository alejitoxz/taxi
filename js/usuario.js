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
    console.log("Entra aqui");
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
            { "data": "cedula" },
            { "data": "telefono" },
            { "data": "email" },
            { "data": "usuario" },
            { "data": "idRol" },
            { "data": "idCompany" },
            {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
        ],
        "language":idioma_espanol,
       select: true
    } );
       

}