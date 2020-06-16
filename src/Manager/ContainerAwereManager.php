<?php
namespace Delirehberi\Manager;

use Delirehberi\DependencyContainer;

abstract class ContainerAwereManager
{
  private $container;
  public function setContainer(DependencyContainer $dependencyContainer){
    $this->container=$dependencyContainer;
  }

  public function getContainer():DependencyContainer{
    return $this->container;
  }
}
