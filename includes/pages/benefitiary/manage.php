<?php
$list = self::$list;
$data = self::$viewData; ?>
<div class="wrap">
  <h1 class="wp-heading-inline">Benefitiary</h1>
  <!-- <form class="search-form wp-clearfix" method="get">
    <p class="search-box">
      <label class="screen-reader-text" for="tag-search-input">Search Appointments:</label>
      <input type="search" id="tag-search-input" name="s" value="" />
      <input type="submit" id="search-submit" class="button" value="Search Appointments"  />
    </p>
  </form> -->
  <div id="col-container" class="wp-clearfix">
    <div id="col-left">
      <div class="col-wrap">
        <div class="form-wrap">
          <?php if (isset($_REQUEST['open'])) { ?>
              <h2><?php echo "View ".$data['full_name']."'s Record"; ?></h2>
          <?php } else if (isset($_REQUEST['edit'])) { ?>
              <h2><?php echo "Modify ".$data['full_name']."'s Record"; ?></h2>
          <?php } else { ?>
              <h2>Add New Benefitiary</h2>
          <?php } ?>

          <?php if (isset(self::$message)): ?><div class="updated"><p><?php echo self::$message; ?></p></div><?php endif; ?>
          <?php if (isset(self::$error_message)): ?><div class="error"><p><?php echo self::$error_message; ?></p></div><?php endif; ?>
            <?php if (isset($_REQUEST['open'])) { ?>
                <p><strong>Full Names</strong><br><?php echo $data['full_name']; ?></p>
                <p><strong>Email</strong><br><?php echo $data['email']; ?></p>
                <p><strong>Phone Number</strong><br><?php echo $data['phone']; ?></p>
                <p><strong>Gender</strong><br><?php echo $data['sex']; ?></p>
                <p><strong>Date of Birth</strong><br><?php echo $data['dob']; ?></p>
                <p><strong>Occupation</strong><br><?php echo $data['occupation']; ?></p>
                <p><strong>Place Of Employment</strong><br><?php echo $data['employer']; ?></p>
                <p><strong>Position</strong><br><?php echo $data['position']; ?></p>
                <p><strong>Address Of Workplace</strong><br><?php echo $data['work_address']; ?></p>
                <p><strong>Type Of Cancer</strong><br><?php echo $data['cancer_type']; ?></p>
                <p><strong>Stage Of Cancer</strong><br><?php echo $data['cancer_stage']; ?></p>
                <p><strong>Hospital</strong><br><?php echo $data['hospital']; ?></p>
                <p><strong>Hospital Consultant Name & Phone Number</strong><br><?php echo $data['hospital_details']; ?></p>
                <p><strong>Date Created</strong><br><?php echo $data['create_time']; ?></p>
                <p><strong>Date Last Modified</strong><br><?php echo $data['modify_time']; ?></p>


                <p><a href="<?php echo admin_url('admin.php?page=kh-manage-volunteer&edit&id='.$data['ref']); ?>" title="Edit Record"><i class="far fa-edit"></i>&nbsp;Edit</a></p>
            <?php } else { ?>
                <form id="form2" name="form2" method="post" action="<?php echo admin_url('admin.php?page=lh-manage-patient'); ?>">
                    <div class="form-field form-required term-full_name-wrap">
                        <label for="full_name"> Full Name</label>
                        <input type="text" name="full_name" id="full_name" value="<?php echo $data['full_name']; ?>" required />
                    </div>
                    <div class="form-field form-required term-email-wrap">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>" required />
                    </div>
                    <div class="form-field form-required term-phone-wrap">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phone" value="<?php echo $data['phone']; ?>" required />
                    </div>
                    <div class="form-field form-required term-sex-wrap">
                        <label for="sex">Sex</label>
                        <select id="sex" name="sex" required>
                            <option value="">Select One</option>
                            <option <?php if ($data['sex'] == "Female") { ?>selected <?php } ?>value="Female">Female</option>
                            <option <?php if ($data['sex'] == "Male") { ?>selected <?php } ?> value="Male">Male</option>
                        </select>
                    </div>
                    <div class="form-field form-required term-dob-wrap">
                        <label for="next_appointment"> Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="<?php echo $data['age']; ?>" max="<?php echo date("Y")."-".date("m")."-".date("d"); ?>" required value="<?php echo $data['dob']; ?>" />
                    </div>
                    <div class="form-field form-required term-occupation-wrap">
                        <label for="occupation"> Occupation</label>
                        <input type="text" name="occupation" id="occupation" value="<?php echo $data['occupation']; ?>" required />
                    </div>
                    <div class="form-field form-required term-employer-wrap">
                        <label for="employer"> Place Of Employment</label>
                        <input type="text" name="employer" id="employer" value="<?php echo $data['employer']; ?>" required />
                    </div>
                    <div class="form-field form-required term-position-wrap">
                        <label for="position"> Position</label>
                        <input type="text" name="position" id="position" value="<?php echo $data['position']; ?>" required />
                    </div>
                    <div class="form-field form-required term-work_address-wrap">
                        <label for="work_address"> Address Of Workplace</label>
                        <textarea name="work_address" id="work_address" required><?php echo $data['work_address']; ?></textarea>
                    </div>
                    <div class="form-field form-required term-cancer_type-wrap">
                        <label for="cancer_type">Type Of Cancer</label>
                        <input type="text" name="cancer_type" id="cancer_type" value="<?php echo $data['cancer_type']; ?>" required />
                    </div>
                    <div class="form-field form-required term-cancer_stage-wrap">
                        <label for="cancer_stage"> Stage Of Cancer</label>
                        <input type="text" name="cancer_stage" id="cancer_stage" value="<?php echo $data['cancer_stage']; ?>" required />
                    </div>
                    <div class="form-field form-required term-hospital-wrap">
                        <label for="hospital"> Hospital</label>
                        <input type="text" name="hospital" id="hospital" value="<?php echo $data['hospital']; ?>" required />
                    </div>
                    <div class="form-field form-required term-hospital_details-wrap">
                        <label for="hospital_details"> Hospital Consultant Name & Phone Number</label>
                        <input type="text" name="hospital_details" id="hospital_details" value="<?php echo $data['hospital_details']; ?>" required />
                    </div>
                    <?php if (isset($_REQUEST['edit'])) { ?>
                        <input type="hidden" name="ref" value="<?php echo $data['ref']; ?>" required />
                        <button name="submit" id="submit" type="submit" class="button button-primary"><i class="fa fa-calendar-check fa-lg"></i>&nbsp;Save Modification</button>
                        <button name="button" id="button" type="button" class="button"><i class="fa fa-undo fa-lg"></i>&nbsp;Cancel Edit</button>
                    <?php } else { ?>
                        <button name="submit" id="submit" type="submit" class="button button-primary"><i class="fa fa-calendar-check fa-lg"></i>&nbsp;Add Benefitiary</button>
                        <button name="reset" id="reset" type="reset" class="button"><i class="fa fa-undo fa-lg"></i>&nbsp;Reset</button>
                    <?php } ?>
                </form>
            <?php } ?>
        </div>
      </div>
    </div>
    <div id="col-right">
      <div class="col-wrap">
        <h2>Benefitiary Record</h2>
        <table class='widefat striped fixed' id="datatable_list">
          <thead>
            <tr>
              <th class="manage-column column-cb check-column"></th>
              <th class="manage-column column-columnname" scope="col">Full Name</th>
              <th class="manage-column column-columnname" scope="col">Email</th>
              <th class="manage-column column-columnname" scope="col">Phone Number</th>
              <th class="manage-column column-columnname" scope="col">Sex</th>
              <th class="manage-column column-columnname" scope="col">Date of Birth</th>
              <th class="manage-column column-columnname" scope="col">Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="manage-column column-cb check-column"></th>
              <th class="manage-column column-columnname" scope="col">Full Name</th>
              <th class="manage-column column-columnname" scope="col">Email</th>
              <th class="manage-column column-columnname" scope="col">Phone Number</th>
              <th class="manage-column column-columnname" scope="col">Sex</th>
              <th class="manage-column column-columnname" scope="col">Date of Birth</th>
              <th class="manage-column column-columnname" scope="col">Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $count = 1;
            for ($i = 0;  $i < count($list); $i++) { ?>
            <tr>
              <th class="check-column" scope="row"><?php echo $count; ?></th>
              <td class="column-columnname"><?php echo $list[$i]['full_name']; ?></td>
              <td class="column-columnname"><?php echo $list[$i]['email']; ?></td>
              <td class="column-columnname"><?php echo $list[$i]['phone']; ?></td>
              <td class="column-columnname"><?php echo $list[$i]['sex']; ?></td>
              <td class="column-columnname"><?php echo $list[$i]['dob']; ?></td>
              <td class="column-columnname">
                <a href="<?php echo admin_url('admin.php?page=kh-manage-benefitiary&open&id='.$list[$i]['ref']); ?>" title="View Record">View Record</a>&nbsp;
                <a href="<?php echo admin_url('admin.php?page=kh-manage-benefitiary&edit&id='.$list[$i]['ref']); ?>" title="Edit <?php echo $list[$i]['full_name']; ?>">Edit</a>
              </td>
            </tr>
            <?php $count++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
jQuery(function ($) {
    $('#datatable_list').DataTable();   
} );
</script>
