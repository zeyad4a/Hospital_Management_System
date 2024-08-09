<?php
session_start();
// ini_set("display_errors", 0);
// if (strlen($_SESSION['login']) !== 0) {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}


if (isset($_POST['Save'])) {
    $specilization = $_POST['specialization'];
    $doctorid = $_POST['Doctor'];
    $userid = $_SESSION['uid'];
    $username = $_SESSION['fullName'];
    $fees = $_POST['price'];
    $appdate = $_POST['Date'];
    $time = $_POST['Time'];
    $userstatus = 1;
    $docstatus = 1;
    $query = mysqli_query(
        $conn,
        "insert into appointment(doctorSpecialization,doctorId,userId,patient_Name,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus)
                      values('$specilization','$doctorid','$userid','$username','$fees','$appdate','$time','$userstatus','$docstatus')"
    );
    if ($query) {
        echo "<script>alert('Appointment done successfully');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../photo/echol.png">
    <script>
        function getdoctor(val) {
            $.ajax({
                type: "POST",
                url: "get_doctor.php",
                data: 'specilizationid=' + val,
                success: function(data) {
                    $("#doctor").html(data);
                }
            });
        }
    </script>


    <script>
        function getfee(val) {
            $.ajax({
                type: "POST",
                url: "get_doctor.php",
                data: 'doctor=' + val,
                success: function(data) {
                    $("#price").html(data);
                }
            });
        }
    </script>
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
                                <a href="./New-reservation.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">New Reservation</a>
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
                    <a href="./New-reservation.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">New Reservation</a>
                    <a href="./calender.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Calendar</a>
                    <a href="./Medical-Record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Medical-Record</a>
                    <a href="./doc.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Doctors Time Table</a>
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
        <!-- <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div> -->
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">New Reservation</h1>
            </div>
        </header>

        <main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

                <form action="#" method="POST" class="mx-auto max-w-xl sm:mt-20">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">



                        <div class="sm:col-span-2">
                            <div class="mt-2.5">
                                <label for="specialization" class="block text-sm font-semibold leading-6 text-gray-900">specialization</label>
                                <div class="mt-2">
                                    <select id="specialization" name="specialization" onChange="getdoctor(this.value);" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option>Select specialization</option>
                                        <?php $ret = mysqli_query($conn, "select * from doctorspecilization");
                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                            <option value="<?php echo htmlentities($row['specilization']); ?>">
                                                <?php echo htmlentities($row['specilization']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="mt-2.5">
                                <label for="specialization" class="block text-sm font-semibold leading-6 text-gray-900">Doctor</label>
                                <div class="mt-2">
                                    <select id="doctor" name="Doctor" onChange="getfee(this.value);" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option>Select Doctor</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="price" class="block text-sm font-semibold leading-6 text-gray-900">price</label>
                            <div class="mt-2.5">
                                <select readonly name="price" id="price" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="Date" class="block text-sm font-semibold leading-6 text-gray-900">Date</label>
                            <div class="mt-2.5">
                                <input type="Date" name="Date" id="Date" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="Time" class="block text-sm font-semibold leading-6 text-gray-900">Time</label>
                            <div class="mt-2.5">
                                <input readonly value="<?php echo date("H:m:i"); ?>" type="Time" name="Time" id="Time" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button type="submit" name="Save" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save </button>
                    </div>
                </form>
            </div>
            <?php
            // } else if (strlen($_SESSION['login']) == 0) {
            //   echo "<script>alert('You Are Not Login');
            //   window.location.href = '/zeyad/Final_Project/done-patint/index.php';</script>";
            // }
            ?>
        </main>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</body>

</html>