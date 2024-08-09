<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

if (!empty($_POST["specilizationid"])) {

  $sql = mysqli_query($conn, "select doctorName,id from doctors where specilization='" . $_POST['specilizationid'] . "'"); ?>
  <option selected="selected">اختر دكتور </option>
  <?php
  while ($row = mysqli_fetch_array($sql)) { ?>
    <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['doctorName']); ?></option>
  <?php
  }
}


if (!empty($_POST["doctor"])) {

  $sql = mysqli_query($conn, "select docFees from doctors where 	id='" . $_POST['doctor'] . "'"); ?>
  <?php
  while ($row = mysqli_fetch_array($sql)) { ?>
    <option value="<?php echo htmlentities($row['docFees']); ?>"><?php echo htmlentities($row['docFees']); ?></option>
<?php
  }
}




?>






<!-- <script>
  document.getElementById('doctor').onchange = function updateFees(e) {
    var selection = document.querySelector(`[value=${this.value}]`).getAttribute('data-value');
    document.getElementById('docFees').value = selection;
  };
</script> -->