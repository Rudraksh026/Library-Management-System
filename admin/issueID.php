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

<body style="color:white;">
    <?php
        include '../extra/nav.php';
        include '../extra/conn.php';
    ?>


   
<form action="issueID.php" method="POST" class="px-8 py-10" enctype="multipart/form-data">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Information Required for Generating ID</h2>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
            <div class="mt-2">
              <input type="text" required name="name" id="name" autocomplete="given-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
  
          <div class="sm:col-span-3">
            <label for="user-id" class="block text-sm font-medium leading-6 text-gray-900">User Id</label>
            <div class="mt-2">
              <input readonly required type="number" name="userid" id="user-id" autocomplete="family-name" 
                <?php
                    $sqlforsno = "SELECT useridno FROM `useridissue` ORDER BY useridno DESC LIMIT 1;";
                    $resultforsno = mysqli_query($conn,$sqlforsno);
                    $rowforsno = mysqli_num_rows($resultforsno);
                    if($rowforsno>0){
                    $dataforsno = mysqli_fetch_assoc($resultforsno);
                    echo 'value="'.($dataforsno['useridno']+1).'"';
                    }
                    else{
                      echo 'value = "1"';
                    }
                ?>
                class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
  
          <div class="col-span-full">
            <label for="file-upload" class="block text-sm font-medium leading-6 text-gray-900">cover photo</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
              <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                </svg>
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                  <label required for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                    <input type="file" name="fileToUpload" id="" required>
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG up to 10MB</p>
              </div>
            </div>
          </div>
          <!-- <input type="file" name="fileToUpload" id=""> -->

  
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
            <label for="issueyear" class="block text-sm font-medium leading-6 text-gray-900">Issue Date</label>
            <div class="mt-2">
              <input required type="date" value="<?php echo date('Y-m-d'); ?>" readonly name="userissueyear" id="issueyear" autocomplete="family-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
            $userbranch = $_POST['userbranch'];
            $userbranchyear = $_POST['userbranchyear'];
            $userissueyear = $_POST['userissueyear'];

            $img_name = $_FILES["fileToUpload"]['name'];
	        $img_size = $_FILES["fileToUpload"]['size'];
	        $tmp_name = $_FILES["fileToUpload"]['tmp_name'];
	        $error = $_FILES["fileToUpload"]['error'];

            if($error == 0){
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
		        $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg","png");

                if (in_array($img_ex_lc, $allowed_exs) || isset($userid)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = '../uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $insertquery = "INSERT INTO `useridissue` (`useridno`, `username`, `userbranch`, `userbranchyear`, `userimageurl`, `useridissueyear`) VALUES ('".$userid."','".$username."', '".$userbranch."', '".$userbranchyear."', '".$new_img_name."', '".$userissueyear."');";
                    $resultcheck = mysqli_query($conn,$insertquery);
                    if($resultcheck){
                      echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "ID Generation Successfully",
          showConfirmButton: false,
          timer: 1500
        });
    location.reload();
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
        location.reload();
        </script>';
                    }
                }
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

</html>
<?php } 
else{
  echo '<script>
    window.location.href =
        "../login.php";

</script>';
}
?>