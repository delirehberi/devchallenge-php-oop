<?php
namespace Delirehberi\Manager;

use Delirehberi\DataSource\DataSourceInterface;
use Delirehberi\Type\Collection;
use Delirehberi\Type\User;

class UserManager extends ContainerAwereManager implements ManagerInterface {
  private $users;
  /**
   * @param DataSourceInterface $data_source
   */
  public function __construct(DataSourceInterface $data_source)
  {
    $this->data_source = $data_source;
  }

  public function getUsers():?Collection {
    if(!$this->users){
      $this->users = $this->data_source->loadResource('users');
    }

    return $this->users;
  }

  public function getUserById(int $user_id):?User {
    $users = $this->getUsers()->filter(function(User $user)use($user_id){
      return $user->getId()==$user_id;
    });
    return $users->shift();
  }
}
