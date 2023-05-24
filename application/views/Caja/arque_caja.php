<style type="text/css">
    .panel-group {
        margin-bottom: 0px !important;
    }
    .panel {
        margin-bottom: 0px !important;
    }
</style>

        <div class="col-sm-10">
            <div class="panel panel-default">

            <div id="imprimir">
             <h2 class="text-primary text-center">Corte de caja</h2>
              <div class="row" >

            <div class="col-md-2">
              <strong>Total S.D. Q.</strong>
                 <H3 class="text-info" id="TotCD"></H3>
            </div>
             <div class="col-md-2">
              <strong>Total C.D. Q.</strong>
                 <H3 class="text-primary" id="TotSD"></H3>
            </div>
            <div class="col-md-4">
                 <input type="date" class="form-inline" id="fechaUno">
                 <input type="date" class="form-inline" id="fechaDos">
                 <button type="button" id="btnVentaCaja" name="btnVentaCaja" class="glyphicon glyphicon-search" onclick="datosArqueoCaja(); datosArqueoCajaDiv();">Movimientos</button>
             </div>
                  <div class="col-md-4">
                      <select name="selectDenom" id="selectDenom" class="col-md-3">

                          <option value="EfectivoVt">Efectivo</option>
                          <option value="¢.5">C.5</option>
                          <option value="¢.10">C.10</option>
                          <option value="¢.25">C.25</option>
                          <option value="¢.50">C.50</option>
                          <option value="¢.100">C-Q.1</option>
                          <option value="Q.1">Q.1</option>
                          <option value="Q.5"> Q.5</option>
                          <option value="Q.10">Q.10</option>
                          <option value="Q.20">Q-20</option>
                          <option value="Q.50">Q.50</option>
                          <option value="Q.100">Q-100</option>
                          <option value="Q.300">Q.200</option>
                          <option value="Venta">Monto inicial Caja</option>
                      </select>
                      <input type="text"  id="montoDen" placeholder="Monto" class="col-md-3">
                      <button type="button" id="btnAdArq" class="glyphicon glyphicon-plus" onclick="addArqueoCent()">Arqueo</button>
                      <button type="button" id="btnAdArq" class="glyphicon glyphicon-plus" onclick="addEfectCaja()">Vta. Efectivo</button>

                  </div>
        </div>

            <div class="row" >
                <div class="col-md-2">
                    <h4 class="text-primary">Ventas generales</h4>
                      <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td><span class="text-primary">Efectivo Q.</span></td>
                            <td><span class="text-info" id="TotEfect" name="TotEfect"></span></td>
                        </tr>
                        <tr>
                            <td><span class="text-primary">Tarjeta. Q.</span></h4></td>
                            <td><span class="text-primary" id="TotTarj" name="TotTarj"></span></td>
                        </tr>
                        <tr>
                            <td><span class="text-primary">Cheque. Q.</span></h4></td>
                            <td><span class="text-primary" id="TotCheque" name="TotCheque"></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <h3 class="text-warning">Contador ¢ / Q .</h3> -->
                <div class="col-md-2">
                    <h4 class="text-warning">Pagos divididos</h4>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td><span class="text-warning">Efectivo Q.</span></td>
                            <td><span class="text-warning" id="TotEfectDiv" name="TotEfectDiv">0</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-warning">Tarjeta. Q.</span></td>
                            <td><span class="text-warning" id="TotTarjDiv" name="TotTarjDiv">0</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-warning">Cheque. Q.</span></td>
                            <td><span class="text-warning" id="TotChequeDiv" name="TotChequeDiv">0</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <h4 class="text-muted">Sumas</h4>
                    <!-- <button type="button" onclick="calcularTotales();">CALCULAR</button>-->
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td><span class="text-muted">Total Efectivo Q.</span></td>
                            <td><dt class="text-muted" id="TotEfectDivT" name="TotEfectDivT">0</dt></td>
                        </tr>
                        <tr>
                            <td><span class="text-muted">Total Tarjeta. Q.</span></td>
                            <td><dt class="text-muted" id="TotTarjDivT" name="TotTarjDivT">0</dt></td>
                        </tr>
                        <tr>
                            <td><span class="text-muted">Total Cheque. Q.</span></td>
                            <td><dt class="text-muted" id="TotChequeDivT" name="TotChequeDivT">0</dt></td>
                        </tr>
                        <tr>
                            <td><span class="text-success">Descuentos. Q.</span></td>
                            <td><dt class="text-success" id="TotDesc" name="TotDesc"></dt></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <dt >Arqueo Monedas</dt>
                    <table class='table table-bordered' id="tblDenom" name="tblDenom">
                        <thead>
                        <tr>
                            <th>Monedas</th>
                            <th>Monto Q.</th>
                        </tr>
                        </thead>
                        <tbody id="contTbl" name="contTbl">
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <!-- <h3 class="text-warning">Contador ¢ / Q .</h3> -->
                        <table class="table table-bordered">
                            <dt>Totales </dt>
                            <tbody>

                            <tr>
                                <td><span>Venta Efectivo Q.</span></td>
                                <td><dt class="col-md-7" id="VtaEfectivo"></dt></td>
                            </tr>
                            <tr>
                                <td><button type="button" class="btn btn-default btn-xs" id="btnArqDen" class="btn-small" onclick="calcularDenom();">Arq. Den. Caja</button></td>
                                <td><dt class="col-md-7" id="arqDen"></dt></td>
                            </tr>
                            <tr>
                                <td><button type="button" class="btn btn-default btn-xs" id="btnTotGast" onclick="TotalGastos();">Gastos.</button></td>
                                <td><dt  class="col-md-7" id="TotGsto"></dt></td>
                            </tr>
                            <tr>
                                <td><button type="button" class="btn btn-default btn-xs" id="btnTotLiqui" onclick="TotLiquido();">Liquido.</button></td>
                                <td><dt class="col-md-7" id="TotLiq"></dt></td>
                            </tr>
                            <tr>
                                <td><button type="button" class="btn btn-default btn-xs" onclick="ArquePdfPrint();">Imprimir</button></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
           <div class="row">
               <!-- AGREGAR CONTENIDO PARA DESCRIPCIONES DE GASTOS Y CUADRAR CAJA -->
               <div class="col-md-4">
                   <dt class="align-left">Gastos</dt>
                   <tr>
                   <th> <input type="text"  id="DescGasto" placeholder="Descrip. Gasto" class="col-xs-4"></th>
                   <th> <input type="text"  id="montoGasto" placeholder="Monto Gasto" class="col-xs-4"></th>
                   <th> <button type="button" id="btnAdGsto" class="glyphicon glyphicon-plus col-xs-2" onclick="addGastoMont()"></button></th>
                   </tr>
                   <table class='table table-bordered align-left' id="tblGsto" name="tblGsto">

                       <thead>

                       <tr>
                           <th>Descripcion</th>
                           <th>Monto Q.</th>
                       </tr>
                       </thead>
                       <tbody id="bdyGsto" name="bdyGsto">
                       </tbody>
                   </table>
               </div>

               <div class="col-md-8">
                   <textarea name="commentCorCaja" id="commentCorCaja"  placeholder="Comentario" cols="70" rows="6"></textarea>
               </div>

            </div>

             </div><!--fin del div para imprir-->
                 <div class="row">
                  <div class="col-sm-6">
                      <h3 class="text-info">Ventas generales</h3>
                      <div class="pre-scrollable" style="height:30%;">
                          <div id="listaVentUno">
                          </div>
                      </div><br>
                  </div>
                  <div class="col-sm-6">
                      <h3 class="text-warning">Pagos Divididos</h3>
                      <div class="pre-scrollable" style="height:30%;">
                          <div id="listaVentDos">
                          </div>
                      </div><br>
                  </div>
            </div>
                <!--  </div>-->
            </div>
      <!--finaliza rows de botones R de Leon-->
        </div>
        <!-- </div>
    </div>-->