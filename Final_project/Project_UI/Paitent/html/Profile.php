<?php
session_start();
// ini_set("display_errors", 0);
if (strlen($_SESSION['login']) !== 0) {
  $connect = new mysqli("localhost", "root", "", "hms");
  if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../photo/echol.png">
  </head>

  <body>
    <div class="min-h-full">
      <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <a href="./Dashboard.php"><img class="h-16 w-16" src="../photo/l-gh.png"></a>
              </div>
              <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                  <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                  <a href="./Dashboard.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                  <a href="./New-reservation.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">New Reservation</a>
                  <a href="./calender.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Calendar</a>
                  <a href="./Medical-Record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Medical-Record</a>
                  <a href="./doc.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Doctors Time Table</a>
                </div>
              </div>
            </div>
            <div class="hidden md:block">
              <div class="ml-4 flex items-center md:ml-6">
                <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                  <span class="absolute -inset-1.5"></span>
                  <span class="sr-only">View notifications</span>
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                  </svg>
                </button>

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                  <div>
                    <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                      <span class="absolute -inset-1.5"></span>
                      <span class="sr-only">Open user menu</span>
                      <img class="h-8 w-8 rounded-full" src="../photo/profile.png" alt="">
                    </button>
                  </div>
                  <div id="user-menu" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden transition opacity duration-300 ease-in-out" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <a href="./Profile.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                    <a href="./logout.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                  </div>
                  <script>
                    // const button = document.getElementById('user-menu-button');
                    // const menu = document.getElementById('user-menu');
                    // button.addEventListener('click', () => {
                    //   menu.classList.toggle('hidden');
                    // });
                    const button = document.getElementById('user-menu-button');
                    const menu = document.getElementById('user-menu');

                    button.addEventListener('click', () => {
                      if (menu.classList.contains('hidden')) {
                        menu.classList.remove('hidden');
                        setTimeout(() => {
                          menu.classList.add('opacity-100');
                          menu.classList.remove('opacity-0');
                        }, 10); // Slight delay to allow the hidden class to be removed
                      } else {
                        menu.classList.add('opacity-0');
                        menu.classList.remove('opacity-100');
                        menu.addEventListener('transitionend', () => {
                          menu.classList.add('hidden');
                        }, {
                          once: true
                        });
                      }
                    });
                  </script>
                </div>
              </div>
            </div>
            <div class="-mr-2 flex md:hidden">
              <!-- Mobile menu button -->
              <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-btn" aria-controls="mobile-menu" aria-expanded="false">
                <span class="absolute -inset-0.5"></span>
                <span class="sr-only">Open main menu</span>
                <!-- Menu open: "hidden", Menu closed: "block" -->
                <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <!-- Menu open: "block", Menu closed: "hidden" -->
                <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden hidden" id="mobile-menu">
          <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="./Dashboard.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
            <a href="./New-reservation.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">New Reservation</a>
            <a href="./calender.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Calendar</a>
            <a href="./Medical-Record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Medical-Record</a>
            <a href="./doc.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Doctors Time Table</a>
          </div>
          <?php
          $sql0 = mysqli_query($connect, "SELECT * from `users` where `uid` =" . $_SESSION['uid'] . " ");
          while ($data = mysqli_fetch_array($sql0)) {
          ?>
            <div class="border-t border-gray-700 pb-3 pt-4">
              <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                  <img class="h-10 w-10 rounded-full" src="../photo/profile.png" alt="">
                </div>
                <div class="ml-3">
                  <div class="text-base font-medium leading-none text-white"><?php echo htmlentities($data['fullName']); ?></div>
                  <div class="text-sm font-medium leading-none text-gray-400"><?php echo htmlentities($data['email']); ?></div>
                </div>
                <button type="button" class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                  <span class="absolute -inset-1.5"></span>
                  <span class="sr-only">View notifications</span>
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                  </svg>
                </button>
              </div>
              <div class="mt-3 space-y-1 px-2">
                <a href="./Profile.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                <a href="./logout.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
              </div>
            </div>
        </div>
        <script>
          // const button = document.getElementById('user-menu-button');
          // const menu = document.getElementById('user-menu');
          // button.addEventListener('click', () => {
          //   menu.classList.toggle('hidden');
          // });
          const btn = document.getElementById('user-menu-btn');
          const men = document.getElementById('mobile-menu');

          btn.addEventListener('click', () => {
            if (men.classList.contains('hidden')) {
              men.classList.remove('hidden');
              setTimeout(() => {
                men.classList.add('opacity-100');
                men.classList.remove('opacity-0');
              }, 10); // Slight delay to allow the hidden class to be removed
            } else {
              men.classList.add('hidden');
              men.classList.remove('opacity-100');
              men.addEventListener('transitionend', () => {
                men.classList.add('hidden');
              }, {
                once: true
              });
            }
          });
        </script>
      </nav>
      <!-- <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
        </div>
      </div> -->
      <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">Profile</h1>
        </div>
      </header>
      <main class="">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

          <?php
            if (isset($_POST['Save'])) {
              $username = $_POST['User-name'];
              $Phone = $_POST['Phone'];
              $email = $_POST['email'];
              $Gender = $_POST['Gender'];
              $age = $_POST['age'];

              $sql = ("Update users set fullName='$username',	PatientContno='$Phone', p_age='$age',	email ='$email',gender='$Gender' where uid='" . $_SESSION['uid'] . "'");

              if ($connect->query($sql) === TRUE) {
                echo "<script>alert('Saved Successful');</script>";
              } else {
                echo "<script>alert('Something Wrong ');</script>";
              }
            }
          ?>

          <h1 class="m-7 text-3xl font-bold tracking-tight text-gray-900 translate-y-0 translate-x-0 "> Welcome <?php echo htmlentities($data['fullName']); ?></h1>

          <!-- <img class=" -translate-y-16 inline-block h-20 w-20 rounded-full ring-2 ring-white" src="../photo/profile.png" alt="">  -->

          <!-- ################################################################### -->
          <div class="flex flex-nowrap">
            <form method="post" class="w-3/6 border-r-4 border-b-4 p-8">
              <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                  <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                  <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you
                    share.</p>

                  <!-- <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                  <div class="col-span-full">
                    <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                    <div class="mt-2 flex items-center gap-x-3">
                      <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                      </svg>
                      <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
                    </div>
                  </div>
                </div> -->
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                  <!-- <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p> -->

                  <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <label for="User-name" class="block text-sm font-medium leading-6 text-gray-900">User name</label>
                      <div class="mt-2">
                        <input type="text" name="User-name" id="User-name" value="<?php echo htmlentities($data['fullName']); ?>" class="block w-full rounded-md border-2 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="Phone" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                      <div class="mt-2">
                        <input type="Tel" name="Phone" id="Phone" value="<?php echo htmlentities($data['PatientContno']); ?>" class="block w-full rounded-md border-2 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                      </div>
                    </div>

                    <div class="sm:col-span-6 sm:col-start-1">
                      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">email</label>
                      <div class="mt-2">
                        <input type="email" name="email" id="email" value="<?php echo htmlentities($data['email']); ?>" class="block w-full rounded-md border-2 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                      </div>
                    </div>
                    <div class="sm:col-span-3 sm:col-start-1">
                      <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Age</label>
                      <div class="mt-2">
                        <input type="text" name="age" id="age" value="<?php echo htmlentities($data['p_age']); ?>" class="block w-full rounded-md border-2 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                      </div>
                    </div>
                    <div class="sm:col-span-3 sm:col-start-4">
                      <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
                      <div class="mt-2">
                        <select id="country" name="Gender" class="block w-full rounded-md border-2 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                          <option><?php echo htmlentities($data['gender']); ?></option>
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                  <button type="submit" name="Save" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
              </div>
            </form>

            <div class="w-3/6 border-b-4 p-8 ">
              <div class="px-4 sm:px-0">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Medical Information</h3>
              </div>
              <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                  <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Patient ID</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $_SESSION['uid']; ?></dd>
                  </div>
                  <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Blood Pressure</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> 00 </dd>
                    <dt class="text-sm font-medium leading-6 text-gray-900">Normal </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> 00 </dd>
                  </div>
                  <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Blood Sugar</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">00</dd>
                    <dt class="text-sm font-medium leading-6 text-gray-900">Normal</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">00</dd>
                  </div>

                  <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
                    <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                      <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                          <div class="flex w-0 flex-1 items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-4 flex min-w-0 flex-1 gap-2">
                              <span class="truncate font-medium">report 1.pdf</span>
                              <span class="flex-shrink-0 text-gray-400">2.4mb</span>
                            </div>
                          </div>
                          <div class="ml-4 flex-shrink-0">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                          </div>
                        </li>
                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                          <div class="flex w-0 flex-1 items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-4 flex min-w-0 flex-1 gap-2">
                              <span class="truncate font-medium">report 2.pdf</span>
                              <span class="flex-shrink-0 text-gray-400">4.5mb</span>
                            </div>
                          </div>
                          <div class="ml-4 flex-shrink-0">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                          </div>
                        </li>
                      </ul>
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>
      <?php
          }
        } else if (strlen($_SESSION['login']) == 0) {
          echo "<script>alert('You Are Not Login');
              window.location.href = '../done-patint/index.php';</script>";
        }
      ?>
        </div>
      </main>
  </body>

  </html>