<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta autor="Carlos Roberto Balam Balam">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Sistema de Reservacion Univerdad del Centro</title>
	<!--SECCION DE JAVASCRIPT-->
	@section('script')
	{{HTML::script('js/jquery-2.0.2.js')}}
	{{HTML::script('js/bootstrap.js')}}

	
	@if(Session::has('error'))
	<script type="text/javascript">
		$(function(){
			$('div#error').addClass('has-error');
			$('input[type=text],input[type=password]').removeAttr('value')
			$('input[type=text],input[type=password]').val("");
			$('input[type=text],input[type=password]').attr('placeholder', 'Incorrecto');
		});

	</script>	
	@endif
	
	@show
	<!--SECCION DE CSS-->
	@section('style')
	{{HTML::style('css/bootstrap.css')}}
	<style type="text/css">
		div.row{
			padding: 0px;
			margin: 0px;
		}
		div#pie{
			min-height: 10em;
			background: rgba(0,0,0,1);
		}
		div#contenedor{
			min-height: 500px;
			margin-bottom: 50px;
		}
	</style>
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
        
        <a class="navbar-brand" href="{{URL::to('admon')}}">Administración</a>
        
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
        	<li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acciones<b class="caret"></b></a>
	          <ul class="dropdown-menu">	            
	            <li><a href="{{URL::to('admon/profesores')}}">Profesores</a></li>
	            <li><a href="{{URL::to('admon/carreras')}}">Carreras</a></li>
	            <li class="divider"></li>
	            <li><a href="{{URL::to('admon/asignaturas')}}">Asignaturas</a></li>
	            <li class="divider"></li>
	            <li><a href="{{URL::to('admon/talleres')}}">Talleres</a></li>
	          </ul>
       		</li>
       		<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bandeja<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li><a href="#"></a></li>
	            <li><a href="#">Peticiones</a></li>	            
	          </ul>
       		</li>
        </ul>
       	<ul class="nav navbar-nav navbar-right">
       		<span class="label label-info">{{Session::get('usuario')}}</span>
	        <a href="{{URL::to('logout')}}" class="btn btn-danger navbar-btn">Salir</a>
	        &nbsp
	        &nbsp
	        &nbsp
	        &nbsp
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