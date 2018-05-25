<?php
namespace axl\fstore\control;

use axolotl\control\LoggedInPageControl;
use axolotl\util\_;
use axolotl\util\Doctrine;
use axolotl\view\RedirectView;

use axl\fstore\model\File;
use axl\fstore\view\FileListView;

class FileListControl extends LoggedInPageControl{
  public function execute(): void{
    if(_::GET('delete', -1) > 0){
      $del = File::get(intval(_::GET('delete')));
      if($del){
        $em = Doctrine::getEntityManager();
        $em->remove($del);
        $em->flush();
      }
      $link = '/m/AXL/fstore/files';
      if($this->hasVar('group')){
        $link .= '/'.$this->vars['group'];
      }
      (new RedirectView($link))->render();
      return;
    }

    $group = null;
    if($this->hasVar('group')){
      $group = $this->vars['group'];
    }
    $files = File::getAll($group);
    (new FileListView($files))->render();
  }
}
