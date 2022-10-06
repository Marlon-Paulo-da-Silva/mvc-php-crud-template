<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\Organization;

class About extends Page {
  public static function getAbout(){

    $obOrganization = new Organization;

    // echo '<pre>';
    // print_r($obOrganization);
    // exit;

    $content = View::render('pages/about', [
      'name' => $obOrganization->name,
      'site' => $obOrganization->site,
      'description' => $obOrganization->description
    ]);

    return parent::getPage('Sobre',$content);
  }
}