<?php

	namespace tweeterapp\model;

	class Follow extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'messages';
		protected $primaryKey = 'id';
		public $timestamps = true;

	}
