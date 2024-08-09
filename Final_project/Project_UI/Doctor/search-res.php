<?php
session_start();
ini_set("display_errors", 0);
// if (strlen($_SESSION['login']) !== 0) {
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
    <title>Search Reservations</title>
    <link rel="stylesheet" href="../css/med record.css">
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
                            <a href="./doc-Dashboard.php"><img class="h-16 w-16" src="./photo/l-gh.png"></a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="./doc-Dashboard.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                                <a href="./doc-Reservations.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Reservations</a>
                                <a href="./doc-med record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Medical
                                    Record</a>
                                <a href="./doc-write.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Write Report</a>
                            </div>
                        </div>
                    </div>
                    <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Log Out</a>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Search Reservations</h1>
            </div>
        </header>
        <main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

                <div class="flex flex-wrap w-full">
                    <form class="space-y-6 flex flex-wrap p-3" action="./search-res.php" method="POST">
                        <div class="px-3 py-1.5">
                            <label for="Search" class="flex text-sm font-medium text-gray-900">Search</label>
                            <div class="mt-2">
                                <input id="Search" name="input" type="Search" required class=" font-bold block w-26 rounded-md border-2 px-4 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="px-3 py-1.5">
                            <button name="search" type="submit" class="flex w-20 justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search</button>
                        </div>
                    </form>
                    <table class=" table table-striped table-hover table-bordered border-gray-400">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">Patient ID</p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">Patient Name</p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">Reservation</p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">Phone Number</p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">Gender</p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">signDate</p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">Statues</p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">Report</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            <?php
                            $docid = $_SESSION['id'];
                            $search = $_POST['input'];
                            $ret = mysqli_query($connect, "SELECT * from appointment join users on users.id=appointment.userId  join doctors on doctors.id=appointment. doctorId WHERE doctorId='$docid' AND appointmentDate = CURRENT_DATE() AND userStatus in ( 1 , 2 ) AND `patient_Name` LIKE '%$search%' OR `patient_Num` LIKE '%$search%' OR `userId` LIKE '%$search%' ORDER BY postingDate DESC");
                            if ($ret->num_rows > 0) {
                                while ($row = $ret->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['userId']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['patient_Name']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['doctorSpecialization']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['PatientContno']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['gender']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['appointmentDate']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><button class=" text-lg inline-flex items-center rounded-md bg-green-50 px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-600">
                                                    <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                                                        echo "Active";
                                                    }
                                                    if (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {

                                                        echo "Canceled By Patient";
                                                    }
                                                    if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                                                        echo "Canceled By Doctor";
                                                    }
                                                    if (($row['userStatus'] == 2) && ($row['doctorStatus'] == 2)) {
                                                        echo "Done";
                                                    }
                                                    ?></button></p>
                                            </p>
                                        </th>
                                        <th scope="col">
                                            <form method="get">
                                                <?php
                                                if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 2)) { ?>
                                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><button class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-blue-700 ring-1 ring-inset ring-green-600/20">Done</button></p>
                                                <?php
                                                } else { ?>
                                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><a href="./doc-write.php?id=<?php echo $row['userId']; ?>" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-green-700 ring-1 ring-inset ring-green-600/20">View</a></p>

                                                <?php } ?>
                                            </form>
                                        </th>
                                    </tr>
                        </tbody>
                <?php }
                            } ?>
                    </table>
                </div>
        </main>
</body>

</html>