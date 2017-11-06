<?php

	namespace mecadoapp\model;

	class Item extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'cadeau';
		protected $primaryKey = 'id';
		public $timestamps = true;
		
		public function liste(){
			return $this->belongsTo('mecadoapp\model\Liste', 'id_liste');
		}
	}
