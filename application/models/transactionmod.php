<?php
class TransactionMod extends CI_Model{

    public function Start(){
    	$sql	= "START TRANSACTION";

		$query	= $this->db->query($sql);
    }

    public function Commit(){
        $sql    = "COMMIT";

        $query  = $this->db->query($sql);
    }

    public function Rollback(){
        $sql    = "ROLLBACK";

        $query  = $this->db->query($sql);
    }
}
?>