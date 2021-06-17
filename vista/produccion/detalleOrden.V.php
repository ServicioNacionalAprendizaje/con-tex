<?php 
    session_start();
    $_SESSION['ruta_formulario']= basename( __FILE__ );
    require ("../../componente/libreria/libreria.php"); 
?>
<script src="../../js/produccion/detalleOrden.js"></script>
<body onload="Enviar('CONSULTAR',null)">
    <form name="frmDetalleO" id="frmDetalleO">
        <div class="margen" align="center">
            <h1>Detalles de orden</h1>
            <div class="container form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Id de Orden</label>
                        <input type="hidden" name="hidIdDetalleOrden" id="hidIdDetalleOrden" value=""><br>
                        <input type="number" name="idOrden" id="idOrden" value="" class="caja form-control"
                            placeholder="Orden">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Producto</label>
                        <input type="hidden" name="hidIdProducto" id="hidIdProducto" value=""><br>
                        <input type="text" name="txtProducto" id="txtProducto" value="" class="caja form-control"
                            placeholder="Producto">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Cantidad</label>
                        <input type="number" name="numCantidad" id="numCantidad" value="" class="caja form-control"
                            placeholder="Cantidad">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Valor inventario</label>
                        <input type="number" class="caja form-control" name="numValorinven" value="" id="numValorinven"
                            placeholder="Valor inventario">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Valor venta</label>
                        <input type="number" class="caja form-control" name="numValorventa" value="" id="numValorventa"
                            placeholder="Valor venta">
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
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table id="tableDatos" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td align="center">Id orden</td>
                                            <td align="center">Producto</td>
                                            <td align="center">Cantidad</td>
                                            <td align="center">Valor inventario</td>
                                            <td align="center">Valor venta</td>
                                            <td align="center">Estado</td>
                                            <td align="center">Modificar</td>
                                            <td align="center">Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody class="justify-content-sm-center" id="resultado">
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
    </form>
</body>