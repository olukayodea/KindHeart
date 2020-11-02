<?php
$list = self::$list;
$data = self::$viewData; ?>
<div class="wrap">
  <h1 class="wp-heading-inline">Planning Committee</h1>
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
          <?php if (isset($_REQUEST['edit'])) { ?>
              <h2><?php echo "Modify ".$data['full_name']."'s Record"; ?></h2>
          <?php } else { ?>
              <h2>Add New Planning Committee Member</h2>
          <?php } ?>

          <?php if (isset(self::$message)): ?><div class="updated"><p><?php echo self::$message; ?></p></div><?php endif; ?>
          <?php if (isset(self::$error_message)): ?><div class="error"><p><?php echo self::$error_message; ?></p></div><?php endif; ?>
            <?php if (isset($_REQUEST['open'])) { ?>
                <p><strong>Full Names</strong><br><?php echo $data['full_name']; ?></p>
                <p><strong>Email</strong><br><?php echo $data['email']; ?></p>
                <p><strong>Phone Number</strong><br><?php echo $data['phone']; ?></p>
                <p><strong>Sex</strong><br><?php echo $data['sex']; ?></p>
                <p><strong>Address</strong><br><?php echo $data['address']; ?></p>
                <p><strong>Date of Birth</strong><br><?php echo $data['dob']; ?></p>
                <p><strong>Qualification</strong><br><?php echo $data['qualification']; ?></p>
                <p><strong>Occupation</strong><br><?php echo $data['occupation']; ?></p>
                <p><strong>Employer</strong><br><?php echo $data['employer']; ?></p>
                <p><strong>Expectation</strong><br><?php echo $data['expectations']; ?></p>
                <p><strong>Date Created</strong><br><?php echo $data['create_time']; ?></p>
                <p><strong>Date Last Modified</strong><br><?php echo $data['modify_time']; ?></p>
                <p><a href="<?php echo admin_url('admin.php?page=kh-manage-planning-committee&edit&id='.$data['ref']); ?>" title="Edit Record"><i class="far fa-edit"></i></a></p>
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
                        <label for="sex">Sex</label></td>
                        <select id="sex" name="sex" required>
                        <option value="">Select One</option>
                        <option <?php if ($data['sex'] == "Female") { ?>selected <?php } ?>value="Female">Female</option>
                        <option <?php if ($data['sex'] == "Male") { ?>selected <?php } ?> value="Male">Male</option>
                        </select>
                    </div>
                    <div class="form-field form-required term-address-wrap">
                        <label for="address"> Address</label>
                        <textarea name="address" id="address" required><?php echo $data['address']; ?></textarea>
                    </div>
                    <div class="form-field form-required term-dob-wrap">
                        <label for="next_appointment"> Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="<?php echo $data['age']; ?>" max="<?php echo date("Y")."-".date("m")."-".date("d"); ?>" required value="<?php echo $data['dob']; ?>" />
                    </div>
                    <div class="form-field form-required term-qualification-wrap">
                        <label for="qualification"> Expectation</label>
                        <input type="text" name="qualification" id="qualification" value="<?php echo $data['qualification']; ?>" required />
                    </div>
                    <div class="form-field form-required term-occupation-wrap">
                        <label for="occupation"> Occupation</label>
                        <input type="text" name="occupation" id="occupation" value="<?php echo $data['occupation']; ?>" required />
                    </div>
                    <div class="form-field form-required term-employer-wrap">
                        <label for="employer"> Employer</label>
                        <input type="text" name="employer" id="employer" value="<?php echo $data['employer']; ?>" required />
                    </div>
                    <div class="form-field form-required term-expectations-wrap">
                        <label for="expectations"> Expectation</label>
                        <textarea name="expectations" id="expectations" required><?php echo $data['expectations']; ?></textarea>
                    </div>
                    <?php if (isset($_REQUEST['edit'])) { ?>
                        <input type="hidden" name="ref" value="<?php echo $data['ref']; ?>" required />
                        <button name="submit" id="submit" type="submit" class="button button-primary"><i class="fa fa-calendar-check fa-lg"></i>&nbsp;Save Modification</button>
                        <button name="button" id="button" type="button" class="button"><i class="fa fa-undo fa-lg"></i>&nbsp;Cancel Edit</button>
                    <?php } else { ?>
                        <button name="submit" id="submit" type="submit" class="button button-primary"><i class="fa fa-calendar-check fa-lg"></i>&nbsp;Add Committee Member</button>
                        <button name="reset" id="reset" type="reset" class="button"><i class="fa fa-undo fa-lg"></i>&nbsp;Reset</button>
                    <?php } ?>
                </form>
            <?php } ?>
        </div>
      </div>
    </div>
    <div id="col-right">
      <div class="col-wrap">
        <h2>Planning Committee Record</h2>
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
                <a href="<?php echo admin_url('admin.php?page=kh-manage-planning-committee&open&id='.$list[$i]['ref']); ?>" title="View Record">View Record</a>&nbsp;
                <a href="<?php echo admin_url('admin.php?page=kh-manage-planning-committee&edit&id='.$list[$i]['ref']); ?>" title="Edit <?php echo $list[$i]['full_name']; ?>">Edit</a>
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
