
<style type="text/css">

.navbar-brand {
    padding: 5px 15px !important;    
}
  
.navbar-inverse {
    background-color: 	#FF7F00;
    border-color: 	#FF7F00;
    
}

.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover{
background-color: #337ab7;

}


.navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover{
  color: rgb(157, 157, 157) !important;
}

.navbar-inverse .navbar-nav>li>a{
  color: white !important;



}

</style>



<title>pgsantiago</title>
<div id="barra">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="/pollofrito/theme/img/pollofrito.jpg" alt="Smiley face" height="40" width="100"></a>

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      </div>
       <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class=""><a href="#">Inicio</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Usuario</a></li>
      <li><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</button></li>
    </ul>
  </div>
  </div>
</nav>
</div>

<!-- Trigger the modal with a button -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Inicio de Sesión</h4>
      </div>
      <div class="modal-body">
        <form action="/pollofrito/index.php/archivo/index" method="post">
          <div class="container">
          <div class="row">
            <div class="col-xs-6">
            <div class="form-group">
              <label for="uname"><b>USUARIO</b></label>
              <input class="form-control" type="text" placeholder="Ingrese su usuario" name="nick" required>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
            <div class="form-group">
              <label for="psw"><b>CONTRASEÑA</b></label>
              <input class="form-control" type="password" placeholder="ingrese su contraseña" name="contra" required>
            </div>
            </div>
          </div>  
              <div class="row">
              <div class="col-xs-8">
                <button class="btn btn-success" type="submit">INICIAR SESIÓN</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>