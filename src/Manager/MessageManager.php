<?php
namespace Delirehberi\Manager;

use Delirehberi\DataSource\DataSourceInterface;
use Delirehberi\DataSource\JsonDataSource;
use Delirehberi\Type\Collection;
use Delirehberi\Type\Message;

class MessageManager implements ManagerInterface
{

  private $messages;

  public function __construct(DataSourceInterface $data_source)
  {
    $this->messages = $data_source->loadResource('messages');
  }

  public function getMessagesByChatId(int $chat_id):Collection
  {
    return $this->messages
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
    $messages = $this->messages->filter(function(Message $message)use($message_id){
      return $message->getId()==$message_id;
    });
    return $messages->shift();
  }
}
