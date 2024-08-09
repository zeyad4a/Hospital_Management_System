<?php
session_start();
ini_set("display_errors", 0);
  $connect = new mysqli("localhost", "root", "", "hms");
  if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }
  $uid = $_SESSION['uid'];
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./about.css">
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
                  <a href="./doc.php" class="bg-gray-900 text-white rounded-md px-1 py-2 text-sm font-medium" aria-current="page">Doctors Time Table</a>
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
                  <a href="./doc.php" class="bg-gray-900 text-white rounded-md px-1 py-2 text-sm font-medium" aria-current="page">Doctors Time Table</a>
          </div>
          <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">
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

      <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold tracking-tight text-gray-900">Doctors</h1>
        </div>
      </header>
<main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <table class=" table table-striped table-hover table-bordered border-gray-400 w-full">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Doctor ID</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Doctor Name</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Doctor statue</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $sql = mysqli_query($connect, "SELECT DISTINCT  * FROM doctors WHERE statue = 1 ORDER BY statue desc ");
                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['id']; ?></p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['doctorName']; ?></p>
                                </th>

                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">
                                        <?php
                                        if (($row['statue'] == 1)) {
                                        ?>
                                            <button class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-blue-700 ring-1 ring-inset ring-red-600/20">`ON`</button>
                                        <?php } else {
                                        ?>
                                            <button class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-red-700 ring-1 ring-inset ring-red-600/20">`OFF`</button>
                                        <?php } ?>
                                    </p>
                                </th>
                            </tr>
                    </tbody>
                <?php } ?>
                </table>

            </div>
        </main>
        <?php
    ?>

  </body>

  </html>