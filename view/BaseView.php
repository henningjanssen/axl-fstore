<?php

namespace axl\fstore\view;

use axolotl\view\PageView;

abstract class BaseView extends PageView{
  protected $staticuri = "";
  protected $moduri = "";
  public function __construct(string $file, string $title = ""){
    parent::__construct($file, $title, true);
    $this->setModuleNavigation(array(
      "List Files" => "/m/AXL/fstore/"
    ));
    $this->staticuri = "{$this->baseuri}/static/m/fstore";
    $this->moduri = "{$this->baseuri}/m/AXL/fstore";
    $this->addTemplateDirectory('fstore', realpath(__DIR__.'/../template'));
  }

  public function preRender(): void{
    $this->vars['moduri'] = $this->moduri;
    $this->vars['staticuri'] = $this->staticuri;
  }
}
