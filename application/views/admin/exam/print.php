<html>
<head>
<style>
body {
  font-family:helvetica;
  font-size: 15px;
}
.tbl {
  border: 1px solid #333;
  margin: auto;
  border-collapse: collapse;
  width: 700px;
}
th,td {
  padding: 15px;
  /* border: 1px solid */
}
.ch-tbl {
  width: 100%;
  border: none;
}
.ch-tbl td {
  border-left:1px solid;
  text-align: center;
}
.ch-tbl th{
  border: 1px solid;
}

</style>

</head>

<body>
<table class="tbl">
  <tr>
    <td colspan="2" align="center">
      <img src="<?=base_url()?>media/config/<?=LOGO?>"  width="160"/>
    </td>
  </tr>
  <tr>
    <td >
      Name : <?=$name?></br>
      Course : <?=$course?></br>
      Batch : <?=$batch_name?></br>
    </td>
    <td width="100" align="right"><small>Exam Code</small> <b><?=$ex_code?></b></td>
  </tr>
  <tr>
  <td colspan="2" style="padding:0px;" >
    <table class="tbl ch-tbl">
      <tr>
        <th style="border-left:none" >Subject</th>
        <th>Maximum Marks</th>
        <th>Obtained Marks</th>
        <th style="border-right:none" >Percentage</th>
      </tr>
      <?php foreach ($marks as $key => $val) : ?>
      <tr>
        <td style="border:none"><?=$val['subject']?></td>
        <td><?=$mx[] = $val['mx_marks']?></td>
        <td><?=$val['marks']?></td>
        <td style="border-right:none"> <?=$val['marks']/$val['mx_marks']*100; ?>%</td>
      </tr>
    <?php endforeach; ?>
    <!-- <tr>
      <th>Total</th>
      <th><?=$mxt = array_sum($mx)?></th>
      <th ><?=$total?></th>
      <td > <?=floor($total/$mxt*100); ?>%</td>
    </tr> -->
    </table>
</td>
</tr>
<tr>
  <th style="border-top:1px solid; text-align:right" >TOTAL</th>
  <th style="border-top:1px solid" ><?=$total?></th>
</tr>
<tr>
  <th></th>
  <th><?=($status == 1)? 'PASSED' : 'FAILED'; ?></th>
</tr>
<tr>
  <th></th>
  <th style="padding-top:0px;">
    <?php
      if($divs == 1) {
        echo '1st Divsion';
      } elseif($divs == 2) {
        echo '2nd Divsion.';
      } elseif($divs == 3) {
        echo '3rd Divsion.';
      }
    ?>
  </th>
</tr>
</table>
</body>
</html>
