<?php 
    session_start();
    $_SESSION['ruta_formulario']= basename( __FILE__ );
    require ("../../componente/libreria/libreria.php"); 
?>
    <script src="../../js/nomina/pagoDia.js"></script>
    <body onload="Enviar('CONSULTAR',null)">
    <form name="frmPagoDia" id="frmPagoDia">
        <div class="margen" align="center">
            <label>
                <h1>Registro pago del día</h1>
            </label>
            <div class="container form-group">
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <input type="hidden" name="hidIdPagoDia" id="hidIdPagoDia" value="">
                        <input type="hidden" name="hidIdEmpleado" id="hidIdEmpleado" value="">
                        <label class="col-form-label">Nombre empleado</label>
                        <input type="text" name="txtEmpleado" id="txtEmpleado" value="" class="caja form-control" placeholder="Empleado">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label class="col-form-label">Valor pago día</label>
                        <input type="number" class="caja form-control" name="numPagoDia" value="" id="numPagoDia"
                            placeholder="Pago día">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label class="col-form-label">Fecha pago</label>
                        <input type="date" class="caja form-control" name="datFechaPago" value="" id="datFechaPago"
                            placeholder="Fecha Pago">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label for="cmbEstado">Estado</label>
                        <select class="lista form-control" id="cmbEstado">
                            <option value="" selected="selected">--Seleccione--</option>
                            <option value="1">Pagado</option>
                            <option value="0">Sin pagar</option>
                        </select>
                    </div> 
                </div>
            </div>
            <div class="row">
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
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tableDatos" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td align="center">Empleado</td>
                                        <td align="center">Pago día</td>
                                        <td align="center">Fecha</td>
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