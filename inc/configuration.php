<?php
session_start();

class Sql {
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect("127.0.0.1", "andre", "210215", "hcode_shop");

        if (!$this->conn) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }

    public function query($string_query){

		return mysqli_query($this->conn, $string_query);

	}

    public function select($string_query) {
        $result = $this->query($string_query);
        $data = array();

        while ($row = mysqli_fetch_array($result)) {
	        
	    	foreach ($row as $key => $value) {
	    		$row[$key] = utf8_encode($value);
	    	}

	        array_push($data, $row);

	    }

	    unset($result);

	    return $data;

        /*if ($result !== false) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }

            mysqli_free_result($result);
        } else {
            die('Error in select: ' . mysqli_error($this->conn) . '<br>Query: ' . $string_query);
        }

        return $data;*/
    }

    public function __destruct() {
        mysqli_close($this->conn);
    }
}
?>
