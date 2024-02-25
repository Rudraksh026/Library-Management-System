<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <?php include '../extra/importantLinks.php'; ?>
</head>
<body>
    <?php include '../extra/conn.php'; include '../extra/nav2.php'; ?>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <form method="post" enctype="multipart/form-data">
          <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Reset Password</h1>
            </div>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2">
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="Password" class="leading-7 text-sm text-gray-600">Password</label>
                  <input type="password" id="Password" name="Password" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="cPassword" class="leading-7 text-sm text-gray-600">Confirm Password</label>
                  <input type="password" id="cPassword" name="cPassword" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
              </div>
              <div class="p-2 w-full mb-1" >
                <input type="checkbox" id="show" onclick="myFunction()"><label for="show" class="leading-7 text-sm text-gray-600">&nbsp; Show Password</label>
              </div><br>
                <input type="submit" name="submit" id="submit" value="Reset Password" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            </form>
            </div>
          </div>
        </div>
      </section>

      <?php
        if(isset($_POST['submit']))
        {
            if($_POST['Password'] == $_POST['cPassword']){
                $pass = $_POST['Password'];
                $useridno = $_SESSION['dsfjhsdk'];
                $sqlForSetPassword = 'UPDATE `useridissue` SET `userpassword` = "'.$pass.'" WHERE `useridissue`.`useridno` ='.$useridno.';';
                $resultForSetPassword = mysqli_query($conn,$sqlForSetPassword);
                echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Password Has Been Changed !",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
            }
            else{
                echo '<script>
    Swal.fire({
      position: "top-end",
      icon: "error",
      title: "password and confirm password must be same ! ",
      showConfirmButton: false,
      timer: 1500
    });
    </script>';
            }
        }
      ?>

    <?php include '../extra/footer.php'; ?>

    <script>
        function myFunction() {
  var x = document.getElementById("Password");
  var y = document.getElementById("cPassword");
  if (x.type === "password" || y.type === "password") {
    x.type = "text";
    y.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
  }
}
      </script>
</body>
</html>