<?php
use Delirehberi\App;
use Delirehberi\DataSource\JsonDataSource;
use Delirehberi\DependencyContainer;
use Delirehberi\Manager\MessageManager;
use Delirehberi\Manager\UserManager;
use Delirehberi\Type\Collection;
use Delirehberi\Type\Message;

require_once __DIR__.'/vendor/autoload.php';

$dataSource = new JsonDataSource(__DIR__.'/data/');
$messageManager = new MessageManager($dataSource);
$userManager = new UserManager($dataSource);
$dependencyContainer = new DependencyContainer();

$dependencyContainer
  ->set('manager.message',$messageManager)
  ->set('manager.user',$userManager)
;

$app = new App($dependencyContainer);

$messageView = function(Message $message){
  return <<<VIEW
  <div>
  <b>UserID: {$message->getUserId()}</b>
  <b>Username: {$message->getUser()->getUsername()}</b>
<br>
  <time>{$message->getDate()->format("Y-m-d H:i:s")}</time>
  <p>Message: {$message}</p>
  </div>
VIEW;
};

$messageListView = function(Collection $collection,callable $itemRenderer){
  $items = $collection->map(function(Message $message)use($itemRenderer){
    return $itemRenderer($message);
  });

  return <<<VIEW
  <div class="message-list">
    {$items->concat()}
  </div> 
VIEW;

};

?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Render Results</title>

</head>

<body>
    <h1>Echo Messages for Chat ID = 3 Here as HTML</h1>
    <div><?php 
  echo $messageListView($app->getMessagesByChatId(3),$messageView);
/* Call Your Class Here using echo() */?></div>

    <h1>Render Messages for Chat ID = 8 Here as JSON</h1>
    <div><?php 
    echo $app->asJSON($app->getMessagesByChatId(8));
/* Call Your Class Here using json_encode() */?></div>

    <h1>Render User ID = 100 Here as JSON</h1>
    <div><?php 
    echo $app->asJSON($app->getUserById(100));  
/* Call Your Class Here using json_encode() */?></div>
    
    <h1>Echo Message ID = 459 Here as HTML</h1>
    <div><?php 
  echo $messageView($app->getMessageById(459));  
/* Call Your Class Here using echo() */?></div>
</body>
</html>
