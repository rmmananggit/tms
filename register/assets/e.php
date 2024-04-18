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

                        <div class="col-md-6 mb-3">
                            <label for=""><strong>Category</strong></label>
                            <select name="category" id="categoryDropdown" required class="form-control">
                                <option value="Academic Skills">Academic Skills</option>
                                <option value="Non Academic Skills">Non Academic Skills</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for=""><strong>Subject</strong></label>
                            <select name="subject" id="subjectDropdown" required class="form-control">
                                <!-- The options will be dynamically populated using JavaScript -->
                            </select>
                        </div>

                            <div class="col-md-12 mb-3">
                            <label for=""><strong>Subject Title </strong></label>
                                <input required type="text" Placeholder="Eg. Math Tutorial" name="title" class="form-control" maxlength="500">
                            </div>

                            <div class="col-md-12 mb-3">
                            <label for=""><strong>Description</strong></label>
                                <textarea class="form-control" placeholder="Description about tutorial services" rows="7"  maxlength="200"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input required type="text" Placeholder="Rate per day" name="rate_day" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <input required type="text" value="Day"  class="form-control" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input required type="text" Placeholder="Rate per hour" name="rate_hour" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <input required type="text" value="Hour" class="form-control" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Contract Duration <strong><small>(hour)</small></strong></label>
                                <input required type="number" Placeholder="Eg. This post is good for 24 tutoring time" name="contract_duration" class="form-control">
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

                            <div class="module-container">
                                <div class="col-md-12 module" data-task-number="1">
                                    <label class="mb-3" for="module_1"><b>Module Name</b></label>
                                    <input required type="text" Placeholder="Eg. Learning Task 1" name="module[1]" class="form-control">
                                    <br>
                                    <textarea class="form-control" name="moduledesc[1]" rows="5" placeholder="Enter Learning Objectives and the Topic Discussion *" maxlength="200"></textarea>
                                </div>
                            </div>

                           
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

<script>
    // Function to populate subject dropdown based on selected category
    function populateSubjects() {
        const categoryDropdown = document.getElementById('categoryDropdown');
        const subjectDropdown = document.getElementById('subjectDropdown');

        // Clear previous options
        subjectDropdown.innerHTML = '';

        // Get the selected category
        const selectedCategory = categoryDropdown.value;

        // Define subject options based on category
        const subjectOptions = {
            'Academic Skills': ['Science', 'Math', 'English'],
            'Non Academic Skills': ['Music', 'Arts', 'Culinary Arts']
        };

        // Populate subject dropdown with options based on selected category
        subjectOptions[selectedCategory].forEach(subject => {
            const option = document.createElement('option');
            option.value = subject;
            option.text = subject;
            subjectDropdown.add(option);
        });
    }

    // Attach event listener to category dropdown change event
    document.getElementById('categoryDropdown').addEventListener('change', populateSubjects);

    // Initial population on page load
    populateSubjects();
</script>







<?php
 include('./include/footer.php');
 ?>
