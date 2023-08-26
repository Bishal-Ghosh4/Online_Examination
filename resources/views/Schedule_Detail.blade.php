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
<script type="text/javascript" src="{{ URL::asset('js/jQuery.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#techid").change(function() {
            $.ajax({
                url: "getcandi",
                type: "POST",
                dataType: "JSON",
                data: {
                    techid: $("#techid").val(),
                    _token: $("input[name='_token']").val()
                },
                success: function(result) {
                    op = '<option>--select--</option>';
                    if (result.length > 0) {
                        $.each(result, function(key, value) {
                            op = op + `<option value="${value.candidate_id}">${value.name}</option>`;
                        });
                        $("#candid").html(op);
                    } else {
                        $("#candid").html('<option>No Candidate Found</option>');
                    }
                }
            })
        })
    });
</script>

<body class="bg-primary sb-nav-fixed sb-sidenav-toggled">
    @include('layout.header')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Schedule Exam </h3>
                                </div>
                                <h5 class="text-center font-weight-light my-4" style="color: blueviolet">{{ @session('msg') }}</h5>
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-control" name="techid" id="techid">
                                                        <option>--select--</option>
                                                          @foreach ($tech as $t)
                                                            <option value="{{ $t->techid }}">
                                                                {{ $t->techname }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="inputFirstName">Technology Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-control" name="candid" id="candid">
                                                    </select>
                                                    <label for="inputLastName">Candidate Name</label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputFirstName" type="date"
                                                        name="date" value="{{ @session('subname') }}"
                                                        placeholder="Enter your first name" />
                                                    <label for="inputFirstName">Exam Date</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="time"
                                                        name="starttime" value="{{ @session('subname') }}"
                                                        placeholder="Enter your first name" />
                                                    <label for="inputFirstName">Start Range Time</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="time"
                                                        name="endtime" value="{{ @session('subname') }}"
                                                        placeholder="Enter your first name" />
                                                    <label for="inputFirstName">End Range Time</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text"
                                                        name="noofquestion" value="{{ @session('subname') }}"
                                                        placeholder="Enter your first name" />
                                                    <label for="inputFirstName">No of Question</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text"
                                                        name="duration" value="{{ @session('subname') }}"
                                                        placeholder="Enter your first name" />
                                                    <label for="inputFirstName">Exam Duration</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary btn-block" name="btn"
                                                    value="Add">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Table --}}
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Schedule Exams
                                </div>
                                <div class="card-body">
                                    <table class="table table-warning table-hover">
                                        <thead>
                                            <tr>
                                                <th>slno</th>
                                                <th>Candidate Name</th>
                                                <th>Exam Date</th>
                                                <th>No of Question</th>
                                                <th>Duration</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($dets))
                                                <input type="hidden" value="{{ $count = 1 }}">
                                                @foreach ($dets as $s)
                                                    <tr>
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $s->name }}</td>
                                                        <td>{{ $s->date }}</td>
                                                        <td>{{ $s->no_of_question }}</td>
                                                        <td>{{ $s->duration }} hrs</td>
                                                        <td>
                                                            <a href="deletesub?slno={{ $s->slno }}"><i
                                                                    class="fa fa-trash"
                                                                    style="font-size:24px;color:red;cursor:pointer;"
                                                                    onclick=""></i></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>


</html>
