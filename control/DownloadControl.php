<?php
namespace axl\fstore\control;

use axolotl\control\LoggedInPageControl;
use axolotl\view\StreamView;

use axl\fstore\model\File;

class DownloadControl extends LoggedInPageControl{
  public function execute(): void{
    try{
      $file = File::get(intval($this->vars['id']));
      (new StreamView($file->getContentStream(), $file->getName()))->render();
    }
    catch(\Exception $ex){
      (new ErrorView(404))->render();
    }
  }
}
