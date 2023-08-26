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
                                    Exam Results
                                </div>
                                <div class="card-body">
                                    <table class="table table-warning table-hover">
                                        <thead>
                                            <tr>
                                                <th>slno</th>
                                                <th>Technology Name</th>
                                                <th>Full Name</th>
                                                <th>No Of Questions</th>
                                                <th>Given Answer</th>
                                                <th>Correct Answer</th>
                                                <th>Result</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($givenans))
                                                <input type="hidden" value="{{ $count = 1 }}">
                                                @foreach ($givenans as $giv)
                                                    <tr>
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $giv->techname }}</td>
                                                        <td>{{ $giv->name }}</td>
                                                        <td>{{ $giv->no_of_question }}</td>
                                                        <td>{{ $giv->givenans }}</td>
                                                        @foreach ($resultans as $res)
                                                            @if ($giv->name == $res->name)
                                                                <td>{{ $res->resultans }}</td>
                                                                @php
                                                                    $per = ($res->resultans / $giv->no_of_question) * 100;
                                                                    $q = count($givenans) == count($resultans);
                                                                @endphp
                                                                <td>{{ $per }} % </td>
                                                            @else
                                                                @if (@$q == 0)
                                                                    <td>0</td>
                                                                    <td>0 %</td>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <td>
                                                            @if (@$per >= 50)
                                                                <a
                                                                    href="{{ url('viewCandidate') }}/{{ $giv->name }}">Generate
                                                                    Certificate <i class="fa fa-share-square"
                                                                        aria-hidden="true"
                                                                        style="font-size:24px;color:green;cursor:pointer;"></i></a>
                                                            @endif
                                                            @if (@$per < 50)
                                                                <a href="">Not Possible to Generate
                                                                    Certificate <i class="fa fa-exclamation-triangle"
                                                                        aria-hidden="true" aria-disabled="true"
                                                                        style="font-size:24px;color:rgb(250, 4, 4);"></i></a>
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
