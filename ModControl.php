<?php

namespace axl\fstore;

use \axolotl\entities\RoutingInfo;
use \axolotl\util\Doctrine;

class ModControl extends \axolotl\module\ModuleControl {
  public function getRoutings(): array{
    $ns = '\axl\fstore\control';

    return array(
      RoutingInfo::newInstance('/', "$ns\\FileListControl", array('GET')),
      RoutingInfo::newInstance('/files[/]', "$ns\\FileListControl", array('GET')),
      RoutingInfo::newInstance(
        '/files/{group}[/]', "$ns\\FileListControl", array('GET')
      ),
      RoutingInfo::newInstance(
        '/file/new[/]', "$ns\\FileControl", array('GET', 'POST')
      ),
      RoutingInfo::newInstance(
        '/file/{id:\d+}[/]', "$ns\\FileControl", array('GET', 'POST')
      ),
      RoutingInfo::newInstance(
        '/file/{id:\d+}/download[/]', "$ns\\DownloadControl", array('GET')
      )
    );
  }

  public function getClasses(): array{
    $em = Doctrine::getEntityManager();
    $classes = array(
      $em->getClassMetadata('axl\fstore\model\File')
    );
    return $classes;
  }
}
