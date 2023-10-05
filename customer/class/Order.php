<?php
class Order {	
   
	private $orderstable = 'food_orders';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function insert(){		
		if($this-prodName) {
			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->ordersTable."(`item_id`, `name`, `price`, `quantity`, `order_date`, `order_id`)
			VALUES(?,?,?,?,?,?)");		
			$this->prodId = htmlspecialchars(strip_tags($this->prodIdd));
			$this->prodName = htmlspecialchars(strip_tags($this->prodName));
			$this->prodPrice = htmlspecialchars(strip_tags($this->prodPrice));
			$this->quantity = htmlspecialchars(strip_tags($this->quantity));
			$this->order_date = htmlspecialchars(strip_tags($this->order_date));
			$this->orderId = htmlspecialchars(strip_tags($this->order_id));			
			$stmt->bind_param("isiiss", $this->prodId, $this->prodName, $this->prodPrice, $this->quantity, $this->order_date, $this->order_id);			
			if($stmt->execute()){
				return true;
			}		
		}
	}	
}
?>