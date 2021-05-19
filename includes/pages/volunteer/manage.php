<?php
$list = self::$list;
$data = self::$viewData; ?>
<div class="wrap">
  <h1 class="wp-heading-inline">Volunteer Committee</h1>
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
          <?php } elseif (isset($_REQUEST['edit'])) { ?>
              <h2><?php echo "Modify ".$data['full_name']."'s Record"; ?></h2>
          <?php } else { ?>
              <h2>Add New Volunteer</h2>
          <?php } ?>

          <?php if (isset(self::$message)): ?><div class="updated"><p><?php echo self::$message; ?></p></div><?php endif; ?>
          <?php if (isset(self::$error_message)): ?><div class="error"><p><?php echo self::$error_message; ?></p></div><?php endif; ?>
            <?php if (isset($_REQUEST['open'])) { ?>
                <p><strong>Full Names</strong><br><?php echo $data['full_name']; ?></p>
                <p><strong>Email</strong><br><?php echo $data['email']; ?></p>
                <p><strong>Phone Number</strong><br><?php echo $data['phone']; ?></p>
                <p><strong>Gender</strong><br><?php echo $data['sex']; ?></p>
                <p><strong>Contact Address</strong><br><?php echo $data['address']; ?></p>
                <p><strong>Date of Birth</strong><br><?php echo $data['dob']; ?></p>
                <p><strong>Profession</strong><br><?php echo $data['profession']; ?></p>
                <p><strong>Volunteer Position</strong><br><?php echo $data['volunteer']; ?></p>
                <p><strong>Why do you want to volunteer for Kindheart organization</strong><br><?php echo $data['reason_for_volunteer']; ?></p>
                <p><strong>List 4 Goals you plan to achieve while volunteering with kindheart organization</strong><br><?php echo $data['goals']; ?></p>
                <p><strong>Facebook handle</strong><br><?php echo $data['facebook']; ?></p>
                <p><strong>Instagram handle</strong><br><?php echo $data['instagram']; ?></p>
                <p><strong>Twitter handle</strong><br><?php echo $data['twitter']; ?></p>
                <p><strong>How did you hear about Kindheart organization</strong><br><?php echo $data['about_kindheart']; ?></p>
                <p><strong>Can you make at least a 7 months commitment with the Organization</strong><br><?php echo $data['commitment']; ?></p>
                <p><strong>Are you willing to be called for an impromptu project</strong><br><?php echo $data['impromptu']; ?></p>
                <p><strong>What have you enjoyed most in previous volunteer works</strong><br><?php echo $data['previous_volunteer_enjoy']; ?></p>
                <p><strong>What have you enjoyed the least in previous volunteer works</strong><br><?php echo $data['previous_volunteer_not_enjoy']; ?></p>
                <p><strong>Specify the languages you speak</strong><br><?php echo $data['languages']; ?></p>
                <p><strong>What communication channels do you prefer</strong><br><?php echo $data['communication_channel']; ?></p>
                <p><strong>Date Created</strong><br><?php echo $data['create_time']; ?></p>
                <p><strong>Date Last Modified</strong><br><?php echo $data['modify_time']; ?></p>
                <p><a href="<?php echo admin_url('admin.php?page=kh-manage-volunteer&edit&id='.$data['ref']); ?>" title="Edit Record"><i class="far fa-edit"></i>&nbsp;Edit</a></p>
            <?php } else { ?>
                <form id="form2" name="form2" method="post" action="<?php echo admin_url('admin.php?page=kh-manage-volunteer'); ?>">
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
                    <div class="form-field form-required term-address-wrap">
                        <label for="address"> Address</label>
                        <textarea name="address" id="address" required><?php echo $data['address']; ?></textarea>
                    </div>
                    <div class="form-field form-required term-dob-wrap">
                        <label for="next_appointment"> Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="<?php echo $data['age']; ?>" max="<?php echo date("Y")."-".date("m")."-".date("d"); ?>" required value="<?php echo $data['dob']; ?>" />
                    </div>
                    <div class="form-field form-required term-profession-wrap">
                        <label for="profession"> Profession</label>
                        <input type="text" name="profession" id="profession" value="<?php echo $data['profession']; ?>" required />
                    </div>
                    <div class="form-field form-required term-volunteer-wrap">
                        <label for="volunteer"> Volunteer Position</label>
                        <input type="text" name="volunteer" id="volunteer" value="<?php echo $data['volunteer']; ?>" required />
                    </div>
                    <div class="form-field form-required term-reason_for_volunteer-wrap">
                        <label for="reason_for_volunteer"> Why do you want to volunteer for Kindheart organization</label>
                        <textarea name="reason_for_volunteer" id="reason_for_volunteer" required><?php echo $data['reason_for_volunteer']; ?></textarea>
                    </div>
                    <div class="form-field form-required term-goals-wrap">
                        <label for="goals">List 4 Goals you plan to achieve while volunteering with kindheart organization</label>
                        <textarea name="goals" id="goals" required><?php echo $data['goals']; ?></textarea>
                    </div>
                    <div class="form-field form-required term-facebook-wrap">
                        <label for="facebook"> Facebook handle</label>
                        <input type="text" name="facebook" id="facebook" value="<?php echo $data['facebook']; ?>" required />
                    </div>
                    <div class="form-field form-required term-instagram-wrap">
                        <label for="instagram"> Instagram handle</label>
                        <input type="text" name="instagram" id="instagram" value="<?php echo $data['instagram']; ?>" required />
                    </div>
                    <div class="form-field form-required term-twitter-wrap">
                        <label for="twitter"> Twitter handle</label>
                        <input type="text" name="twitter" id="twitter" value="<?php echo $data['twitter']; ?>" required />
                    </div>
                    <div class="form-field form-required term-about_kindheart-wrap">
                        <label for="about_kindheart"> How did you hear about Kindheart organization</label>
                        <input type="text" name="about_kindheart" id="about_kindheart" value="<?php echo $data['about_kindheart']; ?>" required />
                    </div>
                    <div class="form-field form-required term-commitment-wrap">
                        <label for="commitment"> Can you make at least a 7 months commitment with the Organization</label>
                        <select id="commitment" name="commitment" required>
                            <option value="">Select One</option>
                            <option <?php if ($data['commitment'] == "Yes") { ?>selected <?php } ?>value="Yes">Yes</option>
                            <option <?php if ($data['commitment'] == "No") { ?>selected <?php } ?> value="No">No</option>
                        </select>
                    </div>
                    <div class="form-field form-required term-impromptu-wrap">
                        <label for="impromptu"> Are you willing to be called for an impromptu project</label>
                        <select id="impromptu" name="impromptu" required>
                            <option value="">Select One</option>
                            <option <?php if ($data['impromptu'] == "Yes") { ?>selected <?php } ?>value="Yes">Yes</option>
                            <option <?php if ($data['impromptu'] == "No") { ?>selected <?php } ?> value="No">No</option>
                        </select>
                    </div>
                    <div class="form-field form-required term-previous_volunteer_enjoy-wrap">
                        <label for="previous_volunteer_enjoy"> What have you enjoyed most in previous volunteer works</label>
                        <textarea name="previous_volunteer_enjoy" id="previous_volunteer_enjoy" required><?php echo $data['previous_volunteer_enjoy']; ?></textarea>
                    </div>
                    <div class="form-field form-required term-previous_volunteer_not_enjoy-wrap">
                        <label for="previous_volunteer_not_enjoy"> What have you enjoyed the least in previous volunteer works<</label>
                        <textarea name="previous_volunteer_not_enjoy" id="previous_volunteer_not_enjoy" required><?php echo $data['previous_volunteer_not_enjoy']; ?></textarea>
                    </div>
                    <div class="form-field form-required term-languages-wrap">
                        <label for="language"> Specify the languages you speak</label>
                        <textarea name="language" id="language" required><?php echo $data['language']; ?></textarea>
                    </div>
                    <div class="form-field form-required term-communication_channel-wrap">
                        <label for="communication_channel"> What communication channels do you prefer</label>
                        <textarea name="communication_channel" id="communication_channel" required><?php echo $data['communication_channel']; ?></textarea>
                    </div>
                    <?php if (isset($_REQUEST['edit'])) { ?>
                        <input type="hidden" name="ref" value="<?php echo $data['ref']; ?>" required />
                        <button name="submit" id="submit" type="submit" class="button button-primary"><i class="fa fa-calendar-check fa-lg"></i>&nbsp;Save Modification</button>
                        <button name="button" id="button" type="button" class="button"><i class="fa fa-undo fa-lg"></i>&nbsp;Cancel Edit</button>
                    <?php } else { ?>
                        <button name="submit" id="submit" type="submit" class="button button-primary"><i class="fa fa-calendar-check fa-lg"></i>&nbsp;Add Volunteer</button>
                        <button name="reset" id="reset" type="reset" class="button"><i class="fa fa-undo fa-lg"></i>&nbsp;Reset</button>
                    <?php } ?>
                </form>
            <?php } ?>
        </div>
      </div>
    </div>
    <div id="col-right">
      <div class="col-wrap">
        <h2>Volunteer Record</h2>
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
                <a href="<?php echo admin_url('admin.php?page=kh-manage-volunteer&open&id='.$list[$i]['ref']); ?>" title="View Record">View Record</a>&nbsp;
                <a href="<?php echo admin_url('admin.php?page=kh-manage-volunteer&edit&id='.$list[$i]['ref']); ?>" title="Edit <?php echo $list[$i]['full_name']; ?>">Edit</a>
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
