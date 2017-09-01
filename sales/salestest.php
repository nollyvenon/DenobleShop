<?php
require_once("../includes/initialize_admin.php");
?>    <script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery-migrate-1.2.1.min.js"></script>

<table class="table table-striped table-condensed table-bordered">
<thead>
    <tr>
        <th>Item</th>
        <th width="20%">Value</th>
        <th width="20%">Quantity</th>
        <th class="actions">Total</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>Item</td>
        <td><input type="text" class="input-small" name="var_1" value="0"></td>
        <td><input type="text" class="input-small" name="var_1_1" onfocus="doCalc()" onchange="doCalc()" value="0"></td>
        <td>$<span class="amount"></span> </td>
    </tr>
    <tr>
        <td>Item</td>
        <td><input type="text" class="input-small" name="var_2" value="0"></td>
        <td><input type="text" class="input-small" name="var_2_2" onfocus="doCalc()" onchange="doCalc()" value="0"></td>
        <td>$<span class="amount"></span> </td>
    </tr>
    <tr>
        <td colspan="3"><strong>Total event cost (viability)</strong></td>
        <td><strong>$<div class="total_amount">total</div></strong></td>
    </tr>
    </tbody></table><button>Go!</button>
    
    
    <script>
	function doCalc() {
    var total = 0;
    $('tr').each(function() {
        $(this).find('span.amount').html($('input:eq(0)', this).val() * $('input:eq(1)', this).val());
    });
    $('.amount').each(function() {
        total += parseInt($(this).text(),10);
    });
    $('div.total_amount').html(total);
}
$('button').click(doCalc);

</script>