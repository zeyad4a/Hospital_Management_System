<?php
session_start();
ini_set("display_errors", 1);
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
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="./photo/echol.png">
    </head>

    <body>
        <div class="min-h-full">
            <nav class="bg-gray-800">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <a href="./admin-Dashboard.php"><img class="h-16 w-16" src="./photo/l-gh.png"></a>
                            </div>
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                                    <a href="./admin-Dashboard.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Dashboard</a>
                                    <a href="./admin-Reservations.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Reservations</a>
                                    <a href="./admin-Payments.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Payments</a>
                                    <a href="./admin-user-log.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Users</a>
                                    <a href="./admin-med record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Medical Record</a>
                                    <a href="./doc.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Doctors Time Table</a>
                                </div>
                            </div>
                        </div>
                        <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Log Out</a>
            </nav>


            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1>
                </div>
            </header>
            <main class="">
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <div class="bg-white">
                        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

                                <!-- total reservation today -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM appointment where appointmentDate = CURRENT_DATE()");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none hover:bg-sky-600 lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/calendar_271180.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Today Reservations</p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>

                                <!-- total active reservation today -->

                                <?php
                                $result2 = $connect->query("SELECT COUNT(*) FROM appointment where userStatus = 1 AND appointmentDate = CURRENT_DATE() "); ?>
                                <div class="group relative grid content-end">
                                    <div class="  aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none hover:bg-sky-600 lg:h-48">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/man_12382488.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Active Reservations</p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count2 = $result2->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>

                                <!-- total Active Doctors today -->

                                <?php
                                $result8 = $connect->query("SELECT COUNT(*) FROM doctors where statue = 1 "); ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none hover:bg-sky-600 lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/doctor_3467772.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Active Doctors</p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count8 = $result8->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                                <!-- total Done Reservations today -->

                                <?php
                                $result5 = $connect->query("SELECT COUNT(*) FROM appointment where doctorStatus = 2 AND userStatus =2 AND appointmentDate = CURRENT_DATE() "); ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none hover:bg-green-400 lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/page_5857222.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Done Reservations</p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count5 = $result5->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>

                                <!-- total Active Employ today -->

                                <?php
                                $result6 = $connect->query("SELECT COUNT(*) FROM employ where employ_statue = 1  "); ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none hover:bg-sky-600 lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/identity_6450683.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Active Employ</p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count6 = $result6->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>

                                <!-- Total Payments -->

                                <?php
                                $sqlp = "SELECT SUM(consultancyFees) AS total FROM appointment WHERE appointmentDate = CURRENT_DATE()";
                                $rxxx = mysqli_query($connect, $sqlp);
                                if (mysqli_num_rows($rxxx) > 0) {
                                    while ($zxc = mysqli_fetch_assoc($rxxx)) {
                                        $total = $zxc["total"]; ?>
                                        <div class="group relative">
                                            <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-90  lg:h-48 ">
                                                <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/profit_10744304.png" width="100"></p>
                                                <p class=" text-lg leading- font-bold text-center text-black p-1">Total Payments</p>
                                                <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $total; ?> ]</p>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <?php
    } else if (strlen($_SESSION['login']) == 0) {
        echo "<script>alert('You Are Not Login');
              window.location.href = '/zxc/Final_Project/admin-log/index.php';</script>";
    }
        ?>
    </body>

    </html>