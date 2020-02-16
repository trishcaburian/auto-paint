<?php
namespace App\Validators;

use Illuminate\Http\Request;

class RequestValidator
{

	public function validate(Array $request)
	{
		if (!$this->isCompleteInput($request)) {
			return false;
		}

		if (!$this->isValidColor($request['current_color']) || !$this->isValidColor($request['target_color'])) {
			return false;
		}

		return true;
	}

	protected function isCompleteInput(Array $request)
	{
		if (!isset($request['plate_no']) || empty($request['plate_no'])) {
			return false;
		}

		if (!isset($request['current_color']) || empty($request['current_color'])) {
			return false;
		}

		if (!isset($request['target_color']) || empty($request['target_color'])) {
			return false;
		}


		return true;
	}

	public function isValidColor(String $color)
	{	
		$color = ucfirst($color);

		if (!in_array($color, ['Red', 'Blue', 'Green'])) {
			return false;
		}

		return true;
	}
}