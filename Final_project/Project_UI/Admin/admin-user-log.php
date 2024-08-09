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
    <title>User Log Time</title>
    <link rel="stylesheet" href="../css/user-log.css">
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
                                <a href="./admin-Dashboard.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                                <a href="./admin-Reservations.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Reservations</a>
                                <a href="./admin-Payments.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Payments</a>
                                <a href="./admin-user-log.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Users</a>
                                <a href="./admin-med record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Medical Record</a>
                                <a href="./doc.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Doctors Time Table</a>
                            </div>
                        </div>
                    </div>
                    <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Log Out</a>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">User Log</h1>
            </div>
        </header>
        <main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

                <form class="space-y-6 flex flex-wrap p-3" action="./search-users.php" method="POST">
                    <div class="px-3 py-1.5">
                        <label for="Search" class="flex text-sm font-medium text-gray-900">Search</label>
                        <div class="mt-2">
                            <input id="Search" name="input" type="Search" required class="font-bold block w-26 rounded-md border-2 px-4 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                                <p class="text-lg leading- font-bold text-gray-900 text-center">User ID</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">User Name</p>
                            </th>
                            <!-- <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Log In Date</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Log In Time</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Log Out Time</p>
                            </th> -->
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Log Statue</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Payments</p>
                            </th>
                            <!-- <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Total Payment</p>
                            </th> -->
                            <!-- <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Reset</p>
                            </th> -->
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $sql = mysqli_query($connect, "SELECT * FROM employ GROUP BY id");
                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['id']; ?></p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['username']; ?></p>
                                </th>
                                <!-- <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Log In Date</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Log In Time</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">Log Out Time</p>
                            </th> -->
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">
                                        <?php
                                        if (($row['employ_statue'] == 1)) {
                                        ?>
                                            <button class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-blue-700 ring-1 ring-inset ring-red-600/20">`ON`</button>
                                        <?php }
                                        // if(($row['employ_statue'] == 0))
                                        else {
                                        ?>
                                            <button class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-red-700 ring-1 ring-inset ring-red-600/20">`OFF`</button>
                                        <?php } ?>
                                    </p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><a href="./admin-Payments.php?employId=<?php echo $row['id']; ?>" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-green-700 ring-1 ring-inset ring-green-600/20">View</a></p>
                                </th>

                            </tr>
                    </tbody>
                <?php } ?>
                </table>
            </div>
        </main>
</body>

</html>