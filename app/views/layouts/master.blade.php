<!DOCTYPE HTML>
<html>
<head>	
	<meta charset="UTF-8">
	<meta autor="Carlos Roberto Balam Balam">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Sistema de Reservación Univerdad del Centro</title>
	<!--SECCION DE JAVASCRIPT-->
	@section('script')
	{{HTML::script('js/jquery-2.0.2.js')}}
	{{HTML::script('js/bootstrap.js')}}
	{{HTML::script('js/jquery-ui.js')}}
	</script>
	@show
	<!--SECCION DE CSS-->
	@section('style')
	{{HTML::style('css/bootstrap.css')}}
	{{HTML::style('css/cssDefault.css')}}
	{{HTML::style('css/jquery-ui.css')}}
	@show
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">T</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
        <a class="navbar-brand" href="{{URL::to('profesor')}}">Principal</a>
        
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
        	<li><a href="{{URL::to('profesor/reservar')}}">Reservar</a></li>
        	<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Perfil<b class="caret"></b></a>
	          <ul class="dropdown-menu">	            
	            <li><a href="#">Historial</a></li>
	            <li class="divider"></li>
	            <li><a href="{{URL::to('profesor/carreras')}}">Carreras</a></li>	 
	            <li><a href="{{URL::to('profesor/reservas')}}">Reservas</a></li>           
	          </ul>
       		</li>
       		<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bandeja<b class="caret"></b></a>
	          <ul class="dropdown-menu">	            
	            <li><a href="#">Peticiones</a></li>	            
	          </ul>
       		</li>
        </ul>
       	<ul class="nav navbar-nav navbar-right">
       		<div class="btn-group" style="position:relative; top:.5em;" title="{{Session::get('usuario')}}">
       			<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
       				<span class="glyphicon glyphicon-user"></span>
       				<span class="caret"></span>
       			</button>
       			 <ul class="dropdown-menu" role="menu">
				    <li><a href="{{URL::to('logout')}}">Salir</a></li>
				 </ul>
       		</div>
      	</ul>        
    </div>  
</nav>
	<div class="row">
		<div class="col-md-10 col-md-offset-1" id="contenedor">
			@yield('contenedor')
		</div>		
	</div>
	<div class="row" id="pie">
		<div class="col-md-12 text-center">
					
		</div>
	</div>
</body>
</html>