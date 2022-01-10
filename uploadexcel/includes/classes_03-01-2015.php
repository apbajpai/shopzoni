<?php
     class DB
     {
	 	var $host = 'localhost';
		
		
		/*var $user = 'shanmukh_new_acc';
		var $password = 'new@123';
		var $database = 'shanmukh_new_acc'; */
		
		
		var $user = 'root';
		var $password = '';
		var $database = 'account'; 
		
		var $persistent = false;
        var $conn = NULL;
        var $result = false;
        var $fields;
        var $check_fields;
        var $tbname;
        var $addNewFlag = false;

        function DB($host="",$user="",$password="",$dbname="",$open=false)
        {
         if($host!="")
            $this->host=$host;
         if($user!="")
            $this->user=$user;
         if($password!="")
            $this->password=$password;
         if($dbname!="")
            $this->database=$dbname;

         if($open)
           $this->open();
        }
		
        function open($host="",$user="",$password="",$dbname="")
        {
         if($host!="")
            $this->host=$host;
         if($user!="")
            $this->user=$user;
         if($password!="")
            $this->password=$password;
         if($dbname!="")
            $this->database=$dbname;

         $this->connect();
         $this->select_db();
        }
        function set_host($host,$user,$password,$dbname)
        {
         $this->host=$host;
         $this->user=$user;
         $this->password=$password;
         $this->database=$dbname;
        }
        function affectedRows() //-- Get number of affected rows in previous operation
        {
         return @mysql_affected_rows($this->conn);
        }
        function close() //-- Close a connection to a  Server
        {
         return @mysql_close($this->conn);
        }
        function connect() //-- Open a connection to a Server
        {
          //-- Choose the appropriate connect function
          if ($this->persist)
              $func = 'mysql_pconnect';
          else
              $func = 'mysql_connect';

          //-- Connect to the database server
          $this->conn = $func($this->host, $this->user, $this->password);
          if(!$this->conn)
             return false;
              
        }
        function select_db($dbname="") //-- Select a databse
        {
          if($dbname=="")
             $dbname=$this->database;
          mysql_select_db($dbname,$this->conn);
        }
        function create_db($dbname) //-- Create a database
        {
          return @mysql_create_db($dbname,$this->conn);
        }
        function drop_db($dbname) //-- Drop a database
        {
         return @mysql_drop_db($dbname,$this->conn);
        }
        function data_seek($row) //-- Move internal result pointer
        {
         return mysql_data_seek($this->result,$row);
        }
        function error() //Get last error
        {
            return (mysql_error());
        }
        function errorno() //Get error number
        {
            return mysql_errno();
        }
        function query($sql = '') //Execute the sql query
        {
            $this->result = @mysql_query($sql, $this->conn);
            return ($this->result != false);
        }
        function numRows() //Return number of rows in selected table
        {
            return (@mysql_num_rows($this->result));
        }
    	  function fieldName($field)
        {
           return (@mysql_field_name($this->result,$field));
        }
    	  function insertID()
        {
            return (@mysql_insert_id($this->conn));
        }
        function fetchObject()
        {
            return (@mysql_fetch_object($this->result, MYSQL_ASSOC));
        }
        function fetchArray($mode=MYSQL_BOTH)
        {
            return (@mysql_fetch_array($this->result,$mode));
        }
        function fetchAssoc()
        {
            return (@mysql_fetch_assoc($this->result));
        }
        function freeResult()
        {
            return (@mysql_free_result($this->result));
        }
		function getSingleResult($sql)
		{
			$this->query($sql);
			$row=$this->fetchArray(MYSQL_NUM);
			$return=$row[0];
			return $return;
		}
		
		function insert_data($table,$insert_value)
		{
			$items = $insert_value;
			foreach($items as $item=>$val){
			 $fname .= "`".$item."`,";
			 $vname .= "'".$val."',";
			}
	    $qry="INSERT INTO ".$table." (".substr($fname,0,strlen($fname)-1).") VALUES( ".substr($vname,0,strlen($vname)-1).")";
		//echo $qry; exit;
		if($this->query($qry)==1)
			{
				return 1;
			}
		}
		
		function update_data($table,$insert_value,$condt)
		{
			$items = $insert_value;
			foreach($items as $item=>$val){
			 $fname .= $item."='".$val."',";
			}
	     $qry="UPDATE $table SET ".substr($fname,0,strlen($fname)-1)." WHERE $condt"; 
			//echo $qry;
	    if($this->query($qry)==1)
			{
				return 1;
			}
		}
		
		function delete_data($table,$condt)
		{
			$qry="DELETE FROM $table WHERE $condt";
			 if($this->query($qry)==1)
			{
				return 1;
			}
		}

		function getTableData($table,$whereClause="")
		{
		    $query="select * from $table where $whereClause";
			$result=@mysql_query($query);
			$row=@mysql_fetch_array($result);
			return $row;
		}
		function checkExist($tbl_name,$col_name,$val)
		{
			$query="SELECT $col_name FROM $tbl_name WHERE $col_name='$val'";
			$result=@mysql_query($query);
			if(!mysql_num_rows($result))
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		
		
		function getAnyTableWhereData($table,$whereClause="")
		{
			$query="select * from $table where 1=1 $whereClause";
			$result=@mysql_query($query);
			if($row=@mysql_fetch_array($result))
			{
				@mysql_free_result($result);
				return $row;
			}
			else
			{
				return false;
			}
		}
		
     }
?>
