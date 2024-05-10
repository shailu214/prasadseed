
<?php
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"StaffAttendanceReport-".date("d-m-Y").".xls\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
?>
	<table width="100%" border="1">
		<tr><td colspan="6" style="border:none;"><b>Coaching Application</b></td></tr>
		<tr><td colspan="6" style="border:none;">------------------------------------------------</td></tr>
		<tr><td colspan="6" style="border:none;">STAFF ATTENDANCE REPORT</td></tr>
		<tr><td colspan="6" style="border:none;">------------------------------------------------</td></tr>
		<tr><td colspan="6" style="border:none;" align="left"><?=$my?></td></tr>
		<tr><td colspan="6" style="border:none;">------------------------------------------------</td></tr>
    <tr><td colspan="6" style="border:none;"></td></tr>
		<tr>
			<th>Name </th>
			<th>Working Days</th>
			<th>Holiday</th>
			<th>Absent</th>
			<th>Working Hours</th>
      <th>Extra hour</th>
			<th>Salary</th>
		</tr>
		<?php foreach ($result as $key => $val) : ?>
      <tr>
        <td align="center"> <?=$val['fname'].' '.$val['lname']?>  </td>
        <td align="center"> <?=$val['wday']?>  d</td>
        <td align="center"> <?=$val['sunday']?>  d</td>
        <td align="center"> <?=$val['absent']?>  d</td>
        <td align="center"> <?=$val['whr']?> hr</td>
        <td align="center"> <?=$val['ex_hr']?> hr</td>
        <td align="center">Rs. <?=$val['sallary']?>  </td>
      </tr>
		<?php endforeach; ?>

	</table>
