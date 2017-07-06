<?php

/*
 * ##################################################
 * #                                                #
 * # rkCSD-WebsiteEngine_3                          #
 * # A simple, modular and flexible CMS             #
 * #                                                #
 * # Copyright (C) by rkCSD Eu                      #
 * #                                                #
 * #	                           email@rkcsd.com  #
 * #              www.customsoftwaredevelopment.de  #
 * #                                                #
 * ##################################################
 *
 * File: mysql.php
 * Version: 2.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

class mysql
{
	private $cid;

	function __construct($host, $user, $pass, $db)
	{
		if($host != '' && $user != '' && $pass != '' && $db != '')
		{
			$this->cid = new mysqli($host, $user, $pass, $db);
			/*if (!$this->cid) {
				return $this->error();
			}*/
			if ($this->cid->connect_error) {
				die('Connection failed: ' . $this->cid->connect_error);
			}
			$this->query("SET NAMES UTF8");
		}
		else
		{
			die('Please provide a Hostname, User, Password and a database to connect with you database.');
		}
	}

	function query($query)
	{
		return $this->cid->query($query);
	}

	function fetch_array($fetch_array)
	{
		return $fetch_array->fetch_array(MYSQLI_ASSOC);
	}

	function num_rows($num_rows)
	{
		return $num_rows->num_rows;
	}

	function escape($str)
	{
		return $this->cid->real_escape_string($str);
	}

	function insert($table, $values)
	{
		$qcols = "";
		$qvals = "";
		$i = 0;
		foreach ($values as $key => $val) {
			if ($i > 0) {
				$qcols .= ", ";
				$qvals .= ", ";
			}
			$qcols .= '`'.$key.'`';
			$qvals .= ((is_string($val)) ? "'".$val."'" : ((is_null($val) ? "NULL" : $val)));
			$i++;
		}
		$query = "INSERT INTO ".$table." (".$qcols.") VALUES (".$qvals.")";
		return $this->query($query);
	}

	function select_last_insert_id()
	{
		return $this->cid->insert_id;
	}

	function update($table, $new_values, $col, $value)
	{
		$query = "UPDATE ".$table." SET ";
		$i = 0;
		foreach ($new_values as $key => $val) {
			if ($i > 0) {
				$query .= ", ";
			}
			$query .= $key."=".((is_string($val)) ? "'".$val."'" : ((is_null($val) ? "NULL" : $val)));
			$i++;
		}
		$query .= " WHERE ".$col."='".$value."'";
		return $this->query($query);
	}

	function select($table, $col=null, $value=null, $scol=null, $smode=null, $limit1=null, $limit2=null)
	{
		$result = null;
		$q = "SELECT * FROM ".$table;
		if (!is_null($col) && !is_null($value)) {
			$q .= " WHERE ".$col."='".$value."'";
		}
		if (!is_null($scol) && !is_null($smode)) {
			$q .= " ORDER BY ".$scol." ".$smode;
		}
		if (!is_null($limit1) && !is_null($limit2)) {
			$q .= " LIMIT ".$limit1.", ".$limit2;
		}
		$dbreq = $this->query($q);
		if(!$dbreq){ echo 'SQL Error (Fetch Error)';exit;}

		while ($dbres = $this->fetch_array($dbreq)) {
			foreach (array_keys($dbres) as $col) {
				$tmp[$col] = $dbres[$col];
			}
			$result[] = $tmp;
		}
		return $result;
	}

	function select_once($table, $col, $value)
	{
		$dbreq = $this->query("SELECT * FROM ".$table." WHERE ".$col."='".$value."' LIMIT 1");
		$dbres = $this->fetch_array($dbreq);
		return $dbres;
	}

	function select_count($table, $col, $value)
	{
		$q = "SELECT COUNT(*) FROM ".$table;
		if ($col != null && $value != null) {
			$q .= " WHERE ".$col."='".$value."'";
		}
		$dbreq = $this->query($q);
		$dbres = $this->fetch_array($dbreq);
		return $dbres['COUNT(*)'];
	}

	function select_min($table, $col)
	{
		$q = "SELECT MIN(".$col.") FROM ".$table;
		$dbreq = $this->query($q);
		$dbres = $this->fetch_array($dbreq);
		return $dbres['MIN('.$col.')'];
	}

	function select_max($table, $col)
	{
		$q = "SELECT MAX(".$col.") FROM ".$table;
		$dbreq = $this->query($q);
		$dbres = $this->fetch_array($dbreq);
		return $dbres['MAX('.$col.')'];
	}

	function delete($table, $col, $value)
	{
		$query = "DELETE FROM ".$table." WHERE ".$col."='".$value."'";
		return $this->query($query);
	}

	function truncate($table)
	{
		return $this->query("TRUNCATE TABLE ".$table);
	}

	function error()
	{
		if (mysql_errno() != 0) {
			die("<br />\n<b>MySQL error</b>:  ".mysql_errno().": ".mysql_error()."<br />\n");
		}
	}

	/*function disconnect()
	{
		return mysql_close($this->cid);
	}*/

	function __destruct()
	{
		mysqli_close($this->cid);
	}
}

?>