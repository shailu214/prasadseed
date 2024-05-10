
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if($alert) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
          <?php endif; ?>
          <div class="row">

            <div class="col-lg-12">
              <form method="post" class="card" enctype="multipart/form-data">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-user-plus"></i> &nbsp;Student Exam</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Exam Type</label>
                        <input type="text" name="data[title]" class="form-control" placeholder="Exam Name.." value="<?=$title?>" data-validation="required" autocomplete="off" data-validation-error-msg="Please enter exam name.">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Course</label>
                        <select class="form-control" name="data[course_id]" id="course" data-validation="required" data-validation-error-msg="Please select course.">
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
                        <select class="form-control" name="data[batch_id]" id="bat" data-validation="required" data-validation-error-msg="Please select batch.">
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
                        <input type="text" name="data[student_id]" class="form-control" placeholder="Student Code.." value="<?=$code?>" data-validation="required number" data-validation-error-msg-number="Student code should be numeric only." autocomplete="off" data-validation-error-msg="Please enter student code.">
                      </div>
                    </div>
					
					<div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Certificate Number</label>
                        <input type="text" name="data[certificate_number]" onkeypress="return validateNumber(event)" class="form-control" placeholder="certificate number.." value="<?=$certificate_number?>" data-validation="required" autocomplete="off" data-validation-error-msg="Please enter certificate number.">
                      </div>
                    </div>
					
					        <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Marksheet Number</label>
                        <input type="text" name="data[marksheet_number]" onkeypress="return validateNumber(event)" class="form-control" placeholder="marksheet number.." value="<?=$marksheet_number?>" data-validation="required" autocomplete="off" data-validation-error-msg="Please enter marksheet_number.">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Marksheet Issue Date</label>
                        <input type="date" name="data[marksheet_issue_date]" class="form-control" placeholder="marksheet number.." value="<?=$marksheet_issue_date?>" data-validation="required" autocomplete="off" data-validation-error-msg="Please enter issue_date.">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Certificate Issue Date</label>
                        <input type="date" name="data[certificate_issue_date]" class="form-control" placeholder="marksheet number.." value="<?=$certificate_issue_date?>" data-validation="required" autocomplete="off" data-validation-error-msg="Please enter issue_date.">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="data[status]" data-validation="required" data-validation-error-msg="Please select status.">
                          <option value="">---- Select Status ----</option>
                          <option value="1">Passed </option>
                          <option value="0">Failed </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label class="form-label">Subject</label>
                            <select class="form-control" id="sub" >
                              <option value="">---- Select Subject ----</option>
                              <?php foreach ($subjects as $sk => $sv) : ?>
                                <option value="<?=$sv['id']?>" ><?=$sv['subject']?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <label class="form-label">Marks</label>
                            <input type="text" class="form-control" placeholder="Marks.."  id="marks">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                          <a href="javascript:;" id="addit" class="btn btn-success">Add</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-bordered">
                        <thead>
                          <th>Subject</th>
                          <th>Marks</th>
                          <th width="170">Action</th>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>exam.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

      <script>
function validateNumber(e) {
            const pattern = /^[0-9]$/;

            return pattern.test(e.key )
        }
      $(document).ready(function(){

          $("#addit").click(function(){

            var sid = parseInt($("#sub").val());
            var sub = $("#sub option:selected").text();
            var mrk = parseInt($("#marks").val());

            if( mrk > 0 && sid > 0 ) {

              $("tbody").append('<tr>'+
              '<td>'+sub+' <input type="hidden" name="sid[]" value="'+sid+'" /><input type="hidden" name="sub[]" value="'+sub+'" /></td>'+
              '<td>'+mrk+' <input type="hidden" name="mrk[]" value="'+mrk+'" /></td>'+
              '<td><a href="javascript:;" class="btn btn-danger btn-sm delrow" title="Delete"><i class="fe fe-trash"></i></a></td>'+
              '</tr>');

              $("#sub option:selected").prop('selected', false);
              $("#marks").val('');

            } else {
              alert("Please enter value in fields.");
            }

          });

          $(document).on("click", ".delrow", function(){
            $(this).closest('tr').remove();
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


      });
      </script>
