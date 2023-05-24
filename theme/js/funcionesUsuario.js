function RegPer(){
    var value = {
        'nombre':    $('#txtNombUsr').val(),
        'direccion': $('#txtDirecUsr').val(),
        'dpi':       $('#txtDpiUsr').val(),
        'tel':       $('#txtTelUsr').val()
    };
    $.ajax({
        type: 'POST',
        url: 'http://localhost/pollofrito/index.php/Usuarios_controller/addPersona',
        data: value,
        success:function (respuesta) {
            if (respuesta != ""){
                $('#idUser').val(respuesta);
                $("#frmPersona").css("display","none" );
                $("#UsrPass").css("display","block" );

            }else {
                swal({ title: "Error..!", text: "intentelo de nuevo.!", type: "error", timer: 1000 });
            }
        }
    });
}
function UsrPssw(){
    var idPer = $('#idUser').val();
    var value = {
        'usuario':     $('#UserLog').val(),
        'clave':       $('#passLog').val(),
        'id_personal': idPer,
        'estado':      'Activo',
        'tipo_usuario': 'NORMAL'
    };
    $.ajax({
        type: 'POST',
        url: 'http://localhost/pollofrito/index.php/Usuarios_controller/UsrNew',
        data: value,
        success:function (respuesta) {
            if (respuesta != ""){
                $("#frmPersona").css("display","block" );
                $("#UsrPass").css("display","none" );
                $('#txtNombUsr').val("");
                $('#txtDirecUsr').val("");
                $('#txtDpiUsr').val("");
                $('#txtTelUsr').val("");
                $('#UserLog').val("");
                $('#passLog').val("");
                $("#RegUsuarios .close").click();
            }else {
                swal({ title: "Error..!", text: "intentelo de nuevo.!", type: "error", timer: 1000 });
            }
        }
    });
}
function UsuarioLoadAcc() {

    $.ajax({
        url:"http://localhost/pollofrito/index.php/Usuarios_controller/verPersonalLst",
        type:'POST',
    }).done(function(resp){
        if (resp != "0")
        {
            var valores = eval(resp);
            html="<table class='table table-hover' id='TablaPagos'><thead><tr><th>Id. Usuario</th><th>Nombre</th><th>Direccion</th><th>Dpi</th><th>Telefono</th><th>Estado</th><th>Ver</th></tr></thead><tbody>";
            for(i=0;i<valores.length;i++){
                // datos=valores[i]['NoFactura']+"*"+valores[i]['Fecha']+"*"+valores[i]['metododepago']+"*"+valores[i]['total']+"*"+valores[i]['descuento'];
                html+="<tr><td>"+valores[i]['idpersonal']+"</td><td>"+valores[i]['nombre']+"</td><td>"+valores[i]['direccion']+"</td><td>"+valores[i]['dpi']+"</td><td>"+valores[i]['tel']+"</td><td>"+valores[i]['estado']+"</td><td ><a class='nav-link loadAccesos' id='" + valores[i]['idpersonal'] + "'> ver</a></td></tr>";
            }
            html+="</tbody></table>"
            $("#lstaUsr").html(html);
        }
        else {
            swal({ title: "No se encontraron ", text: "datos..!", type: "warning", timer: 900 });
        }
    });

}
function AccesoUsersLg(IdUsr) {
    var value = {
        'idUserLg': IdUsr
    };
    $.ajax({
        url:"http://localhost/pollofrito/index.php/Usuarios_controller/verAcLogMenu",
        // async:false,
        type:'POST',
        data: value,
    }).done(function(resp){
        var valores = eval(resp);
        if (resp != '') {
            document.getElementById('userLog').innerHTML = valores[0]['Usuario'];
            var UserTipoIni = $("#usrIniTipo").text();
            $("#IduserLog").val(valores[0]['ID']);
            if(valores[0]['AcUno'] =='1'){
                $("#chAcUno").prop( "checked", true );
            }
            else {
                $("#chAcUno").prop( "checked", false );
            }
            if(valores[0]['AcDos'] =='1'){
                $("#chAcDos").prop( "checked", true );
            }
            else {
                $("#chAcDos").prop( "checked", false );
            }
            if(valores[0]['AcTres'] =='1'){
                $("#chAcTres").prop( "checked", true );
            }
            else {
                $("#chAcTres").prop( "checked", false );
            }
            if(valores[0]['AcCuatro'] =='1'){
                $("#chAcCuatro").prop( "checked", true );
            }
            else {
                $("#chAcCuatro").prop( "checked", false );
            }
            if(valores[0]['AcCinco'] =='1'){
                $("#chAcCinco").prop( "checked", true );
            }
            else {
                $("#chAcCinco").prop( "checked", false );
            }
            if(valores[0]['AcSeis'] =='1'){
                $("#chAcSeis").prop( "checked", true );
            }
            else {
                $("#chAcSeis").prop( "checked", false );
            }
            if(valores[0]['AcSiete'] =='1'){
                $("#chAcSiete").prop( "checked", true );
            }
            else {
                $("#chAcSiete").prop( "checked", false );
            }
            if(valores[0]['AcOcho'] =='1'){
                $("#chAcOcho").prop( "checked", true );
            }
            else {
                $("#chAcOcho").prop( "checked", false );
            }
            if(valores[0]['AcNueve'] =='1'){
                $("#chAcNueve").prop( "checked", true );
            }
            else {
                $("#chAcNueve").prop( "checked", false );
            }
            if(valores[0]['AcDiez'] =='1'){
                $("#chAcDiez").prop( "checked", true );
            }
            else {
                $("#chAcDiez").prop( "checked", false );
            }
            if(valores[0]['RepVen'] =='1'){
                $("#chAcRepVen").prop( "checked", true );
            }
            else {
                $("#chAcRepVen").prop( "checked", false );
            }
            if(valores[0]['RepVenE'] =='1'){
                $("#chAcRepVenE").prop( "checked", true );
            }
            else {
                $("#chAcRepVenE").prop( "checked", false );
            }
            if(valores[0]['RepCom'] =='1'){
                $("#chAcRepCom").prop( "checked", true );
            }
            else {
                $("#chAcRepCom").prop( "checked", false );
            }
            if(valores[0]['RepInv'] =='1'){
                $("#chAcRepInv").prop( "checked", true );
            }
            else {
                $("#chAcRepInv").prop( "checked", false );
            }
            if(UserTipoIni =="SUPER" ){
                document.getElementById('AccVerUsr').style.display='block';
            }
            else {
                document.getElementById('AccVerUsr').style.display='none';
            }
            //veriricacion acceso admin

        }



        else {
            swal({ title: "No se encontraron ", text: "datos..!", type: "warning", timer: 900 });
        }
    });
}
function ActualizarAcLog(flagCmo, valAccess) {
    var idUsrLg = $("#IduserLog").val();
    var value = {
        'idUserLg': idUsrLg,
        'campo': flagCmo,
        'valor': valAccess
    };
    $.ajax({
        url:"http://localhost/pollofrito/index.php/Usuarios_controller/ActAccLogue",
        // async:false,
        type:'POST',
        data: value,
    }).done(function(resp){
        if(resp == 'true'){
            swal({ title: "Ok..!", text: "Acceso actualizado..!", type: "success", timer: 1000 });
        }
    });
}

//function SucursalesUsuario () {
//
 //   $.get("http://localhost/pollofrito/index.php/Usuarios_controller/ObtSucursales", {},
//            //$("#tabla").html(data);
            //  alert(data);
//            var valores = eval(data);
//            html="<table class='table table-hover'><thead><tr><th>ID</th><th>OPCIONES</th><th>SUCURSAL</th></tr></thead><tbody>";
//            for(i=0;i<valores.length;i++){
//                datos=valores[i]['idgs_producto']+"*"+valores[i]['codigo']+"*"+valores[i]['nombre']+"*"+valores[i]['descripcion']+"*"+valores[i]['NombreCat']+"*"+valores[i]['stock'];
//                html+="<tr><td>"+valores[i]['idgs_producto']+"</td><td>"+valores[i]['codigo']+"</td><td>"+valores[i]['nombre']+"</td><td>"+valores[i]['descripcion']+"</td><td>"+valores[i]['NombreCat']+"</td><td>"+valores[i]['stock']+"</td><td><button type='button' class='btn btn-primary btn-sm' name='agregar' id='" + i + "'><span class='glyphicon glyphicon-ok btn_add'></span></button></td></tr>";
//            }
 //           html+="</tbody></table>"
//        });
//}
