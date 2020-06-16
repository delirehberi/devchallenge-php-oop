<?php
namespace Delirehberi\Type;

use DateTime;
use DateTimeInterface;
use DateTimeZone;
use JsonSerializable;

class Message implements FillableTypeInterface,JsonSerializable
{
  private $id;
  private $chat_id;
  private $message;
  private $user_id;
  private $user;
  private $date;



  public static function fromArray(array $data):self{
    $message = new static();
    isset($data['id']) && $message->setId($data['id']);
    isset($data['chatid']) && $message->setChatId($data['chatid']);
    isset($data['message']) && $message->setMessage($data['message']);
    isset($data['userid']) && $message->setUserId($data['userid']);
    isset($data['ts']) && $message->setDate(DateTime::createFromFormat('U',$data['ts'],new DateTimeZone( '-0400' )));
    return $message;
  }

  /**
   * Get date.
   *
   * @return date.
   */
  public function getDate():?DateTimeInterface
  {
    return $this->date;
  }

  /**
   * Set date.
   *
   * @param date the value to set.
   */
  public function setDate($date):self
  {
    $this->date = $date;
    return $this;
  }

  /**
   * Get user_id.
   *
   * @return user_id.
   */
  public function getUserId()
  {
    return $this->user_id;
  }

  /**
   * Set user_id.
   *
   * @param user_id the value to set.
   */
  public function setUserId($user_id):self
  {
    $this->user_id = $user_id;
    return $this;
  }

  /**
   * Get message.
   *
   * @return message.
   */
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Set message.
   *
   * @param message the value to set.
   */
  public function setMessage($message):self
  {
    $this->message = $message;
    return $this;
  }

  /**
   * Get chat_id.
   *
   * @return chat_id.
   */
  public function getChatId()
  {
    return $this->chat_id;
  }

  /**
   * Set chat_id.
   *
   * @param chat_id the value to set.
   */
  public function setChatId($chat_id):self
  {
    $this->chat_id = $chat_id;
    return $this;
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
  public function setId($id):self 
  {
    $this->id = $id;
    return $this;
  }
    
    /**
     * Get user.
     *
     * @return user.
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Set user.
     *
     * @param user the value to set.
     */
    public function setUser($user)
    {
      $this->user = $user;
      return $this;
    }

    public function jsonSerialize():array {
      return [
        'id'=>$this->getId(),
        'chatid'=>$this->getChatId(),
        'message'=>$this->getMessage(),
        'userid'=>$this->getUserId(),
        'ts'=>$this->getDate()->getTimestamp(),
      ];
    }

    public function __toString()
    {
      return strip_tags($this->getMessage());
    }
}
