<?php

namespace axl\fstore;

use \Doctrine\ORM\Tools\SchemaTool;

use \axolotl\entities\RoutingInfo;
use \axolotl\util\Doctrine;

class ModControl implements \axolotl\module\ModuleControl {
  public function install(): bool{
    list($schemaTool, $classes) = $this->getSchemaClasses();
    $schemaTool->createSchema($classes);
    return true;
	}

  public function uninstall(): bool{
    list($schemaTool, $classes) = $this->getSchemaClasses();
    $schemaTool->dropSchema($classes);
    return true;
	}

  public function update(): bool{
    list($schemaTool, $classes) = $this->getSchemaClasses();
    $schemaTool->updateSchema($classes, true);
    return true;
	}

  public function backup(): void{
		// If the user wants to backup his stuff, this function is called
	}

  public function getRoutings(): array{
    $ns = '\axl\articular\control';

    return array(
      RoutingInfo::newInstance('/', "$ns\\FileListControl", array('GET')),
      RoutingInfo::newInstance('/files[/]', "$ns\\FileListControl", array('GET')),
      RoutingInfo::newInstance(
        '/files/{group}[/]', "$ns\\FileListControl", array('GET')
      ),
      RoutingInfo::newInstance(
        '/file/{id}[/]', "$ns\\FileControl", array('GET', 'POST')
      )
      RoutingInfo::newInstance(
        '/file/new[/]', "$ns\\FileControl", array('GET', 'POST')
      )
    );
  }

  private function getSchemaClasses()
  : array{
    $em = Doctrine::getEntityManager();
    $schemaTool = new SchemaTool($em);
    $classes = array(
      //$em->getClassMetadata('axl\fstore\model\File'),
    );
    return array($schemaTool, $classes);
  }
}
