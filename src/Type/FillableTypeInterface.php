<?php
namespace Delirehberi\Type;

interface FillableTypeInterface
{
  public static function fromArray(array $data):self;
}
