<?php

	namespace mecadoapp\model;

	class Message extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'message';
		protected $primaryKey = 'id';
		public $timestamps = true;

		public function liste(){
			return $this->belongsTo('mecadoapp\model\Liste', 'id_liste');
		}
	}
