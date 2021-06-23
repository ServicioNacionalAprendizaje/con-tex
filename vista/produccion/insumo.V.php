<?php 
    session_start();
    $_SESSION['ruta_formulario']= basename( __FILE__ );
    require ("../../componente/libreria/libreria.php"); 
?>
    <script src="../../js/produccion/insumo.js"></script>
    <body onload="Enviar('CONSULTAR',null)"></body>
    <form name="frmInsumo" id="frmInsumo">
        <div class="margen" align="center">
            <label><h1>Insumo</h1></label>
            <div class="container form-group">
                <div class="row">
                    <div class="col-12 col-sm-1"></div>
                    <div class="col-12 col-sm-3">
                        <label class="col-form-label">Descripción</label>
                        <input type="text" name="txtDescripcion" id="txtDescripcion" value="" class="caja form-control" placeholder="Descripción">
                    </div>
                    <div class="col-12 col-sm-3">
                        <input type="hidden" name="hidIdInsumo" id="hidIdInsumo" value="">
                        <label class="col-form-label">Categoria</label>
                        <input type="hidden" name="hidIdCategoria" id="hidIdCategoria" value=""><br>
                        <input type="text" name="txtCategoria" id="txtCategoria" value="" class="caja form-control" placeholder="Categoria">
                    </div>
                    <div class="col-12 col-sm-2">
                        <label class="col-form-label">Cantidad</label>
                        <input type="number" name="numCantidad" id="numCantidad" value="" class="caja form-control" placeholder="Cantidad" disabled>
                    </div>
                    <div class="col-12 col-sm-2 form-group">
                        <label for="cmbEstado">Estado</label>
                        <select class="lista form-control" id="cmbEstado">
                            <option value="" selected="selected">--Seleccione--</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4"></div>
                    <div class="col-12 col-sm-2 form-group">
                        <label for="cmbOperacion">Operación</label>
                        <select class="lista form-control" id="cmbOperacion">
                            <option value="" selected="selected">--Seleccione--</option>
                            <option value="+">Adicionar</option>
                            <option value="-">Disminuir</option>
                        </select>
                    </div> 
                    <div class="col-12 col-sm-2">
                        <br>
                        <input type="number" name="numOperacion" id="numOperacion" value="" class="caja form-control" placeholder="Cantidad">
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
                                    <td align="center">Descripción</td>
                                    <td align="center">Categoria</td>
                                    <td align="center">Cantidad</td>
                                    <td align="center">Estado</td>
                                    <td align="center">Modificar</td>
                                    <td align="center">Eliminar</td>
                                </tr>
                            </thead>
                            <tbody id = "resultado">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>