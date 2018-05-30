<?php

namespace App\Traits;

trait ModelRulesTrait
{
    protected static function unique($rowIgnore, $column, $table = null){
        $instance = new static;
        if(!isset($table))
            $table = $instance->table;
        return 'unique:'.$table.','.$column.','.$rowIgnore.','.$instance->getKeyName();
    }

    protected static function uniqueWith($rowIgnore, $columns = [], $table = null){
        if(!empty($columns)){
	        $instance = new static;
	        if(!isset($table))
	            $table = $instance->table;
        	return 'unique_with:'.$table.','.implode(',',$columns).','.$rowIgnore.'='.$instance->getKeyName();
        }
    }

}