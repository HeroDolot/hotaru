<title>Admin Dashboard | Overview</title>
<?php
session_start();

include '../connection.php';

if (!isset($_SESSION['user_email'])) {
  header('Location: login.php');
  exit();
}

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
    <div class="row mb-5 d-flex justify-content-center align-items-center">
      <div class="col-md-4 col-6 mt-5">
        <div class="card bg-info rounded-2" style="max-width: 20rem;">
          <div class="card-body text-white p-0">
            <div class="row p-3">
              <i class="fa-solid fa-arrow-trend-up fa-xl text-white text-end" style="font-size: 100px; opacity: 0.5; transform: rotate(9deg); margin-left:20px;"></i>
              <div class="col-md-9 col">
                <h4>Net Worth</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./reports.php" class="btn btn-transparent text-white fw-bolder">
                  <?php
                  $total = 0;
                  $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_completed_date != 0");
                  while ($acceptedRow = $acceptedInfo->fetch_assoc()) {
                    $accepted_inquiry_id = $acceptedRow["accepted_inquiry_id"];
                    $expense = mysqli_query($conn, "SELECT (exp_history_price * expense_quantity) as subtotal FROM expense_history WHERE exp_history_inquiry_id = $accepted_inquiry_id")->fetch_assoc()["subtotal"];
                    $subtotal = $acceptedRow["accepted_contract"] - $expense;
                    $total = $total + $subtotal;
                  }
                  echo number_format($total);
                  ?>
                  ¥</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-6 mt-5">
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
      <div class="col-md-4 col-6 mt-5">
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
      <div class="col-md-4 col-6 mt-5">
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
      <div class="col-md-4 col-6 mt-5">
        <div class="card bg-warning rounded-2" style="max-width: 20rem;">
          <div class="card-body text-white p-0">
            <div class="row p-3">
              <i class="fa-solid fa-money-bills fa-xl text-white text-end" style="font-size: 100px; opacity: 0.5; transform: rotate(20deg); margin-left:30px;"></i>
              <div class="col-md-9 col">
                <h4>Expenses</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./expenses.php" class="btn btn-transparent text-white">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-6 mt-5">
        <div class="card bg-secondary rounded-2" style="max-width: 20rem;">
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
        <canvas id="monthlyChart" width="600" height="400"></canvas>
      </div>
      <div class="col-md-6 col-12">

        <div class="table-responsive">
          <table class="table table-bordered table-hover text-center">
            <thead class="table-info">
              <tr>
                <th colspan="6" class="fw-bolder">INQUIRIES</th>
              </tr>
            </thead>
            <thead class="table-info">
              <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Region</th>
                <th>Work Order</th>
                <th>Call/Mail</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="align-middle">
              <?php
              $res = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 0 limit 3");
              while ($row = $res->fetch_assoc()) :
                $inquiry = $row;
                $inq_id = $inquiry['inquiry_id'];
                $modalId = 'myModal_' . $inquiry['inquiry_id'];
                $wo_id = $inquiry['client_wo'];
                if ($inquiry["inquiry_status"] == 0) :
              ?>
                  <tr>
                    <td><?php echo $inquiry['client_name']; ?></td>
                    <td><?php echo $inquiry['client_number']; ?></td>
                    <td><?php echo $inquiry['client_region']; ?></td>
                    <td><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $wo_id")->fetch_assoc()["work_name"]; ?></td>
                    <td>Call</td>
                    <td>
                      <form method="POST" class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">
                          <i class="fa fa-check fa-solid"></i>
                        </button>
                        <input type="hidden" name="inquiry_id" value="<?php echo $inq_id ?>">
                        <button class="btn btn-danger" type="submit" name="inquiry_decline">
                          <li class="fa fa-trash fa-solid"></li>
                        </button>
                      </form>

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
                                <div class="mb-3 form-floating">
                                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" readonly><?php echo $inquiry["client_comment"] ?></textarea>
                                  <label for="floatingTextarea2">Context</label>
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

                    </td>
                  </tr>
                <?php endif; ?>
              <?php endwhile; ?>

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 col-12">
      <div class="fw-bolder text-danger" id='calendar'></div>
    </div>
    <div class="col-md-4 col-12 mt-4 mt-md-0">
      <div class="flex-fill">
        <canvas id="myLineChart"></canvas>
      </div>
      <div class="card">
        <div class="card-header fw-bolder fs-4 text-center text-white bg-success">
          Work Order
        </div>
        <canvas id="myDoughnutChart"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="wrapper">
  <div class="row">
    <div class="col-md-12 mt-5">
    </div>
  </div>
</div>


<script>
  function getJapaneseMonths(year) {
    const months = [];
    const japaneseFormatter = new Intl.DateTimeFormat('ja-JP', {
      month: 'long'
    });
    let startMonth = 0; // January by default

    // Adjust startMonth based on the era change from Heisei to Reiwa
    if (year > 2019 || (year === 2019 && new Date(year, 3, 30) < new Date(year, 3, 1))) {
      startMonth = 0; // Reiwa starts from May (index 4)
    }

    for (let i = startMonth; i < startMonth + 12; i++) {
      const date = new Date(year, i, 1);
      const monthName = japaneseFormatter.format(date);
      months.push("<?php echo date("Y"); ?>年" + monthName);
    }

    return months;
  }

  var months = getJapaneseMonths(<?php echo date('Y'); ?>);
  var incomeData = [
    <?php
    for ($i = 1; $i <= 12; $i++) {
      $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status >= 1");
      $total = 0;
      while ($row = $result->fetch_assoc()) {
        $inquiry_id = $row["inquiry_id"];
        $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();
        $startdate = date("m", $acceptedInfo["accepted_start_date"]);
        if ($startdate == $i){
          $total = $total + $acceptedInfo["accepted_contract"];
        }
      }
      echo $total . ",";
    }
    ?>
  ];
  var expensesData = [
    1500, 1800, 2000, 2100, 2500, 2800, 3000, 2700, 2200, 2400, 2600, 3000
  ];

  // Calculate Profit
  var profitData = incomeData.map((income, index) => income - expensesData[index]);

  // Create a bar chart
  var ctx = document.getElementById('monthlyChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: months,
      datasets: [{
          label: 'Income',
          backgroundColor: 'rgba(75, 192, 192, 0.7)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          data: incomeData
        },
        {
          label: 'Expenses',
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          data: expensesData
        },
        {
          label: 'Profit',
          backgroundColor: 'rgba(99, 255, 132, 0.7)',
          borderColor: 'rgba(99, 255, 132, 1)',
          borderWidth: 1,
          data: profitData
        }
      ]
    },
    options: {
      scales: {
        x: {
          stacked: false
        },
        y: {
          stacked: false
        }
      }
    }
  });


  $(document).ready(function() {
    function loadInquiries(page) {
      $.ajax({
        url: './ajax/inquiry_pagination.php',
        type: 'POST',
        data: {
          page: page
        },
        success: function(response) {
          // $('tbody').html(response);
        }
      });
    }

    // Initial load
    loadInquiries(1);

    // Pagination click event
    $(document).on('click', '.pagination a', function(e) {
      e.preventDefault();
      var page = $(this).attr('href').split('=')[1];
      loadInquiries(page);
    });
  });

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
        right: 'dayGridMonth,timeGridWeek,listWeek',
      },
      events: [
        <?php
        $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 1 or inquiry_status = 2");
        while ($row = $result->fetch_assoc()) :
          $inq_id = $row["inquiry_id"];
          $info = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inq_id")->fetch_assoc();
          $work_id = $row["client_wo"]
        ?> {
            title: '<?php echo  mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $work_id")->fetch_assoc()["work_name"] . ":" . $info["accepted_client_name"]; ?>',
            start: '<?php echo date("Y-m-d", $info["accepted_start_date"]); ?>',
            color: '<?php if ($row["inquiry_status"] == 1) {
                      echo 'red';
                    } else {
                      echo 'green';
                    } ?>'
          },
        <?php endwhile; ?>
      ],

    });

    calendar.render();
  });




  // Get the canvas elements by their IDs
  const doughnutCtx = document.getElementById('myDoughnutChart').getContext('2d');
  const lineCtx = document.getElementById('myLineChart').getContext('2d');

  // Doughnut Chart Data and Configuration
  const doughnutData = {
    labels: [
      <?php
      $result = mysqli_query($conn, "SELECT * FROM work_order");
      while ($row = $result->fetch_assoc()) {
        echo "'" . $row["work_name"] . "',";
      }
      ?>
    ],
    datasets: [{
      label: 'Accumulated',
      data: [
        <?php
        $res = mysqli_query($conn, "SELECT * FROM work_order");
        while ($resRow = $res->fetch_assoc()) {
          $count = 0;
          $work_id = $resRow["work_id"];
          $res1 = mysqli_query($conn, "SELECT * FROM inquiry WHERE client_wo = $work_id AND inquiry_status >= 1");
          while ($res1Row = $res1->fetch_assoc()) {
            $count++;
          }
          echo $count . ",";
        }
        ?>
      ],
      backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(128,128,128)'],
      hoverOffset: 4
    }]
  };

  const doughnutConfig = {
    type: 'doughnut',
    data: doughnutData,
  };

  // Line Chart Data and Configuration
  const lineData = {
    labels: [
      'Start',
      <?php
      $result = mysqli_query($conn, "SELECT * FROM page_count");
      $monthYear = array();
      $salesData = array();
      while ($row = $result->fetch_assoc()) {
        if (!in_array(date("M-Y", $row["count_date"]), $monthYear)) {
          $monthYear[] = date("M-Y", $row["count_date"]);
          echo '"' . date("M-Y", $row["count_date"]) . '",';
        }

        $index = array_search(date("M-Y", $row["count_date"]), $monthYear);
        if ($index !== false) {
          if (isset($salesData[$index])) {
            $salesData[$index] = $salesData[$index] + $row["count"];
          } else {
            $salesData[$index] = $row["count"];
          }
        }
      }
      ?>
    ],
    datasets: [{
      label: 'Page Visitor Volume',
      data: [
        0,
        <?php
        foreach ($salesData as $value) {
          echo $value . ',';
        }
        ?>
      ],
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