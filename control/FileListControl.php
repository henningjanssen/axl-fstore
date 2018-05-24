<?php
namespace axl\fstore\control;

use axolotl\control\LoggedInPageControl;

use axl\fstore\model\File;
use axl\fstore\view\FileListView;

class FileListControl extends LoggedInPageControl{
  public function execute(): void{
    $group = null;
    if(array_key_exists('group', $this->vars)){
      $group = $this->vars['group'];
    }
    $files = File::getAll($group);
    (new FileListView($files))->render();
  }
}
