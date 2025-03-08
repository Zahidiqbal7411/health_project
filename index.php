<!doctype html>
<html lang="en">

<?php require_once('conn.php'); ?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=5, minimum-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/style.css">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

  <!-- Media Queries CSS -->
  <link rel="stylesheet" href="assets/media-queries.css">

  <title>Recuperar</title>
</head>

<body>
  <style>
    .highlighted_date{
      background-color:yellow !important;
      color:black !important;

    }
  </style>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="#">
        <img src="./assets/images/logo.png" alt="Logo">
      </a>

      <!-- Toggle button for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color: #0091DA;"></span>
      </button>

      <!-- Navbar Links + Right Side Items (inside the collapse) -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-5 p-5 mb-2 mb-lg-0 w-100">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Necessidade</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contract_management.html">Gestão de Contrato</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Orçamento</a>
          </li>
        </ul>

        <!-- Right Side Items (Move inside the menu on mobile) -->
        <div class="d-flex align-items-center right-items position-relative">
          <div class="position-relative">
            <i class="fa-regular fa-bell me-2 mt-1 bell-icon" style="color: white; font-size: 22px;"></i>
            <span class="notification-badge">3</span> <!-- Notification Badge -->
          </div>
          <img src="./assets/images/Ellipse 6.png" alt="Profile" class="profile-img mx-2">
          <div class="dropdown">
            <button class="btn btn-outline-light lang-toggle" type="button" data-bs-toggle="dropdown">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Flag_of_Portugal.svg" width="20"> PT
              <i class="fa-solid fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">English</a></li>
              <li><a class="dropdown-item" href="#">Português</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero" style="height: 960px">
    <div class="overlay"></div>
    <div class="container position-relative">
      <h1 class="fw-bold" style="display: inline-block; position: relative; top: 210px; font-size: 50px;">ENTIDADE A</h1>
      <p class="d-block" style="position: relative; top: 210px; font-size: 32px;">Entidade A.</p>
    </div>

    <div class="calendar-card">
      <div class="calendar-header">
        <small class="mb-3 d-block" style="color: #2A6B2F;">Calendário</small>
        <div class="nav-icons d-flex justify-content-between">
          <i class="fa-solid fa-chevron-left" onclick="changeMonth(-1)"></i>
          <small id="monthYear"> <!-- data comes dynamically --> </small>
          <i class="fa-solid fa-chevron-right" onclick="changeMonth(1)"></i>
        </div>
      </div>
      <div class="day-names">
        <div class="weekday">Sun</div>
        <div class="weekday">Mon</div>
        <div class="weekday">Tue</div>
        <div class="weekday">Wed</div>
        <div class="weekday">Thu</div>
        <div class="weekday">Fri</div>
        <div class="weekday">Sat</div>
      </div>
      <div class="calendar-days" id="calendarDays"></div>
      <div class="event-box" id="eventDetails"></div>
      <div id="calendarContainer" >
        <h3 id="monthYear"></h3>
        <div id="calendarDays"></div>
        <div id="selectedDateDisplay">
        <textarea id="input_remainder" class="form-control" style="display:none; border:none; border-radius:2px;" placeholder="Enter your remainder here" onclick="submitRemainder()"></textarea>
            <div id="remainder_div" ></div>
            <textarea id="show_remainder" class="form-control" style="display:none; border:none; border-radius:2px;" placeholder="Enter your remainder for update" onclick="getRemainder()"></textarea>
        </div>
        <div style="display:none;">
        <h1>Remainders</h1>
    <ul id="remainder_list">
        <!-- Remainders will be dynamically added here -->
    </ul>
    </div>
      </div>
    </div>
  </div>

  <!-- Bar Chart Section -->
  <section class="barchartSection mb-3">
    <div class="container py-4">
      <h3 class="fw-bold" style="color: #4E4E4E !important;">Gráfico de Necessidades</h3>
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="chart-container">
            <h5 class="fw-bold" style="color: #03445E !important; display: block;">Alerta de tarefas</h5>
            <!-- Flexbox for horizontal layout -->
            <div class="mainBar" style="display: flex; align-items: center;">
              <div class="barChart-items me-4">
                <ul class="list-unstyled">
                  <li><span class="badge bg-primary">&nbsp;</span> Concluído</li>
                  <li><span class="badge bg-info">&nbsp;</span> A terminar</li>
                  <li><span class="badge bg-success">&nbsp;</span> Em atraso</li>
                </ul>
              </div>
              <div>
                <canvas id="barChart" style="width: 100% !important; height: 300px !important;"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="chart-container">
            <h5 class="fw-bold" style="display: inline-block; white-space: nowrap; color: #03445E;">Estado das tarefas</h5>
            <canvas id="doughnutChart" class="" style=" width: 222px;" height="222px"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Dashboard Chart -->
    <div class="container mb-5 py-5">
      <div class="dashboard-container row">
        <div class="col-md-5">
          <h5 class="fw-bold" style="color: #03445E;">Contratos</h5>
          <div id="bar-chart"></div>
        </div>
        <div class="col-md-7">
          <h5 class="fw-bold" style="color: #03445E;">Contratos <br> (Volume em &euro;)</h5>
          <canvas id="lineChart"></canvas>
        </div>
      </div>
    </div>
  </section>

  <!-- Candidate Section -->
  <section class="candidate-section p-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="main p-3" style="margin-top: 50px;">
            <div class="row">
              <div class="col-md-6">
                <h3 class="fw-bold mt-4 ms-2" style="color: #4E4E4E;">Necessidades</h3>
              </div>
              <div class="col-md-6">
                <div class="candidate-btn mt-4 me-3 d-flex justify-content-end">
                  <button type="button" class="btn btn-primary candidate-btn1">Criar Necessidade</button>
                  <button type="button" class="btn btn-outline-light ms-1 candidate-serchBtn">
                    <i class="fa-solid fa-magnifying-glass"></i> Search ID Task
                  </button>
                </div>
              </div>
            </div>
            <!-- Table -->
            <div class="row">
              <div class="table-container table-responsive needs-table">
                <div class="d-flex align-items-center mb-3 table-date">
                  <i class="fa-solid fa-chevron-left me-3" id="table-icons"></i>
                  <span style="color: #3F8045;"><i class="fa-solid fa-calendar-days"></i> &nbsp;Janeiro 2024</span>
                  <i class="fa-solid fa-chevron-right ms-3 table-icons"></i>
                </div>
                <table class="table table-hover text-center table-responsive">
                  <thead>
                    <tr>
                      <th>Company</th>
                      <th>Service</th>
                      <th>Subject</th>
                      <th>Category</th>
                      <th>Due Date</th>
                      <th>Status</th>
                      <th>Assigned To</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>1/19/2024</td>
                      <td>Hold</td>
                      <td>Lorem Ipsum</td>
                    </tr>
                    <tr>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>1/20/2024</td>
                      <td>Hold</td>
                      <td>Lorem Ipsum</td>
                    </tr>
                    <tr>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>1/21/2024</td>
                      <td>&#x2714;</td>
                      <td>Lorem Ipsum</td>
                    </tr>
                    <tr>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>1/22/2024</td>
                      <td>&#x2714;</td>
                      <td>Lorem Ipsum</td>
                    </tr>
                    <tr>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>Lorem Ipsum</td>
                      <td>1/30/2024</td>
                      <td>Hold</td>
                      <td>Lorem Ipsum</td>
                    </tr>
                  </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="mb-0 fw-bold table-para" style="color: #3F8045;">8 - 36 Tarefas</p>
                  <nav>
                    <ul class="pagination">
                      <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div> <!-- End of .main -->
        </div> <!-- End of .col-12 -->
      </div> <!-- End of .row -->
    </div>
  </section>

  <!-- Footer Section -->
  <footer style="background-color: #172629;">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mt-5">
          <h3 class="fw-bold">contacte-nos</h3>
        </div>

        <div class="col-md-8 mt-5">
          <div class="quick-links">
            <a href=""> <span>TERMOS E CONDIÇÕES</span></a>
            <a href=""> <span>POLÍTICA DE PRIVACIDADE</span></a>
            <a href=""> <span>POLÍTICA DE COOKIES</span></a>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-12">
            <div class="social-links">
              <a href=""> <i class="fa-brands fa-youtube"></i></a>
              <a href=""><i class="fa-brands fa-facebook"></i></a>
              <a href=""> <i class="fa-brands fa-linkedin"></i></a>
              <a href=""> <i class="fa-brands fa-twitter"></i></a>
              <a href=""> <i class="fa-brands fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- Custom JS -->
  <script src="index.js"></script>
</body>

</html>
