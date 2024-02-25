<?php session_start();
  if(isset($_SESSION["dsfjhsdk"])){ 
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include '../extra/importantLinks.php'; ?>
</head>

<body>
    <?php
        include '../extra/nav.php';
        include '../extra/conn.php';
    ?>
    <?php
        $bookid = $_COOKIE['bookid'];
        $sql = 'SELECT * FROM `useridissue`;';
        $result = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($result);
        $data = mysqli_fetch_all($result);
    ?>


   
<form method="POST" class="px-8 py-10" enctype="multipart/form-data">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Information Required for Renewing ID</h2>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        
  
          <div class="sm:col-span-2">
            <label for="user-id" class="block text-sm font-medium leading-6 text-gray-900">User Id</label>
            <div class="mt-2">
              <input required type="number" onchange="populate()" name="userid" id="issuebookid" autocomplete="family-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:col-span-2">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
            <div class="mt-2">
              <input type="text" required name="name" id="name" autocomplete="given-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
          <div class="sm:col-span-2">
            <label for="password" required class="block text-sm font-medium leading-6 text-gray-900">User Password</label>
            <div class="mt-2">
              <input type="text" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" autocomplete="family-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

  
          <div class="sm:col-span-2 sm:col-start-1">
            <label for="userbranch" class="block text-sm font-medium leading-6 text-gray-900">Branch</label>
            <div class="mt-2">
              <select required id="userbranch" name="userbranch" autocomplete="country-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" disabled selected>Select the given option</option>
                <option value="Electrical">Electrical</option>
                <option value="Electronics">Electronics</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Information_Technology">Information Technology</option>
                <option value="Civil">Civil</option>
                <option value="Gaming_&_Animation">Gaming & Animation</option>
                <option value="mechanical">mechanical</option>
              </select>
            </div>
          </div>
  
          <div class="sm:col-span-2">
            <label for="userbranchyear" class="block text-sm font-medium leading-6 text-gray-900">Branch Year</label>
            <div class="mt-2">
              <select required id="userbranchyear" name="userbranchyear" autocomplete="country-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="" disabled selected>Select the given option</option>
                <option value="1">1st</option>
                <option value="2">2nd</option>
                <option value="3">3rd</option>
              </select>
            </div>
          </div>
  
          <div class="sm:col-span-2">
            <label for="issueyear" class="block text-sm font-medium leading-6 text-gray-900">Renue Date</label>
            <div class="mt-2">
              <input required type="date" value="<?php echo date('Y-m-d'); ?>" readonly name="userissueyear" id="userissueyear" autocomplete="family-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
        </div>
      </div>
  
  
      <div class="mt-6 flex items-center justify-end gap-x-6">
        <input type="reset" value="Cancel" class="text-sm font-semibold leading-6 text-gray-900"/>
        <input type="submit" name="submit" value="Submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
      </div>
  </form>
  
    <?php
        if(isset($_POST['submit'])){
            $username = $_POST['name'];
            $userid = $_POST['userid'];
            $password = $_POST['password'];
            $userbranch = $_POST['userbranch'];
            $userbranchyear = $_POST['userbranchyear'];
            $userissueyear = $_POST['userissueyear'];
            $insertquery = "UPDATE `useridissue` SET `username` = '".$username."', `userbranch` = '".$userbranch."', `userbranchyear` = '".$userbranchyear."', `useridissueyear` = '".$userissueyear."', `userpassword` = '".$password."' WHERE `useridissue`.`useridno` = ".$userid.";";
            $resultcheck = mysqli_query($conn,$insertquery);
            if($resultcheck){
                      echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "ID Renew Successfully",
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
          title: "Something Went Wrong",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
                    }
                
            
            $_POST['submit'] = null;
            $username = null;
            $userid = null;
            $password = null;
            $userbranch = null;
            $userbranchyear = null;
            $userissueyear = null;
        }
    ?>
<?php include '../extra/footer.php'; ?>
</body>
<script>
    function populate(){
        let x =document.getElementById("issuebookid").value;
        document.cookie = "bookid = " + x;
        let size = <?php echo $row; ?>;
        let data = new Array(size);
        let temp =true;
        data = <?php echo json_encode($data); ?>;
        for(let i=0;i<data.length;i++)
        {
          if(data[i].includes(x))
          {
            let index = data.indexOf(x);
            document.getElementById("userbranch").value = data[i][2];
            document.getElementById("userbranchyear").value = data[i][3];
            document.getElementById("name").value = data[i][1];
            document.getElementById("password").value = data[i][6];
            temp =false;
          }
          
        }
        if(temp){
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "No User Id Found",
          showConfirmButton: false,
          timer: 1500
        });
            document.getElementById("userbranch").value = "";
            document.getElementById("userbranchyear").value = "";
            document.getElementById("name").value = "";
            document.getElementById("password").value = "";
        }
        
        
    }
</script>
</html>
<?php } 
else{
  echo '<script>
    window.location.href =
        "../login.php";

</script>';
}
?>