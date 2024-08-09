<?php
session_start();
ini_set("display_errors", 0);
// if (strlen($_SESSION['login']) !== 0) {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(" connection failed " . $conn->connect_error);
}

if (isset($_POST['Save'])) {
    $userid = $_POST['ID'];
    $name = $_POST['name'];
    $phnumber = $_POST['phnumber'];
    $specialization = $_POST['specialization'];
    $DoctorID = $_POST['Doctor'];
    $price = $_POST['price'];
    $Payed = $_POST['Payed'];
    $method = $_POST['method'];
    $Date = $_POST['Date'];
    $Time = $_POST['Time'];
    $about = $_POST['about'];
    $docstatus = 1;
    $employid = $_SESSION['id'];
    $employname = $_SESSION['username'];
    $userstatus = 1;
    $employstat = 1;
    $query = mysqli_query(
        $conn,
        "insert into appointment(userId,patient_Name,patient_Num,doctorSpecialization,doctorId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus,employStatues,employId , employname , paid , method,commnet) 
                        values('$userid','$name','$phnumber','$specialization','$DoctorID','$price','$Date','$Time','$userstatus','$docstatus','$employstat','$employid','$employname' ,'$Payed' ,'$method' , '$about')"
    );
    if ($query) {
        echo "<script>alert('Appoientment Done');</script>";
    }
    // #####################################################################################################################################################

    $sql = "SELECT patient_Name , patient_Num FROM appointment where patient_Num = '$phnumber' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customerName = $row["patient_Name"];
            $customerNum = $row["patient_Num"];
            $sqlInsert = "INSERT INTO users (fullName,PatientContno) VALUES ('$customerName','$customerNum')";
            $conn->query($sqlInsert);
        }
        $sqlselsect = "SELECT * FROM users where fullName = '$customerName'";
        $sel = $conn->query($sqlselsect);
        $wqw = $sel->fetch_assoc();
        $uid = $wqw['uid'];
        $sqlup = "UPDATE appointment SET userId = $uid where patient_Name = '$customerName'";
        $conn->query($sqlup);
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./photo/l-gh.png">
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
                            <a href="./Reservations.php.php"><img class="h-16 w-16" src="./photo/l-gh.png"></a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="./Reservations.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Reservations</a>
                                <a href="./med record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Medical Record</a>
                                <a href="./new_appoint.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">New Appointment</a>
                                <a href="./doc.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Doctors Time Table</a>
                            </div>
                        </div>
                    </div>
                    <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Log Out</a>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">New Appointment</h1>
            </div>
        </header>
        <main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <form method="post">
                    <div class="space-y-12">

                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div hidden class="sm:col-span-3">
                                    <label for="ID" class="block text-sm font-medium leading-6 text-gray-900">Paitent ID</label>
                                    <div class="mt-2">
                                        <input value="<?php echo $wqw['uid']; ?>" type="text" name="ID" id="ID" class=" font-bold p-7 block w-full rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset border-2 ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Paitent name</label>
                                    <div class="mt-2">
                                        <input type="text" name="name" id="first-name" autocomplete="given-name" class=" font-bold p-7 block w-full rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset border-2 ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="phnumber" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                                    <div class="mt-2">
                                        <input id="phnumber" name="phnumber" type="text" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
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

                                <div class="sm:col-span-3">
                                    <div class="mt-2.5">
                                        <label for="specialization" class="block text-sm font-semibold leading-6 text-gray-900">Doctor</label>
                                        <div class="mt-2">
                                            <select id="doctor" name="Doctor" onChange="getfee(this.value);" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option>Select Doctor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">price</label>
                                    <div class="mt-2.5">
                                        <select readonly name="price" id="price" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </select>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="Payed" class="block text-sm font-medium leading-6 text-gray-900">Payed</label>
                                    <div class="mt-2">
                                        <input type="text" name="Payed" id="Payed" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                            </div>
                            <div class="mt-10 space-y-5  ">
                                <fieldset>
                                    <legend class="text-sm font-semibold leading-6 text-gray-900">Payment Method</legend>
                                    <div class="flex flex-nowrap justify-around">
                                        <select name="method" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            <<option>Cash</option>
                                                <<option>VF Cash</option>
                                                    <<option>Visa</option>
                                        </select>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="Date" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                            <div class="mt-2">
                                <input type="Date" value="<?php echo date('Y-m-d'); ?>" name="Date" id="Date" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="Time" class="block text-sm font-medium leading-6 text-gray-900">Time</label>
                            <div class="mt-2">
                                <input readonly type="time" value="<?php echo date('H:i:s'); ?>" name="Time" id="Time" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Comment</label>
                            <div class="mt-2">
                                <textarea placeholder="Add A Comment" id="about" name="about" rows="3" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                    </div>
            </div>

    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6 m-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
        <button type="submit" name="Save" class="  rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
    </form>
    </div>
    </main>
    <?php
    // } else if (strlen($_SESSION['login']) == 0) {
    //     echo "<script>alert('You Are Not Login');
    //               window.location.href = '/zeyad/Final_Project/admin-log/index.php';</script>";
    // }
    ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</body>

</html>