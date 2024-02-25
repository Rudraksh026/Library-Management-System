<?php session_start();
  if(isset($_SESSION["dsfjhsdk"])){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <?php include '../extra/importantLinks.php'; ?>
</head>

<body style="color:white;">
    <?php include '../extra/nav.php';
    include '../extra/conn.php'; ?>

    <form class="px-8 py-10" method="post" enctype="multipart/form-data">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Information Required for Add Book</h2>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-2">
                    <label for="bookname" class="block text-sm font-medium leading-6 text-gray-900">Book Name</label>
                    <div class="mt-2">
                        <input type="text" name="bookname" id="bookname" autocomplete="given-name" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="bookid" class="block text-sm font-medium leading-6 text-gray-900">Book Id</label>
                    <div class="mt-2">
                        <input type="number" name="bookid" onchange="populate()" id="bookid" autocomplete="family-name" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="bookpages" class="block text-sm font-medium leading-6 text-gray-900">Book Pages</label>
                    <div class="mt-2">
                        <input type="number" name="bookpages" id="bookpages" autocomplete="family-name" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>


                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="bookbranch" class="block text-sm font-medium leading-6 text-gray-900">Book Branch</label>
                    <div class="mt-2">
                        <select id="bookbranch" name="bookbranch" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                    <label for="userbranchyear" class="block text-sm font-medium leading-6 text-gray-900">Book
                        Publishing Year</label>
                    <div class="mt-2">
                        <select id="userbranchyear" name="bookyear" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" disabled selected>Select the given option</option>
                            <?php
                            for ($x = date("Y"); $x >= (date("Y") - 40); $x--) {
                                echo '<option value="' . $x . '">' . $x . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="issueyear" class="block text-sm font-medium leading-6 text-gray-900">Book Edition</label>
                    <div class="mt-2">
                        <input type="number" min="1" name="bookedition" id="issueyear" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>


                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Book Author</label>
                    <div class="mt-2">
                        <input type="text" name="bookauthor" id="author" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="publisher" class="block text-sm font-medium leading-6 text-gray-900">Book Publisher</label>
                    <div class="mt-2">
                        <input type="text" name="bookpublisher" id="publisher" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Book Price</label>
                    <div class="mt-2">
                        <input type="number" min="1" name="bookprice" id="price" autocomplete="family-name" required class="form-control ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
            </div>
        </div>


        <div class="mt-6 flex items-center justify-end gap-x-6">
            <input type="reset" value="Cancel" class="text-sm font-semibold leading-6 text-gray-900" />
            <input type="submit" id="submit" name="submit" value="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        </div>
    </form>

    <?php
    $bookid = $_COOKIE['bookid'];
    $sql = 'SELECT bookno FROM `bookdetails` WHERE 1;';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    $bookno = array();
    while ($data = mysqli_fetch_assoc($result)) {
        array_push($bookno, $data['bookno']);
    }
    ?>
    <?php include '../extra/footer.php'; ?>
</body>
<script>
    function populate() {
        let x = document.getElementById("bookid").value;
        document.cookie = "bookid = " + x;
        let size = <?php echo $row; ?>;
        let booknoarray = new Array(size);
        booknoarray = <?php echo json_encode($bookno); ?>;
        console.log(x);
        if (booknoarray.includes(x)) {
            document.getElementById("bookid").style.borderColor = "Red";
            alert("Wrong Id Input! ID was of another book");
        }
        else {
            document.getElementById("bookid").style.borderColor = "var(--bs-border-color)";
        }
    }
</script>

</html>

<?php
if (isset($_POST['submit'])) {
    $bookname = $_POST['bookname'];
    $bookid = $_POST['bookid'];
    $bookbranch = $_POST['bookbranch'];
    $bookyear = $_POST['bookyear'];
    $bookedition = $_POST['bookedition'];
    $bookauthor = $_POST['bookauthor'];
    $bookpublisher = $_POST['bookpublisher'];
    $bookprice = $_POST['bookprice'];
    $bookpages = $_POST['bookpages'];

    $sqlforbookinsert = "INSERT INTO `bookdetails` (`bookedition`, `bookyear`, `bookbranch`, `bookname`, `bookauthor`, `bookpublisher`, `bookprice`, `bookno`, `bookpages`) VALUES ('" . $bookedition . "','" . $bookyear . "','" . $bookbranch . "','" . $bookname . "','" . $bookauthor . "', '" . $bookpublisher . "', '" . $bookprice . "', '" . $bookid . "', '" . $bookpages . "');";
    $resultcheckforinsert = mysqli_query($conn,$sqlforbookinsert);
    if ($resultcheckforinsert) {
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

    } else {
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
?>
<?php } 
else{
  echo '<script>
    window.location.href =
        "../login.php";

</script>';
}
?>