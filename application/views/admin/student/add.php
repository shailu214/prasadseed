
      <div class="my-3 my-md-5">
        <div class="container">
			<?php if($this->session->flashdata('success_msg')) { ?>
			<div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> <?php echo $this->session->flashdata('success_msg'); ?>
          </div>
		  <?php } ?>
          <?php if($alert ==1 ) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
        <?php elseif($alert == 2 ) : ?>
            <div class="alert alert-danger alert-dismissible ">
              <button data-dismiss="alert" class="close"></button>
              <i class="fe fe-alert-triangle"></i> &nbsp; <b>Error!</b> Student code already exists.
            </div>
          <?php endif; ?>
          <div class="row">

            <div class="col-lg-12">
              <form method="post" class="card" enctype="multipart/form-data">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-user-plus"></i> &nbsp;Student Registration</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-9">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name.." data-validation="required" name="data[fname]" data-validation-error-msg="Please enter first name." value="<?=$fname?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name.." data-validation="required" name="data[lname]" data-validation-error-msg="Please enter last name." value="<?=$lname?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" placeholder="Email" data-validation=""  name="data[email]" data-validation-error-msg="Please enter valid email address." value="<?=$email?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Contact No.</label>
                            <input type="text" class="form-control" placeholder="Contact Number.."  name="data[mobile]" data-validation="required number length" data-validation-length="10" maxlength="10"  data-validation-error-msg-length="Contact number should be 10 digit only." data-validation-error-msg="Please enter contact number.." value="<?=$mobile?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Father Name</label>
                            <input type="text" class="form-control" placeholder="Father Name.."  name="data[father_name]" value="<?=$father_name?>" data-validation="" data-validation-error-msg="Please enter father name.">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Father Contact No.</label>
                            <input type="text" class="form-control" placeholder="Contact Number.." name="data[mobile2]" value="<?=$mobile2?>" data-validation="required number length" data-validation-length="10" maxlength="10"  data-validation-error-msg-length="Contact number should be 10 digit only." data-validation-error-msg="Please enter contact number..">
                          </div>
                        </div>
						<div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Mother Name</label>
                            <input type="text" class="form-control" placeholder="Mother Name.."  name="data[mother_name]" value="<?=$mother_name?>" data-validation="" data-validation-error-msg="Please enter father name.">
                          </div>
                        </div>
						<div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Addhar Number</label>
                            <input type="text" class="form-control" placeholder="Mother Name.."  name="data[addhar_number]" value="<?=$addhar_number?>" data-validation="" data-validation-error-msg="Please enter mother name.">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-3"><br>
                      <center>
                        <?php if(strlen($image)) : ?>
                          <img src="<?=base_url()?>media/student/<?=$image?>" width="200" style="border:3px solid #D4D4D4; cursor:pointer;" />
                        <?php else : ?>
                          <img src="<?=base_url()?>media/config/default.jpg" id="pimg" width="200" style="border:3px solid #D4D4D4; cursor:pointer;" />
                        <?php endif; ?>
                      <input type="file" name="image" id="img" style="border:3px solid #d4d4d4;width:200px;"/>
                    </center>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="data[address]" placeholder="Address..." data-validation="" data-validation-error-msg="Please enter address.." value="<?=$address?>">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" name="data[city]" placeholder="City Name.." value="<?=$city?>" data-validation="required" data-validation-error-msg="Please enter city name..">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="data[status]"  class="form-control">
                          <option value="1" <?=($id>0 && $status == 1)? 'selected="selected"' : '';?>>Enable</option>
                          <option value="0" <?=($id>0 && $status == 0)? 'selected="selected"' : '';?>>Disable</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Course</label>
                        <select class="form-control" name="data[course_id]" id="course">
                          <option value="">---- Select Course ----</option>
                          <?php foreach ($course as $key => $val) : ?>
                            <option value="<?=$val['id']?>" <?=($course_id == $val['id'])? 'selected="selected"' : '';?>><?=$val['course']?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Batch</label>
                        <select class="form-control" name="data[batch]" id="bat" data-validation="required" data-validation-error-msg="Please select batch.">
                          <option value="">---- Select Batch ----</option>
                          <?php foreach ($batches as $key2 => $val2) : ?>
                            <option value="<?=$val2['id']?>" <?=($batch == $val2['id'])? 'selected="selected"' : '';?>><?=$val2['batch_name']?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Student Code</label>
                        <input type="text" name="data[code]" <?=($edit ==1 )? 'disabled="disabled"' : ''; ?> class="form-control" placeholder="Student Code.." value="<?=$code?>" data-validation="required " data-validation-error-msg-number="Student code should be numeric only." autocomplete="off" data-validation-error-msg="Please enter student code.">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Previous Codes</label>
                        <input type="text" name="data[prev_ids]" class="form-control" placeholder="Previous Student Code.." value="<?=$prev_ids?>" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Joining Date</label>
                        <input type="text" name="data[created]" class="form-control dps" data-validation="required" placeholder="Joining Date.." value="<?=($created)? date('d-m-Y', strtotime($created)) : ''; ?>" >
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Custom Info</label>
                        <table style="width:100%;">
                          <thead>
                          <tr>
                            <th>Title</th>
                            <th>Value</th>
                            <th width="200"><a href="javascript:;" id="adrow" class="btn btn-sm btn-primary">Add New</a></th>
                            <?php foreach ($custom as $ckey => $cval) : ?>
                              <tr>
                                <th style="text-align:left; width:160px;"><?=$cval['title']?> : </th>
                                <th style="text-align:left" colspan="2"> <?=$cval['sval']?></th>
                              </tr>
                            <?php endforeach; ?>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>

                        </table>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <?php if($code) { ?>
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Services</label>
                        <?php $srvs = explode(",", $services); ?>
                        <?php foreach ($srvdata as $sk => $svl) : ?>
                          <input type="checkbox" name="srv[]" <?=(in_array($svl['id'], $srvs))? 'checked="checked"' : '';?> value="<?=$svl['id']?>" /> &nbsp; <?=$svl['service_name']?> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;
                        <?php endforeach; ?>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">
                        <label class="form-label">Services</label>
                        <?php $srvs = explode(",", $services); ?>
                        <?php foreach ($srvdata as $sk => $svl) : ?>
                          <input type="checkbox" name="srv[]" checked="checked" value="<?=$svl['id']?>" /> &nbsp; <?=$svl['service_name']?> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;
                        <?php endforeach; ?>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <!---<span class="pull-left"><input type="checkbox" name="sms" value="1" checked /> &nbsp; Allow Registration SMS.</span>---->
                  <a href="<?=base_url()?>student.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
      <script>
      $(document).ready(function(){

        $("#img").change(function(){
          if(this.files && this.files[0]) {
          var reader =new FileReader();
          reader.onload = function(e) {
              $("#pimg").attr('src',e.target.result);
              }
              reader.readAsDataURL(this.files[0]);
            }
        });

        $("#course").change(function(){
          var id = $(this).val();
          $.ajax({
            type:'post',
            url:'<?=base_url()?>ajax/getBatch',
            data:'cid='+id,
            dataType:'json',
            success: function( res ) {
              var htm='<option value="">---- Select Batch ----</option>';
              $.each(res, function(i, vl){
                htm = htm+'<option value="'+vl.id+'">'+vl.batch_name+'</option>';
              });
              $("#bat").html(htm);
            }

        });

      });

      $("#adrow").click(function(){
        $('tbody').append('<tr>'+
        '<td><input type="text" class="form-control" placeholder="Enter Title.." name="col[]"></td>'+
        '<td><input type="text" class="form-control" placeholder="Enter Value.." name="val[]"></td>'+
        '<td><a href="javascript:;" class="btn btn-sm btn-danger delrow" >Delete</a></td>'+
        '</tr>');
      });

      $(document).on("click", ".delrow", function(){
          $(this).closest('tr').remove();
      });

      $(".dps").datepicker({format:'dd-mm-yyyy'});
    });
      </script>
