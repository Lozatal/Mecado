<?php

	namespace mecadoapp\model;

	class Acheteur extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'acheteur';
		protected $primaryKey = 'id';
		public $timestamps = false;

		public function item(){
			return $this->belongsTo('mecadoapp\model\Item', 'id_item');
		}
	}
