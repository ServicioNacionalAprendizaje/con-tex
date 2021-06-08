<?php include_once ("../../componente/libreria/libreria.php"); ?>
<script src="../../js/produccion/tarea.js"></script>
<body onload="Enviar('CONSULTAR',null)">
    <form name="frmTarea" id="frmTarea">
        <div class="margen" align="center">
            <h1><label>Tarea</label></h1>
            <div class="container form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <input type="hidden" name="hidIdTarea" id="hidIdTarea" value="">
                        <label class="col-form-label">Nombre empleado</label>
                        <input type="hidden" name="hidIdEmpleado" id="hidIdEmpleado" value="">
                        <input type="text" name="txtEmpleado" id="txtEmpleado" value="" class="caja form-control" placeholder="Empleado">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Valor unitario</label>
                        <input type="number" class="caja form-control" name="numValorUnitario" value="" id="numValorUnitario" placeholder="Valor unitario">
                    </div>
                        <div class="col-12 col-sm-4">
                            <label class="col-form-label">Fecha</label>
                            <input type="date" name="datFecha" id="datFecha" value=""
                                class="caja form-control" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="col-form-label">Cantidad</label>
                            <input type="number" class="caja form-control" name="numCantidad" value="" id="numCantidad"
                                placeholder="Cantidad">
                        </div>
                    <div class="col-12 col-sm-4">
                        <label for="cmbEstadoPago">Estado Pago</label>
                        <select class="lista form-control" id="cmbEstadoPago">
                            <option value="" selected="selected">--Seleccione--</option>
                            <option value="Pagado">Pagado</option>
                            <option value="Por pagar">Por pagar</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-4">
                            <label class="col-form-label">Descripción</label>
                            <input type="text" class="caja form-control" name="txtDescripcion" value=""
                                id="txtDescripcion" placeholder="Descripción">
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label for="cmbEstado">Estado</label>
                        <select class="lista form-control" id="cmbEstado">
                            <option value="" selected="selected">--Seleccione--</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-2"></div>
                        <div class="col-12 col-sm-2">
                            <input type="button" class="boton form-control btn-light btn-outline-primary" name="btnBuscar" id="btnBuscar" value="BUSCAR" placeholder="Código del empleado" onclick="Enviar('CONSULTAR',null);">
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
                    <br></br>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table id="tableDatos" class="table table-striped table-bordered table-hover">  
                                    <thead>
                                        <tr>
                                            <td align="center">Empleado</td>
                                            <td align="center">Valor unitario</td>
                                            <td align="center">Fecha</td>
                                            <td align="center">Cantidad</td>
                                            <td align="center">Estado pago</td>
                                            <td align="center">Descripción</td>
                                            <td align="center">Estado</td>
                                            <td align="center">Modificar</td>
                                            <td align="center">Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody id="resultado">
                                        <!-- <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="center"><a href="#" class="btn btn-warning"><i
                                                        class="fas fa-edit"></i></a>
                                            </td>
                                            <td align="center"><a href="#" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
    </form>
</body>