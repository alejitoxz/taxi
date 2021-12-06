<div class="col-md-12">
    <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">Bienvenido al contenido de la compañia</h3>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/pages/widgets.html" data-source-selector="#card-refresh-content"><i class="fas fa-sync-alt"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
                <!-- /.card-tools -->
            </div>
              <!-- /.card-header -->
            <div class="card-body">
            <div class="form-group">
                <div class="col-lg-10">
                    <div class="col-lg-2">
                    <button type="button" class="btn btn-default"  onclick="AbrirModalRegistroCompany()" style="background: rgb(87, 146, 255);width: 120px;color:#fff;"><i class="fas fa-registered"><b>&nbsp;Registrar</b></i></button>
                    </div> 
                </div>
            </div>
            <table id="tabla_company" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Compañia</th>
                          <th>NIT</th>
                          <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody id="Listadocompañias">
                    </tbody>
            </table>
            </div>
              <!-- /.card-body -->
        </div>
            <!-- /.card -->
    </div>
</div>

<form autocomplete="false" onsubmit="return false">

<div class="modal fade" id="modal_registro_company" role="dialog">

    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-primary">
        <h4 class="modal-title"><b>Registro de company</b></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO REGISTRO DE USUARIOS, CAMPOS -->
        <form class="form">

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Compañia</label>
              <input type="text" class="form-control" id="txt_ent" placeholder="Ingrese los Nombre"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">NIT</label>
              <input type="text" class="form-control" id="txt_nit" placeholder="Ingrese los Apellidos"><br>
            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Close</b></i></button>
          <button type="button" class="btn btn-primary" onclick="registrar_usuario()"><i class="fa fa-check"><b>&nbsp;Guardar</b></i></button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL PARA EDITAR REGISTRO -->
  <div class="modal fade" id="modal_editarC" role="dialog">

    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-primary">
        <h4 class="modal-title"><b>Editar Usuario</b></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO REGISTRO DE USUARIOS, CAMPOS -->
        <form class="form">

        <div class="row">
          <div class="col-md-4">
          <input type="hidden" id="id" >
          <input type="hidden" id="idPersona" >
            <div class="form-group">
              <label for="">Compañia</label>
              <input type="text" class="form-control" id="txt_com_edit" placeholder="Ingrese los Nombre"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">NIT</label>
              <input type="text" class="form-control" id="txt_nit_edit" placeholder="Ingrese los Apellidos"><br>
            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Close</b></i></button>
          <button type="button" class="btn btn-primary" onclick="modificar_company()"><i class="fa fa-check"><b>&nbsp;Modificar</b></i></button>
        </div>
      </div>
    </div>
  </div>
  </form>
<script type="text/javascript" src="../js/company.js"></script>

<script>
  $(document).ready(function(){
    listar_company();
    $("#modal_registroC").on('shown.bs.modal',function(){

    });
  });
    

</script>
