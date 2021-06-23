<?php 
    session_start();
    $_SESSION['ruta_formulario']= basename( __FILE__ );
    include_once ("../../componente/libreria/libreria.php"); 
    
?>
<script src="../../js/seguridad/usuario.js"></script>
<body onload="Enviar('CONSULTAR',null)">
    <form name="frmUsuario" id="frmUsuario">
        <div class="margen" align="center">
            <label> 
                <h1>Usuario</h1>
            </label>
            <div class="container form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <input type="hidden" name="hidIdUsuario" id="hidIdUsuario" value="">
                        <label class="col-form-label">Usuario</label>
                        <input type="text" name="txtUsuario" id="txtUsuario" value="" placeholder="Nombre de usuario" class="caja form-control">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Contraseña</label>
                        <input type="password" class="caja form-control" name="passContrasenia" value="" id="passContrasenia" placeholder="Contraseña">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Fecha Activacion</label>
                        <input type="date" name="datFechaActivacion" id="datFechaActivacion" value="" class="caja form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <label class="col-form-label">Fecha Expiracion</label>
                        <input type="date" name="datFechaExpiracion" id="datFechaExpiracion" value="" class="caja form-control">
                    </div> <div class="col-12 col-sm-4">
                        <label class="col-form-label">Persona</label>
                        <input type="hidden" name="hidIdPersona" id="hidIdPersona" value=""><br>
                        <input type="text" name="txtPersona" id="txtPersona" value="" class="caja form-control" placeholder="Persona">
                    </div>
                    <div class="col-12 col-sm-4 form-group">
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
                                        <td align="center">Persona</td>
                                        <td align="center">Usuario</td>
                                        <td align="center">Fecha Activacion</td>
                                        <td align="center">Fecha Expiracion</td>
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