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
<script type="text/javascript" src="{{ URL::asset('js/jQuery.js') }}"></script>
<script type="text/javascript">
   
        function openFullWindow() {
            var newWindow = window.open('question?techid=7&userid=1 ', '_blank', 'width=' + screen.width + ',height=' + screen.height);
            newWindow.focus();
        }
</script>

<body class="sb-nav-fixed sb-sidenav-toggled">
    @include('layout.header')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" id="">
                <h1 style="color:rgb(219, 119, 219)">Exam Instructions</h1>

                <p>Welcome to the exam. Please read and follow the instructions carefully:</p>
            
                <p>
                    1. This is a timed exam. You will have 90 minutes to complete all the questions.
                    <br>
                    2. Answer all questions. Leaving a question unanswered will result in no points for that question.
                    <br>
                    3. Use a pen or pencil to write your answers on the provided answer sheet.
                    <br>
                    4. Do not use any electronic devices during the exam, including calculators and phones.
                    <br>
                    5. Raise your hand if you have any questions or need assistance.
                    <br>
                    6. When you are finished, submit your answer sheet to the exam proctor.
                    <br>
                    7. Stay seated until you are instructed to leave.
                </p>
                <input type="submit" class="btn btn-primary btn-block" onclick="openFullWindow()" name="btn" id="btn"
                value="Procced">
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
