<?php
session_start();

include '../connection.php';


// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
  // Redirect to the login page or show an error message
  header('Location: login.php'); // Change to your login page URL
  exit();
}

function fetchInquiries($conn)
{
  $sql = "SELECT inquiry_id, client_name, client_number, client_region, client_wo, inquiry_status FROM inquiry";
  $result = mysqli_query($conn, $sql);

  $inquiries = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $inquiries[] = $row;
  }

  return $inquiries;
}

$inquiries = fetchInquiries($conn);

if (isset($_POST["submit_contract"])) {
  var_dump($_POST);
  $inquiry_id = mysqli_real_escape_string($conn, $_POST["inquiry_id"]);
  $name = mysqli_real_escape_string($conn, $_POST["name"]);
  $location = mysqli_real_escape_string($conn, $_POST["location"]);
  $contract = mysqli_real_escape_string($conn, $_POST["contract"]);

  $startDate = strtotime(mysqli_real_escape_string($conn, $_POST["start_date"]));

  $sql = "INSERT INTO accepted (accepted_inquiry_id,accepted_client_name,accepted_contract,accepted_start_date,accepted_location) VALUES($inquiry_id,'$name',$contract,$startDate,'$location')";
  mysqli_query($conn, $sql);
  if (mysqli_affected_rows($conn) == 1) {
    $sql = "UPDATE inquiry SET inquiry_status = 1 WHERE inquiry_id = $inquiry_id";
    mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) == 1) {
      header("location:./?success=Inquiry Approved!");
    } else {
      header("location:./?error=Failed to update status!");
    }
  } else {
    header("location:./?error=Failed to approved!");
  }
}

if (isset($_POST["inquiry_decline"])) {
  var_dump($_POST);
  $inquiry_id = mysqli_real_escape_string($conn, $_POST["inquiry_id"]);
  $sql = "UPDATE inquiry SET inquiry_status = -1 WHERE inquiry_id = $inquiry_id";
  mysqli_query($conn, $sql);
  if (mysqli_affected_rows($conn) == 1) {
    header("location:./?success=Inquiry decline!");
  } else {
    header("location:./?error=Inquiry failed to decline!");
  }
}

include './includes/header.php';
include './components/navbar.php';
?>

<div class="container-fluid py-5 p-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active fw-bold fs-3" aria-current="page">Overview</li>
    </ol>
  </nav>
</div>


<div class="container">
  <div id="clock" class="fw-bolder fs-6"></div>
  <div class="wrapper overflow-hidden">
    <div class="row mb-5">
      <div class="col-md-3 col-6 mt-5">
        <div class="card bg-primary rounded-2" style="max-width: 20rem;">
          <div class="card-body text-white p-0">
            <div class="row p-3">
              <i class="fa-regular fa-file fa-xl text-white text-end" style="font-size: 100px; opacity: 0.5; transform: rotate(20deg); margin-left:30px;"></i>
              <div class="col-md-9 col">
                <h4>Reports</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./reports.php" class="btn btn-transparent text-white">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-6 mt-5">
        <div class="card bg-danger rounded-2" style="max-width: 20rem;">
          <div class="card-body text-white p-0">
            <div class="row p-3">
              <i class="fa-solid fa-clock fa-xl text-white text-end" style="font-size: 100px; opacity: 0.5; transform: rotate(20deg); margin-left:30px;"></i>
              <div class="col-md-9 col">
                <h4>Pending</h4>
              </div>
              <div class="col-md-3 col-3">
                <h4 class="fw-bolder" style="margin-left: 10px;"><?php echo mysqli_query($conn, "SELECT COUNT(*) as total FROM inquiry WHERE inquiry_status = 1")->fetch_assoc()["total"]; ?></h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./pending.php" class="btn btn-transparent text-white">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-6 mt-5">
        <div class="card bg-success rounded-2" style="max-width: 20rem;">
          <div class="card-body text-white p-0">
            <div class="row p-3">
              <i class="fa-solid fa-yen-sign fa-xl text-white text-end" style="font-size: 100px; opacity: 0.5; transform: rotate(20deg); margin-left:30px;"></i>
              <div class="col-md-9 col">
                <h4>Income</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./income.php" class="btn btn-transparent text-white">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-6 mt-5">
        <div class="card bg-warning rounded-2" style="max-width: 20rem;">
          <div class="card-body text-white p-0">
            <div class="row p-3">
              <i class="fa-solid fa-warehouse fa-xl text-white text-end" style="font-size: 100px; opacity: 0.5; transform: rotate(20deg); margin-left:30px;"></i>
              <div class="col-md-9 col">
                <h4>Assets</h4>
              </div>
              <div class="col-md-3 col-3">
                <h4 class="fw-bolder" style="margin-left: 10px;">4</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./assets.php" class="btn btn-transparent text-white">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-12">
        <div class="fw-bolder text-danger" id='calendar'></div>
      </div>
      <div class="col-md-6 col-12 mt-4 mt-md-0">
        <div class="flex-fill">
          <canvas id="myLineChart"></canvas>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <div class="row">
        <div class="col-md-6 mt-5">
          <div class="card">
            <div class="card-header fw-bolder fs-4 text-center text-white bg-success">
              共同作業した都市
            </div>
            <canvas id="myDoughnutChart"></canvas>
          </div>
        </div>
        <div class="col-md-6 mt-5">
          <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
              <thead class="table-info">
                <tr>
                  <th colspan="5" class="fw-bolder">INQUIRIES</th>
                </tr>
              </thead>
              <thead class="table-info">
                <tr>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Region</th>
                  <th>Work Order</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                <?php foreach ($inquiries as $inquiry) {
                  $inq_id = $inquiry['inquiry_id'];
                  $modalId = 'myModal_' . $inquiry['inquiry_id']; // Unique modal ID for each record
                  if ($inquiry["inquiry_status"] == 0) :
                ?>
                    <tr>
                      <td><?php echo $inquiry['client_name']; ?></td>
                      <td><?php echo $inquiry['client_number']; ?></td>
                      <td><?php echo $inquiry['client_region']; ?></td>
                      <td><?php echo $inquiry['client_wo']; ?></td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">
                            <i class="fa fa-check fa-solid"></i>
                          </button>
                          <!-- Check Modal -->
                          <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Approving</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <!-- Form inside the modal -->
                                  <form method="POST">
                                    <input type="hidden" name="inquiry_id" value="<?php echo $inq_id ?>">
                                    <div class="mb-3 form-floating">
                                      <input type="text" class="form-control fw-bolder" required id="clientName" name="name" placeholder="Client Name" value="<?php echo $inquiry['client_name']; ?>" readonly>
                                      <label for="clientName">Client Name</label>
                                    </div>
                                    <div class="mb-3 form-floating">
                                      <input type="text" class="form-control fw-bolder" required id="clientLocation" name="location" placeholder="Location">
                                      <label for="clientLocation">Location</label>
                                    </div>
                                    <div class="mb-3 form-floating">
                                      <input type="date" class="form-control fw-bolder" required id="dateStart" name="start_date">
                                      <label for="dateStart">Date Start</label>
                                    </div>
                                    <div class="mb-3 form-floating">
                                      <input type="number" class="form-control fw-bolder" required id="contractAmount" name="contract" placeholder="Contract Amount">
                                      <label for="contractAmount">Contract Amount</label>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" name="submit_contract" class="btn btn-primary">Submit Contract</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Check Modal -->
                          <form method="POST">
                            <input type="hidden" name="inquiry_id" value="<?php echo $inq_id ?>">
                            <button class="btn btn-danger" type="submit" name="inquiry_decline">
                              <li class="fa fa-trash fa-solid"></li>
                            </button>
                          </form>
                        </div>
                      </td>
                    <?php endif; ?>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
          <nav aria-label="Page navigation example" class="mt-3 mt-md-0">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  function updateClock() {
    // Create a Date object
    var japanTime = new Date();

    // Set the time zone to Japan (Asia/Tokyo)
    japanTime.setTime(japanTime.getTime() + japanTime.getTimezoneOffset() * 60 * 1000);
    japanTime.setTime(japanTime.getTime() + 9 * 60 * 60 * 1000);

    // Format the date and time
    var options = {
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit'
    };
    var dateTime = japanTime.toLocaleString('ja-JP', options);

    // Update the clock element
    document.getElementById('clock').textContent = "Japan Date and Time: " + dateTime;
  }

  // Update the clock every second
  setInterval(updateClock, 1000);

  // Initial clock update
  updateClock();

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'ja',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth',
      },
      events: [
        <?php
          $result = mysqli_query($conn,"SELECT * FROM inquiry WHERE inquiry_status = 1 or inquiry_status = 2");
          while ($row = $result->fetch_assoc()):
            $inq_id = $row["inquiry_id"];
            $info = mysqli_query($conn,"SELECT * FROM accepted WHERE accepted_inquiry_id = $inq_id")->fetch_assoc();
        ?> {
          title: '<?php echo $row["client_wo"];?>',
          start: '<?php echo date("Y-m-d", $info["accepted_start_date"]);?>', // Event start date
          color: '<?php if ($row["inquiry_status"] == 1){echo 'red';} else {echo 'green';}?>',
        },
        <?php endwhile;?>
      ],

    });

    calendar.render();
  });




  // Get the canvas elements by their IDs
  const doughnutCtx = document.getElementById('myDoughnutChart').getContext('2d');
  const lineCtx = document.getElementById('myLineChart').getContext('2d');

  // Doughnut Chart Data and Configuration
  const doughnutData = {
    labels: ['Red', 'Blue', 'Yellow'],
    datasets: [{
      label: 'Doughnut Dataset',
      data: [300, 50, 100],
      backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
      hoverOffset: 4
    }]
  };

  const doughnutConfig = {
    type: 'doughnut',
    data: doughnutData,
  };

  // Line Chart Data and Configuration
  const lineData = {
    labels: ['January', 'February', 'March', 'April', 'May'],
    datasets: [{
      label: 'Page Visitor Volume',
      data: [10, 25, 17, 30, 22],
      borderColor: 'rgb(75, 192, 192)',
      tension: 0.1
    }]
  };

  const lineConfig = {
    type: 'line',
    data: lineData,
  };

  // Create and render the Doughnut Chart
  const myDoughnutChart = new Chart(doughnutCtx, doughnutConfig);

  // Create and render the Line Chart
  const myLineChart = new Chart(lineCtx, lineConfig);
</script>
<?php
include './includes/footer.php';
?>