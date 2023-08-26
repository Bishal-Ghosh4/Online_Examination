<?php
$conn = mysqli_connect('localhost', 'root', '', 'online_sys');
$name = Session::get('name');
$row = mysqli_fetch_assoc(mysqli_query($conn, "select * from candidate where name='$name'  "));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles1.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
    .pdf-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .pdf-button:hover {
        background-color: #0056b3;
    }
</style>
<body class="sb-nav-fixed sb-sidenav-toggled">
    @include('layout.header')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">{{ Session::get('name') }}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Details
                    </div>
                    <div class="card-body">
                        <table class="table table-warning table-hover">
                            <thead>
                                <tr>
                                    <th>slno</th>
                                    <th>Candidate Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Exam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone_no']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>
                                        @php
                                            $id = Session::get('id');
                                            $result = mysqli_query($conn, "select * from schedule where candidate_id='$id' ");
                                            
                                            if (mysqli_num_rows($result)) {
                                                echo '<div class="card bg-success text-white mb-4">
                                                <div class="card-body">Exam Schedule</div>
                                                <div class="card-footer d-flex align-items-center justify-content-between">
                                                    <a class="small text-white stretched-link" href="exam?techid=' .
                                                    $row['techid'] .
                                                    '&userid=' .
                                                    $id .
                                                    ' ">Go To Page <i
                                                            class="fa fa-plus" aria-hidden="true"></i></a>
                                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                </div>
                                            </div>';
                                            } else {
                                                echo '<div class="card bg-warning text-white mb-4">
                                            <div class="card-body">No Exam Schedule</div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="viewCandidate">Go To Page <i
                                                        class="fa fa-plus" aria-hidden="true"></i></a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>';
                                            }
                                        @endphp
                                        <form method="post" action="{{ route('generate.pdf') }}" style="display: table-caption;">
                                            @csrf
                                            <input type="hidden" name="id" value="<?php echo $row['candidate_id'];?>">
                                            <input type="hidden" name="username" value="<?php echo $row['name'];?>">
                                            <button type="submit" class="pdf-button" style="width:300px">Download Certificate <i class="fa fa-download" aria-hidden="true"></button></i>
                                        </form>

                                    </td>
                                </tr>
                                @php $count++; @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <br><br><br><br>
        <br><br><br><br>
        <br>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
