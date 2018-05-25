<?php
namespace axl\fstore\control;

use axolotl\control\LoggedInPageControl;
use axolotl\util\_;
use axolotl\util\UploadedFile;
use axolotl\view\RedirectView;

use axl\fstore\model\File;
use axl\fstore\view\FileView;
use axl\fstore\view\NewFileView;

class FileControl extends LoggedInPageControl{
  public function execute(): void{
    // Display file or "new file"-page
    if($this->httpMethod == 'GET'){
      $file = null;
      if($this->hasVar('id')){
        $file = File::get(intval($this->vars['id']));
      }
      (new FileView($file))->render();
      return;
    }

    // save file

    $file = null;

    // get file instance
    if(_::POST('id') >= 0){
      $file = File::get(intval(_::POST('id')));
    }
    else{
      $file = new File();
    }

    // update values
    $file->setTitle(strval(_::POST('title')))
      ->setName(strval(_::POST('name')))
      ->setGroup(strval(_::POST('group')));

    // update file if it was uploaded
    if(strlen(_::POST('upload')) > 0){
      $upload = new UploadedFile('upload');
      if($upload->exists()){
        $fstream = fopen($upload->getPath(), 'r');
        $file->setContent($fstream);
        fclose($fstream);

        // set filename if it was not set manually
        if(strlen($file->getName()) === 0){
          $file->setName($upload->getFilename());
        }

        $upload->delete();
      }
    }
    $file->save();

    // /file/new -> /file/<id>
    if(!($this->hasVar('id'))){
      (new RedirectView("/m/AXL/fstore/file/{$file->getID()}"))->render();
      return;
    }
    (new FileView($file))->render();
  }
}
