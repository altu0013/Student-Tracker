<?php
	class Student{		

		private $id;
		private $name;
		private $telNo;
		private $dob;
		private $file_name;
				
		function __construct($id, $name, $telNo, $dob){
			$this->setId($id);
			$this->setName($name);
			$this->setTelNo($telNo);
			$this->setDob($dob);
			}		
		
		public function getName(){
			return $this->name;
		}
		
		public function setName($name){
			$this->name = $name;
		}
		

		public function getTelNo(){
			return $this->telNo;
		}

		public function setTelNo($telNo){
			$this->telNo = $telNo;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getId(){
			return $this->id;
		}

		public function getDob(){
			return $this->dob;
		}

		public function setDob($dob){
			$this->dob = $dob;
		}

		public function getFileName(){
			return $this->file_name;
		}

		public function setFileName($file_name){
			$this->file_name = $file_name;
		}

	}
?>