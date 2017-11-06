<?php

	namespace mecadoapp\model;

	class Liste extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'liste';
		protected $primaryKey = 'id';
		public $timestamps = true;

		public function items(){
			return $this->hasMany( 'mecadoapp\model\Item', 'id_liste');
		}
		
		public function messages(){
			return $this->hasMany( 'mecadoapp\model\Message', 'id_liste');
		}
		
		public function user(){
			return $this->belongsTo('mecadoapp\model\User', 'id_user');
		}
	}
