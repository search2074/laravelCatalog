<?php

namespace App\Helpers;

use Illuminate\Http\Request;

/**
 * Помошник для работы с файлами
 */
class FileHelper {
	const UPLOAD_DIR = 'uploads';
	
	/**
	 * Загружает файл
	 * @param \Illuminate\Http\Request $request
	 * @return boolean|string
	 */
	public static function upload(Request $request){
		if ($request->hasFile('file')) {
			$directory = DIRECTORY_SEPARATOR.self::UPLOAD_DIR.date('/Y/m/d/');
            $filename = md5(date('c')).'.'.$request->file('file')->getClientOriginalExtension();
			
			if($request->file('file')->move(public_path().$directory, $filename)){
				return public_path().$directory.$filename;
			}
		}
		
		return false;
	}
}
