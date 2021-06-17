<?php 
    session_start();
    $_SESSION['ruta_formulario']= basename( __FILE__ );
    require ("../../componente/libreria/libreria.php"); 
?>
<script src="../../js/nomina/cargo.js"></script>
<body onload="Enviar('CONSULTAR',null)"></body>
    <form name="frmCargo" id="frmCargo"> 
    <div class="margen" align="center">
        <label>
            <h1>Cargo</h1>
        </label><br>
        <div class="container form-group">
            <div class="row">
                <input type="hidden" name="hidIdCargo" id="hidIdCargo" value="">
                <div class="col-12 col-sm-6">
                    <label class="col-form-label">Descripción</label>
                    <input type="text" class="caja form-control" name="txtDescripcion" value="" id="txtDescripcion"
                        placeholder="Descripción">
                </div>
                <div class="col-12 col-sm-6">
                    <label for="cmbEstado">Estado</label>
                    <select class="lista form-control" id="cmbEstado">
                        <option value="" selected="selected">--Seleccione--</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-sm-center">
                <div>
                    <input type="hidden" class="boton form-control btn-light btn-outline-primary" name="btnBuscar" id="btnBuscar" value="BUSCAR" placeholder="Código del empleado" onclick="Enviar('CONSULTAR',null);">
                </div>
                <div class="col-12 col-sm-2">
                    <input type="button" class="boton form-control btn-light btn-outline-primary" name="btnRegistrar" value="REGISTRAR" id="btnRegistrar" placeholder="Descripción" onclick=" Enviar('ADICIONAR',null);">
                </div>
                <div class="col-12 col-sm-2">
                    <input type="button" class="boton form-control btn-light btn-outline-primary" name="btnModificar" value="MODIFICAR" id="btnModificar" placeholder="Modificar" onclick=" Enviar('MODIFICAR',null);">
                </div>
                <div class="col-12 col-sm-2">
                    <input type="button" class="boton form-control btn-light btn-outline-primary" name="btnLimpiar" value="LIMPIAR" id="btnLimpiar" placeholder="Limpiar" onclick=" Limpiar();">
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table id="tableDatos" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td align="center">Descripción</td>
                                    <td align="center">Estado</td>
                                    <td align="center">Modificar</td>
                                    <td align="center">Eliminar</td>
                                </tr>
                            </thead>
                            <tbody id="resultado">
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    </form>
</body>