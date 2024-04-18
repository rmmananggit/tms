<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bootstrap Registration Form</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4">Registration Form</h2>
      <form id="registrationForm">
        <div class="form-group">
          <label for="userType">Select User Type:</label>
          <select class="form-control" id="userType" name="userType" onchange="toggleForm()">
            <option selected disabled value="#">--- Select ---</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
          </select>
        </div>

        <!-- Student Form -->
        <div id="studentForm" style="display: none;">
          <div class="form-group">
            <label for="studentName">Student Name:</label>
            <input type="text" class="form-control" id="studentName" name="studentName">
          </div>
          <div class="form-group">
            <label for="studentRollNo">Roll Number:</label>
            <input type="text" class="form-control" id="studentRollNo" name="studentRollNo">
          </div>
        </div>

        <!-- Teacher Form -->
        <div id="teacherForm" style="display: none;">
          <div class="form-group">
            <label for="teacherName">Teacher Name:</label>
            <input type="text" class="form-control" id="teacherName" name="teacherName">
          </div>
          <div class="form-group">
            <label for="teacherSubject">Subject:</label>
            <input type="text" class="form-control" id="teacherSubject" name="teacherSubject">
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  function toggleForm() {
    var userType = document.getElementById("userType").value;

    // Hide all forms
    document.getElementById("studentForm").style.display = "none";
    document.getElementById("teacherForm").style.display = "none";

    // Show the selected form
    document.getElementById(userType + "Form").style.display = "block";
  }
</script>

</body>
</html>
  