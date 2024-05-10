<!doctype html>
<html>
<head>
  <title>Fee Receipt - <?=$code?></title>
  <style>
  body {
    font-family: helvetica;
    font-size: 13px;
  }
  h4 {
      font-size: 18px;
      margin: 0px;
  }
    .row {
      width: 800px;
      margin: auto;
      border: 1px solid #ddd;
      min-height: 380px;
    }
    .item-tbl {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #f1f1f1;
    }
    .item-tbl td, th { padding:8px 15px; text-align: left; border: 1px solid #eee;}
    .item-tbl th {
      /* background: #f1f1f1; */
    }

  .sign {
    float: right;
    padding: 20px;
    font-size: 15px;
    font-style: italic;
    text-transform: capitalize;
  }
  </style>

</head>
<body>
          <div class="row">
            <div class="col-lg-10" >
                <div class="card" style="padding:25px; height:520px;">
                <table style="width:100%;">
                  <thead>
                  <tr>
                    <td>
                      <h4><?=COM_NAME?></h4>
                      <p>
                        Mobile : +91 <?=MOBILE?><br>
                        Email : <?=EMAIL?>
                      </p><br>
                    </td>
                    <td style="vertical-align:text-top">
                      <u><b>FEE RECEIPT</b></u>
                    </td>
                    <td style="text-align:right; vertical-align:text-top">
                      <b>
                        <small>Reciept No.</small><br>
                        <?=$code?>
                      </b><br><br>
                      Date : <?=date("d-m-Y", strtotime($created))?>
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="3"><br>
                      <table class="item-tbl">
                        <tr>
                          <td width="220"><i><b>Received from</b></i> &nbsp; </td>
                          <td><?=$name?></td>
                        </tr>
                        <tr>
                          <td><i><b>Course &amp; Batch</b></i>  &nbsp; </td>
                          <td> <?=$course?> - <?=$batch_name?></td>
                        </tr>
                        <tr>
                          <td><i><b>Contact No.</b></i>  &nbsp; </td>
                          <td> <?=$mobile?></td>
                        </tr>
                        <tr>
                          <td colspan="2"><i><b>Payment Details.</b></i>  &nbsp; </td>
                        </tr>

                        <?php if($rfee) : ?>
                        <tr>
                          <td><i><b>Reg. Fee</b></i>  &nbsp; </td>
                          <td>Rs. <?=$rfee_amt?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($other_fee) : ?>
                        <tr>
                          <td><i><b><?=$other_remark?></b></i>  &nbsp; </td>
                          <td>Rs. <?=$other_fee?></td>
                        </tr>
                        <?php endif; ?>


                        <tr>
                          <td><i><b>Monthly Fee </b></i>  &nbsp; </td>
                          <td>Rs.<?php
                            echo $amount-$rfee_amt;
                          if($month) :
                            echo " &nbsp; (";
                            $date = explode(",", $month);
                            foreach ($date as $key2 => $val2) {
                              $dts[] = date("M", strtotime("5-".$val2."-2018"));
                            }
                            echo implode(", ", $dts);
                            unset($dts);
                            echo ")";
                            endif;
                           ?>
                         </td>
                         <?php if($disc) : ?>
                         <tr>
                           <td><i><b>Discount</b></i>  &nbsp; </td>
                           <td>Rs. <?=$disc?></td>
                         </tr>
                         <?php endif; ?>
                         <tr>
                           <td><i><b>Total Amount</b></i>  &nbsp; </td>
                           <td><b>Rs. <?=$total?></b></td>
                         </tr>
                         <tr>
                           <td><i><b>Paid Amount</b></i>  &nbsp; </td>
                           <td>Rs. <?=$paid?></td>
                         </tr>
                         <?php if($disc) : ?>
                         <tr>
                           <td><i><b>Due Amount</b></i>  &nbsp; </td>
                           <td>Rs. <?=$due?></td>
                         </tr>
                        <?php endif; ?>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </tbody>
                </table>
                <span class="sign">signature</span>
              </div>
            </div>
          </div>
<script>
		// window.print();
		// window.close();
</script>
</body>
</html>
