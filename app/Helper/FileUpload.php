<?php

namespace App\Helper;
use Validator;
use Illuminate\Http\Request;

class FileUpload
{
	/**
	 * @var $r ini adalah parameter request
	 * @var $input_file ini adalah nama dari input file
	 * @var $path adalah tempat penyimpanan directory
	 */
	
	public static function foto($request, $input_file)
	{

		$validator = Validator::make($request->all(), [
			$input_file => 'mimes:jpeg,bmp,png'
		]);

		if ($validator->fails()) {
            return 'failed';
        }

		return $request;
	}
}