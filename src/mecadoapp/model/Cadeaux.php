<?php

	namespace tweeterapp\model;

	class Tweet extends \Illuminate\Database\Eloquent\Model {

		protected $table = 'cadeaux';
		protected $primaryKey = 'id';
		public $timestamps = true;

	}
