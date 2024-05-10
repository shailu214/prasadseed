
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
		<b>	ATTENDANCE REPORT <?=$my?></b>
		</td></tr>
    <tr><td colspan="5" style="border:none;"></td></tr>
		<tr>
			<th>MONTH </th>
			<th>ATTENDANCE</th>
			<th>HOLIDAY</th>
			<th>PRESENT</th>
			<th>ABSENT</th>
			<th>PERCENT</th>
		</tr>
		<?php foreach ($result as $key => $val) : ?>
      <tr>
        <td align="center"> <?=$val['month'].'-'.$val['year']?> </td>
        <td align="center"> <?=$val['wday']?></td>
        <td align="center"> <?=$val['sun']?></td>
				<td align="center"><?=$val['atd']?></td>
				<td align="center"><?=$val['abs']?></td>
        <td align="center"><?=$val['prc']?>%</td>
      </tr>
		<?php endforeach; ?>

	</table>
