<?php

namespace Delirehberi\Type;

use JsonSerializable;

class User implements FillableTypeInterface, JsonSerializable
{
  private $id;
  private $username;
  private $password;

  public static function fromArray(array $data):self 
  {
    $user = new static();
    isset($data['id']) && $user->setId($data['id']);
    isset($data['username']) && $user->setUsername($data['username']);
    isset($data['password']) && $user->setPassword($data['password']);
    return $user; 
  }

  /**
   * Get id.
   *
   * @return id.
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set id.
   *
   * @param id the value to set.
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * Get username.
   *
   * @return username.
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set username.
   *
   * @param username the value to set.
   */
  public function setUsername($username)
  {
    $this->username = $username;
  }

  /**
   * Get password.
   *
   * @return password.
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set password.
   *
   * @param password the value to set.
   */
  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function jsonSerialize(): array
  {
    return [
      'id'=>$this->getId(),
      'username'=>$this->getUsername(),
      //'password'=>$this->getPassword(),
    ];
  }
}
