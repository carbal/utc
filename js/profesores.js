/*
	@autor    : Carlos Roberto Balam Balam
	@fecha    : 02/12/2014
	@proyecto : Vista principal para módulo administrativo maestros
*/

var profesor = Backbone.Model.extend({
	idAttribute:'id',
	urlRoot:path +'/profesores/profesores',
	initialize :  function(){
		this.on('invalid',this.error,this);
	},
	validate : function(attrs,opts){
		if(!attrs.nombre.length)
			return 'nombre';

		if(!attrs.apellido.length)
			return 'apellido';

		if(!attrs.correo.length)
			return 'correo';

		if(!attrs.nick.length)
			return 'nick';

		if(!attrs.password.length)
			return 'password';
	},
	error :  function(model,opts){
		console.log(model,opts);
	}
});

/*

@autor  Carlos Roberto Balam Balam
@fecha 23/10/2014
@clase Colleciton Backbone.Collection
*/
//clase principal colleccion profesores
var profesores = Backbone.Collection.extend({
	model : profesor,
	url   : path +'/profesores/profesores',
});

var viewTr =  Backbone.View.extend({
	tagName: 'tr',
	initialize:function(){
		_.bindAll(this,'render','update','delete');
		this.template =  _.template($('#tmpProfesores').html());
	},
	events:{
		'click #update' : 'update',
		'click #delete' : 'delete',
	},
	render:function(){
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	},
	update:function(){
		$('')
	},
	delete:function(){
		console.log(this.model.toJSON(),'delete');
	}
});
/*
	@autor :  Carlos Roberto Balam Balam
	@fecha  :  23/11/2014
	instance of Backbone.View
*/
var viewTable = Backbone.View.extend({
	el:'div#profesores',
	events:{
		'click .panel-footer button#add'    : 'showModal',
		'click .modal-footer button#add'	: 'add'
	},
	initialize : function(){
		_.bindAll(this,'render');
		this.collection  =  new profesores;
		this.collection.fetch();
		this.emergente = $('div#modalProfesores');
		this.collection.on('add',this.render);
	},
	render : function(model){
		var tr = new viewTr({ model : model }).render().el;
		this.$el.find('tbody').append(tr);
	},
	showModal : function(){
		this.emergente.modal('show');
	},
	add :  function(){

		var self  = this;
		var form  = this.emergente.find('form#dataProfesor');
		var data  = form.serializeObject();
		var model = new profesor;
		model.save(data,{
			success : function(model,response,opts){
				if(response.success){
					_.each(form.find('input'),function(){
						this.reset();
					});
					self.emergente.modal('hide');
				}
			},
			error :  function(model,response,opts){
				 console.log(model,response,opts);
			},
		});

		this.collection.set(model);
	},
	error :  function(model,opts){
		console.log(model,opts)
	}
});
	
new viewTable
