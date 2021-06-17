<?php 
    session_start();
    $_SESSION['ruta_formulario']= basename( __FILE__ );
    require ("../../componente/libreria/libreria.php"); 
?>
<script src="../../js/nomina/empleado.js"></script>
<body onload="Enviar('CONSULTAR',null)">
    <form name="frmEmpleado" id="frmEmpleado">
    <div class="margen" align="center">
        <label>
            <h1>Empleado</h1>
        </label><br>
        <div class="container form-group">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <input type="hidden" name="hidIdEmpleado" id="hidIdEmpleado" value="">
                    <label class="col-form-label">Cargo</label>
                    <input type="hidden" name="hidIdCargo" id="hidIdCargo" value=""><br>
                    <input type="text" name="txtCargo" id="txtCargo" value="" class="caja form-control" placeholder="Cargo">
                </div>
                <div class="col-12 col-sm-4">
                    <label class="col-form-label">Correo institucional</label>
                    <input type="email" name="txtCorreoInstitucional" id="txtCorreoInstitucional" value="" class="caja form-control"
                        placeholder="Correo">
                </div>
                <div class="col-12 col-sm-4">
                    <label class="col-form-label">Fecha ingreso</label>
                    <input type="date" name="datFechaIngreso" id="datFechaIngreso" value="" class="caja form-control"
                        placeholder="Fecha ingreso">
                </div>
                <div class="col-12 col-sm-4">
                    <label class="col-form-label">ARL</label>
                    <select class="lista form-control" id="cmbArl">
                        <option value="" selected="selected">--Seleccione--</option>
                        <option value="Equidad Seguros">Equidad Seguros</option>
                        <option value="Seguros Bolivar">Seguros Bolivar</option>
                        <option value="Sura">Sura</option>
                    </select>
                </div>
                <div class="col-12 col-sm-4">
                    <label class="col-form-label">Salud</label>
                    <select class="lista form-control" id="cmbSalud">
                        <option value="" selected="selected">--Seleccione--</option>
                        <option value="Comfamiliar">Comfamiliar</option>
                        <option value="Nueva Eps">Nueva Eps</option>
                        <option value="Sanitas">Sanitas</option>
                    </select>
                </div>
                <div class="col-12 col-sm-4">
                    <label class="col-form-label">Pensión</label>
                        <select class="lista form-control" id="cmbPension">
                            <option value="" selected="selected">--Seleccione--</option>
                            <option value="Colpesiones">Colpesiones</option>
                            <option value="Porvenir">Porvenir</option>
                            <option value="Proteccion">Proteccion</option>
                        </select>
                </div>
                <div class="col-12 col-sm-4">
                    <label class="col-form-label">Persona</label>
                    <input type="hidden" name="hidIdPersona" id="hidIdPersona" value=""><br>
                    <input type="text" name="txtPersona" id="txtPersona" value="" class="caja form-control" placeholder="Persona">
                </div>
                <div class="col-12 col-sm-4">
                    <label class="col-form-label">Sueldo básico</label>
                    <input type="number" name="numSueldoBasico" id="numSueldoBasico" value="" class="caja form-control"
                        placeholder="Sueldo básico">
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
            <br></br>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tableDatos" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td align="center">Persona</td>
                                        <td align="center">Cargo</td>
                                        <td align="center">Correo institucional</td>
                                        <td align="center">Fecha ingreso</td>
                                        <td align="center">ARL</td>
                                        <td align="center">Salud</td>
                                        <td align="center">Pensión</td>
                                        <td align="center">Sueldo básico</td>
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
        </div>
    </div>
</form>
</body>