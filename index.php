<?php
require_once __DIR__.'/vendor/autoload.php';

$dataSource = new JsonDataSource(__DIR__.'/data/');
$messageManager = new MessageManager($dataSource);
$userManager = new UserManager($dataSource);
$dependencyManager = new DependencyManager();

$dependencyManager
  ->add('manager.message',$messageManager)
  ->add('manager.user',$userManager)
;

$app = new App($dependencyManager);

$messageView = function(Message $message){

  return <<<VIEW
  <div>
  <b>{$message->getUser()->getUsername()}</b>
  <p>{$message->getMessage()}</p>
  </div>
VIEW;

}

$messageListView = function(Collection $collection,callable $itemRenderer){

  $items = array_map(function(Message $message)use($itemRenderer){
    return $itemRenderer($message);
  },$collection);

  $itemsHtml = join('',$items);

  return <<<VIEW
  <div class="message-list">
    {$items}
  </div> 
VIEW;

}

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
    echo json_encode($app->getMessagesByChatId(8));  
/* Call Your Class Here using json_encode() */?></div>

    <h1>Render User ID = 100 Here as JSON</h1>
    <div><?php 
    echo json_encode($app->getUserById(100));  
/* Call Your Class Here using json_encode() */?></div>
    
    <h1>Echo Message ID = 459 Here as HTML</h1>
    <div><?php 
  echo $messageView($app->getMessageById(459));  
/* Call Your Class Here using echo() */?></div>
</body>
</html>
