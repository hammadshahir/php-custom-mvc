<?php
/** Main Model Trait */
Trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $orderByDesc = "DESC";
    protected $orderColumn = "id";

    public function first($data, $data_not = [])
    {
        try {
            // Separate keys for inclusion and exclusion conditions
            $keys = array_keys($data);
            $keysNot = array_keys($data_not);

            // Build the SQL query with placeholders
            $query = "SELECT * FROM $this->table WHERE ";

            $conditions = [];

            // Build inclusion conditions
            foreach ($keys as $key) {
                $conditions[] = "$key = :$key";
            }

            // Build exclusion conditions
            foreach ($keysNot as $keyNot) {
                $conditions[] = "$keyNot != :$keyNot";
            }

            $query .= implode(' AND ', $conditions);

            // Add LIMIT and OFFSET clauses
            $query .= " LIMIT $this->limit OFFSET $this->offset";

            // Combine data and data_not arrays
            $params = array_merge($data, $data_not);

            // Execute the query
            $result = $this->query($query, $params);

            // Check if a result was found
            if ($result) {
                return $result[0];
            }

            throw new Exception("No result found.");
        } catch (Exception $e) {
            // Handle the exception or log it as needed
            throw $e;
            // For now, we'll return false to indicate no result.
            return false;
        }
    }

    public function findAll($data = [], $dataNot = [])
    {
        try {
            $query = "SELECT * FROM $this->table 
                        ORDER BY $this->orderColumn $this->orderByDesc 
                        LIMIT $this->limit OFFSET $this->offset";

            $result = $this->query($query);

            return $result;
        } catch (Exception $e) {
            // Handle the exception or log it as needed
            return false;
        }
    }

    public function where($data, $dataNot = [])
    {
        try {
            // Separate keys for inclusion and exclusion conditions
            $keys = array_keys($data);
            $keysNot = array_keys($dataNot);

            // Build the SQL query with placeholders
            $query = "SELECT * FROM $this->table WHERE ";

            $conditions = [];

            // Build inclusion conditions
            foreach ($keys as $key) {
                $conditions[] = "$key = :$key";
            }

            // Build exclusion conditions
            foreach ($keysNot as $keyNot) {
                $conditions[] = "$keyNot != :$keyNot";
            }

            $query .= implode(' AND ', $conditions);

            // Add ORDER BY, if specified
            if ($this->columnId) {
                $query .= " ORDER BY $this->columnId";
                if ($this->orderByDesc) {
                    $query .= " DESC";
                }
            }

            // Add LIMIT and OFFSET clauses
            $query .= " LIMIT $this->limit OFFSET $this->offset";

            // Combine data and dataNot arrays
            $params = array_merge($data, $dataNot);

            // Execute the query
            return $this->query($query, $params);
        } catch (Exception $e) {
            throw $e;
            // For now, we'll return false to indicate an error.
            return false;
        }
    } // End of where()


    public function insert($data)
    {
        try {
            /* Remove unwanted data */
            if(!empty($this->allowedColumns))
            {
                foreach ($data as $key => $value) {
                   if (!in_array([$key, $this->allowedColumns])) {
                       unset($data[$key]);
                   }
                }
            }

            $keys = array_keys($data);
    
            $query = "INSERT INTO $this->table (" . implode(", ", $keys) . ") VALUES (:" . implode(", :", $keys) . ")";
    
            $this->query($query, $data);
    
            // If the insertion was successful, you can return true or some other indication of success.
            //return true;
        } catch (Exception $e) {
            
            // throw $e;
            
            // For now, we'll return false to indicate an error.
            return false;
        }
    } // End of insert()
    

    public function update($id, $data, $id_column = 'id')
    {
        try {
            /* Remove unwanted data */
            if(!empty($this->allowedColumns))
            {
                foreach ($data as $key => $value) {
                   if (!in_array([$key, $this->allowedColumns])) {
                       unset($data[$key]);
                   }
                }
            }
            $keys = array_keys($data);

            $query = "UPDATE $this->table SET ";

            foreach ($keys as $key) {
                $query .= "$key = :$key, ";
            }

            $query = trim($query, ", ");

            $query .= " WHERE $id_column = :$id_column ";

            $data[$id_column] = $id;

            $this->query($query, $data);

            // If the update was successful, you can return true or some other indication of success.
            // return true;
        } catch (Exception $e) {
            
            // throw $e;
            
            // For now, we'll return false to indicate an error.
            return false;
        }
    }

    public function delete($id, $id_column = 'id')
    {
        try {
            $data[$id_column] = $id;

            $query = "DELETE FROM $this->table WHERE $id_column = :$id_column ";

            $this->query($query, $data);

            // If the delete was successful, you can return true or some other indication of success.
            //return true;
        } catch (Exception $e) {
            // throw $e;

            // For now, we'll return false to indicate an error.
            return false;
        }
    }
}
