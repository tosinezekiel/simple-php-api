<?php
class Validation{
	public $post_data;

	public function validate_request($arg){
		$acceptable_params = ['title','body','author','name'];
			foreach($acceptable_params as $value){
				if(!isset($arg[$value])){
					return true;
				}
				break 1;
			}

	}
	public function validate_params($arg){
		
			foreach($arg as $key => $value){
				if(empty($value) && in_array($key, $acceptable_params)){
					return true;
				}
				break 1;
			}

	}
}
?>