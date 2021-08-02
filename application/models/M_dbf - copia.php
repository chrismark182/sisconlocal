<?php
require_once("./vendor/dompdf/dompdf/autoload.inc.php");
use XBase\Table;
use XBase\WritableTable;

class M_dbf
{
	public function __construct(){

	}

	/* Guardar */
	public function create($tabla, $datos, $limpiar){
		$plantilla = dirname(dirname(__FILE__)) .'../../assets/dbf/plantilla/'.$tabla.'.dbf';
		$generado = dirname(dirname(__FILE__)) .'../../assets/dbf/generado/'.$tabla.'.dbf';
		if (file_exists($generado)) {
			// echo 'Archivo existe';
			// foreach ($datos as $key => $value):
			//  	echo $key . ":" . $value . "<br>";
			// endforeach;	
			$table = new WritableTable($generado);
			$table->openWrite();
			$record = $table->appendRecord();
			foreach ($datos as $key => $value):
				$record->$key = $value;
				//echo $key . ":" . $value . "<br>";
			endforeach;			
			$table->writeRecord();
			$table->close();
			return true;
		}else
		{
			echo 'Archivo no encontrado';
			return false;
		}

		// try {
		// 	//$table = new WritableTable(dirname(__FILE__).'../../dbf/generado/'.$tabla.'.dbf');
		// 	$table = new WritableTable($generado);
		// 	$table->openWrite();
		// 	$record = $table->appendRecord();
		// 	foreach ($datos as $key => $value):
		// 		$record->$key = $value;
		// 		//echo $key . ":" . $value . "<br>";
		// 	endforeach;			
		// 	$table->writeRecord();
		// 	$table->close();
		// 	return true;
		// } catch (\Throwable $th) {
		// 	throw $th;
		// 	return false;
		// }
	}

	public function multiCreate($file, $data)
	{
		$table = new WritableTable(dirname(__FILE__).'../../dbf/generado/'.$file.'.dbf');
		$table->openWrite();
		for ($i=0; $i < count($data); $i++) { 
			$record = $table->appendRecord();
			foreach ($data[$i] as $key => $value):
				$record->$key = $value;
			endforeach;	
			$table->writeRecord();
		}
		$table->close();
	}
	/*
	 *
	 */
	public function read($tabla, $colums){
		$table = new Table(dirname(__FILE__).'../../dbf/'.$tabla.'.dbf', $colums);
		$data = array();
		$i = 0;
		while ($record = $table->nextRecord()) {
			//var_dump($record);
			$row = array();
			foreach($colums as $colum):
				 $row[$colum] = $record->$colum;
			endforeach;
			$data[$i] = $row;
			//echo 'N: '.$i .'<br>';
			//echo '<br>';
			$i++;
		}
		//var_dump($data);
		return $data;
	}

	public function update($tabla, $datos, $donde){
		//$this->output->enable_profiler(TRUE);
		$this->db->where($donde);
		if ($this->db->update($tabla, $datos)) {

			$r = $this->read($tabla, $donde);
			return $r[0];
		}else{
			return FALSE;
		}
	}

	public function delete($tabla, $datos){
		$table = new WritableTable(dirname(__FILE__).'../../dbf/'.$tabla.'.dbf');
		$table->openWrite();
		//var_dump($table->recordCount);
		for ($i=0; $i < $table->recordCount; $i++) { 
			$record = $table->nextRecord();
			//echo 'Record:' . $table->getRecord();
			echo $i;
			//$table->deleteRecord();		
		}
		$table->close();
	}

	public function sql($sql){
		$query = $this->db->query($sql);
		return $query->result();
	}
}