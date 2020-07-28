<?php

namespace App\Controllers;

use App\Models\Pmodel;
use CodeIgniter\RESTful\ResourceController;

class peron extends ResourceController
{
   protected $format = 'json';
   protected $modelName = 'use App\Models\Pmodel';

   public function __construct()
   {
      $this->pmodel = new Pmodel();
       header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Credentials: true');
      header('Access-Control-Allow-Methods: POST,GET,DELETE,PUT');
      header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
   }

   public function index()
   {
      $pmodel = $this->pmodel->getperon();

      foreach ($pmodel as $row) {
         $pmodel_all[] = [
            'id' => intval($row['id']),
            'Nama' => $row['Nama'],
            'Pengarang' => $row['Pengarang'],
            'Penerbit' => $row['Penerbit'],
            'terbit' => $row['terbit'],
            'bahasa' => $row['bahasa'],
            'page' => $row['page'],
            'gambar' => $row['gambar'],
            'sinopsis' => $row['sinopsis'],
            'preview' => $row['preview'],
         ];
      }

      return $this->respond($pmodel_all, 200);
   }

   public function create()
   {
      $Nama = $this->request->getPost('Nama');
        $Pengarang = $this->request->getPost('Pengarang');
        $Penerbit = $this->request->getVar('Penerbit');
        $terbit = $this->request->getPost('terbit');
        $bahasa = $this->request->getPost('bahasa');
        $page = $this->request->getPost('page');
        $gambar = $this->request->getPost('gambar');
        $sinopsis = $this->request->getPost('sinopsis');
        $preview = $this->request->getPost('preview');      

      $data = [
         'Nama' => $Nama,
        'Pengarang' => $Pengarang,
        'Penerbit' => $Penerbit,
        'terbit' => $terbit,
        'bahasa' => $bahasa,
        'page' => $page,
        'sinopsis' => $sinopsis,
        'gambar' => $gambar,
        'preview' => $preview
      ];

      $simpan = $this->pmodel->insertperon($data);

      if ($simpan == true) {
         $output = [
            'status' => 200,
            'message' => 'Berhasil menyimpan data',
            'data' => ''
         ];
         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Gagal menyimpan data',
            'data' => ''
         ];
         return $this->respond($output, 400);
      }
   }

   public function show($id = null)
   {
      $pmodel = $this->pmodel->getperon($id);

      if (!empty($pmodel)) {
         $output = [
            'id' => intval($pmodel['id']),
            'Nama' => $pmodel['Nama'],
             'Pengarang' => $pmodel['Pengarang'],
         'Penerbit' => $pmodel['Penerbit'],
         'terbit' => $pmodel['terbit'],
         'bahasa' => $pmodel['bahasa'],
         'page' => $pmodel['page'],
         'sinopsis' => $pmodel['sinopsis'],
         'gambar' => $pmodel['gambar'],
         'preview' => $pmodel['preview']
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Data tidak ditemukan',
            'data' => ''
         ];

         return $this->respond($output, 400);
      }
   }

   public function edit($id = null)
   {
      $pmodel = $this->pmodel->getperon($id);

      if (!empty($pmodel)) {
         $output = [
            'id' => intval($pmodel['id']),
            'Nama' => $pmodel['Nama'],
             'Pengarang' => $pmodel['Pengarang'],
         'Penerbit' => $pmodel['Penerbit'],
         'terbit' => $pmodel['terbit'],
         'bahasa' => $pmodel['bahasa'],
         'page' => $pmodel['page'],
         'sinopsis' => $pmodel['sinopsis'],
         'gambar' => $pmodel['gambar'],
         'preview' => $pmodel['preview']
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => 400,
            'message' => 'Data tidak ditemukan',
            'data' => ''
         ];
         return $this->respond($output, 400);
      }
   }

   public function update($id = null)
   {
      // menangkap data dari method PUT, DELETE
      $data = $this->request->getRawInput();

      // cek data berdasarkan id
      $pmodel = $this->pmodel->getperon($id);

      //cek peron
      if (!empty($pmodel)) {
         // update data
         $updateperon = $this->pmodel->updateperon($data, $id);

         $output = [
            'status' => true,
            'data' => '',
            'message' => 'sukses melakukan update'
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => false,
            'data' => '',
            'message' => 'gagal melakukan update'
         ];

         return $this->respond($output, 400);
      }
   }

   public function delete($id = null)
   {
      // cek data berdasarkan id
      $pmodel = $this->pmodel->getperon($id);

      //cek peron
      if (!empty($pmodel)) {
         // delete data
         $deleteperon = $this->pmodel->deleteperon($id);

         $output = [
            'status' => true,
            'data' => '',
            'message' => 'sukses hapus data'
         ];

         return $this->respond($output, 200);
      } else {
         $output = [
            'status' => false,
            'data' => '',
            'message' => 'gagal hapus data'
         ];

         return $this->respond($output, 400);
      }
   }

   //--------------------------------------------------------------------

}
