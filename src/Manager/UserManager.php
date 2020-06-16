<?php
namespace Delirehberi\Manager;

use Delirehberi\DataSource\DataSourceInterface;
use Delirehberi\Type\User;

class UserManager implements ManagerInterface
{
  private $users;
  /**
   * @param DataSourceInterface $data_source
   */
  public function __construct(DataSourceInterface $data_source)
  {
    $this->users = $data_source->loadResource('users');
  }

  public function getUserById(int $user_id):?User {
    $users = $this->users->filter(function(User $user)use($user_id){
      return $user->getId()==$user_id;
    });
    return $users->shift();
  }
}
