<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Library Management System</title>
    <?php include 'extra/importantLinks.php'; ?>
</head>
<body>
<header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                    viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">Library Management System</span>
            </a>

        </div>
    </header>
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
          <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Government Polytechnic Narendra Nagar
              <br class="hidden lg:inline-block">Library Management System
            </h1>
            <p class="mb-8 leading-relaxed">The traditional methods of managing libraries often involve manual processes, which are time-consuming, error-prone, and inefficient.By Seeing this we make a Library Management System For Government Polytechnic Narendra Nagar. Librarians and staff spend significant amounts of time on tasks such as cataloging books, managing borrower information, tracking inventory, and handling circulation transactions. These manual processes not only consume resources but also limit the ability of libraries to provide efficient and user-friendly services to their patrons.</p>
            <div style="width: 100% !important;" class="flex justify-center">
              <button onclick="sjkdfhjsa()" style="width: 100%;" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Let's Get Started</button>
            </div>
          </div>
          <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
          <video class="object-cover object-center rounded" alt="hero" autoplay muted loop style=" width: 720px !important; height: 600px !important;">
                <source src="videos/IMG_7812.MP4" type="video/MP4">
          </video>
          </div>
        </div>
      </section>
      <script>
        function sjkdfhjsa(){
          window.location.href = "login.php";
        }
    </script>
</body>
</html>