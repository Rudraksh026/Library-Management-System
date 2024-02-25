<?php session_start();
  if(isset($_SESSION["dsfjhsdk"])){ 
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../extra/importantLinks.php';?>
</head>

<body>
    <?php include '../extra/conn.php'; include '../extra/nav.php';?>


    
<form method="post" class="px-8 py-10">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Information Required for Issue Book</h2>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="issuerid" class="block text-sm font-medium leading-6 text-gray-900">Issuer ID</label>
            <div class="mt-2">
              <input type="text" required name="issuerid" id="issuerid" onchange="populate2()" autocomplete="given-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
          <div class="sm:col-span-3">
            <label for="issuerid" class="block text-sm font-medium leading-6 text-gray-900">Issuer Name</label>
            <div class="mt-2">
            <p type="number" name="issuername" readonly id="issuername" autocomplete="family-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">&nbsp;</p>
            </div>
          </div>
  
          <div class="sm:col-span-3">
            <label for="issuebookid" class="block text-sm font-medium leading-6 text-gray-900">Book Id</label>
            <div class="mt-2">
              <input type="number" required name="issuebookid" id="issuebookid" onchange="populate()" autocomplete="family-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
  
          <div class="sm:col-span-3">
            <label for="issuedate" class="block text-sm font-medium leading-6 text-gray-900">Issue Date</label>
            <div class="mt-2">
              <input type="date" readonly value="<?php echo date("Y-m-d"); ?>" name="issuedate" id="issuedate" autocomplete="family-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>
  
          <div class="sm:col-span-3">
            <label for="bookname" class="block text-sm font-medium leading-6 text-gray-900">Book Name</label>
            <div class="mt-2">
              <p type="number" name="bookname" readonly id="bookname" autocomplete="family-name" class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">&nbsp;</p>
            </div>
          </div>
        </div>
      </div>
  
  
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <input type="reset" name="cancel" value="Cancel" class="text-sm font-semibold leading-6 text-gray-900"/>
      <input type="submit" name="submit" value="Submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
    </div>
  </form>
  <?php
        $bookid = $_COOKIE['bookid'];
        $sql = 'SELECT bookname,bookno FROM `bookdetails` WHERE 1;';
        $result = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($result);
        $bookname = array();
        $bookno = array();
        while ($data = mysqli_fetch_assoc($result)){
            array_push($bookname,$data['bookname']);
            array_push($bookno,$data['bookno']);
        }
    ?>
    <?php
        $issuerid = $_COOKIE['fdjh'];
        $sql2 = 'SELECT useridno,username FROM `useridissue` WHERE 1;';
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_num_rows($result2);
        $username = array();
        $useridno = array();
        while ($data2 = mysqli_fetch_assoc($result2)){
            array_push($username,$data2['username']);
            array_push($useridno,$data2['useridno']);
        }
    ?>
    <?php
      $check = 'SELECT DISTINCT issuebookid FROM `issuebook`;';
      $checkresult = mysqli_query($conn,$check);
      $checkrow = mysqli_num_rows($checkresult);
      $checkarray = array();
      while($checkdata = mysqli_fetch_assoc($checkresult)){
        array_push($checkarray,$checkdata['issuebookid']);
      }

      $checkofborrow = "SELECT issuebookid FROM `issuebook`;";
      $resultofborrow = mysqli_query($conn,$checkofborrow);
      $arrayofborrow = array();
      while($dataofborrow = mysqli_fetch_assoc($resultofborrow)){
        array_push($arrayofborrow,$dataofborrow['issuebookid']);
      }
    ?>
    <?php
    if(isset($_POST['submit'])){
      $tempofphp = true;
      $tempofphp2 = true;
      $date = $_POST['issuedate'];
      $userid = $_POST['issuerid'];
      $issuebookid = $_POST['issuebookid'];
      if(!(in_array($userid,$useridno))){
        $tempofphp = false;
        $tempofphp2 = false;
        echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Not a Register User.",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
      }
      if(in_array($issuebookid,$arrayofborrow))
      {
        $tempofphp = false;
        $tempofphp2 = false;
        echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Book is borrow by Someone",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
      }
      $SQLCHECK = "SELECT useridissueyear FROM useridissue WHERE useridno = ".$userid.";";
      $RESULTCHECK = mysqli_query($conn,$SQLCHECK);
      $data5646 = mysqli_fetch_assoc($RESULTCHECK);
      $diff = date_create(date("Y")) ;
      $useridissueyear =  date_create($data5646['useridissueyear']);
      $storedatediff =  date_diff($useridissueyear,$diff);
      $storedatediffformat =  $storedatediff->format("%a");
      if($storedatediffformat > 365){
        $tempofphp = false;
        $tempofphp2 = false;
        echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "ID was Expired ! ",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
      }
      if($tempofphp){
        $sqlforinsert = "INSERT INTO `issuebook` (`issuedate`, `issuerid`, `issuebookid`, `sno`) VALUES ('".$date."', '".$userid."', '".$issuebookid."', NULL);";
        $resultforinsert = mysqli_query($conn,$sqlforinsert);
        echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Book Issue Successfully",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
        $tempofphp = false;
        $tempofphp2 = false;
      }
      if($tempofphp){
        $tempofphp = false;
        $tempofphp2 = false;
        echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Something Went wrong on our end ! ",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
      }
    }
  ?>
  <?php include '../extra/footer.php'; ?>
</body>
<script>
    function populate(){
        let x =document.getElementById("issuebookid").value;
        document.cookie = "bookid = " + x;
        let size = <?php echo $row; ?>;
        let sizecheck = <?php echo $checkrow; ?>;
        let booknamearray = new Array(size);
        let booknoarray = new Array(size);
        let bookcheckarray = new Array(sizecheck);
        booknamearray = <?php echo json_encode($bookname); ?>;
        booknoarray = <?php echo json_encode($bookno); ?>; 
        bookcheckarray = <?php echo json_encode($checkarray); ?>; 
        if(!(bookcheckarray.includes(x))){
          if(booknoarray.includes(x)){
            let index = booknoarray.indexOf(x);
            x =booknamearray[index];
            document.getElementById("bookname").innerHTML = ""+x;
            document.getElementById("bookname").style.borderColor = "green";
            document.getElementById("issuebookid").style.borderColor = "green";
          }
          else{
            document.getElementById("bookname").style.borderColor = "Red";
            document.getElementById("issuebookid").style.borderColor = "Red";
            alert("Invalid Book Id");
          }
        }
        else{
            document.getElementById("bookname").style.borderColor = "Red";
            document.getElementById("issuebookid").style.borderColor = "Red";
            alert("Book Is Issued By Someone");
        }
    }

    function populate2(){
        let x2 =document.getElementById("issuerid").value;
        document.cookie = "fdjh = " + x2;
        let size2 = <?php echo $row2; ?>;
        let usernamearray = new Array(size2);
        let useridnoarray = new Array(size2);
        usernamearray = <?php echo json_encode($username); ?>;
        useridnoarray = <?php echo json_encode($useridno); ?>; ;
        if(useridnoarray.includes(x2)){
            let index2 = useridnoarray.indexOf(x2);
            x2 =usernamearray[index2];
            document.getElementById("issuername").innerHTML = ""+x2;
            document.getElementById("issuername").style.borderColor = "green";
            document.getElementById("issuerid").style.borderColor = "green";
        }
        else{
            document.getElementById("issuername").style.borderColor = "Red";
            document.getElementById("issuerid").style.borderColor = "Red";
            alert("Not a Registered User");
        }
      }


    function confirm(){
          
        }

        function notconfirm()
        {
          
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