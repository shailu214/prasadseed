
<?php
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"StudentAttendanceReport-".date("d-m-Y").".xls\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
?>
	<table width="50%" border="1">
		<tr><td style="border-bottom:1px dashed #000" colspan="5" style="border:none;font-size:17px;text-align:center">
		<b>	EXPENCES REPORT <?=$my?></b>
		</td></tr>
    <tr><td colspan="5" style="border:none;"></td></tr>
		<tr>
			<th>CATEGORY </th>
			<th>SUBCATEGORY</th>
			<th>DESCRIPTION</th>
			<th>DATE</th>
			<th>AMOUNT</th>
		</tr>
		<?php foreach ($result as $key => $val) : ?>
      <tr>
        <td align="center"> <?=$val['pcat']?></td>
        <td align="center"> <?=$val['category']?></td>
        <td align="center"> <?=$val['title']?></td>
        <td align="center"> <?=date("d-m-Y", strtotime($val['created']))?></td>
        <td align="center"><?=$val['amount']?></td>
        <?php $sum[] = $val['amount']; ?>
      </tr>
		<?php endforeach; ?>
    <tr>
      <th colspan="4" align="right">Total Amount</th>
      <th><?=array_sum($sum)?></th>
    </tr>
	</table>