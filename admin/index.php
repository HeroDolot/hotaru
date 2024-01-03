<title>管理者ダッシュボード | 概要</title>
<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user_email"])) {
  header("location:../login.php");
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
      <li class="breadcrumb-item active fw-bold fs-3" aria-current="page">概要</li>
    </ol>
  </nav>
</div>


<div class="container">
  <div id="clock" class="fw-bolder fs-6"></div>
  <div class="wrapper overflow-hidden">
    <div class="row mb-5 d-flex justify-content-center align-items-center">
      <div class="col-md-4 col-6 mt-5">
        <div class="card bg-info rounded-2" style="max-width: 20rem; min-height:122px;">
          <div class="card-body text-white p-0">
            <div class="row p-3">
              <i class="fa-solid fa-arrow-trend-up fa-xl text-white text-end" style="font-size: 100px; opacity: 0.5; transform: rotate(9deg); margin-left:20px;"></i>
              <div class="col-md-9 col">
                <h4>純資産</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <p class="p-1">
                  <!-- <a href="./reports.php" class="btn btn-transparent text-white fw-bolder"> -->
                  <?php
                  $total = mysqli_query($conn, "SELECT SUM(accepted_contract) as total FROM accepted WHERE accepted_completed_date != 0")->fetch_assoc()["total"];
                  $expense = 0;

                  $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_completed_date != 0");
                  while ($row = $acceptedInfo->fetch_assoc()) {
                    $inq_id = $row["accepted_inquiry_id"];
                    $expenseResult = mysqli_query($conn, "SELECT (exp_history_price * expense_quantity) as totalExpense FROM expense_history WHERE exp_history_inquiry_id = $inq_id");

                    // Check if the query was successful
                    if ($expenseResult) {
                      $expenseRow = $expenseResult->fetch_assoc();

                      // Check if the result is not null before accessing its values
                      if ($expenseRow !== null && array_key_exists("totalExpense", $expenseRow)) {
                        $expense = $expense + $expenseRow["totalExpense"];
                      }
                    }
                  }

                  $currentYear = date("Y");
                  $assetInfo = mysqli_query($conn, "SELECT * FROM assets");
                  while ($asset = $assetInfo->fetch_assoc()) {
                    $purchaseMonth = date("m", $asset["asset_date_acquired"]);
                    $purchaseYear = date("Y", $asset["asset_date_acquired"]);
                    $supersubtotal = $asset["asset_price"] * $asset["asset_quantity"];
                    $expense = $expense + $supersubtotal;;
                  }

                  $total = $total - $expense;

                  echo number_format($total) . " YEN";
                  ?>

                </p>

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
                <h4>レポート</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./reports.php" class="btn btn-transparent text-white">詳細を表示</a>
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
                <h4>保留中</h4>
              </div>
              <div class="col-md-3 col-3">
                <h4 class="fw-bolder" style="margin-left: 10px;"><?php echo mysqli_query($conn, "SELECT COUNT(*) as total FROM inquiry WHERE inquiry_status = 1")->fetch_assoc()["total"]; ?></h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./pending.php" class="btn btn-transparent text-white">詳細を表示</a>
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
                <h4>収入</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./income.php" class="btn btn-transparent text-white">詳細を表示</a>
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
                <h4>支出</h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./expenses.php" class="btn btn-transparent text-white">詳細を表示</a>
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
                <h4>資産</h4>
              </div>
              <div class="col-md-3 col-3">
                <h4 class="fw-bolder" style="margin-left: 10px;"><?php echo mysqli_query($conn, "SELECT COUNT(*) as total FROM assets")->fetch_assoc()["total"] ?></h4>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="m-1">
                <a href="./assets.php" class="btn btn-transparent text-white">詳細を表示</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-12 mb-5 mb-md-0">
        <canvas id="monthlyChart" width="600" height="400"></canvas>
      </div>
      <div class="col-md-6 col-12 mb-5 mb-md-0">
        <?php
        $recordsPerPage = 4;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $recordsPerPage;

        $res = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 0 LIMIT $offset, $recordsPerPage");
        ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover text-center">
            <thead class="table-info">
              <tr>
                <th colspan="6" class="fw-bolder">お問い合わせ</th>
              </tr>
            </thead>
            <thead class="table-info">
              <tr>
                <th>名前</th>
                <th>電話番号</th>
                <th>地域</th>
                <th>作業依頼</th>
                <th>希望の連絡手段</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody class="align-middle">
              <?php
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
                    <td><?php echo $inquiry['preferred_contact'] ?></td>
                    <td>
                      <form method="POST" id="deleteForm" class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">
                          <i class="fa fa-check fa-solid"></i>
                        </button>
                        <input type="hidden" name="inquiry_id" value="<?php echo $inq_id ?>">
                        <button class="btn btn-danger" type="submit" onclick="confirmDelete(event)" name="inquiry_decline">
                          <li class="fa fa-trash fa-solid"></li>
                        </button>
                      </form>

                      <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">承認中</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <!-- モーダル内のフォーム -->
                              <form method="POST">
                                <input type="hidden" name="inquiry_id" value="<?php echo $inq_id ?>">
                                <div class="mb-3 form-floating">
                                  <input type="text" class="form-control fw-bolder" required id="clientName" name="name" placeholder="クライアント名" value="<?php echo $inquiry['client_name']; ?>" readonly>
                                  <label for="clientName">クライアント名</label>
                                </div>
                                <div class="mb-3 form-floating">
                                  <input type="text" class="form-control fw-bolder" required id="clientLocation" name="location" placeholder="場所">
                                  <label for="clientLocation">場所</label>
                                </div>
                                <div class="mb-3 form-floating">
                                  <input type="date" class="form-control fw-bolder" min="<?php echo date('Y-m-d'); ?>" required id="dateStart" name="start_date">
                                  <label for="dateStart">開始日</label>
                                </div>
                                <div class="mb-3 form-floating">
                                  <input type="number" class="form-control fw-bolder" required id="contractAmount" name="contract" placeholder="契約金額">
                                  <label for="contractAmount">契約金額</label>
                                </div>
                                <div class="mb-3 form-floating">
                                  <textarea class="form-control" placeholder="ここにコメントを残してください" id="floatingTextarea2" style="height: 100px" readonly><?php echo $inquiry["client_comment"] ?></textarea>
                                  <label for="floatingTextarea2">コンテキスト</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                              <button type="submit" name="submit_contract" class="btn btn-primary">契約を提出</button>
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

          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php
              $totalPages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 0")) / $recordsPerPage);

              // Previous Page Link
              if ($page > 1) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'><</a></li>";
              }

              // Page Links
              for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
              }

              // Next Page Link
              if ($page < $totalPages) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>></a></li>";
              }
              ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 col-12 mb-5 mb-md-0">
      <div class="fw-bolder text-danger" id='calendar'></div>
    </div>
    <div class="col-md-4 col-12 mt-4 mt-md-0">
      <div class="flex-fill mb-5 mb-md-4">
        <canvas id="myLineChart"></canvas>
      </div>
      <div class="card">
        <div class="card-header fw-bolder fs-4 text-center text-white bg-success">
          作業指示書
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
  function confirmDelete(event) {

    var confirmation = prompt("削除してもよろしいですか？続行するには 'confirm' と入力してください。");
    if (confirmation && confirmation.toLowerCase() === 'confirm') {} else {
      alert("削除がキャンセルされました。");
      event.preventDefault();
    }
  }

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
      $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status >= 2");
      $total = 0;
      while ($row = $result->fetch_assoc()) {
        $inquiry_id = $row["inquiry_id"];
        $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();
        $startdate = date("m", $acceptedInfo["accepted_start_date"]);
        if ($startdate == $i) {
          $total = $total + $acceptedInfo["accepted_contract"];
        }
      }
      echo $total . ",";
    }
    ?>
  ];
  var expensesData = [
    <?php
    $currentYear = date("Y");
    $subtotal = 0;
    for ($i = 1; $i <= 12; $i++) {
      $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status >= 2");
      $total = 0;
      while ($row = $result->fetch_assoc()) {
        $inquiry_id = $row["inquiry_id"];
        $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();
        $startMonth = date("m", $acceptedInfo["accepted_start_date"]);
        $startYear = date("Y", $acceptedInfo["accepted_start_date"]);
        if ($startMonth == $i && $startYear == $currentYear) {
          $expenseInfo = mysqli_query($conn, "SELECT * FROM expense_history WHERE exp_history_inquiry_id = $inquiry_id");
          while ($expense = $expenseInfo->fetch_assoc()) {
            $supersubtotal = $expense["exp_history_price"] * $expense["expense_quantity"];
            $subtotal = $subtotal + $supersubtotal;
          }
        }
      }


      $assetInfo = mysqli_query($conn, "SELECT * FROM assets");
      while ($asset = $assetInfo->fetch_assoc()) {
        $purchaseMonth = date("m", $asset["asset_date_acquired"]);
        $purchaseYear = date("Y", $asset["asset_date_acquired"]);
        if ($purchaseMonth == $i && $purchaseYear == $currentYear) {
          $supersubtotal = $asset["asset_price"] * $asset["asset_quantity"];
          $subtotal = $subtotal + $supersubtotal;;
        }
      }

      $total = $total + $subtotal;

      echo $total . ",";
    }
    ?>
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
          label: '収入',
          backgroundColor: 'rgba(75, 192, 192, 0.7)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          data: incomeData
        },
        {
          label: '支出',
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          data: expensesData
        },
        {
          label: '利益',
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
    document.getElementById('clock').textContent = "日本の日時: " + dateTime;
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
          $work_id = $row["client_wo"];
        ?> {
            title: '<?php echo  mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $work_id")->fetch_assoc()["work_name"] . ":" . $info["accepted_client_name"]; ?>',
            start: '<?php echo date("Y-m-d", $info["accepted_start_date"]); ?>',
            color: '<?php if ($row["inquiry_status"] == 1) {
                      echo 'red';
                    } else {
                      echo 'green';
                    } ?>'
          },
        <?php endwhile ?>
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
      $result = mysqli_query($conn, "SELECT * FROM work_order WHERE is_deleted < 1");
      while ($row = $result->fetch_assoc()) {
        echo "'" . $row["work_name"] . "',";
      }
      ?>
    ],
    datasets: [{
      label: 'Accumulated',
      data: [
        <?php
        $res = mysqli_query($conn, "SELECT * FROM work_order WHERE is_deleted = 0");
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
      label: 'ページ訪問者数',
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