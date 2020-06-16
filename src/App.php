<?php
namespace Delirehberi;

use Delirehberi\Manager\MessageManager;
use Delirehberi\Type\Collection;
use Delirehberi\Type\Message;
use Delirehberi\Type\User;

class App
{
  private $userManager;
  private $messageManager;
  /**
   * @param DependencyContainer $container
   */
  public function __construct(DependencyContainer $container)
  {
    $this->messageManager = $container->get('manager.message');
    $this->userManager = $container->get('manager.user');
  }

  /**
   * Returns all data as json_encoded
   */
  public function asJSON($data)
  {
    return htmlspecialchars(json_encode($data));
  }

  public function getMessagesByChatId(int $chat_id): Collection
  {
    return $this->messageManager->getMessagesByChatId($chat_id);
  }

  public function getUserById(int $user_id): ?User
  {
    return $this->userManager->getUserById($user_id);
  }

  public function getMessageById(int $message_id): ?Message
  {
    return $this->messageManager->getMessageById($message_id);
  }
  
}
