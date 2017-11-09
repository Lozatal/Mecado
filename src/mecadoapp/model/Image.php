<?php

	namespace mecadoapp\model;

	class Image extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'image';
		protected $primaryKey = 'id';
		public $timestamps = false;

		public function item(){
			return $this->belongsTo('mecadoapp\model\Item', 'id_item');
		}
	}
