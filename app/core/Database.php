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
        $con = $this->connect();
        $stm = $con->prepare($query);

        if ($stm->execute($data)) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if (!empty($result)) {
                return $result;
            }
        }

        return false;
    }

    public function get_row($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        if ($stm->execute($data)) {
            $result = $stm->fetch(PDO::FETCH_OBJ);
            if ($result) {
                return $result;
            }
        }

        return false;
    }
}