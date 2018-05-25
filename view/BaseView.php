<?php

namespace axl\fstore\view;

use axolotl\view\PageView;

abstract class BaseView extends PageView{
  protected $staticuri = "";
  protected $moduri = "";
  public function __construct(string $file, string $title = ""){
    parent::__construct($file, strlen($title)>0 ?"i18n:axl__fstore:$title" :"");
    $this->setModuleNavigation(array(
      "i18n:axl__fstore:navigation.listfiles" => "m/AXL/fstore/",
      "i18n:axl__fstore:navigation.newfile" => "m/AXL/fstore/file/new"
    ));
    $this->staticuri = "{$this->baseuri}/static/m/fstore";
    $this->moduri = "{$this->baseuri}/m/AXL/fstore";
    $this->addTemplateDirectory('fstore', realpath(__DIR__.'/../template'));
  }

  public function preRender(): void{
    $this->vars['moduri'] = $this->moduri;
    $this->vars['staticuri'] = $this->staticuri;
    $this->vars['i18nMod'] = 'axl__fstore';
  }
}
