<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Database_Table_Column_Int extends Database_Table_Column {
	
	// Not editable
	public $precision;
	public $scale;
	public $maximum_value;
	public $minimum_value;
	
	// Editable
	public $is_auto_increment;
	
	public function __construct($datatype, $maximum_value = NULL, $minimum_value = NULL)
	{
		$this->maximum_value = $maximum_value;
		$this->minimum_value = $minimum_value;
		
		parent::__construct($datatype);
	}
	
	public function load_schema( & $table, $schema)
	{
		$this->is_auto_increment = strpos($schema['EXTRA'], 'auto_increment') !== false;
		$this->precision = $schema['NUMERIC_PRECISION'];
		$this->scale = $schema['NUMERIC_SCALE'];
		
		parent::load_schema($table, $schema);
	}
	
	public function compile_constraints()
	{
		$sql = '';
		
		if($this->is_auto_increment)
		{
			$sql .= 'AUTO_INCREMENT ';
		}
		
		$sql .= parent::compile_constraints();
		
		return $sql;
	}
}