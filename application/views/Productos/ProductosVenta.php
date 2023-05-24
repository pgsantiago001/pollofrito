<div class="container">
         <br>  
           <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Agregar Producto</button> 

       <form action="" method="post">
            <br>

            <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <button type="submit" class="btn btn-success">
                Guardar
            </button>
     

        </form>

          <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                            
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><div id="depto"></div></h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="idBuscarTablet" name="BuscarTablet" class="form-control" placeholder="Buscar producto..">
         
                        <div id="idTblTablets" class="row-fluid">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Hecho</button>
                    </div>
                  </div>
                  
                </div>
          </div>

</div>

<script>

cont=0;

function agregar_tabla(codigo, nombre) {
    cont++;
    var table = document.getElementById("myTable");
    var row = table.insertRow(table.lenght);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = codigo+" <input type='hidden' name='codigo[]' value ='"+codigo+"'>";
    cell2.innerHTML = nombre;
    cell3.innerHTML = "<input name='cantidad[]'>";
    cell4.innerHTML = '<button  type="button" class="btn borrar">eliminar</button>';


    
}

$(function () {
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });
});

function mostrarTablet(valor){
            $.ajax({
                url: 'https://<?php print $_SERVER['HTTP_HOST'];?>/www.guatesistemas.com/pollofrito/index.php/Asignacion_controller/listar_productos',
                type:'POST',
                dataType: 'json',
                data: {valorBuscado:valor},
                success: function(output_string){
                    var output_string = eval(output_string);
                    html = "<table class='table table-responsive table-bordered'><thead>";
                    html += "<tr><th>Código</th><th>No. Serie</th><th></th></tr>";
                    html += "</thead><tbody>";
                    
                    for (var i = 0; i < output_string.length; i++){
                        html += '<tr><td>'+output_string[i]['codigo']+
                                '</td><td>'+output_string[i]["nombre"]+'</td>'+'<td><button type="button" class="btn" onclick="agregar_tabla(\''+output_string[i]['codigo']+'\',\''+output_string[i]['nombre']+'\')">Agregar</button></td></tr>';
                    };
                    
                    html += "</tbody></table>";
                    
                    $("#idTblTablets").html(html);
                    
                }, // End of success function of ajax form
                error: function(data){
                    alert('Se produjo un error al recuperar los datos!!');
                }
            });
        }

        $(document).ready(function() {
            //$(":input").inputmask();
            
            $("#idBuscarTablet").keyup(function(){
                valor = $("#idBuscarTablet").val();
                mostrarTablet(valor);
            });
            
          
        });

</script>