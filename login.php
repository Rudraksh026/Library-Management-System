<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'extra/importantLinks.php'; ?>
</head>
<body>
    <?php include 'extra/conn.php'; ?>

    <section class="text-gray-600 body-font relative">
        <div class="absolute inset-0 bg-gray-300">
            <img width="100%"   frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="img/books-1281581_1280.jpg" style="filter: grayscale(0) contrast(0.5) opacity(1);height:750px !important;">
        </div>
        <div class="container px-5 py-24 mx-auto flex">
            <div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
              <form method="post" enctype="multipart/form-data">
            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Login</h2>
            <p class="leading-relaxed mb-5 text-gray-600">Enter the Details that has been asked</p>
            <div class="relative mb-4">
              <label for="loginas" class="leading-7 text-sm text-gray-600">Login As</label>
              <select id="loginas" name="loginas" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                  <option value="" selected disabled>Select From the option</option>  
                  <option value="admin">As An admin</option>
                  <option value="customer">As A Customer</option>
              </select>
            </div>
            <div class="relative mb-4">
              <label for="id" class="leading-7 text-sm text-gray-600">Id Number</label>
              <input type="number" id="id" onchange="populate()" name="id" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
            </div>
            <div class="relative mb-4">
              <label for="password" class="leading-7 text-sm text-gray-600">Password</label>
              <input type="password" id="password" name="password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            </div>
            <div class="relative mb-4" id="show" style="display: none;">
              <label for="cpassword" class="leading-7 text-sm text-gray-600">Confirm Password</label>
              <input type="password" id="cpassword" name="cpassword" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
            <div class="relative mb-4" >
              <input type="checkbox" id="show" onclick="myFunction()"><label for="show" class="leading-7 text-sm text-gray-600">&nbsp; Show Password</label>
            </div>
            <input type="submit" name="submit" id="submit" value="Login" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        </form>
          </div>
        </div>
      </section>
</body>
<?php
    if(isset($_POST['submit']))
    {
        if($_POST['loginas'] == "admin"){
            if($_POST['id'] == 1234 && $_POST['password'] == '#Abc1234'){
                
                $_SESSION['dsfjhsdk'] = "set";
                echo '<script> window.location.href = "admin/index.php"; </script>';
            }
            else{
                echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Wrong Entry ! ",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
            }
        }
        if($_POST['loginas'] == "customer" ){
            $sqlForExtract = "SELECT useridno,userpassword FROM useridissue WHERE useridno = ".$_POST['id'].";";
            $resultOfExtract = mysqli_query($conn,$sqlForExtract);
            $data = mysqli_fetch_all($resultOfExtract);
            if(isset($data[0][1])){
                
                $rowOfExtract = mysqli_num_rows($resultOfExtract);

                if($rowOfExtract>0){
                    $useridno = $data[0][0];
                    $_SESSION['dsfjhsdk'] = $useridno;
                    echo '<script> window.location.href = "IDUser/index.php"; </script>';
                }
                else{
                    echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Wrong Entry ! ",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
                }
            }
            else{
                if($_POST['password'] == $_POST['cpassword']){
                    $useridno = $data[0][0];
                    $_SESSION['dsfjhsdk'] = $useridno;
                    $sqlForSetPassword = 'UPDATE `useridissue` SET `userpassword` = "'.$_POST['password'].'" WHERE `useridissue`.`useridno` ='.$_POST['id'].';';
                    $resultForSetPassword = mysqli_query($conn,$sqlForSetPassword);
                    echo '<script> window.location.href = "IDUser/index.php"; </script>';
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
        }
    }
?>

<?php
    $sqlforcheckonload = "SELECT useridno FROM `useridissue` WHERE userpassword IS null;";
    $resultforcheckonload = mysqli_query($conn,$sqlforcheckonload);
    $sizeforcheckonload = mysqli_num_rows($resultforcheckonload);
    $dataforcheckonload = mysqli_fetch_all($resultforcheckonload);
?>
<script type='text/javascript'>
    function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

    function populate(){
        let x =document.getElementById('id').value;
        let y =document.getElementById('loginas').value;
        console.log(y);
        let size = <?php echo $sizeforcheckonload; ?>;
        let arr = [size][1];
        arr = <?php echo json_encode($dataforcheckonload); ?>;
        console.log(x);
        if(!(x === "") && (y === "customer")){
        for(let i=0 ; i<size ; i++)
        {
            if(arr[i][0].includes(x)){
                document.getElementById('show').style.display = "block";
                alert("you are logging first time so you have to set password !");
                break;
            }
            else{
                document.getElementById('show').style.display = "none";
            }
        }
    }
    else{
        document.getElementById('show').style.display = "none";
    }
    }
      
</script>
</html>