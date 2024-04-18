<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>


<div class="container-fluid px-4">
  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-title">
                    <h4 style="margin-left: 20px">New Post
                        </h4>
                    </div>
                <div class="card-body">

                    <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">

                        <div class="row">

                        <?php
                            $user_id = $_SESSION['auth_user']['user_id'];
                            $sql = "SELECT `skills` FROM `tutor` WHERE `user_id` = '$user_id'";
                            $result = $con->query($sql);
                            $skills = [];
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $skills = explode(',', $row['skills']);
                                }
                            }
                            $con->close();
                            ?>

                        <div class="col-md-12 mb-3">
                            <label for=""><strong>Subject <small>(Pick one of your skills)</small></strong></label>
                            <select name="subject" required class="form-control">
                                <?php foreach ($skills as $skill): ?>
                                    <option value="<?php echo $skill; ?>"><?php echo $skill; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                            <div class="col-md-12 mb-3">
                            <label for=""><strong>Subject Title </strong></label>
                                <input required type="text" Placeholder="Eg. Math Tutorial" name="title" class="form-control" maxlength="80">
                            </div>

                            <div class="col-md-12 mb-3">
                            <label for=""><strong>Description</strong></label>
                                <textarea class="form-control" placeholder="Description about tutorial services" name="description" rows="7"  maxlength="1000"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input required type="text" Placeholder="Rate per day" name="rate_hour" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <input required type="text" Placeholder="Rate per hour" name="rate_day" class="form-control">
                            </div>

                <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">Class Schedule</h4c>
                </div>
                <div class="col">
                  <hr class="my-4">
                </div>
              </div>

                        <div class="container" id="scheduleContainer">

                        <div class="col-md-12 mb-3">
                        <div class="float-end">
                        <button type="button" class="btn btn-link" id="addMore">Add More</button>
                        </div>
                        </div>

                        <label for=""><strong>Schedule</strong></label>

                        <div class="row schedule-row">
                            <div class="col-md-4 mb-3">
                                <select name="day[]" required class="form-control">
                                    <option value="" disabled selected>-- Select Day --</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>

              

                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Start Time</span>
                                    </div>
                                    <input type="time" class="form-control" name="starttime[]" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">End Time</span>
                                    </div>
                                    <input type="time" class="form-control" name="endtime[]" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-md-1 mb-3">
                                <button type="button" class="btn btn-link" onclick="removeRow(this)">Delete</button>
                            </div>
                        </div>


</div>
              
                <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">Module</h4c>
                </div>
                <div class="col">
                  <hr class="my-4">
                </div>
              </div>
                        
              <div class="col-md-12 mb-3">
                                <div class="float-end">
                                <button type="button" id="addModule" class="btn btn-link">Add More</button>
                                </div>
                                
                            <!-- Inside the form -->
                                <div class="module-container">
                                <div class="col-md-12 module" data-task-number="1">
                                <label class="mb-3" for="module_1"><strong>Module Name</strong></label>
                                <input required type="text" Placeholder="Eg. Learning Task" name="module_title[]" class="form-control">
                                <br>
                                <textarea class="form-control" name="module_description[]" rows="5" placeholder="Learning Objectives and Topic Discussion *" maxlength="1000"></textarea>
                                </div>
                                </div>


                           
                            </div>

                        </div>

                        <div class="row mt-4">
                        <div class="col">
                        <hr class="my-4">
                        </div>
                        <div class="col-auto mt-2 mb-4">
                        <h4 class="text-primary">Payment</h4c>
                        </div>
                        <div class="col">
                        <hr class="my-4">
                        </div>
                        </div>

                    
                        <div class="row">
                        <div class="col-md-6">
                    <label for="" class="form-label"><strong>Payment Method</strong></label>
                    <select name="mop" class="form-select" required>
                    <option value="" disabled selected>Select Payment</option>
                    <option value="Gcash">Gcash</option>
                    <option value="Palawan">Palawan</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    </select>     
         
                    </div>

                    
                    <div class="col-md-6 mt-2 mb-3">
                            <label for=""><strong>Account Number</strong></label>
                                <input required type="number" Placeholder="XXX - XXX - XXXX" name="accountnumber" class="form-control" maxlength="80">
                    </div>
                    </div>

                    <div class="col-12">
    <div class="form-check">
        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
        <label class="form-check-label" for="acceptTerms">
            I agree and accept the <a href="#" onclick="showTermsModal()">terms and conditions</a>
        </label>
        <div class="invalid-feedback">You must agree before submitting.</div>
    </div>
</div>

                    <div class="float-end">
                        <a href="my_tutoring_services.php" class="btn btn-danger">Back</a>
                        <button type="submit" name="create_tutoring_services" class="btn btn-primary">Post</button>
                    </div>

                       
                       
             

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Terms and Conditions for Tutors: Refund Policy for Unexpected Student Circumstances</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>1. Refund Eligibility:</strong></p>
        <ul>
          <li>Tutors agree to provide refunds to students under the following circumstances:</li>
          <ul>
            <li>A student is unable to attend a scheduled class due to unexpected circumstances beyond their control, such as illness, family emergency, or unavoidable commitments.</li>
            <li>The student notifies the tutor of their inability to attend at least 24 hours before the scheduled class.</li>
          </ul>
        </ul>

        <p><strong>2. Refund Amount:</strong></p>
        <ul>
          <li>Tutors will refund the full amount of the missed class to the student in the event of an eligible refund request.</li>
        </ul>

        <p><strong>3. Refund Process:</strong></p>
        <ul>
          <li>Students must provide valid documentation or evidence of the unexpected circumstances that prevented them from attending the scheduled class.</li>
          <li>Upon receipt of the documentation, tutors will review the request and process the refund within seven (7) business days.</li>
        </ul>

        <!-- Add other sections following the same format -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
      function showTermsModal() {
        $('#termsModal').modal('show');
    }
    
document.addEventListener('DOMContentLoaded', function () {
    const addModuleButton = document.getElementById('addModule');
    const moduleContainer = document.querySelector('.module-container');

    let taskNumber = 1;

    function addModule() {
        taskNumber++;

        const newModule = document.createElement('div');
        newModule.classList.add('col-md-12', 'mb-3', 'mt-3', 'module');
        newModule.dataset.taskNumber = taskNumber;

        newModule.innerHTML = `
            <label for="module_${taskNumber}"><strong>Module Name</strong></label>
            <input required type="text" Placeholder="Eg. Learning Task" name="module_title[]" class="form-control">
            <br>
            <textarea class="form-control" name="module_description[]" rows="5" placeholder="Learning Objectives and Topic Discussion *" maxlength="1000"></textarea>
            <button type="button" class="btn btn-link mt-2 delete-module">Delete</button>
        `;

        moduleContainer.appendChild(newModule);
    }

    function deleteModule(event) {
        const button = event.target;
        const moduleToDelete = button.closest('.module');
        moduleToDelete.remove();
    }

    addModuleButton.addEventListener('click', addModule);

    moduleContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-module')) {
            deleteModule(event);
        }
    });
});
</script>

<script>
    document.getElementById('addMore').addEventListener('click', function () {
        // Clone the schedule row
        const newRow = document.querySelector('.schedule-row').cloneNode(true);
        
        // Clear the selected values in the cloned row
        newRow.querySelectorAll('select, input[type="time"]').forEach(function (element) {
            element.value = '';
        });

        // Append the cloned row to the container
        document.getElementById('scheduleContainer').appendChild(newRow);
    });

    function removeRow(button) {
        // Get the parent row and remove it
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>





<?php
 include('./include/footer.php');
 ?>
