<?php

	namespace tweeterapp\model;

	class Like extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'liste';
		protected $primaryKey = 'id';
		public $timestamps = true;

	}
