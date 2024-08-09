<?php
session_start();
ini_set("display_errors", 0);
// if (strlen($_SESSION['login']) !== 0) {
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

if (isset($_POST['submit'])) {
  $Patient_ID = $_GET['uid'];
  $$apid = $_GET['id'];
  $docid = $_SESSION['id'];
  $name = $_POST['name'];
  $apid = $_POST['apid'];
  $Reservation = $_POST['Reservation'];
  $Report = $_POST['Report'];
  $Treatment = $_POST['Treatment'];
  $Scan = $_POST['Scan'];

  $sql = "UPDATE appointment SET doctorStatus = 2 WHERE userId = '$Patient_ID'";
  $connect->query($sql);

  $sqlq = "UPDATE appointment SET userStatus = 2 WHERE userId = '$Patient_ID'";
  $connect->query($sqlq);


  $query = mysqli_query(
    $connect,
    "insert into    tblmedicalhistory( UserID     , treatment    , Report    ,  apid  , Scan)
                              values('$Patient_ID', '$Treatment' ,'$Report' , '$apid'  , '$Scan' )"
  );
  if ($query) {
    echo "<script>alert('Report Saved successfully');
    window.location.href = '/zeyad/Final_Project/Project_UI/Doctor/doc-Reservations.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Write Report</title>
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
                <a href="./doc-Reservations.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Reservations</a>
                <a href="./doc-med record.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Medical Record</a>
                <a href="./doc-write.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Write Report</a>
              </div>
            </div>
          </div>
          <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Log Out</a>
    </nav>

    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Write Report</h1>
      </div>
    </header>
    <main class="">
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8 ">

          <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Patient Report</h2>
          </div>
          <form method="post" class="mx-auto max-w-full sm:mt-20 ">
            <?php
            $id = $_GET['id'];
            $sql = mysqli_query($connect, "SELECT * from appointment join users on users.uid=appointment.userId where apid = $id   ");
            if (mysqli_num_rows($sql) > 0) {
              $row = mysqli_fetch_assoc($sql);
            ?>
              <div class="grid grid-cols-4 gap-x-8 gap-y-6 sm:grid-cols-4">


                <div hidden class="sm:col-span-2">
                  <label for="id" class="block text-sm font-semibold leading-6 text-gray-900">id</label>
                  <div class="mt-2.5">
                    <input value="<?php echo $row['apid']; ?>" type="text" name="apid" id="id" class=" block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>


                <div class="sm:col-span-2">
                  <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">First name</label>
                  <div class="mt-2.5">
                    <input value="<?php echo $row['patient_Name']; ?>" type="text" name="name" id="first-name" class=" block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>


                <div class="sm:col-span-2">
                  <label for="Date" class="block text-sm font-semibold leading-6 text-gray-900">Date</label>
                  <div class="mt-2.5">
                    <input type="text" name="Date" value="<?php echo $row['appointmentDate']; ?>" id="Date" class="block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="Patient ID" class="block text-sm font-semibold leading-6 text-gray-900">Patient ID</label>
                  <div class="mt-2.5">
                    <input value="<?php echo $row['userId']; ?>" type="text" name="Patient_ID" id="Patient ID" class="block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="Reservation" class="block text-sm font-semibold leading-6 text-gray-900">Reservation Type</label>
                  <div class="mt-2.5">
                    <input value="<?php echo $row['doctorSpecialization']; ?>" type="text" name="Reservation" id="Reservation" class="block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  </div>
                </div>
                <?php
                $docid = $_SESSION['id'];
                $sql = mysqli_query($connect, "select doctors.doctorName as docname, appointment.* from appointment join doctors on doctors.id=appointment.doctorId where doctors.id = '$docid' ");
                if (mysqli_num_rows($sql) > 0) {
                  $row = mysqli_fetch_assoc($sql);
                ?>
                  <div class="sm:col-span-4">
                    <labe for="Doctor" class="block text-sm font-semibold leading-6 text-gray-900">Doctor </label>
                    <div class="mt-2.5">
                      <input value="<?php echo $row['docname']; ?>" type="text" name="Doctor" id="Doctor" class="block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                  </div>
                <?php } ?>

                <div class="sm:col-span-4">
                  <label for="Treatment" class="block text-sm font-semibold leading-6 text-gray-900">Treatment</label>
                  <div class="mt-2.5">
                    <textarea name="Treatment" id="Treatment" rows="2" class="block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label for="Treatment" class="block text-sm font-semibold leading-6 text-gray-900">Scan</label>
                  <div class="mt-2.5">
                    <textarea name="Scan" id="Scan" rows="1" class="block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label for="Report" class="block text-sm font-semibold leading-6 text-gray-900">Report</label>
                  <div class="mt-2.5">
                    <textarea name="Report" id="Report" rows="4" class="block w-full rounded-md border-x-neutral-900 border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                  </div>
                </div>
              </div>
              <div class="mt-10 flex justify-around">
                <button type="submit" name="submit" class=" w-96 rounded-md bg-indigo-600 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
              </div>
          </form>
        </div>
      <?php
            }
            // } else if (strlen($_SESSION['login']) == 0) {
            //   echo "<script>alert('You Are Not Login');
            //         window.location.href = '/zeyad/Final_Project/Project_UI/Doctor/index.php';</script>";
            // }
      ?>
      </div>
    </main>
</body>

</html>