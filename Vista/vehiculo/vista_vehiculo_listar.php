<div class="col-md-12">
    <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">Bienvenido al contenido del vehiculo</h3>

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
                    <button type="button" class="btn btn-default"  onclick="AbrirModalRegistroVehiculo()" style="background: rgb(87, 146, 255);width: 120px;color:#fff;"><i class="fas fa-registered"><b>&nbsp;Registrar</b></i></button>
                    </div> 
                </div>
            </div>
            <table id="tabla_vehiculo" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Placa</th>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Ent. Responsable</th>
                          <th>nombre</th>
                          <th>apellido</th>
                          <th>Numero Interno</th>
                          <th>Vencimiento Movilizacion</th>
                          <th>Vencimiento Soat</th>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="ListadoVehiculos">
                    </tbody>
            </table>
            </div>
              <!-- /.card-body -->
        </div>
            <!-- /.card -->
    </div>
</div>

<form autocomplete="false" onsubmit="return false">

<div class="modal fade" id="modal_registro_vehiculo" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-primary">
        <h4 class="modal-title"><b>Registro de Vehiculo</b></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO REGISTRO DE vehiculo, CAMPOS -->
        <form class="form">

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Placa</label>
              <input type="text" class="form-control" id="txt_pla" placeholder="Ingrese los Nombre"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Marca</label>
              <input type="text" class="form-control" id="txt_mar" placeholder="Ingrese los Apellidos"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Modelo</label>
              <input type="text" class="form-control" id="txt_mod" placeholder="Ingrese la cedula"><br>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Numero Interno</label>
              <input type="text" class="form-control" id="txt_int" placeholder="Ingrese los Nombre"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Vencimiento Movilizacion</label>
              <input type="date" class="form-control" id="txt_mov" placeholder="Ingrese los Apellidos"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Vencimiento Soat</label>
              <input type="date" class="form-control" id="txt_soa" placeholder="Ingrese la cedula"><br>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Entidad responsable</label>
              <select class="js-example-basic-single"  name="state" id="sel_entResp" style="width:100%; heigth: 40px;">               
              </select><br><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Dueño</label>
              <select class="js-example-basic-single"  name="state" id="sel_pro" style="width:100%; heigth: 40px;">   
              </select><br><br>
            </div>
          </div>
          
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Close</b></i></button>
          <button type="button" class="btn btn-primary" onclick="registrar_vehiculo()"><i class="fa fa-check"><b>&nbsp;Guardar</b></i></button>
        </div>
      </div>
    </div>
  </div>
  </form>
<script type="text/javascript" src="../js/vehiculo.js"></script>
<script>
  $(document).ready(function(){
    listar_vehiculo();
    //$('.js-example-basic-single').select2();
    //listar_rol();
    //listar_ent();
    //$("#modal_registro_vehiculo").on('shown.bs.modal',function(){
    //});
  });
</script>