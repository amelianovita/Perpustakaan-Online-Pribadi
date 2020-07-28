<?php

namespace App\Models;

use CodeIgniter\Model;

class Pmodel extends Model
{
   protected $table = 'tdata';

   public function getperon($id = false)
   {
      if ($id === false) {
         return $this->findAll();
      } else {
         return $this->getWhere(['id' => $id])->getRowArray();
      }
   }

   public function insertperon($data)
   {
      $query = $this->db->table($this->table)->insert($data);
      if ($query) {
         return true;
      } else {
         return false;
      }
   }

   public function updateperon($data, $id)
   {
      return $this->db->table($this->table)->update($data, ['id' => $id]);
   }

   public function deleteperon($id)
   {
      return $this->db->table($this->table)->delete(['id' => $id]);
   }
}
