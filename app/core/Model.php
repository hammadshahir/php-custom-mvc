<?php
/** Main Model class */
class Model
{
    use Database;
    protected $table = 'users';
    protected $limit = 10;
    protected $offset = 0;

    public function first($data, $data_not = [])
    {
       
    }

    public function where($data, $dataNot = [])
    {
        $keys = array_keys($data);
        $keysNot = array_keys($dataNot);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
          $query .= $key . " = :". $key . " && ";
        }

        foreach ($keysNot as $keyNot) {
           $query .= $keyNot . " != :". $keyNot . " && ";
         }

        $query = trim($query, " &&");
       
        $query .= " LIMIT $this->limit OFFSET $this->offset";
        // Merging $data and $notData
        $data = array_merge($data, $dataNot);
        return $query($query, $data);
    }

    public function insert($data)
    {

    }

    public function update($id, $data, $id_column='id')
    {
        
    }

    public function delete($id, $id_column='id')
    {
        
    }
}
