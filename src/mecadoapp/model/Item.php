<?php

	namespace mecadoapp\model;

	class Item extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'item';
		protected $primaryKey = 'id';
		public $timestamps = true;
		
		public function liste(){
			return $this->belongsTo('mecadoapp\model\Liste', 'id_liste');
		}
		
		public function acheteurs(){
			return $this->hasMany( 'mecadoapp\model\Acheteur', 'id_item');
		}
	}
