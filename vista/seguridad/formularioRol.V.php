<?php 
    session_start();
    $_SESSION['ruta_formulario']= basename( __FILE__ );
    require ("../../componente/libreria/libreria.php"); 
?>
    <script src="../../js/seguridad/formularioRol.js"></script>
    <body onload="Enviar('CONSULTAR',null)">
    <form name="fmrFormularioRol" id="frmFormularioRol"> 
        <div class="margen" align="center">
            <label>
                <h1>Formularios del Rol</h1>
            </label>
            <div class="container form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <input type="hidden" name="hidIdFormularioRol" id="hidIdFormularioRol" value="">
                        <input type="hidden" name="hidIdRol" id="hidIdRol" value="">
                        <label class="col-form-label">Rol</label>
                        <input type="text" name="txtRol" id="txtRol" value="" placeholder=" Rol" class="caja form-control">
                    </div>
                    <div class="col-12 col-sm-4">
                        <input type="hidden" name="hidIdFormulario" id="hidIdFormulario" value="">
                        <label class="col-form-label">Formulario</label>
                        <input type="text" name="txtFormulario" id="txtFormulario" value="" placeholder=" Formulario" class="caja form-control">
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
            <br></br>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tableDatos" class="table table-striped table-bordered table-hover"> 
                                <thead>
                                    <tr>
                                        <td align="center">Id</td>
                                        <td align="center">Rol</td>
                                        <td align="center">Formulario</td>
                                        <td align="center">Fecha Creacion</td>
                                        <td align="center">Fecha Modificacion</td>
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