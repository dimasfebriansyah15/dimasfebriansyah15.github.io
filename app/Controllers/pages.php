<?php

namespace App\Controllers;

class Pages extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Home | DimasFebriansyah',
      'tes' => ['satu', 'dua', 'tiga']
    ];
    return view('pages/home', $data);
  }
  public function about()
  {
    $data = [
      'title' => 'About Me'
    ];
    return view('pages/about', $data);
  }

  public function contact()
  {
    $data = [
      'title' => 'Contact Us',
      'alamat' => [
        [
          'tipe' => 'rumah',
          'alamat' => 'jl.abc No 23',
          'kota' => 'jakarta'
        ],
        [
          'tipe' => 'Kantor',
          'alamat' => 'jl sudirman No 323',
          'kota' => 'jakarta'
        ]
      ]
    ];
    return view('pages/contact', $data);
  }
  //--------------------------------------------------------------------

}
