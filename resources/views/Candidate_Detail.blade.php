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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>



<body class="bg-primary sb-nav-fixed sb-sidenav-toggled">
    @include('layout.header')


    <h3>{{ @session('msg') }}</h3>
    <p>{{ isset($msg) ? $msg : '' }}</p>
    {{-- <h3>{{ @isset($msg) ? 1 : 0 @endisset }}</h3> --}}
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            {{-- Table --}}
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Candidate Details
                                </div>
                                <div class="card-body">
                                    <table class="table table-warning table-hover">
                                        <thead>
                                            <tr>
                                                <th>slno</th>
                                                <th>Technology Name</th>
                                                <th>Full Name</th>
                                                <th>Address</th>
                                                <th>Number</th>
                                                <th>Email</th>
                                                <th>User ID</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($candi))
                                                <input type="hidden" value="{{ $count = 1 }}">
                                                @foreach ($candi as $s)
                                                    <tr>
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $s->techname }}</td>
                                                        <td>{{ $s->name }}</td>
                                                        <td>{{ $s->address }}</td>
                                                        <td>{{ $s->phone_no }}</td>
                                                        <td>{{ $s->email }}</td>
                                                        <td>{{ $s->userid }}</td>
                                                        <td>{{ $s->password }}</td>
                                                        <td>{{ $s->status }}</td>
                                                        <td>
                                                            @if ($s->status == 'A')
                                                                <a href="{{ url('viewCandidate') }}/{{ $s->email }}">Approved<i
                                                                        class="fa fa-check"
                                                                        style="font-size:24px;color:green;cursor:pointer;"></i></a>
                                                            @endif
                                                            @if ($s->status == 'N')
                                                                <a href="{{ url('viewCandidate') }}/{{ $s->email }}">Approve<i
                                                                        class="fa fa-exclamation-circle"
                                                                        style="font-size:24px;color:rgb(228, 214, 18);cursor:pointer;"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" value="{{ $count += 1 }}">
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <br><br><br>
        <br><br><br><br>
        <br><br><br>
        <div id="layoutAuthentication_footer">
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
</body>

</html>
