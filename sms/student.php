<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/student.css">
  <title>SSRMS</title>
</head>

<body>
  <?php
  include("init.php");

  if (!isset($_GET['class']))
    $class = null;
  else
    $class = $_GET['class'];
  $rn = $_GET['rn'];
  // validation
  if (empty($class) or empty($rn) or preg_match("/[a-z]/i", $rn)) {
    if (empty($class))
      echo '<p class="error">Please select your class</p>';
    if (empty($rn))
      echo '<p class="error">Please enter your roll number</p>';
    if (preg_match("/[a-z]/i", $rn))
      echo '<p class="error">Please enter valid roll number</p>';
    exit();
  }
  $name_sql = mysqli_query($conn, "SELECT `name` FROM `students` WHERE `rno` = '$rn' and `class_name`='$class'");
  while ($row = mysqli_fetch_assoc($name_sql)) {
    $name = $row['name'];
  }
  echo "";
  $result_sql = mysqli_query($conn, "SELECT * FROM `students` WHERE `rno` = '$rn' and `class_name` = '$class'");
  // $result_sql=mysqli_query($conn,"SELECT `p1`, `p2`, `p3`, `p4`, `p5`, `marks`, `percentage` FROM `result` WHERE `rno`='$rn' and `class`='$class'");
  
  while ($row = mysqli_fetch_assoc($result_sql)) {
    $p1 = $row['sub1'];
    $p2 = $row['sub2'];
    $p3 = $row['sub3'];
    $p4 = $row['sub4'];
    $p5 = $row['sub5'];
    $tot = $row['tot'];
    $grade = $row['grade'];
  }
  $sub_sql = mysqli_query($conn, "SELECT `subject` FROM `subjects` WHERE `semester` = '$class'");

  if ($sub_sql->num_rows > 0) {
    // Fetch and display each value from the field
    $counter = 1;
    while ($row = $sub_sql->fetch_assoc()) {
      $variableName = "s" . $counter;
      ${$variableName} = $row['subject'];
      $counter++;
    }
  }

  if (mysqli_num_rows($result_sql) == 0) {
    echo "no result";
    exit();
  }
  ?>
  <div class="container">
    <div class="details">
      <span>Name:</span>
      <?php echo $name ?> <br>
      <span>Class:</span>
      <?php echo $class; ?> <br>
      <span>Roll No:</span>
      <?php echo $rn; ?> <br>
    </div>

    <div class="main">
      <div class="s1">
        <p>Subjects</p>
        <p>
          <?php echo '<p>' . $s1 . '</p>'; ?>
        </p>
        <p>
          <?php echo '<p>' . $s2 . '</p>'; ?>
        </p>
        <p>
          <?php echo '<p>' . $s3 . '</p>'; ?>
        </p>
        <p>
          <?php echo '<p>' . $s4 . '</p>'; ?>
        </p>
        <p>
          <?php echo '<p>' . $s5 . '</p>'; ?>
        </p>
      </div>
      <div class="s2">
        <p>Marks</p>
        <?php echo '<p>' . $p1 . '</p>'; ?>
        <?php echo '<p>' . $p2 . '</p>'; ?>
        <?php echo '<p>' . $p3 . '</p>'; ?>
        <?php echo '<p>' . $p4 . '</p>'; ?>
        <?php echo '<p>' . $p5 . '</p>'; ?>
      </div>
    </div>

    <div class="result">
      <?php echo '<p>Total Marks:&nbsp' . $tot . '</p>'; ?>
      <?php echo '<p>Grade:&nbsp' . $grade . '</p>'; ?>
    </div>

    <div class="button">
      <button onclick="window.print()">Print Result</button>
    </div>


    <div class="main2">
      <table>
        <thead>
          <tr>
            <td> S.N </td>
            <td colspan="10">Subjects </td>
            <td rowspan="2"> Obtained Marks </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> 1 </td>
            <td colspan="10">
              <?php echo '<p>' . $s1 . '</p>'; ?>
            </td>
            <td>
              <?php echo '<p>' . $p1 . ' / 100</p>'; ?>
            </td>
          </tr>

          <tr>
            <td> 2 </td>
            <td colspan="10">
              <?php echo '<p>' . $s2 . '</p>'; ?>
            </td>
            <td>
              <?php echo '<p>' . $p2 . ' / 100</p>'; ?>
            </td>
          </tr>

          <tr>
            <td> 3 </td>
            <td colspan="10">
              <?php echo '<p>' . $s3 . '</p>'; ?>
            </td>
            <td>
              <?php echo '<p>' . $p3 . ' / 100</p>'; ?>
            </td>
          </tr>

          <tr>
            <td> 4 </td>
            <td colspan="10">
              <?php echo '<p>' . $s4 . '</p>'; ?>
            </td>
            <td>
              <?php echo '<p>' . $p4 . ' / 100</p>'; ?>
            </td>
          </tr>

          <tr>
            <td> 5 </td>
            <td colspan="10">
              <?php echo '<p>' . $s5 . '</p>'; ?>
            </td>
            <td>
              <?php echo '<p>' . $p5 . ' / 100</p>'; ?>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>#</td>
            <td colspan="10" class="footer">Total Marks Obtained</td>
            <td colspan="2">
              <?php echo $tot; ?> / 500
            </td>
          </tr>

          <tr>
            <td colspan="10" class="footer">Grade</td>
            <td colspan="2">
              <?php echo $grade; ?>
            </td>
          </tr>

          <tr>
            <td colspan="10" class="footer">Student's Name</td>
            <td colspan="2">
              <?php echo $name; ?>
            </td>
          </tr>

          <tr>
            <td colspan="10" class="footer">Class</td>
            <td colspan="2">
              <?php echo $class; ?>
            </td>
          </tr>

          <tr>
            <td colspan="10" class="footer">Roll</td>
            <td colspan="2">
              <?php echo $rn; ?>
            </td>
          </tr>
        </tfoot>
      </table>

      <div class="row">
        <div class="container">
          <div class="button">
            <button class="button" onclick="window.print()">Print Result</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<style>
  td {
    border: 1px solid #726E6D;
    padding: 7px;
  }

  thead {
    font-weight: bold;
    text-align: center;
    background: #625D5D;
    color: white;
  }

  .button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 3px 6px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
  }

  table {
    border-collapse: collapse;
  }

  .footer {
    text-align: right;
    font-weight: bold;
  }

  tbody>tr:nth-child(odd) {
    background: #D1D0CE;
  }
</style>