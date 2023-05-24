
<!--<script>
             
                  $(document).ready(function(){
                   
                        var altura = $("#barra").offset().top; 
                         
                        $(window).scroll(function(){
                         
                              if($(window).scrollTop() >= altura){
                                     
                                    $("#barra").css("margin-top","0");
                                    $("#barra").css("position","fixed");
                                    $("#barra").css("display","block");
                                    $("#barra").css("width","100%");
                               
                              }
                         
                        });
                   
                  });
                   
</script>-->
<style type="text/css">

.navbar-brand {
    padding: 5px 15px !important;    
}
  
.navbar-inverse {
    background-color: #FF7F00;
    border-color: #FF7F00;
    
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
#loading {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  text-align: center;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
  display: flex;
  justify-content: center;
  align-items: center;
}

#loading-image {
  display: block;
  margin-left: auto;
  margin-right: auto;
  z-index: 100;
}

</style>



<title>pgsantiago</title>
<div id="loading">
  <img id="loading-image" src="/pollofrito/theme/img/loading.gif" alt="Loading..." />
</div>
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
      <li class="dropdown">
     <!--   <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/pgsantiago/index.php/Reportes/educacion_menu">Reportes Lugares Poblados</a></li>
          <li><a href="/pgsantiago/index.php/Reportes/Guatemala">Guatemala</a></li>
        </ul>
      </li>-->
     <li class="dropdown">
      <!--  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios -->
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/pollofrito/index.php/Usuario/usuarios_index">Personas</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><span id="nivelUsr" style="display: none"><?php echo $this->session
          ->nivel; ?></span>
        <li><span id="flgUno" style="display: none"><?php echo $this->session
          ->AcUno; ?></span>
        <li><span id="flgDos" style="display: none"><?php echo $this->session
          ->AcDos; ?></span>
        <li><span id="flgTres" style="display: none"><?php echo $this->session
          ->AcTres; ?></span>
        <li><span id="flgCuatro" style="display: none"><?php echo $this->session
          ->AcCuatro; ?></span>
        <li><span id="flgCinco" style="display: none"><?php echo $this->session
          ->AcCinco; ?></span>
        <li><span id="flgSeis" style="display: none"><?php echo $this->session
          ->AcSeis; ?></span>
        <li><span id="flgSiete" style="display: none"><?php echo $this->session
          ->AcSiete; ?></span>
        <li><span id="flgOcho" style="display: none"><?php echo $this->session
          ->AcOcho; ?></span>
        <li><span id="flgNueve" style="display: none"><?php echo $this->session
          ->AcNueve; ?></span>
        <li><span id="flgDiez" style="display: none"><?php echo $this->session
          ->AcDiez; ?></span>
        <li><span id="RepVen" style="display: none"><?php echo $this->session
          ->RepVen; ?></span>
        <li><span id="RepVenE" style="display: none"><?php echo $this->session
          ->RepVenE; ?></span>
        <li><span id="RepCom" style="display: none"><?php echo $this->session
          ->RepCom; ?></span>
        <li><span id="RepInv" style="display: none"><?php echo $this->session
          ->RepInv; ?></span>
        <li><span id="AcConsultarProd" style="display: none"><?php echo $this
          ->session->AcConsultarProd; ?></span>
        <li><span id="usrIniTipo" style="display: none"><?php echo $this
          ->session->nivel; ?></span>

      <li><a href="#"><span class="glyphicon glyphicon-user" ></span><?php echo $this
        ->session->nombre .
        " " .
        $this->session->apellido .
        " " .
        $this->session->Nombre; ?> </a></li>
      <li><a href="/pollofrito/index.php/Reportes/Logout">
      <span class="glyphicon glyphicon-log-in"></span> Cerrar session</a></li>
      
    </ul>
  </div>
  </div>
</nav>
</div>
