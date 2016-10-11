<?php 
class President{
	public $name;
	public $gender;
	public $started;
	public function commitedError(){
		if($this->name=="Rodrigo Duterte"){	
		return true;
		}else{
		return false;
		}
	}
	public function reason($name){
		$reasons = array(
			'HINDI AKO ANG PROBLEMA','CHANGE IS COMING','PATAYIN KO KAYO EH','EVERYTIME I SEE THE VIDEO NANDIDIRI AKO',
			'I H8 CHINESE BUT I LOVE THEM NOW.',
			'CHINA > USA',
			'ETC');

	}
	public function setAttributes($name,$gender,$started){
		$this->name= $name;
		$this->gender= $gender;
		$this->started= $started;

	}
	public function hisTards(){
		if($this->name=="Rodrigo Duterte"){
			$reasons = array('KASANALAN NI PNOY YAN EH','STOP DRUGS/LEGALIZE MARIJUANA','MARIJUAN CURES CANCER','<INSERT ILLOGICAL REASONS HERE');
		}else{
			$reasons = array('TRAIN IS COMING','TRAFFIC IS JUST A STATE OF MIND','YELLOW IS LOVE','MY MAMA/PAPA DONT LIKE YOU THEY LIKE EVERYONE',);
	
		}
		foreach($reasons as $x){
			echo $x."<br>";
		}
	}
	public static function HateOrLoveIt(){
		echo 'MARCOS PA DIN ( by COACH MACKHIE )';
	}
}

$duterte = new President();
$duterte->setAttributes('Rodrigo Duterte','MALE','2016');
$pnoy= new President();
$pnoy->setAttributes('Benigno Aquino III','MALE','2010');
if($duterte->commitedError()){
	$duterte->reason($duterte->name);
	$duterte->hisTards();
}else{
 	$pnoy->hisTards();
}

//panapos
$panapos = new President();
$panapos::HateOrLoveIt();

?>