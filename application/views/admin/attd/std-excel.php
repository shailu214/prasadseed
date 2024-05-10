
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
		<b>	STUDENT ATTENDANCE REPORT &nbsp; | &nbsp; <?=$batch?> | &nbsp; <?=$my?></b>
		</td></tr>
    <tr><td colspan="5" style="border:none;"></td></tr>
		<tr>
			<th>STUDENT NAME </th>
			<th>PRESENTS</th>
			<th>SUNDAY</th>
			<th>ABSENTS</th>
			<th>PERCENT</th>
		</tr>
		<?php foreach ($result as $key => $val) : ?>
      <tr>
        <td align="center"> <?=$val['fname'].' '.$val['lname']?>  </td>
        <td align="center"> <?=$val['atd']?>  d</td>
        <td align="center"> <?=$val['sunday']?>  d</td>
        <td align="center"> <?=$val['absent']?>  d</td>
        <td align="center"><?=$val['prc']?>%  </td>
      </tr>
		<?php endforeach; ?>

	</table>
