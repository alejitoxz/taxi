<div class="col-md-12">
    <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Bienvenido al contenido del conductor</h3>

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
                    <button type="button"  class="btn btn-primary"  onclick="AbrirModalRegistroConductor()" ><i class="fas fa-plus"></i> Registrar</button>                  
                    <button type="button"  class="btn btn-primary"  onclick="editarVencimiento()" ><i class="fas fa-tasks" ></i> Editar</button>
                    </div> 
                </div>
            </div>
            <table id="tabla_conductor" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th style="display:none"></th>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Cedula</th>
                          <th>Telefono</th>
                          <th>Direccion</th>
                          <th>Email</th>
                          <th>Eps</th>
                          <th>Vencimiento Seguridad</th>
                          <th>Arl</th>
                          <th>Rh</th>
                          <th>Fondo Pension</th>
                          <th>Vencimientos licencia</th>
                          <th>Vehiculo A.</th>
                          <th align="right" >Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="ListadoConductores">
                    </tbody>
            </table>
            </div>
              <!-- /.card-body -->
        </div>
            <!-- /.card -->
    </div>
</div>

<form autocomplete="false" onsubmit="return false">

<div class="modal fade" id="modal_registro_conductor" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-primary">
        <h4 class="modal-title"><b>Registro de conductor</b></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO REGISTRO DE conductor, CAMPOS -->
        <form class="form">
        
        <div class="row">
          <div class="col-md-4">
                <div class="form-group">
                    <label for="">Cedula</label>
                    <input type="text" class="form-control" id="txt_ced" placeholder="Ingrese cedula" onchange="buscarPersona(this.value)" ><br>
                </div>
            </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Nombres</label>
              <input type="hidden" id="idPersonaC">
              <input type="hidden" id="id">
              <input type="text" class="form-control" id="txt_nom" placeholder="Ingrese nombres"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Apellidos</label>
              <input type="text" class="form-control" id="txt_ape" placeholder="Ingrese apellidos"><br>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Telefono</label>
              <input type="text" class="form-control" id="txt_tel" placeholder="Ingrese telefono"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Direccion</label>
              <input type="text" class="form-control" id="txt_dir" placeholder="Ingrese direccion"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Email</label>
              <input type="text" class="form-control" id="txt_ema" placeholder="Ingrese email"><br>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Eps</label>
              <input type="text" class="form-control" id="txt_eps" placeholder="Ingrese la eps"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Vencimiento Seguridad</label>
              <input type="date" class="form-control" id="txt_vSeguridad" ><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">ARL</label>
              <input type="text" class="form-control" id="txt_arl" placeholder="Ingrese la arl"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">GS.RH</label>
              <input type="text" class="form-control" id="txt_rh" placeholder="Ingrese el RH"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Fondo Pension</label>
              <input type="text" class="form-control" id="txt_pen" placeholder="Ingrese el fondo Pension"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Vencimiento de licencia</label>
              <input type="date" class="form-control" id="txt_lic" ><br>
            </div>
          </div>
        </div>
        <div class="row">
          
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Placa del vehiculo</label>
              <select class="js-example-basic-single"  name="state" id="sel_placa_vehiculo" style="width:100%; heigth: 40px;">               
              </select><br><br>
            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> </i> Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="registrar_conductor()"><i class="fa fa-check"> </i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>


  <!-- MODAL PARA EDITAR REGISTRO -->
  <div class="modal fade" id="modal_editar_conductor" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-primary">
        <h4 class="modal-title"><b>Editar conductor</b></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO REGISTRO DE vehiculo, CAMPOS -->
        <form class="form">
        <div class="row">
          <div class="col-md-4">
                <div class="form-group">
                    <label for="">Cedula</label>
                    <input type="text" class="form-control" id="txt_ced_edit" placeholder="Ingrese cedula" onchange="buscarPersona(this.value)" ><br>
                </div>
            </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Nombres</label>
              <input type="hidden" id="idVehiculo">
              <input type="text" class="form-control" id="txt_nom_edit" placeholder="Ingrese nombres"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Apellidos</label>
              <input type="text" class="form-control" id="txt_ape_edit" placeholder="Ingrese apellidos"><br>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Telefono</label>
              <input type="text" class="form-control" id="txt_tel_edit" placeholder="Ingrese telefono"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Direccion</label>
              <input type="text" class="form-control" id="txt_dir_edit" placeholder="Ingrese direccion"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Email</label>
              <input type="text" class="form-control" id="txt_ema_edit" placeholder="Ingrese email"><br>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Eps</label>
              <input type="text" class="form-control" id="txt_eps_edit" placeholder="Ingrese la eps"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Vencimiento Seguridad</label>
              <input type="date" class="form-control" id="txt_vSeguridad_edit" placeholder="Ingrese la seguridad"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">ARL</label>
              <input type="text" class="form-control" id="txt_arl_edit" placeholder="Ingrese la arl"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">GS.RH</label>
              <input type="text" class="form-control" id="txt_rh_edit" placeholder="Ingrese el RH"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Fondo Pension</label>
              <input type="text" class="form-control" id="txt_pen_edit" placeholder="Ingrese fondo de pension"><br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Vencimiento de licencia</label>
              <input type="date" class="form-control" id="txt_lic_edit" ><br>
            </div>
          </div>
        </div>
        <div class="row">
      
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Placa del vehiculo</label>
              <select class="js-example-basic-single"  name="state" id="sel_placa_vehiculo_edit" style="width:100%; heigth: 40px;">               
              </select><br><br>
            </div>
          </div>
        </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> </i> Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="modificar_datos_conductor()"><i class="fa fa-check"> </i> Guardar</button>
        </div>
      </div>
      
    </div>
  </div>
  </form>


    <!-- MODAL PARA EDITAR REGISTRO -->
  <div class="modal fade" id="modal_editar_vencimientos" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-primary">
        <h4 class="modal-title"><b>Editar Vencimientos</b></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO REGISTRO DE vehiculo, CAMPOS -->
        <form class="form">
        <div class="form-group">
                  <label>Multiple</label>
                  <div class="bootstrap-duallistbox-container row moveonselect moveondoubleclick"> <div class="box1 col-md-6">   <label for="bootstrap-duallistbox-nonselected-list_" style="display: none;"></label>   
                  <span class="info-container">     
                  <span class="info">Empty list</span>    
                  <button type="button" class="btn btn-sm clear1" style="float:right!important;">show all</button>   
                  </span>   
                  <input class="form-control filter" type="text" placeholder="Filter">   
                  <div class="btn-group buttons">   
                  <button type="button" class="btn moveall btn-outline-secondary" title="Move all">&gt;&gt;</button>  
                  </div>   
                  <select multiple="multiple" id="bootstrap-duallistbox-nonselected-list_" name="_helper1" style="height: 102px;"></select> 
                  </div>
                  <div class="box2 col-md-6">   
                  <label for="bootstrap-duallistbox-selected-list_" style="display: none;"></label>   
                  <span class="info-container">    
                  <span class="info"></span>     
                  <button type="button" class="btn btn-sm clear2" style="float:right!important;">show all</button>   
                  </span>   
                  <input class="form-control filter" type="text" placeholder="Filter">   
                  <div class="btn-group buttons">          
                  <button type="button" class="btn removeall btn-outline-secondary" title="Remove all">&lt;&lt;</button>
                  </div>   
                  <select multiple="multiple" id="bootstrap-duallistbox-selected-list_ sel_conductor" name="_helper2" style="height: 102px;">
                  
                  </select> 
                  </div>
                  </div>
                  <select class="duallistbox" multiple="multiple" style="display: none;">
                  </select>
                </div>
        
        
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"> </i> Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="modificar_vencimientos()"><i class="fa fa-check"> </i> Guardar</button>
        </div>
      </div>
      
    </div>
  </div>



  </form>
<script type="text/javascript" src="../js/conductor.js"></script>
<script>
  $(document).ready(function(){
    listar_conductor();
    listar_con();
    $('.js-example-basic-single').select2();
    listar_placa();
    $("#modal_registro_conductor").on('shown.bs.modal',function(){
    });
  });
</script>