<?php
namespace Delirehberi\DataSource;

use Delirehberi\Type\Collection;
use Delirehberi\Type\Message;
use Delirehberi\Type\User;
use Exception;

class JsonDataSource implements DataSourceInterface
{
  private string $folder_name;
  public function __construct(string $folder_name)
  {
    $this->folder_name = $folder_name;
    return $this;
  }

  public function resource_type(string $resource_name):string
  {
    $type_map = [
      'users'=>User::class,
      'messages'=>Message::class,
    ];
    if(!in_array($resource_name, array_keys($type_map)))
    {
      throw new Exception("Undefined type.".$resource_name);
    }

    return $type_map[$resource_name];
  }
  public function loadResource(string $resource_name):Collection
  {
    $resource_uri = $this->folder_name.'/'.$resource_name.'.json';
    if(!is_file($resource_uri)) {
      throw new Exception("Resource file doesn't find.");
    }
    return $this->deserialize(file_get_contents($resource_uri),$resource_name);
  }

  public function deserialize(string $data,string $resource_name): Collection 
  {
    $decoded_data = json_decode($data,true);
    $type = $this->resource_type($resource_name);
    $items = array_map(function($item)use($type){
      return $type::fromArray($item);
    },$decoded_data);
    return new Collection($items);
  }
}
