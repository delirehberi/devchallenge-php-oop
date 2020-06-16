<?php
namespace Delirehberi\Type;

use ArrayAccess;
use JsonSerializable;

class Collection implements ArrayAccess,JsonSerializable
{
  private $items;
  /**
   * @param ?array $items=null
   */
  public function __construct(?array $items=[])
  {
    $this->items = $items;
  }

  public function add(int $key,$value=null)
  {
    if(!isset($this->items[$key])){
      $this->items[$key]=$value;
    }
    return $this;
  }

  public function remove(int $key):self
  {
    if(isset($this->items[$key])) {
      unset($this->items[$key]);
    }
    return $this;
  }

  public function has($value)
  {
    if(is_array($value) || is_object($value)) {
      throw new \Exception("Comparison doesn't works except primitive types.");
    }
    return array_search($value,$this->items);
  }

  public function get(int $key)
  {
    return isset($this->items[$key])?$this->items[$key]:null;
  }

  public function offsetExists($offset) {
    return isset($this->items[$offset]);
  }
  public function offsetGet($offset ) {
    return $this->get($offset);
  }
  public function offsetSet($offset , $value ){
    return $this->add((int)$offset, $value);
  }
  public function offsetUnset($offset ){
    return $this->remove((int)$offset);
  }

  public function filter(callable $validator) {
    $filteredItems = array_filter($this->items,$validator);
    return new self($filteredItems);
  }

  public function map(callable $modifier) {
    $modifiedItems = array_map($modifier,$this->items);
    return new self($modifiedItems);
  }

  public function concat():string
  {
    return join('',$this->items);
  }

  public function jsonSerialize():array{
    return $this->items;
  }

  public function shift(){
    return array_shift($this->items);
  }

  public function sort(callable $alg) {
    $newElements = $this->items;
    usort($newElements,$alg);
    return new self($newElements);
  }
}
