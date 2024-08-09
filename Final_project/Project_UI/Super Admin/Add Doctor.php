<?php
session_start();
ini_set("display_errors", 0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $Role = $_POST['Role'];
    $specialization = $_POST['specialization'];
    $price = $_POST['price'];
    $email = $_POST['email'];
    $Password = $_POST['Password'];
    // $Number = $_POST['Number'];
    $check_email = mysqli_query($connect, "SELECT docEmail FROM doctors WHERE docEmail = '$email_r'");
    if (mysqli_num_rows($check_email) > 0) {
        echo "<script>alert('Email already exists!');</script>";
        exit();
    }
    $sql_r = "insert into doctors  
      (`doctorName` , `specilization` ,   `docFees`        , `docEmail` , `password` , `role`)
value ('$name',       '$specialization'  ,'$price',         '$email' ,   '$Password' , '$Role')";

    if ($conn->query($sql_r) === TRUE) {
        echo "<script>alert('Doctor Added Successfully');
              window.location.href = './Add Doctor.php';</script>";
    } else {
        echo "<script>alert('Something Wrong ');</script>";
    }
    $conn->close();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
    </script>
    <link rel="icon" href="./photo/echol.png">
</head>

<body>
    <div class="min-h-full">
        <nav class="bg-gray-800">
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
                                <a href="./Add Doctor.php" class="bg-gray-900 text-white rounded-md px-1 py-2 text-sm font-medium" aria-current="page">Add
                                    New Doctor</a>
                                <a href="./Add specilization.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Add Specialization</a>
                                <a href="./doc.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Doctors Time Table</a>
                            </div>
                        </div>
                    </div>
                    <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Log Out</a>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Add New Doctor</h1>
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
                            <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Doctor name</label>
                            <div class="mt-2.5">
                                <input type="text" name="name" id="name" value = "DR / " class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div hidden class="sm:col-span-2">
                            <div class="mt-2.5">
                                <label for="Role" class="block text-sm font-semibold leading-6 text-gray-900">Role</label>
                                <div class="mt-2">
                                    <select id="Role" name="Role" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option>System Admin</option>
                                        <option>Admin</option>
                                        <option selected>Doctor</option>
                                        <option>User</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="price" class="block text-sm font-semibold leading-6 text-gray-900">Appointment price</label>
                            <div class="mt-2.5">
                                <input type="text" name="price" id="price" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                            <div class="mt-2.5">
                                <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="Password" class="block text-sm font-semibold leading-6 text-gray-900">Password</label>
                            <div class="mt-2.5">
                                <input type="text" name="Password" id="Password" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                    </div>
                    <div class="mt-10">
                        <button type="submit" name="add" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                            Doctor</button>
                    </div>
                </form>

            </div>
        </main>
</body>

</html>