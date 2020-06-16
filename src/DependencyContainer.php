<?php
namespace Delirehberi;

use Delirehberi\Manager\ContainerAwereManager;
use Delirehberi\Manager\ManagerInterface;

class DependencyContainer
{
  private array $di;

  public function set($id,object $object):self 
  {
    if($object instanceof ContainerAwereManager) {
      $object->setContainer($this);
    }
    $this->di[$id]=$object;
    return $this;
  }

  public function get($id):object
  {
    if(!in_array($id,array_keys($this->di))){
      throw new \Exception("Dependency not found: $id");
    }

    return $this->di[$id];
  }
}
