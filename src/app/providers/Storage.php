<?php

namespace AssessmentBackendxp\App\Providers;

class Storage 
{
  private static $exts = array('jpg', 'png', 'gif');

  public static function disk($file,$path)
  {

    $result = self::validate($file);
    if($result['error'])
      throw new \Exception('Error upload file');

    $path_distiny = __DIR__.'\..\..\public\storage\\'.$path;
    if(!is_dir($path_distiny))
      mkdir($path_distiny,0700);

    $newFile = time().'.'.$result['ext'];
    if(move_uploaded_file($file['tmp_name'], $path_distiny.DIRECTORY_SEPARATOR.$newFile))
        return URL.'storage/'.$path.'/'.$newFile;
    else
      throw new \Exception('Error upload file');
  }

  public static function validate($file)
  {
    $originalExt = substr($file['name'],-3);
    if (array_search($originalExt, self::$exts) === false) {
      return [
        'error' => true,
        'message' => 'jpg, png, or gif'
      ];
    }
    if ($file["size"] > 500000) {
      return [
        'error' => true,
        'message' => 'Very large file'
      ];
    }
    return [
      'error' => false,
      'ext' => $originalExt
    ];
  }


}