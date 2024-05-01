<?php session_start();
  if(isset($_SESSION["dsfjhsdk"])){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <?php include '../extra/importantLinks.php'; ?>
</head>
<body>
    <?php
        include '../extra/nav.php';
        include '../extra/conn.php';
    ?>
    <?php
        $resultforbooksize = mysqli_query($conn,"SELECT * FROM `bookdetails`;"); 
        $resultforissuebooksize = mysqli_query($conn,"SELECT * FROM `issuebook`;"); 
        $resultforuseridsize = mysqli_query($conn,"SELECT * FROM `useridissue`;"); 
        $rowforbooksize = mysqli_num_rows($resultforbooksize);
        $rowforissuebooksize = mysqli_num_rows($resultforissuebooksize);
        $rowforuseridsize = mysqli_num_rows($resultforuseridsize);
    ?>
<section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
          <div class="flex flex-wrap -m-4 text-center">
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
              <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                  <path d="M8 17l4 4 4-4m-4-5v9"></path>
                  <path d="M20.88 18.09A5 5 0 0018 9h-1.26A8 8 0 103 16.29"></path>
                </svg>
                <h2 class="title-font font-medium text-3xl text-gray-900">
                    <?php
                        if($rowforissuebooksize < 999){echo $rowforissuebooksize;}
                        else{ echo ($rowforissuebooksize/1000)."K";}
                    ?>
                </h2>
                <p class="leading-relaxed">Books Issues</p>
              </div>
            </div>
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
              <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                  <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                  <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
                </svg>
                <h2 class="title-font font-medium text-3xl text-gray-900">
                    <?php
                        if($rowforuseridsize < 999){echo $rowforuseridsize;}
                        else{ echo ($rowforuseridsize/1000)."K";}
                    ?>
                </h2>
                <p class="leading-relaxed">ID Issue</p>
              </div>
            </div>
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full">
              <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                  <path d="M3 18v-6a9 9 0 0118 0v6"></path>
                  <path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"></path>
                </svg>
                <h2 class="title-font font-medium text-3xl text-gray-900">
                    <?php
                        if($rowforbooksize < 999){echo $rowforbooksize;}
                        else{ echo ($rowforbooksize/1000)."K";}
                    ?>
                </h2>
                <p class="leading-relaxed">Total Books</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="text-gray-600 body-font">
        <div class="container px-5 py-2 mx-auto">
            <div class="text-center mb-20">
                <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">Quicks Links</h1>
            </div>
          <div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
            <div class="p-2 sm:w-1/2 w-full">
              <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                  <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                  <path d="M22 4L12 14.01l-3-3"></path>
                </svg>
                <a href="search.php" class="mr-5 hover:text-gray-900 title-font font-medium">Search Book</a>
              </div>
            </div>
            <div class="p-2 sm:w-1/2 w-full">
              <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                  <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                  <path d="M22 4L12 14.01l-3-3"></path>
                </svg>
                <a href="issuebook.php" class="mr-5 hover:text-gray-900 title-font font-medium">Issue Book</a>
              </div>
            </div>
            <div class="p-2 sm:w-1/2 w-full">
              <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                  <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                  <path d="M22 4L12 14.01l-3-3"></path>
                </svg>
                <a href="returnbook.php" class="mr-5 hover:text-gray-900 title-font font-medium">Return Book</a>
              </div>
            </div>
            <div class="p-2 sm:w-1/2 w-full">
              <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                  <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                  <path d="M22 4L12 14.01l-3-3"></path>
                </svg>
                <a href="addbook.php" class="mr-5 hover:text-gray-900 title-font font-medium">Add Book</a>
              </div>
            </div>
            <div class="p-2 sm:w-1/2 w-full">
              <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                  <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                  <path d="M22 4L12 14.01l-3-3"></path>
                </svg>
                <a href="issueID.php" class="mr-5 hover:text-gray-900 title-font font-medium">ID Issue</a>
              </div>
            </div>
            <div class="p-2 sm:w-1/2 w-full">
              <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                  <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                  <path d="M22 4L12 14.01l-3-3"></path>
                </svg>
                <a href="manageExistingID.php" class="mr-5 hover:text-gray-900 title-font font-medium">Search Existing ID</a>
              </div>
            </div>
          </div>
        </div>
      </section>
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