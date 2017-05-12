<?php 
session_start();

include('../dbconfig.php');
include('../header.php');
include('../sidebar.php');
//include('../common-methods.php');

if(!$_SESSION['login']){
  echo "<script>window.location.href=\"".HOMEURL."index.php\"</script>";
  //header('Location: ../index.php');
}

if(!hasPermission('enquiry')){
  echo "<script>window.location.href=\"".HOMEURL.$_SESSION['userrole']['user_homepage']."\"</script>";
}

$bsarray = $mparray = array();
// function getuniqueid(){
//     global $dbc;
//     $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $time = time();
//     $t1 = substr($time, 0, 5);
//     $t2 = substr($time, 5);
//     $prefix = "ENQ_";
//     $s1 = $alpha[mt_rand(0,51)].$alpha[mt_rand(0,51)];
//     $s2 = $alpha[mt_rand(0,51)].$alpha[mt_rand(0,51)];
//     $uniqid = $prefix.$s1.$t1.$s2.$t2;
//     $query = "SELECT * FROM marketing_enquiry WHERE enquiry_uuid = '$uniqid'";
//     $result = mysqli_query($dbc, $query);
//     if(mysqli_num_rows($result)>0){
//       return getuniquetxnid();
//     }else{
//       return $uniqid;
//     }
//   }

function getuniqueid(){
  global $dbc;
  $curr_m = date('m', time());
  $curr_Y = date('Y', time());
  $curr_count = 1;
  $prefix = "ENQ_";

  $query = "SELECT enquiry_uuid FROM marketing_enquiry ORDER BY created_date DESC LIMIT 1";
  $result = mysqli_query($dbc, $query);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    $previd = explode("_", $row['enquiry_uuid']);
    $previd_date = str_split($previd[1], 2);
    $previd_m = $previd_date[0];
    $previd_Y = $previd_date[1].$previd_date[2];
    $previd_count = intval($previd[2]);
    if($curr_Y == $previd_Y && $curr_m == $previd_m){
      $curr_count = $previd_count + 1;
    }
  }
  $uniqid = $prefix . $curr_m . $curr_Y . '_' . $curr_count;
  return $uniqid;
}

  //$enquiry_uuid = getuniqueid();

  //echo "<script>alert('".$_SESSION['userrole']."'')</script>";

function display_product_range(){
    global $bsarray;
    $productarray = array('men','women','kids','tabletop','mannequin','others');$output = '';
    foreach ($productarray as $key => $value) {
        $output .= '<div class="form-group">
                  <div class="col-md-3"><label><center>'.ucfirst($value).'</center></label></div>
                  <div class="col-md-3 pb10">
                    <input id="pr_check_'.$value.'" type="checkbox"  name="pr_check_'.$value.'">
                    <label for="pr_check_'.$value.'" ></label></label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" name="pr_count_'.$value.'" id="pr_count_'.$value.'" class="form-control" placeholder="Count"/>
                  </div>
                  <div class="col-md-3">
                    <input type="text" name="pr_remarks_'.$value.'" id="pr_remarks_'.$value.'" class="form-control" placeholder="Remarks"/>
                  </div>
                </div><div class="clearfix"></div>';
        $bsarray[] = "pr_check_".$value;
    }
    //file_put_contents("testlog.log","\n\n". print_r( json_encode($bsarray), true ));//, FILE_APPEND | LOCK_EX);
    return $output;
}

function display_marketplace_list(){
    global $dbc,$mparray;$output='';
    $query = "SELECT * FROM marketplace_list";
    $result = mysqli_query($dbc,$query);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $output .= '<div class="form-group">
                  <div class="col-md-4"><label><center>'.ucfirst($row['mp_displayname']).'</center></label></div>
                  <div class="col-md-4 pb10">
                    <input id="mp_check_'.$row['mp_name'].'" type="checkbox"  name="mp_check_'.$row['mp_name'].'">
                    <label for="mp_check_'.$row['mp_name'].'" ></label></label>
                  </div>
                </div><div class="clearfix"></div>';
            $mparray[] = "mp_check_".$row['mp_name'];
        }
    }
    
    //file_put_contents("testlog.log","\n\n". print_r( json_encode($bsarray), true ));//, FILE_APPEND | LOCK_EX);
    return $output;
}
?>
<link rel="stylesheet" href="<?php echo HOMEURL; ?>plugins/iCheck/all.css">
<style type="text/css">
.pb10{
  padding-bottom: 10px;
}


.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}

</style>

<div class="content-wrapper">
 <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Booking Form</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Product Range</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Market Required</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Registration</small></p>
            </div>
        </div>
    </div>
    
    <form action="#" method="POST" onsubmit="return false;" id="addEnquiryForm">
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Booking Form</h3>
            </div>
            <div class="panel-body">
                <input type="hidden" name="enquiry_uuid" id="enquiry_uuid">
                <input type="hidden" name="action" value="add_enquiry">
                <div class="form-group">
                  <label for="company_name">Company Name</label>
                  <input type="text" placeholder="Company name" name="company_name" id="company_name" class="form-control" required="">
                </div>
                <div class="form-group">
                  <label for="contact_name">Contact Name</label>
                  <input type="text" placeholder="Contact name" name="contact_name" id="contact_name" class="form-control" required="">
                </div>
                <div class="form-group">
                  <label for="contact_email">Email</label>
                  <input type="text" placeholder="Email" name="contact_email" id="contact_email" class="form-control" required="">
                </div>
                <div class="form-group">
                  <label for="contact_phone">Phone</label>
                  <input type="text" placeholder="Phone" name="contact_phone" id="contact_phone" class="form-control" required="">
                </div>
                <div class="form-group">
                  <label for="contact_address">Registered Address</label>
                  <textarea type="text" placeholder="Registered Address" name="contact_address" id="contact_address" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="pickup_address">Pickup Address</label>
                  <textarea type="text" placeholder="Pickup Address" name="pickup_address" id="pickup_address" class="form-control"></textarea>
                </div>
                <div class="form-group" id="employee_details">
                </div>
                
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Product Range</h3>
            </div>
            <div class="panel-body">
                <!--div class="form-group">
                  <div class="col-md-6">
                  <label><center>Men</center></label>
                  </div>
                  <div class="col-md-6 pb10">
                    <input id="check_men" type="checkbox" name="check_men" checked="checked" >
                    <label>
                        <label for="check_men" ></label>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                  <label><center>Women</center></label>
                  </div>
                  <div class="col-md-6 pb10">
                    <input id="check_women" type="checkbox"  name="check_women">
                    <label>
                        <label for="check_women" ></label>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                  <label><center>Kids</center></label>
                  </div>
                  <div class="col-md-6 pb10">
                    <input id="check_kids" type="checkbox" name="check_kids">
                    <label>
                        <label for="check_kids" value="None"></label>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                  <label><center>Table Top</center></label>
                  </div>
                  <div class="col-md-6 pb10">
                    <input id="check_tabletop" type="checkbox" name="check_tabletop">
                    <label>
                        <label for="check_tabletop" value="None"></label>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                  <label><center>Mannequin</center></label>
                  </div>
                  <div class="col-md-6 pb10">
                    <input id="check_mannequin" type="checkbox" name="check_mannequin">
                    <label>
                        <label for="check_mannequin" value="None"></label>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                  <label><center>Others</center></label>
                  </div>
                  <div class="col-md-6 pb10">
                    <input id="check_others" type="checkbox" name="check_others">
                    <label>
                        <label for="check_others" value="None"></label>
                    </label>
                  </div>
                </div-->
                <?php echo display_product_range(); ?>
                <hr><div class="row">
                  <h3 class="panel-title">&nbsp;&nbsp;&nbsp;Project Type</h3>
                  <div class="form-group col-md-offset-1">
                    <label>
                      <input type="radio" name="project_type" class="flat-red" value="shoot" checked> Shoot&nbsp;&nbsp;
                    </label>
                    <label>
                      <input type="radio" name="project_type" class="flat-red" value="edit_design"> Edit & Design&nbsp;&nbsp;
                    </label>
                    <label>
                      <input type="radio" name="project_type" class="flat-red" value="catalog"> Catalog&nbsp;&nbsp;
                    </label>
                  </div>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Market Required</h3>
            </div>
            <div class="panel-body">
                <!--div class="form-group">
                  <div class="col-md-6">
                  <label><center>Flipkart</center></label>
                  </div>
                  <div class="col-md-6">
                    <input id="flipkart" type="checkbox" data-off-text="No" data-on-text="Yes" checked="false" class="BSswitch" name="flipkart">
                    <label>
                        <label id="flipkart" value="None"></label>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                  <label><center>Mnytra</center></label>
                  </div>
                  <div class="col-md-6">
                    <input id="myntra" type="checkbox" data-off-text="No" data-on-text="Yes" checked="false" class="BSswitch" name="myntra">
                    <label>
                        <label id="myntra" value="None"></label>
                    </label>
                  </div>
                </div-->
                <?php echo display_marketplace_list(); ?>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        
          <div class="panel panel-primary setup-content" id="step-4">
              <div class="panel-heading">
                   <h3 class="panel-title">Registration</h3>
              </div>
            <div class="panel-body">
                <div class="row">
                    <div class="form-group col-md-10">
                      <label for="tin_number">TIN Number</label>
                      <input type="text" placeholder="TIN Number" name="tin_number" id="tin_number" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                      <div class="fileUpload btn btn-primary">
                        <span>Upload</span>
                        <input type="file" class="upload" id="tin_file" name="tin_file" />
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-10">
                    <label for="trademark">Trademark</label>
                    <input type="text" placeholder="Trademark" name="trademark" id="trademark" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <div class="fileUpload btn btn-primary">
                      <span>Upload</span>
                      <input type="file" class="upload" id="trademark_file" name="trademark_file" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-10">
                    <label for="cst_number">CST Number</label>
                    <input type="text" placeholder="CST Number" name="cst_number" id="cst_number" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <div class="fileUpload btn btn-primary">
                      <span>Upload</span>
                      <input type="file" class="upload" id="cst_file" name="cst_file" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-10">
                    <label for="pan_number">PAN Number</label>
                    <input type="text" placeholder="PAN Number" name="pan_number" id="pan_number" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <div class="fileUpload btn btn-primary">
                      <span>Upload</span>
                      <input type="file" class="upload" id="pan_file" name="pan_file" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-10">
                    <label for="cheque_numbers">Cheque Numbers</label>
                    <input type="text" placeholder="Cheque Numbers" name="cheque_numbers" id="cheque_numbers" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <div class="fileUpload btn btn-primary">
                      <span>Upload</span>
                      <input type="file" class="upload" id="cheque_file" name="cheque_file" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-10">
                    <label for="logo_url">Logo URL</label>
                    <input type="text" placeholder="Logo URL" name="logo_url" id="logo_url" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <div class="fileUpload btn btn-primary">
                      <span>Upload</span>
                      <input type="file" class="upload" id="logo_file" name="logo_file" />
                    </div>
                  </div>
                </div>
                <br>
                 <input type="submit" name="submit" value="Add Enquiry" class="btn btn-primary pull-right" onclick="addEnquiry()">
            </div>
        </div>
        
    </form>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('../footer_jsimports.php'); ?>
<script src="<?php echo HOMEURL; ?>plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">

var bsarray = <?php echo json_encode($bsarray); ?>;
var mparray = <?php echo json_encode($mparray); ?>;

for(c=0;c<bsarray.length;c++){
    $("#"+bsarray[c]).bootstrapSwitch({on: 'Yes', off: 'No', onClass: 'success', offClass: 'danger' });
}
for(c1=0;c1<bsarray.length;c1++){
    $("#"+mparray[c1]).bootstrapSwitch({on: 'Yes', off: 'No', onClass: 'success', offClass: 'danger' });
}

$(function(){
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
});
  //$('.BSswitch').bootstrapSwitch('state', true);
/*$("#check_men").bootstrapSwitch({on: 'Yes', off: 'No', onClass: 'success', offClass: 'danger' });
$("#check_women").bootstrapSwitch({on: 'Yes', off: 'No', onClass: 'success', offClass: 'danger' });
$("#check_kids").bootstrapSwitch({on: 'Yes', off: 'No', onClass: 'success', offClass: 'danger' });
$("#check_tabletop").bootstrapSwitch({on: 'Yes', off: 'No', onClass: 'success', offClass: 'danger' });
$("#check_mannequin").bootstrapSwitch({on: 'Yes', off: 'No', onClass: 'success', offClass: 'danger' });
$("#check_others").bootstrapSwitch({on: 'Yes', off: 'No', onClass: 'success', offClass: 'danger' });*/

function getemployeedetails(){
    //alert();
    var data = "action=get_employee_details";
    $.ajax({
        url: "enquiryservices.php",
        type: "POST",
        data:  data,
        dataType: 'html',
        success: function(result){
          $('#employee_details').html(result);
        },
        error: function(){
          bootbox.alert(result.message);}           
      });
  }

  
  $(document).ready(getemployeedetails());

//   function addEnquiry(){
//   //if($('#pm_form').valid()){
//     var data = $('#addEnquiryForm').serialize();
//     //alert(JSON.stringify(data));
//     $.ajax({
      //url: "<?php //echo HOMEURL; ?>userservices.php",
//       type: "POST",
//       data:  data,
//       dataType: 'json',
//       success: function(data){
//         alert(data.message);
//         window.location.reload();
//       },
//       error: function(){
//         alert(data.message);}           
//     });
//   //}
// }

  function addEnquiry(){
    //if($('#addEnquiryForm').valid()){


        var data = $('#addEnquiryForm').serializefiles();
        $.ajax({
            url: "<?php echo HOMEURL; ?>userservices.php",
            type: "POST",
            data:  data,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(result){
                bootbox.alert(result.message, function(){window.location.href = "<?php echo HOMEURL; ?>enquiry/addenquiry.php";});
            },
            error: function(){
              bootbox.alert(result.message);
            }           
        });
    //}
  }

  (function($) {
  $.fn.serializefiles = function() {
      var obj = $(this);
      /* ADD FILE TO PARAM AJAX */
      var formData = new FormData();
      $.each($(obj).find("input[type='file']"), function(i, tag) {
          $.each($(tag)[0].files, function(i, file) {
              formData.append(tag.name, file);
          });
      });
      var params = $(obj).serializeArray();
      $.each(params, function (i, val) {
          formData.append(val.name, val.value);
      });
      return formData;
  };
  })(jQuery);



</script>
<?php 
include('../footer.php'); 
?>