<?php
namespace Delirehberi\Manager;

use Delirehberi\DataSource\DataSourceInterface;
use Delirehberi\DataSource\JsonDataSource;
use Delirehberi\Type\Collection;
use Delirehberi\Type\Message;

class MessageManager extends ContainerAwereManager implements ManagerInterface
{

  private $messages;
  private $data_source;
  public function __construct(DataSourceInterface $data_source)
  {
    $this->data_source = $data_source;
  }

  public function getMessages():?Collection{

    if($this->messages) return $this->messages;

    $this->messages = $this->data_source->loadResource('messages');

    $userManager = $this->getContainer()->get('manager.user');

    $this->messages = $this->messages->map(function(Message $message)use($userManager){
      $message->setUser($userManager->getUserById($message->getUserId()));
      return $message;
    });

    return $this->messages;
  }
  public function getMessagesByChatId(int $chat_id):Collection
  {
    return $this->getMessages()
                ->filter(function(Message $message)use($chat_id){
      return $message->getChatId()==$chat_id;
    })
    ->sort(function(Message $messageA,Message $messageB){
      $a = $messageA->getDate()->getTimestamp();
      $b = $messageB->getDate()->getTimestamp();
      if($a==$b) {
        return 0;
      }
      return $a<$b?-1:1;
    }); 
  }
  public function getMessageById(int $message_id):?Message 
  {
    $messages = $this->getMessages()->filter(function(Message $message)use($message_id){
      return $message->getId()==$message_id;
    });
    return $messages->shift();
  }
}
