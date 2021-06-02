<?php include_once ("../../componente/libreria/libreria.php"); ?>
<body onload="Enviar('CONSULTAR',null)">
    <form name="frmCategoria" id="frmCategoria">
        <div class="margen" align="center"> 
            <h1><label>Categoria</label></h1>
            <div class="container form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <input type="hidden" name="hidIdCategoria" id="hidIdCategoria" value="">
                        <label class="col-form-label">Descripción</label>
                        <input type="text" class="caja form-control" name="txtDescripcion" id="txtDescripcion" value="" placeholder="Descripción">
                    </div>
                    <div class="col-12 col-sm-6 form-group">
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
                <div class="col-12 col-sm-3">
                    <input type="button" class="boton form-control btn-light btn-outline-primary" name="btnBuscar" id="btnBuscar" value="BUSCAR" placeholder="Código del empleado" onclick="Enviar('CONSULTAR',null);">
                </div>
                <div class="col-12 col-sm-3">
                    <input type="button" class="boton form-control btn-light btn-outline-primary" name="btnRegistrar" value="REGISTRAR" id="btnRegistrar" placeholder="Descripción" onclick="Enviar('ADICIONAR',null);">
                </div>
                <div class="col-12 col-sm-3">
                <input type="button" class="boton form-control btn-light btn-outline-primary" name="btnModificar" value="ACTUALIZAR" id="btnModificar" placeholder="Descripción" onclick=" Enviar('MODIFICAR',null);">
            </div>
            <div class="col-12 col-sm-3">
                <input type="button" class="boton form-control btn-light btn-outline-primary" name="btnLimpiar" value="LIMPIAR" id="btnLimpiar" onclick="Limpiar()" />
            </div>
            </div>
            <br></br>
            <div class="table-responsive">
                <!-- <div class="dataTables_length" id="tableDatos_length"> ==$0</div> -->
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
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <td align="center"><a href="#" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a></td>
                            <td align="center"><a href="#" class="btn btn-danger"><i
                                        class="fas fa-trash"></i></a></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
                    
        </div>
    </form>
</body>