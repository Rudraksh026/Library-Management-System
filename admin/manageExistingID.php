<?php session_start();
  if(isset($_SESSION["dsfjhsdk"])){ 
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../extra/importantLinks.php'; ?>
</head>

<body>
    <?php 
    include '../extra/conn.php';
    include '../extra/nav.php'; ?>
    <?php
    if(isset($_POST['search']) || isset($_POST['fineclear']))
      {
        
        $optionRequest = $_POST['optionRequest'];
        $requestId = $_POST['requestId'];
        $sql = "SELECT * FROM `useridissue` WHERE 0;";
        $sql2 = "SELECT * FROM `useridissue` WHERE 0;";
        echo '<section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
        <form method="post">
        <label for="exampleDataList" class="form-label"><strong>Search ID Holder</strong></label>
        <select onchange="populate()" id="datalistOptions" name="optionRequest" class="form-control" required>
            <option value="'.$optionRequest.'" selected>Searching with '.$optionRequest.'</option>
            <option value="ID">Search By ID</option>
            <option value="Name">Search By Name</option>
            <option value="Branch">Search By Branch</option>
        </select><br>
        <input type="text" name="requestId" id="bookrequirement" class="form-control" value="'.$requestId.'" required>
        <br>
        <input type="submit" name="search" value="submit" style="background-color: rgb(99 102 241); color: white;" id="submit" class="form-control" />
        </form>
        </div>
    </section>';
    if($optionRequest == "ID"){
      $sql = 'SELECT * FROM `useridissue` WHERE useridno = '.$requestId.';';
      // $sql2 = 'SELECT * FROM `useridissue` INNER JOIN issuebook ON useridissue.useridno = issuebook.issuerid WHERE useridno = '.$requestId.';';
      }
    elseif($optionRequest == 'Name'){
      $sql = 'SELECT * FROM `useridissue` WHERE username like "%'.$requestId.'%";';
      // $sql2 = 'SELECT * FROM `useridissue` INNER JOIN issuebook ON useridissue.useridno = issuebook.issuerid WHERE username like "%'.$requestId.'%";';
    }
    elseif($optionRequest == 'Branch'){
      $sql = 'SELECT * FROM `useridissue` WHERE userbranch like "%'.$requestId.'%";';
      // $sql2 = 'SELECT * FROM `useridissue` INNER JOIN issuebook ON useridissue.useridno = issuebook.issuerid WHERE userbranch like "%'.$requestId.'%";';
    }

    if(isset($_POST['fineclear'])){
      $sqlforfineclear = "UPDATE `issuebook` SET `issuedate` = '".date('Y-m-d')."' WHERE `issuebook`.`issuerid` = ".$_POST['usercheckforextra'].";";
      mysqli_query($conn,$sqlforfineclear);
    }

    $result = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result);
    if($rows>0){
      echo'<section class="text-gray-600 body-font">
      <div class="container px-5 py-2 mx-auto">
      <div class="flex flex-wrap -m-4">';
      while($data = mysqli_fetch_assoc($result)){
          $bookId = [];
          $sql2 = 'SELECT * FROM `useridissue` INNER JOIN issuebook ON useridissue.useridno = issuebook.issuerid WHERE useridno like '.$data['useridno'].';';
          $result2 = mysqli_query($conn,$sql2);
          while($data2 = mysqli_fetch_assoc($result2)){
            array_push($bookId,$data2['issuebookid']);
          }
          echo'<div class="border-solid border-1 border-slate-400 p-4 lg:w-1/3">
          <div class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
            <img alt="team" class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4" src="../uploads/';
            $img_ex = pathinfo($data['userimageurl'], PATHINFO_EXTENSION);
		        $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg","png");
            if(in_array($img_ex_lc, $allowed_exs)){
              echo $data['userimageurl'];
            }
            else{
              echo 'temp.jpg';
            }
            echo'">
            <div class="flex-grow sm:pl-8">
              <h2 class="title-font font-medium text-lg text-gray-900">'.$data['useridno'].'</h2>
              <h2 class="title-font font-medium text-lg text-gray-900">'.$data['username'].'</h2>
              <h3 class="text-gray-500 mb-3">'.$data['userbranch'].'</h3>
              <p class="mb-1">'.$data['userbranchyear'].' year</p>
              ';
              $nameofbooks = "";
              $arrayofdate = array();
              $datediffint = array();
              $currentdate = date("Y-m-d");
              $date1 = date_create($currentdate);
              foreach ($bookId as $bkid){
                $booknamesql = "SELECT bookname FROM `bookdetails` WHERE bookno = ".$bkid.";";
                $resultforbookname = mysqli_query($conn,$booknamesql);
                $dataforbookname = mysqli_fetch_assoc($resultforbookname);
                $nameofbooks = $dataforbookname['bookname']." , ".$nameofbooks;

                $bookissuedatesql = "SELECT issuedate From `issuebook` WHERE issuebookid like  ".$bkid.";";
                $bookissuedaterersult = mysqli_query($conn,$bookissuedatesql);
                $bookissuedatedata = mysqli_fetch_assoc($bookissuedaterersult);
                array_push($arrayofdate,$bookissuedatedata['issuedate']);
              }
              $finevalue =0;
              for($x =0;$x<sizeof($arrayofdate);$x++){
                $date2 = date_create($arrayofdate[$x]);
                $arrayofdate[$x] = date_diff($date2,$date1);
                $datediffint[$x] = $arrayofdate[$x]->format("%a");
              }
              for($x =0;$x<sizeof($datediffint);$x++){
                if(($datediffint[$x]-15) > 0)
                {
                  $finevalue += ($datediffint[$x]-15);
                }
              }
              if($finevalue > 0){
              echo '<p class="mb-1" style="color:red;"><strong>Fine :- ₹'.$finevalue.' /-</strong></p>';
              }else{
                echo '<p class="mb-1" style="color:green;"><strong>Fine :- ₹'.$finevalue.' /-</strong></p>';
              }
              if(strlen($nameofbooks)<=0){
                echo '<p class="mb-4"><strong>No Book was Issued</strong></p>';
              }
              else{
                  echo '<p class="mb-4">Issue Books :- <strong>'.$nameofbooks.'</strong></p>';
              }
              $diff = date_create(date("Y")) ;
              $useridissueyear =  date_create($data['useridissueyear']);
              $storedatediff =  date_diff($useridissueyear,$diff);
              $storedatediffformat =  $storedatediff->format("%a");
              if($storedatediffformat > 365){echo '<h2 style="color:red;" class="title-font font-medium text-lg text-gray-900">Expired( <a href="renueID.php" class="hover:text-green-900 title-font font-medium">Click Here For Renue</a> )</h2>';}
              else{echo '<h2 style="color:Green;" class="title-font font-medium text-lg text-gray-900">Running</h2>';}
              
              echo'<div class="flex justify-center">
              <form method="post">
                <input type="number" name="usercheckforextra" value="'.$data['useridno'].'" style="display:none;">
                <select onchange="populate()" id="datalistOptions" name="optionRequest" style="display:none;" class="form-control" required>
                    <option value="'.$optionRequest.'" selected>Searching with '.$optionRequest.'</option>
                    <option value="ID">Search By ID</option>
                    <option value="Name">Search By Name</option>
                    <option value="Branch">Search By Branch</option>
                </select><br>
                <input type="text" name="requestId" id="bookrequirement" style="display:none;" class="form-control" value="'.$requestId.'" required>
                <input type="submit" text="Submit" name="fineclear" value="Clear Fine" class="inline-flex text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg">
                </form>
      </div>
            </div>
          </div>
        </div>';
        }

        echo'</div>
    </div>
  </section>';
    }
    else{
      echo'<main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
      <div class="text-center">
        <p class="text-base font-semibold text-indigo-600"></p>
        <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Data not found</h1>
        <p class="mt-6 text-base leading-7 text-gray-600">Anyone Doesn'."'".'t Consists With This ID.</p>
      </div>
    </main>';
    }
      }
    else{
        echo'<section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
        <form method="post">
        <label for="exampleDataList" class="form-label"><strong>Search ID Holder</strong></label>
        <select onchange="populate()" id="datalistOptions" name="optionRequest" class="form-control" required>
            <option value="" selected disable>Select the Option</option>
            <option value="ID">Search By ID</option>
            <option value="Name">Search By Name</option>
            <option value="Branch">Search By Branch</option>
        </select><br>
        <input type="text" style="display:none;" name="requestId" id="bookrequirement" class="form-control" placeholder="Enter the Book Name" required>
        <br>
        <input type="submit" name="search" value="submit" style="background-color: rgb(99 102 241); color: white;" id="submit" class="form-control" />
        </form>
        </div>
    </section>';
    }
    ?>
    <?php include '../extra/footer.php'; ?>
</body>
<script>
      function populate()
      {
        let x = document.getElementById('datalistOptions').value;
        document.getElementById('bookrequirement').placeholder = "Enter the "+x;
        document.getElementById('bookrequirement').style.display = "block";
        console.log(x);
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