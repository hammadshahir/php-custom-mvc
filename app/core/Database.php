<?php

Trait Database
{
    private function connect()
	{
		$string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
		$con = new PDO($string,DBUSER,DBPASS);
		return $con;
	}

    public function query($query, $data = [])
    {
        try {
            $con = $this->connect();
            $stm = $con->prepare($query);

            if ($stm->execute($data)) {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                if (!empty($result)) {
                    return $result;
                }
            }

            return false;
        } catch (PDOException $e) {
            // throw $e;
            echo "Database query failed: " . $e->getMessage();
            return false;
        }
    }


    public function get_row($query, $data = [])
    {
        try {
            $con = $this->connect();
            $stm = $con->prepare($query);
    
            if ($stm->execute($data)) {
                $result = $stm->fetch(PDO::FETCH_OBJ);
                if ($result) {
                    return $result;
                }
            }
    
            return false;
        } catch (PDOException $e) {
            // throw $e;
            echo "Database query failed: " . $e->getMessage();
            return false;
        }
    }    
}