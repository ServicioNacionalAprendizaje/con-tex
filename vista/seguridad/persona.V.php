<?php 
    session_start();
    $_SESSION['ruta_formulario']= basename( __FILE__ );
    require ("../../componente/libreria/libreria.php"); 
?>
<script src="../../js/seguridad/persona.js"></script>
<body onload="Enviar('CONSULTAR',null)">
    <form name="frmPersona" id="frmPersona"> 
    <div class="margen" align="center">
        <label>
            <h1>Persona</h1>
        </label><br>
        <div class="container form-group">
            <div class="row">
                <div class="col-12 col-sm-3">
                    <input type="hidden" name="hidIdPersona" id="hidIdPersona" value="">
                    <label class="col-form-label">Nombre</label>
                    <input type="text" name="txtNombre" id="txtNombre" value="" class="caja form-control"
                        placeholder="Nombre">
                </div>
                <div class="col-12 col-sm-3">
                    <label class="col-form-label">Apellido</label>                    
                    <input type="text" name="txtApellido" id="txtApellido" value="" class="caja form-control"
                        placeholder="Apellido">
                </div>
                <div class="col-12 col-sm-3">
                    <label for="cmbEstado">Tipo de documento</label>
                    <select class="lista form-control" id="cmbTipoDocumento">
                        <option value="" selected="selected">--Seleccione--</option>
                        <option value="CC">Cedula de ciudadania - CC</option>
                        <option value="TI">Tarjeta de identidad - TI</option>
                        <option value="CE">Cedula de extranjeria - CE</option>
                        <option value="PEP">Permiso especial de permanencia - PEP</option>
                    </select>
                </div>
                <div class="col-12 col-sm-3">
                    <label class="col-form-label">Nº Documento</label>
                    <input type="number" name="numDocumento" id="numDocumento" value="" class="caja form-control"
                        placeholder="Documento">
                </div>
                <div class="col-12 col-sm-2"></div>
                <div class="col-12 col-sm-2">
                    <label class="col-form-label">Edad</label>
                    <input type="number" name="numEdad" id="numEdad" value="" class="caja form-control"
                        placeholder="Edad">
                </div>
                <div class="col-12 col-sm-3">
                    <label for="cmbGenero">Genero</label>
                    <select class="lista form-control" id="cmbGenero">
                        <option value="" selected="selected">--Seleccione--</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otro</option>
                    </select>
                </div>
                <div class="col-12 col-sm-3">
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
                                <td align="center">Nombre</td>
                                <td align="center">Apellido</td>
                                <td align="center">Tipo de doc</td>
                                <td align="center">Documento</td>
                                <td align="center">Edad</td>
                                <td align="center">Genero</td>
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