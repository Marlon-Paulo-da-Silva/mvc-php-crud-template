<?php

namespace App\Helpers;

use App\Utils\Uri;

$base = new URI();
$base =  $base->base();

define("BASE_URL", $base);

function base_url()
{
  return BASE_URL;
}

?>