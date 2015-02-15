=begin
	creamos se inicializamos la clase Hola
	ejemplos con ruby
=end

$global = 'esta es una variable global'
class Hola
	def initialize()
		
	end

	def saluda()
		puts $global
	end

	def aritmetic()
		num = 1
		num2 =  2
		puts num + num2
		=begin
		conversion de cadenas
		num.to_i
		num.to_s
		num.to_f
		esctricto 
		num.to_int
		num.to_float
		num.to_string	
		=end
	end

	def tiposDatos()
		=begin 
		tipo de variables en ruby
		=end

		$global = 'soy una variable globalk'
		@instancia = 'soy una variable de instancia'
		local = 'soy una variable local'
	end
end
#instanciamos la clase
hi = Hola.new()
hi.saluda
gets()