<?php
namespace Delirehberi\DataSource;
use Delirehberi\Type\Collection;

interface DataSourceInterface {
  public function loadResource(string $resource_name):Collection;
}
