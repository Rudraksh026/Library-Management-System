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
        include '../extra/nav.php';
        include '../extra/conn.php';
    ?>

    
            
        
    <?php
      if(isset($_POST['search']))
      {
        $optionRequest = $_POST['optionRequest'];
        $requestId = $_POST['requestId'];
        $sql2 = "SELECT * FROM `useridissue` WHERE 0;";
        echo '<section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
        <form method="post">
        <label for="exampleDataList" class="form-label"><strong>Search Book</strong></label>
        <select onchange="populate()" id="datalistOptions" name="optionRequest" class="form-control" required>
            <option value="'.$optionRequest.'" selected>Searching with '.$optionRequest.'</option>
            <option value="BookID">Search By Book ID</option>
            <option value="BookName">Search By Book Name</option>
            <option value="AuthorName">Search By Author Name</option>
            <option value="BranchName">Search By Branch Name</option>
        </select><br>
        <input type="text" name="requestId" id="bookrequirement" class="form-control" value='.$requestId.' required>
        <br>
        <input type="submit" name="search" value="submit" style="background-color: rgb(99 102 241); color: white;" id="submit" class="form-control" />
        </form>
        </div>
    </section>';

        if($optionRequest == "BookID"){
          $sql2 = 'SELECT * FROM `bookdetails` LEFT JOIN issuebook ON bookdetails.bookno = issuebook.issuebookid WHERE bookno = '.$requestId.';';
        }
        elseif($optionRequest == 'BookName'){
          $sql2 = 'SELECT * FROM `bookdetails` LEFT JOIN issuebook ON bookdetails.bookno = issuebook.issuebookid WHERE bookname like "%'.$requestId.'%";';
        }
        elseif($optionRequest == 'AuthorName'){
          $sql2 = 'SELECT * FROM `bookdetails` LEFT JOIN issuebook ON bookdetails.bookno = issuebook.issuebookid WHERE bookauthor like "%'.$requestId.'%";';
        }
        elseif($optionRequest == 'BranchName'){
          $sql2 = 'SELECT * FROM `bookdetails` LEFT JOIN issuebook ON bookdetails.bookno = issuebook.issuebookid WHERE bookbranch like "%'.$requestId.'%";';
        }
        $result = mysqli_query($conn,$sql2);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
          echo '<section class="text-gray-600 body-font">
        <div class="container px-5 py-1 mx-auto">
          <div class="flex flex-wrap -mx-4 -my-8">';
          while($data = mysqli_fetch_assoc($result))
          {
            echo'<div class="border-solid border-1 border-slate-400 py-8 px-4 lg:w-1/4">
            <div class="h-full flex items-start">
              <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
                <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">'.$data['bookedition'].' Edition</span>
                <span class="font-medium text-lg text-gray-800 title-font leading-none">'.$data['bookyear'].'</span>
              </div>
              <div class="flex-grow pl-6">
                <h2 class="tracking-widest text-xs title-font font-medium text-indigo-500 mb-1">'.$data['bookbranch'].'</h2>
                <h1 class="title-font text-xl font-medium text-gray-900 mb-3">'.$data['bookname'].'</h1>
                <p class="leading-relaxed mb-1">Author :- '.$data['bookauthor'].'</p>
                <p class="leading-relaxed mb-1">'.$data['bookpublisher'].'</p>
                <p class="leading-relaxed mb-1">₹'.$data['bookprice'].'/-</p>
                <p class="leading-relaxed mb-1">Book Id :- '.$data['bookno'].'</p>
                <p class="leading-relaxed mb-3">Book pages :- '.$data['bookpages'].'</p>
                <a class="inline-flex items-center">
                  <span class="flex-grow flex flex-col pl-3">';
                  if(isset($data['issuerid'])){
                    echo'<span style="color:Red;" class="title-font font-medium text-gray-900">Book Issued by ';
                    $sqlforname = 'SELECT `username`,`userbranchyear` FROM `useridissue` WHERE `useridno` = '.$data['issuerid'].';';
                    $dataforname = mysqli_fetch_assoc(mysqli_query($conn,$sqlforname));
                    
                  echo $dataforname['username'].' ('.$dataforname['userbranchyear'].' year)</span>';
                  }
                  else
                    echo'<span style="color:green;" class="title-font font-medium text-gray-900">In the Library</span>';
                    echo'</span>
                </a>
              </div>
            </div>
          </div>';
          }
          echo '</div>
          </div>
        </section>';
        }
        else{
          echo'<main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
          <div class="text-center">
            <p class="text-base font-semibold text-indigo-600"></p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Data not found</h1>
            <p class="mt-6 text-base leading-7 text-gray-600">No Book Consists With Above Details</p>
          </div>
        </main>';
        }
      }
      else{
        echo'<section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
        <form method="post">
        <label for="exampleDataList" class="form-label"><strong>Search Book</strong></label>
        <select onchange="populate()" id="datalistOptions" name="optionRequest" class="form-control" required>
            <option value="" selected disable>Select the Option</option>
            <option value="BookID">Search By Book ID</option>
            <option value="BookName">Search By Book Name</option>
            <option value="AuthorName">Search By Author Name</option>
            <option value="BranchName">Search By Branch Name</option>
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