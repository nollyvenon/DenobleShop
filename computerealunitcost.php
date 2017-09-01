<?php

$dispmessage = '';
 $cost_price=addslashes($_GET["q"]) ? $_GET["q"] : 0;
 $shipping_cost=addslashes($_GET["r"]) ? $_GET["r"] : 0;
 $tax=addslashes($_GET["s"]) ? $_GET["s"] : 0;
 $expenses=addslashes($_GET["t"]) ? $_GET["t"] : 0;
 $quantity=addslashes($_GET["u"]) ? $_GET["u"] : 0;
 
 //get real unit cost
  $rut =(($shipping_cost + $tax + $expenses)/$quantity) + $cost_price;
  if ($rut == "" || $rut =='undefined'|| empty($rut) == true)$rut =0;
?>                           
<div class="col-md-4"><div class="form-group">
    Real Unit Cost
    <input name="real_unit_cost" id="real_unit_cost" value="<?php echo $rut;?>" class="form-control tip" type="text" > 
</div></div>                               
