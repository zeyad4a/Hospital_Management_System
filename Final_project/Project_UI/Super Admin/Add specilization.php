<?php
session_start();
ini_set("display_errors", 0);
if (isset($_POST['Add'])) {
    $name = $_POST['name'];

    $connect = new mysqli("localhost", "root", "", "hms");
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    $sql_r = "insert into doctorspecilization  
      (`specilization`) value ('$name' )";

    if ($connect->query($sql_r) === TRUE) {
        echo "<script>alert('Specialization Added Successfully');</script>";
    } else {
        echo "<script>alert('Something Wrong ');</script>";
    }
    $connect->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Specialization</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./photo/echol.png">
</head>

<body>
    <div class="min-h-full">
        <nav class="bg-gray-800 ">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="./super-Dashboard.php"><img class="h-16 w-16" src="./photo/l-gh.png"></a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                                <a href="./super-Dashboard.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Dashboard</a>
                                <a href="./super-Reservations.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Reservations</a>
                                <a href="./super-Payments.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Payments</a>
                                <a href="./super-user-log.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Users</a>
                                <a href="./super-med record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Medical
                                    Record</a>
                                <a href="./Add user.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Add New User</a>
                                <a href="./Add Doctor.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Add New Doctor</a>
                                <a href="./Add specilization.php" class="bg-gray-900 text-white rounded-md px-1 py-2 text-sm font-medium" aria-current="page">Add Specialization</a>
                                <a href="./doc.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Doctors Time Table</a>
                            </div>
                        </div>
                    </div>
                    <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Log Out</a>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Add New Specialization</h1>
            </div>
        </header>
        <main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

                <form action="#" method="POST" class="mx-auto max-w-xl sm:mt-20">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Specialization name</label>
                            <div class="mt-2.5">
                                <input type="text" name="name" id="name" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button type="submit" name="Add" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Specialization</button>
                    </div>
                </form>

            </div>
        </main>
</body>

</html>