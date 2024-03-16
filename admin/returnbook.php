<?php session_start();
  if(isset($_SESSION["dsfjhsdk"])){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../extra/importantLinks.php' ?>
    <title>Return Book</title>
</head>
<body>
    <?php 
        include '../extra/conn.php';
        include '../extra/nav.php'; 
        $SQLForStart = "SELECT useridno FROM useridissue;";
        $ResultForStart = mysqli_query($conn,$SQLForStart);
        $ResultForStart2 = mysqli_query($conn,$SQLForStart);
        $RowForStart = mysqli_num_rows($ResultForStart);
        $data = mysqli_fetch_all($ResultForStart);
        
        $arr = array();
        while($dataSecond = mysqli_fetch_assoc($ResultForStart2)){
            array_push($arr,$dataSecond['useridno']);
        }
    ?>
    
    <?php
        if(isset($_POST['search']) || isset($_POST['return'])){
            $issueidvalue = $_POST['issuerID'];
            echo '<section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
            <form method="post">
            <label for="exampleDataList" class="form-label"><strong>Return Book</strong></label>
            <input type="number" name="issuerID" onchange="populate()" id="issuerID" class="form-control" placeholder="Enter the Issuer ID" required value="'.$issueidvalue.'">
            <br>
            <input type="submit" name="search" value="submit" style="background-color: rgb(99 102 241); color: white;" id="submit" class="form-control" />
            </form>
            </div>
        </section>';
            if(isset($_POST['return'])){
                $sno = $_POST['sno'];
                $sqlforreturn = "DELETE FROM `issuebook` WHERE `issuebook`.`sno` = ".$sno.";";
                mysqli_query($conn,$sqlforreturn);
            }
            if(in_array($issueidvalue,$arr)){
                $issuerid = $_POST['issuerID'];
                $sql = "SELECT * FROM issuebook LEFT JOIN bookdetails ON bookdetails.bookno = issuebook.issuebookid WHERE issuebook.issuerid = ".$issuerid."
                UNION
                SELECT * FROM issuebook RIGHT JOIN bookdetails ON bookdetails.bookno = issuebook.issuebookid WHERE issuebook.issuerid = ".$issuerid.";";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_num_rows($result);
                if($row>0){
                    echo '<section class="text-gray-600 body-font">
                    <div class="flex flex-col text-center w-full">
              <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Issue Books</h1>
              </div>
                    
                    <div class="container px-5 py-24 mx-auto">
                      <div class="flex flex-wrap -mx-4 -my-8">';
                    while($data45 = mysqli_fetch_assoc($result)){
                        echo '
                            
                        <div class="border-solid border-1 border-slate-400 py-8 px-4 lg:w-1/4">
                        <div class="h-full flex items-start">
                          <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
                            <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">'.$data45['bookedition'].' Edition</span>
                            <span class="font-medium text-lg text-gray-800 title-font leading-none">'.$data45['bookyear'].'</span>
                          </div>
                          <div class="flex-grow pl-6">
                            <h2 class="tracking-widest text-xs title-font font-medium text-indigo-500 mb-1">'.$data45['bookbranch'].'</h2>
                            <h1 class="title-font text-xl font-medium text-gray-900 mb-3">'.$data45['bookname'].'</h1>
                            <p class="leading-relaxed mb-1">Author :- '.$data45['bookauthor'].'</p>
                            <p class="leading-relaxed mb-1">'.$data45['bookpublisher'].'</p>
                            <p class="leading-relaxed mb-1">₹'.$data45['bookprice'].'/-</p>
                            <p class="leading-relaxed mb-1">Book Id :- '.$data45['bookno'].'</p>
                            <p class="leading-relaxed mb-1">Book Pages :- '.$data45['bookpages'].'</p>
                            <p class="leading-relaxed mb-3">Issue Date :- '.$data45['issuedate'].'</p>';
                            $diff = date_create(date("Y")) ;
                            $useridissueyear =  date_create($data45['issuedate']);
                            $storedatediff =  date_diff($useridissueyear,$diff);
                            $finevalue =  $storedatediff->format("%a");
                            if($finevalue > 15){
                                echo '<p class="leading-relaxed mb-3" style="color:red;"><strong>Fine :- ₹'.($finevalue-15).' /-</strong></p>';
                                }
                            else{
                                echo '<p class="leading-relaxed mb-3" style="color:green;"><strong>Fine :-₹0 /-</strong></p>';
                                }
                        echo'<a class="inline-flex items-center">
                                    <form method="post">
                                    <input type="number" name="issuerID" class="form-control" placeholder="Enter the Issuer ID" required value="'.$issueidvalue.'" style="display:none;">
                                        <input type="number" name="sno" id="" value="'.$data45['sno'].'" class="form-control" style="display:none;">
                                        <input type="submit" name="return" value="Return Book" style="background-color: rgb(99 102 241); color: white;" id="submit" class="form-control" />
                                    </form>
                                  </a>
                                </div>
                              </div>
                            </div>
                          ';
                    }
                    echo '</div>
                    </div>
                  </section>';
                }
                else{
                    echo '<main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
                    <div class="text-center">
                      <p class="text-base font-semibold text-indigo-600"></p>
                      <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">No Book Issue</h1>
                      <p class="mt-6 text-base leading-7 text-gray-600">No Book Is Issued by Them.</p>
                    </div>
                  </main>';
                }
            }
            else{
                echo '<script>
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Invalid Issuer ID ! ",
          showConfirmButton: false,
          timer: 1500
        });
        </script>';
            }
        }
        else
        {
            echo '<section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
            <form method="post">
            <label for="exampleDataList" class="form-label"><strong>Return Book</strong></label>
            <input type="number" name="issuerID" onchange="populate()" id="issuerID" class="form-control" placeholder="Enter the Issuer ID" required>
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
    function populate(){
        let x =document.getElementById('issuerID').value;
        let size = <?php echo $RowForStart; ?>;
        let temp = true;
        let arr = [size][1];
        arr = <?php echo json_encode($data); ?>;
        for(let i =0;i<size;i++){
            if(arr[i][0].includes(x)){
                temp = false;
                document.getElementById('issuerID').style.borderColor = "var(--bs-border-color)";
                break;
            }
        }
        if(temp){
            alert("Invalid Issuer ID");
            document.getElementById('issuerID').style.borderColor = "red";
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