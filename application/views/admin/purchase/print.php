<!doctype html>
<html>
<head>
  <title>Invoice - <?=$code?></title>
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
      min-height: 600px;
    }
    .item-tbl {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #f1f1f1;
    }
    .item-tbl td, th { padding:8px 15px; text-align: center;}
    .item-tbl th {
      background: #f1f1f1;
    }

    .tfoot {
      text-align: right;
      padding-top: 5px;
      padding-bottom: 5px;
    }
  </style>

</head>
<body>
          <div class="row">
            <div class="col-lg-10" >
                <div class="card" style="padding:25px;">
                <table style="width:100%;">
                  <thead>
                  <tr>
                    <td>
                      <h4><?=$vnd['company_name']?></h4>
                      <p>
                        <?=$vnd['vendor_name']?><br>
                        <?php if(strlen($vnd['address'])) :?>
                        <?=$vnd['address']?><br>
                      <?php endif; ?>
                        Mobile : +91 <?=$vnd['mobile']?><br>
                        <?php if(strlen($vnd['email'])) :?>
                        Email : <?=$vnd['email']?>
                      <?php endif; ?>
                      </p><br>
                    </td>
                    <td style="vertical-align:text-top">
                      <u><b>PURCHASE ORDER</b></u>
                    </td>
                    <td style="text-align:right; vertical-align:text-top">
                      <b>
                        <small>Invoice No.</small><br>
                        <?=$code?>
                      </b><br><br>
                      Date : <?=date("d-m-Y", strtotime($created))?>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="3"><br>
                      <table class="item-tbl">
                        <tr>
                          <th>S.No.</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Amount</th>
                          <th>GST</th>
                          <th style="text-align:right">Sub Total &nbsp; </th>
                        </tr>
                        <?php $i=0; foreach ($items as $key => $val) : $i++;?>
                          <tr>
                            <td><?=$i?></td>
                            <td><?=$val['product_name']?></td>
                            <td><?=$val['qty']?></td>
                            <td><?=$val['price']?></td>
                            <td><?=$val['gst_amt']?></td>
                            <td style="text-align:right"><?=$val['total']?> &nbsp; </td>
                          </tr>
                        <?php endforeach; ?>
                        <tr>
                          <th colspan="5" class="tfoot">Total</th>
                          <th class="tfoot"><?=$amount?> &nbsp; </th>
                        </tr>
                        <tr>
                          <th colspan="5" class="tfoot">Grand Total</th>
                          <th class="tfoot"><?=$total?> &nbsp; </th>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </tbody>
                </table>

                <table style="width:100%;">
                    <tbody>
                      <tr>
                          <table class="item-tbl">
                            <tr style="border-bottom:1px solid #eee;">
                              <td ><b>Paid :</b> Rs. <?=$paid?></td>
                              <td ><b>Due :</b> Rs. <?=$due?></td>
                              <td colspan="3"></td>
                            </tr>
                            <?php if(!empty($payments)) : ?>
                            <tr>
                              <td colspan="5"><b>Payment Detail</b></td>
                            </tr>
                            <tr>
                              <th width="100">Mode</th>
                              <th>Description</th>
                              <th>Amount</th>
                              <th>Date</th>
                            </tr>
                            <?php $i=0; foreach ($payments as $pk => $pv) : $i++;?>
                              <tr>
                                <td>
                                  <?php if($pv['mode'] == 1) : ?>
                                    Cash
                                  <?php elseif($pv['mode'] == 2) : ?>
                                    Cheque
                                  <?php elseif($pv['mode'] == 3) : ?>
                                    Credit/Debit Card
                                  <?php elseif($pv['mode'] == 4) : ?>
                                    WalletApp or Online
                                  <?php endif; ?>
                                </td>
                                <td><?=$pv['pay_desc']?></td>
                                <td>Rs. <?=$pv['amount']?></td>
                                <!-- <td><?=$pv['remark']?></td> -->
                                <td><?=date("d-m-Y", strtotime($pv['created']))?></td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                          </table>
                        </td>
                      </tr>
                      <tr><td colspan="3"><br><br></td></tr>
                      <tr><td colspan="3"><br><br></td></tr>
                      <tr>
                        <td colspan="3" align="right">
                          <b>From : &nbsp;</b><br>
                          <b><?=COM_NAME?></b><br>
                          <b><?=MOBILE?></b><br>
                          <b><?=EMAIL?></b>
                        </td>
                      </tr>
                    </tbody>
                    </table>

              </div>
            </div>
          </div>
<script>
		window.print();
		window.close();
</script>
</body>
</html>
