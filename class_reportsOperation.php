<?php
class reportsOperation {
    private $client_data;
    
    public function __construct($ifx_account = '', $email_address = '') {
        if(isset($ifx_account) && !empty($ifx_account)) {
            $this->client_data = $this->set_client_data($ifx_account);
        }
    }

	public function expenses_table($reference_no=NULL, $created_by=NULL, $category=NULL, $note=NULL, $start_date=NULL, $end_date=NULL) {
        global $db_handle;
      	 $query = "SELECT * FROM sma_expenses WHERE date != 'NULL' ";
		 if (!empty($reference_no)){
			$query .= "AND reference= '$reference_no' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		 if (!empty($category)){
			$query .= "AND category_id= '$category' "; 
		 }
		 if (!empty($note)){
			$query .= "AND note= '$note' "; 
		 }
		 if (!empty($start_date) and empty($end_date)){
			$query .= "AND date = '$start_date' "; 
		 }
		 if (!empty($start_date) and !empty($end_date)){
			$query .= "AND date BETWEEN '$start_date' AND '$end_date' "; 
		 }
			$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}
	
	public function total_sales($customer_id=NULL, $created_by=NULL){
        global $db_handle;
      	$query = "SELECT * FROM sma_sales WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
       	$numQuery = $db_handle->numRows($query);

        return $numQuery ? $numQuery : 0;
		
	}

	public function total_sales_returns($customer_id=NULL, $created_by=NULL){
        global $db_handle;
      	$query = "SELECT * FROM sma_sales_returns WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
       	$numQuery = $db_handle->numRows($query);

        return $numQuery ? $numQuery : 0;
		
	}
	
	public function total_sales_record($customer_id=NULL, $created_by=NULL, $salespoint=NULL, $reference_no=NULL, $start_date=NULL, $end_date=NULL){
        global $db_handle;
      	$query = "SELECT * FROM sma_sales WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		 if (!empty($salespoint)){
			$query .= "AND salespoint_id= '$salespoint' "; 
		 }
		 if (!empty($serial)){
			$query .= "AND reference_no= '$reference_no' "; 
		 }
		 if (!empty($start_date) and empty($end_date)){
			$query .= "AND DATE_FORMAT(date,'%Y-%m-%d') = '$start_date'"; 
		 }
		 if (!empty($start_date) and !empty($end_date)){
			$query .= "AND date BETWEEN '$start_date' AND '$end_date' "; 
		 }
		 $query .= "ORDER BY date DESC"; 
       	$numQuery = $db_handle->numRows($query);

        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
		return $fetched_data;
		
	}
	
	public function total_sales_amount($customer_id=NULL, $created_by=NULL, $yearmonth=NULL, $salespoint=NULL, $sales_officer_assigned, $start_date=NULL, $end_date=NULL){
        global $db_handle;
      	$query = "SELECT SUM(grand_total) AS sum_amount FROM sma_sales WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		 if (!empty($salespoint)){
			$query .= "AND salespoint_id= '$salespoint' "; 
		 }
		 if (!empty($yearmonth)){
			$query .= "AND DATE_FORMAT(date,'%Y-%m') = '$yearmonth'"; 
		 }
		 if (!empty($start_date) and empty($end_date)){
			$query .= "AND DATE_FORMAT(date,'%Y-%m-%d') = '$start_date'"; 
		 }
		 if (!empty($start_date) and !empty($end_date)){
			$query .= "AND date BETWEEN '$start_date' AND '$end_date' "; 
		 }
		$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data[0]['sum_amount'] ? $fetched_data[0]['sum_amount'] : 0;
		
	}

	public function total_sales_paid($customer_id=NULL, $created_by=NULL){
        global $db_handle;
      	$query = "SELECT SUM(paid) AS sum_paid FROM sma_sales WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data[0]['sum_paid'] ? $fetched_data[0]['sum_paid'] : 0;
		
	}

	public function total_purchases($supplier_id=NULL, $created_by=NULL){
        global $db_handle;
      	$query = "SELECT * FROM sma_purchase_items WHERE supplier_id != 'NULL' ";
		 if (!empty($supplier_id)){
			$query .= "AND supplier_id= '$supplier_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
       	$numQuery = $db_handle->numRows($query);

        return $numQuery ? $numQuery : 0;
		
	}
	
	public function total_purchases_amount($supplier_id=NULL, $created_by=NULL){
        global $db_handle;
      	$query = "SELECT SUM(subtotal) AS sum_amount FROM sma_purchase_items WHERE supplier_id != 'NULL' ";
		 if (!empty($supplier_id)){
			$query .= "AND supplier_id= '$supplier_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data[0]['sum_amount'] ? $fetched_data[0]['sum_amount'] : 0;
		
	}

	public function total_purchases_paid($supplier_id=NULL){
        global $db_handle;
      	$query = "SELECT SUM(suppl_paid) AS sum_paid FROM sma_purchase_items WHERE supplier_id != 'NULL' ";
		 if (!empty($supplier_id)){
			$query .= "AND supplier_id= '$supplier_id' "; 
		 }
		$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data[0]['sum_paid'] ? $fetched_data[0]['sum_paid'] : 0;
		
	}
	
	public function total_order_tax_amount($customer_id=NULL, $created_by=NULL, $yearmonth=NULL, $salespoint=NULL){
        global $db_handle;
      	$query = "SELECT SUM(order_tax) AS order_tax FROM sma_sales WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		 if (!empty($salespoint)){
			$query .= "AND salespoint_id= '$salespoint' "; 
		 }
		 if (!empty($yearmonth)){
			$query .= "AND DATE_FORMAT(date,'%Y-%m') = '$yearmonth'"; 
		 }
		$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data[0]['order_tax'] ? $fetched_data[0]['order_tax'] : 0;
		
	}

	public function total_product_tax_amount($customer_id=NULL, $created_by=NULL, $yearmonth=NULL, $salespoint=NULL){
        global $db_handle;
      	$query = "SELECT SUM(product_tax) AS product_tax FROM sma_sales WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		 if (!empty($salespoint)){
			$query .= "AND salespoint_id= '$salespoint' "; 
		 }
		 if (!empty($yearmonth)){
			$query .= "AND DATE_FORMAT(date,'%Y-%m') = '$yearmonth'"; 
		 }
		$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data[0]['product_tax'] ? $fetched_data[0]['product_tax'] : 0;
		
	}

	public function total_shipping_amount($customer_id=NULL, $created_by=NULL, $yearmonth=NULL, $salespoint=NULL){
        global $db_handle;
      	$query = "SELECT SUM(shipping) AS shipping FROM sma_sales WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		 if (!empty($salespoint)){
			$query .= "AND salespoint_id= '$salespoint' "; 
		 }
		 if (!empty($yearmonth)){
			$query .= "AND DATE_FORMAT(date,'%Y-%m') = '$yearmonth'"; 
		 }
		$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data[0]['shipping'] ? $fetched_data[0]['shipping'] : 0;
		
	}

	public function total_discount_amount($customer_id=NULL, $created_by=NULL, $yearmonth=NULL, $salespoint=NULL){
        global $db_handle;
      	$query = "SELECT SUM(total_discount) AS total_discount FROM sma_sales WHERE customer_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		if (!empty($salespoint)){
			$query .= "AND salespoint_id= '$salespoint' "; 
		 }
		 if (!empty($yearmonth)){
			$query .= "AND DATE_FORMAT(date,'%Y-%m') = '$yearmonth'"; 
		 }
		$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data[0]['total_discount'] ? $fetched_data[0]['total_discount'] : 0;
		
	}

	public function purchases_table($reference_no=NULL, $supplier_id=NULL, $created_by=NULL, $category=NULL, $note=NULL, $start_date=NULL, $end_date=NULL) {
        global $db_handle;
      	 $query = "SELECT * FROM sma_purchase_items WHERE date != 'NULL' ";
		 if (!empty($reference_no)){
			$query .= "AND reference= '$reference_no' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		 if (!empty($supplier_id)){
			$query .= "AND (supplier_id= '$supplier_id' OR real_supplier_id= '$supplier_id') "; 
		 }
		 if (!empty($category)){
			$query .= "AND category_id= '$category' "; 
		 }
		 if (!empty($note)){
			$query .= "AND note= '$note' "; 
		 }
		 if (!empty($start_date) and empty($end_date)){
			$query .= "AND date = '$start_date' "; 
		 }
		 if (!empty($start_date) and !empty($end_date)){
			$query .= "AND date BETWEEN '$start_date' AND '$end_date' "; 
		 }
			$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}

	public function supplier_payments($supplier_id=NULL, $purchase_id=NULL){
		 global $db_handle;
      	 /*$query = "SELECT sma_payments.date AS date, sma_payments.amount AS amount, sma_purchases.reference_no as purch_reference_no, sma_payments.reference_no as paym_reference_no,sma_payments.paid_by,sma_payments.type
		 FROM sma_purchases,sma_payments 
		 WHERE sma_purchases.id=sma_payments.purchase_id AND sma_purchases.supplier_id='$supplier_id'";*/
		$query = "SELECT purch.*,pp.*, paym.reference_no AS paym_reference_no, paym.paid_by,paym.type
		FROM sma_purchases AS purch
		LEFT JOIN sma_purch_pay_log AS pp ON purch.id = pp.purchase_id
		LEFT JOIN sma_payments AS paym ON paym.purchase_id = purch.id
		WHERE pp.supplier_id='$supplier_id' LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}

	public function supplier_payments_created_by($created_by=NULL, $purchase_id=NULL){
		 global $db_handle;
      	 $query = "SELECT sma_payments.date AS date, sma_payments.amount AS amount, sma_purchases.reference_no as purch_reference_no, sma_payments.reference_no as paym_reference_no,sma_payments.paid_by,sma_payments.type
		 FROM sma_purchases,sma_payments 
		 WHERE sma_purchases.id=sma_payments.purchase_id AND sma_payments.created_by='$created_by'";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}
	
	public function customer_payments($customer=NULL, $created_by=NULL, $salespoint=NULL, $reference_no=NULL,$start_date=NULL,$end_date=NULL){
		 global $db_handle;
      	 $query = "SELECT sma_payments.date AS date, sma_payments.amount AS amount, sma_sales.reference_no as sale_reference_no, sma_payments.reference_no as paym_reference_no,sma_payments.paid_by,sma_payments.type
		 FROM sma_sales,sma_payments 
		 WHERE sma_sales.id=sma_payments.sale_id ";
		 if (!empty($customer)){
			$query .= "AND sma_sales.customer_id= '$customer' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND sma_payments.created_by= '$created_by' "; 
		 }
		 if (!empty($salespoint)){
			$query .= "AND sma_payments.salespoint_id= '$salespoint' "; 
		 }
		 if (!empty($reference_no)){
			$query .= "AND sma_payments.reference_no= '$reference_no' "; 
		 }
		 if (!empty($start_date) and empty($end_date)){
			$query .= "AND DATE_FORMAT(sma_payments.date,'%Y-%m-%d') = '$start_date'"; 
		 }
		 if (!empty($start_date) and !empty($end_date)){
			$query .= "AND sma_payments.date BETWEEN '$start_date' AND '$end_date' "; 
		 }
		 $query .= "ORDER BY sma_payments.id DESC";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}
	
	public function payments($sale_id=NULL, $purchase_id=NULL, $return_id=NULL, $created_by=NULL, $salespoint_id=NULL, $reference_no=NULL, $note=NULL, $start_date=NULL, $end_date=NULL) {
        global $db_handle;
      	 $query = "SELECT * FROM sma_payments WHERE date != 'NULL' ";
		 if (!empty($sale_id)){
			$query .= "AND sale_id= '$sale_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		 if (!empty($purchase_id)){
			$query .= "AND purchase_id= '$purchase_id' "; 
		 }
		 if (!empty($return_id)){
			$query .= "AND return_id= '$return_id' "; 
		 }
		 if (!empty($salespoint_id)){
			$query .= "AND salespoint_id= '$salespoint_id' "; 
		 }
		 if (!empty($reference_no)){
			$query .= "AND reference_no= '$reference_no' "; 
		 }
		 if (!empty($note)){
			$query .= "AND note= '$note' "; 
		 }
		 if (!empty($start_date) and empty($end_date)){
			$query .= "AND date = '$start_date' "; 
		 }
		 if (!empty($start_date) and !empty($end_date)){
			$query .= "AND date BETWEEN '$start_date' AND '$end_date' "; 
		 }
			$query .= "ORDER BY date DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}

	public function user_login_reports($user_id=NULL, $company_id=NULL, $login=NULL, $start_date=NULL, $end_date=NULL) {
        global $db_handle;
      	 $query = "SELECT * FROM sma_user_logins WHERE user_id != 'NULL' ";
		 if (!empty($user_id)){
			$query .= "AND user_id= '$user_id' "; 
		 }
		 if (!empty($company_id)){
			$query .= "AND company_id= '$company_id' "; 
		 }
		 if (!empty($login)){
			$query .= "AND login= '$login' "; 
		 }
		 if (!empty($start_date) and empty($end_date)){
			$query .= "AND time = '$start_date' "; 
		 }
		 if (!empty($start_date) and !empty($end_date)){
			$query .= "AND time BETWEEN '$start_date' AND '$end_date' "; 
		 }
			$query .= "ORDER BY time DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data ? $fetched_data : false;
	}

	public function best_sellers($customer_id=NULL, $created_by=NULL, $yearmonth=NULL, $salespoint=NULL){
        global $db_handle;
      	$query = "SELECT SUM(quantity) AS total_quantity, product_id,product_name FROM sma_sale_items WHERE product_id != 'NULL' ";
		 if (!empty($customer_id)){
			$query .= "AND customer_id= '$customer_id' "; 
		 }
		 if (!empty($created_by)){
			$query .= "AND created_by= '$created_by' "; 
		 }
		if (!empty($salespoint)){
			$query .= "AND salespoint_id= '$salespoint' "; 
		 }
		 if (!empty($yearmonth)){
			$query .= "AND DATE_FORMAT(date,'%Y-%m') = '$yearmonth'"; 
		 }
		$query .= "ORDER BY total_quantity DESC "; 
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);

        return $fetched_data? $fetched_data : 0;
		
	}


}
?>