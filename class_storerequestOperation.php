<?php
class storerequestOperation {
    private $client_data;
    
    public function __construct($ifx_account = '', $email_address = '') {
        if(isset($ifx_account) && !empty($ifx_account)) {
            $this->client_data = $this->set_client_data($ifx_account);
        }
    }

	public function view_storerequest_info_by_id($request_id) {
        global $db_handle;
      	 $query = "SELECT * FROM sma_stores_requests WHERE id='$request_id'";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        $fetched_data = $fetched_data[0];
        return $fetched_data ? $fetched_data : false;
	}
	
	public function view_salespointrequest_info_by_id($request_id) {
        global $db_handle;
      	 $query = "SELECT * FROM sma_salespoint_requests WHERE id='$request_id'";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        $fetched_data = $fetched_data[0];
        return $fetched_data ? $fetched_data : false;
	}
	
	public function view_warehousererequest_info_by_id($request_id) {
        global $db_handle;
      	 $query = "SELECT * FROM sma_warehouses_requests WHERE id='$request_id'";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        $fetched_data = $fetched_data[0];
        return $fetched_data ? $fetched_data : false;
	}
	
	public function view_salespoint_request($salespoint=NULL, $store = NULL) {
        global $db_handle;
	$query = "SELECT us.*, s.name as store_name, u.username as creator,sp.name as salespoint_name
                FROM sma_salespoint_requests AS us
				LEFT JOIN sma_stores AS s ON us.store_id = s.id
                LEFT JOIN sma_users AS u ON us.created_by = u.id
				LEFT JOIN sma_salespoints AS sp ON us.salespoint_id = sp.id ";
		if ($salespoint != ""){
			$query .= "WHERE us.salespoint_id = '$salespoint' ";
		}
		if ($store != "" && $salespoint != ""){
			$query .= "AND ";
		}
		if ($store != ""){
			$query .= "us.store_id = '$store' ";
		}
		$query .= "ORDER BY us.id DESC ";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}
	
	public function view_store_request($warehouse=NULL, $store = NULL) {
        global $db_handle;
	$query = "SELECT us.*, s.name as store_name, u.username as creator, us.created_by as created_by,sp.name as warehouse_name
                FROM sma_stores_requests AS us
				LEFT JOIN sma_stores AS s ON us.store_id = s.id
                LEFT JOIN sma_users AS u ON us.created_by = u.id
				LEFT JOIN sma_warehouses AS sp ON us.warehouse_id = sp.id 
				WHERE us.warehouse_id !='NULL' ";
		if ($warehouse != ""){
			$query .= "AND us.warehouse_id = '$warehouse' ";
		}
		if ($store != ""){
			$query .= "AND us.store_id = '$store' ";
		}
		$query .= "ORDER BY us.id DESC ";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}
	
	public function add_storerequest_items($request_id, $warehouse, $store, $product, $sellingprice, $serialnumber, $quantity, $subtotal){
        global $db_handle;
		$zentabooks_operation = new zentabooksOperation();
		$prod_det =  $zentabooks_operation->view_product_detail($product);
		$product_code = $prod_det['code'];
		$product_name = $prod_det['name'];
		$product_type = $prod_det['type'];
		$category_id = $prod_det['category_id'];
		$unit_price = $prod_det['price'];
		$sale_unit = $prod_det['sale_unit'];
		$unit_det =  $zentabooks_operation->unit_detail($prod_det['sale_unit']);
		$query = "INSERT INTO sma_stores_request_items (store_request_id, warehouse_id, store_id, product_id, product_code, product_name, stock_before_trans, stock_after_trans, option_id, category_id, quantity, selling_price, serialnumber,subtotal) VALUES
		 ('$request_id', '$warehouse', '$store', '$product', '$product_code', '$product_name', '$stor_qty', '$new_balance', '$option_id', '$category_id', '$quantity', '$sellingprice', '$serialnumber', '$subtotal')";
			$i_id = $db_handle->runQuery($query);
		
        return $i_id;

	}

	public function add_salespointrequest_items($request_id, $salespoint, $store, $product, $sellingprice, $serialnumber, $quantity, $subtotal){
        global $db_handle;
		$zentabooks_operation = new zentabooksOperation();		
		$prod_det =  $zentabooks_operation->view_product_detail($product);
		$product_code = $prod_det['code'];
		$product_name = $prod_det['name'];
		$product_type = $prod_det['type'];
		$unit_price = $prod_det['unit_price'];
		$sale_unit = $prod_det['sale_unit'];
		$unit_det =  $zentabooks_operation->unit_detail($prod_det['sale_unit']);
			$salp_qty = $zentabooks_operation->get_salespoint_qty_by_productid($product,$salespoint);
			$new_balance = $salp_qty + $quantity;
		$query = "INSERT INTO sma_salespoint_request_items (salespoint_request_id, salespoint_id, store_id, product_id, product_code, product_name, stock_before_trans, stock_after_trans, product_price, option_id, quantity, serial_no,subtotal) VALUES
		 ('$request_id', '$salespoint', '$store', '$product', '$product_code', '$product_name', '$salp_qty', '$new_balance', '$sellingprice', '$option_id', '$quantity', '$serialnumber', '$subtotal')";
			$i_id = $db_handle->runQuery($query);
		
        return $i_id;

	}

/*	public function add_warehouserequest_items($request_id, $warehouse, $store, $product,  $serialnumber, $quantity){
        global $db_handle;
		$zentabooks_operation = new zentabooksOperation();
		$prod_det =  $zentabooks_operation->view_product_detail($product);
		$unit_det =  $zentabooks_operation->unit_detail($prod_det['sale_unit']);
		$query = "INSERT INTO sma_warehouses_request_items (warehouse_request_id, warehouse, store, product_id, product_code, product_name, product_type, option_id, net_unit_price, unit_price, quantity, product_unit_id, product_unit_code, unit_quantity,serial_no) VALUES
		 ('$request_id', '$warehouse', '$store', '$product', ".$prod_det['product_code'].", ".$prod_det['product_name'].", ".$prod_det['type'].", '$option_id', '$netunitprice', ".$prod_det['unit_price'].", '$quantity', '$product_unit_id', '$product_unit_code', ".$prod_det['sale_unit'].", '$serialnumber')";
			$i_id = $db_handle->runQuery($query);
		
        return $i_id;

	}*/

	public function add_storerequest($date, $reference_no, $warehouse, $store, $document, $status, $note, $user_code){
        global $db_handle;
		
		$query = "INSERT INTO sma_stores_requests(date, reference_no, warehouse_id, store_id, attachment, status, note, created_by) VALUES 
		('$date', '$reference_no', '$warehouse', '$store', '$document', '$status', '$note', '$user_code')";
		$db_handle->runQuery($query);
		$sale_id  = $db_handle->insertedId();
		return $sale_id;		
	}	

	/*public function add_warehouserequest($date, $reference_no, $warehouse, $store, $document, $status, $note, $user_code){
        global $db_handle;
		
		$query = "INSERT INTO sma_warehouses_requests(date, reference_no, warehouse_id, store_id, document, status, note, user_code) VALUES 
		('$date', '$reference_no', '$warehouse', '$store', '$document', '$status', '$note', '$user_code')";
		$db_handle->runQuery($query);
        
		$sale_id  = $db_handle->insertedId();
		return $sale_id;		
	}	*/
	
	public function add_salespointrequest($date, $reference_no, $salespoint, $store, $document, $status, $note, $user_id){
        global $db_handle;
		
		$query = "INSERT INTO sma_salespoint_requests(date, reference_no, salespoint_id, store_id, attachment, status, note, created_by) VALUES 
		('$date', '$reference_no', '$salespoint', '$store', '$document', '$status', '$note', '$user_id')";
		$db_handle->runQuery($query);
        
		$salep_id  = $db_handle->insertedId();
	    $this->add_salespointrequest_items($salep_id);
		return $salep_id;		
	}	

	public function del_salespoint_requests($id){
        global $db_handle;
		
	    $query = "INSERT INTO sma_deleted_salespoint_requests select * from sma_salespoint_requests where id = '$id';";
        $result = $db_handle->runQuery($query);

	    $query = "INSERT INTO sma_deleted_salespoint_request_items select * from sma_salespoint_request_items where id = '$id';";
        $result = $db_handle->runQuery($query);
		
		$query1 = "DELETE FROM sma_salespoint_requests where id = '$id'";
        $result1 = $db_handle->runQuery($query1);

		$query1 = "DELETE FROM sma_salespoint_request_items where id = '$id'";
        $result1 = $db_handle->runQuery($query1);

        return $db_handle->affectedRows() > 0 ? true : false;

	}

	
	public function approve_storerequest_items($request_id, $warehouse=NULL, $store=NULL, $product=NULL, $quantity=NULL){
        global $db_handle;
		$zentabooks_operation = new zentabooksOperation();
		
		$query22="SELECT * FROM sma_stores_request_items WHERE store_request_id = '44'"; 
	  $result22 = $db_handle->runQuery($query22);
		while($row22 = mysqli_fetch_array($result22)){
			 $store= $row22["store_id"];
			 $warehouse=$row22["warehouse_id"];
			 $product=$row22["product_id"];
			 $quantity=$row22["quantity"];

	     	$query = "UPDATE sma_stores_request_items SET status = 'approved' WHERE store_request_id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
			/*$newquantity =  $zentabooks_operation->get_store_qty_by_productid($product,$store) + $quantity;
	     	$query = "UPDATE sma_stores_products SET quantity = '$newquantity' WHERE product_id = '$product' AND store_id='$store' LIMIT 1";
			$db_handle->runQuery($query);

			$newquantity =  $zentabooks_operation->get_warehouse_qty_by_productid($product,$warehouse) - $quantity;
	     	$query = "UPDATE sma_warehouses_products SET quantity = '$newquantity' WHERE product_id = '$product' AND warehouse_id='$warehouse' LIMIT 1";
			$db_handle->runQuery($query);*/
			$sreference_no = $this->view_storerequest_info_by_id($request_id)['reference_no'];

			$date = date('Y-m-d H:i:s', time());
			$wareh_qty = $zentabooks_operation->get_warehouse_qty_by_productid($product,$warehouse);
			$new_balance = $wareh_qty - $quantity;
		    $query = "UPDATE sma_warehouses_products SET quantity = '$new_balance' WHERE product_id = '$product' AND warehouse_id='$warehouse' LIMIT 1";
			$db_handle->runQuery($query);
			$product_name = $zentabooks_operation->view_product_detail($product)['name'];
			$trans_count = $zentabooks_operation->get_no_of_monthly_transactions('sma_warehouse_stockflow',date('m'))+1;
			//$refno = "WRHFLW/".date('Y').'/'.date('m').'/'.sprintf("%04s", $trans_count);
			$query = "INSERT INTO sma_warehouse_stockflow (date, product_id, product_name, qtyout, balance, stock_before_trans, stock_after_trans, store_id, warehouse_id, batch,reference_no) VALUES 
			('$date', '$product', '$product_name', '$quantity', '$new_balance', '$wareh_qty', '$new_balance', '$store', '$warehouse', '$refno', '$sreference_no')";
			$db_handle->runQuery($query);		
			
			$stor_qty = $zentabooks_operation->get_store_qty_by_productid($product,$store);
			$new_balance = $stor_qty + $quantity;
		    $query = "UPDATE sma_stores_products SET quantity = '$new_balance' WHERE product_id = '$product' AND store_id='$store' LIMIT 1";
			$db_handle->runQuery($query);
			$product_name = $zentabooks_operation->view_product_detail($product)['name'];
			$trans_count = $zentabooks_operation->get_no_of_monthly_transactions('sma_store_stockflow',date('m'))+1;
			//$refno = "STRFLW/".date('Y').'/'.date('m').'/'.sprintf("%04s", $trans_count);
			$query = "INSERT INTO sma_store_stockflow (date, product_id, product_name, qtyin, balance, stock_before_trans, stock_after_trans, store_id, warehouse_id, batch,reference_no) VALUES 
			('$date', '$product', '$product_name', '$quantity', '$new_balance', '$stor_qty', '$new_balance', '$store', '$warehouse', '$refno', '$sreference_no')";
			$db_handle->runQuery($query);		
			
		}

        return $i_id;

	}

	public function approve_storerequest($request_id){
        global $db_handle;
		
	     	$query = "UPDATE sma_stores_requests SET status = 'approved' WHERE id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
        $this->approve_storerequest_items($request_id);
		$id  = $db_handle->insertedId();
		return $id;		
	}	

	/*public function approve_warehouserequest_items($request_id, $warehouse=NULL, $store=NULL, $product=NULL, $quantity=NULL){
        global $db_handle;
		
		$query="SELECT * FROM sma_warehouses_request_items WHERE warehouse_request_id = '$request_id'"; 
	  $result = $db_handle->runQuery($query);
		while($row = mysqli_fetch_array($result)){
			 $store= $row["store_id"];
			 $warehouse=$row["warehouse_id"];
			 $product=$row["product_id"];
			 $quantity=$row["quantity"];

	     	$query = "UPDATE sma_warehouses_request_items SET status = 'approved' WHERE store_request_id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
			$newquantity =  $zentabooks_operation->get_store_qty_by_productid($product,$store) + $quantity;
	     	$query = "UPDATE sma_warehouses_products SET quantity = '$newquantity' WHERE product_id = '$product' AND store_id='$store' LIMIT 1";
			$db_handle->runQuery($query);
		
		}

        return $i_id;

	}

	public function approve_warehouserequest($request_id){
        global $db_handle;
		
	     	$query = "UPDATE sma_warehouses_requests SET status = 'approved' WHERE id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
        $this->approve_warehouserequest_items($request_id);
		$id  = $db_handle->insertedId();
		return $id;		
	}*/
	
	public function approve_salespointrequest_items($request_id, $salespoint=NULL, $store=NULL, $product=NULL, $quantity=NULL){
        global $db_handle;
		$zentabooks_operation = new zentabooksOperation();
		
		$query="SELECT * FROM sma_salespoint_request_items WHERE salespoint_request_id = '$request_id'"; 
	  $result = $db_handle->runQuery($query);
		while($row = mysqli_fetch_array($result)){
			 $store= $row["store_id"];
			 $salespoint=$row["salespoint_id"];
			 $product=$row["product_id"];
			 $quantity=$row["quantity"];
			 $date=$row["date"];
			 $date=date('Y-m-d H:i:s');

	     	$query = "UPDATE sma_salespoint_request_items SET status = 'approved' WHERE salespoint_request_id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
			$sreference_no = $this->view_salespointrequest_info_by_id($request_id)['reference_no'];
			
			$cur_quantity =  $zentabooks_operation->get_salespoint_qty_by_productid($product,$salespoint);
			$newquantity =  $cur_quantity + $quantity;
	     	$query = "UPDATE sma_salespoint_products SET quantity = '$newquantity' WHERE product_id = '$product' AND salespoint_id='$salespoint' LIMIT 1";
			$db_handle->runQuery($query);
			$product_name = $zentabooks_operation->view_product_detail($product)['name'];
			$trans_count = $zentabooks_operation->get_no_of_monthly_transactions('sma_salespoint_stockflow',date('m'))+1;
			//$refno = $db_handle->sanitizePost('SALSFLW/'.date('Y').'/'.date('m').'/'.sprintf("%04s", $trans_count));
			$query = "INSERT INTO sma_salespoint_stockflow (date, product_id, product_name, qtyin, balance, stock_before_trans, stock_after_trans, store_id, salespoint_id, batch, reference_no) VALUES 
			('$date', '$product', '$product_name', '$quantity', '$newquantity', '$cur_quantity', '$newquantity', '$store', '$salespoint', '$refno', '$sreference_no')";
			$db_handle->runQuery($query);		

			$cur_stor_qty =  $zentabooks_operation->get_store_qty_by_productid($product,$store);
			$newquantity =  $cur_stor_qty - $quantity;
	     	$query = "UPDATE sma_stores_products SET quantity = '$newquantity' WHERE product_id = '$product' AND store_id='$store' LIMIT 1";
			$db_handle->runQuery($query);
			$product_name = $zentabooks_operation->view_product_detail($product)['name'];
			$trans_count = $zentabooks_operation->get_no_of_monthly_transactions('sma_store_stockflow',date('m'))+1;
			//$refno = $db_handle->sanitizePost('STRFLW/'.date('Y').'/'.date('m').'/'.sprintf("%04s", $trans_count));
			$query = "INSERT INTO sma_store_stockflow (date, product_id, product_name, qtyout, balance, stock_before_trans, stock_after_trans, store_id, salespoint_id, batch, reference_no) VALUES 
			('$date', '$product', '$product_name', '$quantity', '$newquantity', '$cur_stor_qty', '$newquantity', '$store', '$salespoint', '$refno', '$sreference_no')";
			$db_handle->runQuery($query);		

			/*$newquantity =  $zentabooks_operation->get_warehouse_qty_by_productid($product,$warehouse) - $quantity;
	     	$query = "UPDATE sma_warehouses_products SET quantity = '$newquantity' WHERE product_id = '$product' AND warehouse_id='$warehouse' LIMIT 1";
			$db_handle->runQuery($query);*/
		
		}

        return $i_id;

	}

	public function approve_salespointrequest($request_id){
        global $db_handle;
		
	     	$query = "UPDATE sma_salespoint_requests SET status = 'approved' WHERE id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
        $this->approve_salespointrequest_items($request_id);
		$id  = $db_handle->insertedId();
		return $id;		
	}		



	public function decline_storerequest_items($request_id, $warehouse=NULL, $store=NULL, $product=NULL, $quantity=NULL){
        global $db_handle;

		$query = "UPDATE sma_stores_request_items SET status = 'declined' WHERE store_request_id = '$request_id'";
		$i_id = $db_handle->runQuery($query);		
        return $i_id;

	}

	public function decline_storerequest($request_id){
        global $db_handle;
		
	     	$query = "UPDATE sma_stores_requests SET status = 'declined' WHERE id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
        $this->decline_storerequest_items($request_id);
		$id  = $db_handle->insertedId();
		return $id;		
	}	

	public function decline_salespointrequest_items($request_id, $salespoint=NULL, $store=NULL, $product=NULL, $quantity=NULL){
        global $db_handle;

		$query = "UPDATE sma_salespoint_request_items SET status = 'declined' WHERE salespoint_request_id = '$request_id'";
		$i_id = $db_handle->runQuery($query);		
        return $i_id;

	}

	public function decline_salespointrequest($request_id){
        global $db_handle;
		
	     	$query = "UPDATE sma_salespoint_requests SET status = 'declined' WHERE id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
        $this->decline_storerequest_items($request_id);
		$id  = $db_handle->insertedId();
		return $id;		
	}	

	public function decline_warehouserequest_items($request_id, $warehouse=NULL, $store=NULL, $product=NULL, $quantity=NULL){
        global $db_handle;

		$query = "UPDATE sma_warehouses_request_items SET status = 'declined' WHERE warehouse_request_id = '$request_id'";
		$i_id = $db_handle->runQuery($query);		
        return $i_id;

	}

	public function decline_warehousrequest($request_id){
        global $db_handle;
		
	     	$query = "UPDATE sma_warehouses_requests SET status = 'declined' WHERE id = '$request_id'";
			$i_id = $db_handle->runQuery($query);
        $this->decline_warehouserequest_items($request_id);
		$id  = $db_handle->insertedId();
		return $id;		
	}	
	
}
?>