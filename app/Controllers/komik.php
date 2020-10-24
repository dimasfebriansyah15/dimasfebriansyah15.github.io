<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
  public function __construct()
  {
    $this->komikModel = new KomikModel();
  }
  public function index()
  {
    $komik = $this->komikModel->findall();
    $data = [
      'title' => 'Daftar komik',
      'komik' => $komik
    ];
    // cara konek db tanpa model
    // $db = \Config\Database::connect();
    // $komik = $db->query("SELECT * FROM komik");
    // foreach ($komik->getResultArray() as $row) {
    //   d($row);
    // };
    return view('komik/index', $data);
  }
}
