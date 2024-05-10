
<?php
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"StudentDueList-".date("d-m-Y").".xls\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
?>
	<table width="50%" border="1">
		<tr><td style="border-bottom:1px dashed #000" colspan="5" style="border:none;font-size:17px;text-align:center">
		<b>	STUDENT DUE LIST &nbsp; | &nbsp; <?=(strlen($batch))? $batch : "All Batch"; ?></b>
		</td></tr>
    <tr><td colspan="5" style="border:none;"></td></tr>
		<tr>
      <th>CODE</th>
			<th>STUDENT NAME </th>
			<th>CONTACT NO.</th>
			<th>DUE AMOUNT</th>
			<th>JOIN DATE</th>
		</tr>
    <?php foreach ($result as $key => $val ) { $sn++;?>
    <tr>
      <td> <?=$val['code']?>  </td>
      <td> <?=$val['fname'].' '.$val['lname']?>  </td>
      <td> <?=$val['mobile']?>  </td>
      <td> <?=$val['due']+$val['fee']?>  </td>
      <td> <?=date("d-m-Y", strtotime($val['created']))?>  </td>
    </tr>
  <?php } ?>

	</table>
