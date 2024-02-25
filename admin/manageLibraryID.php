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
    ?>

<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-wrap">
    <div class="flex flex-wrap -m-4">
      <div class="p-4 lg:w-1/1 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
            
            <i class="fa fa-user fa-3x" aria-hidden="true"></i>
          </div>
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">New ID Issue</h2>
            <a href="issueID.php" class="mt-3 text-indigo-500 inline-flex items-center">Issue New Library ID</a>
          </div>
        </div>
      </div>
      <div class="p-4 lg:w-1/1 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
            <i class="fa fa-users fa-3x" aria-hidden="true"></i>
          </div>
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Search Existing ID</h2>
            <a href="manageExistingID.php" class="mt-3 text-indigo-500 inline-flex items-center">Search Existing Library ID</a>
          </div>
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