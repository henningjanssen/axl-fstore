<?php

namespace axl\fstore\view;

class FileListView extends BaseView{
  public function __construct(array $files){
    parent::__construct("@fstore/filelist.html", "filelist.title");
    $this->setVars(array(
      "files" => $files
    ));
  }
}
