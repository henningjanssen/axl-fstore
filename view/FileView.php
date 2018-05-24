<?php

namespace axl\fstore\view;

use \axl\fstore\model\File;

class FileView extends BaseView{
  public function __construct(?File $file){
    parent::__construct("@fstore/file.html", "fileview.title", true);
    if($file === null){
      $file = array(
        "id" => -1,
        "title" => "",
        "name" => "",
        "group" => ""
      );
    }
    $this->setVars(array(
      "file" => $file
    ));
  }
}
