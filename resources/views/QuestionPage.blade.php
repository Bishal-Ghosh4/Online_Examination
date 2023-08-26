<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles1.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
    /* ... Other existing styles ... */

    .score-container {
        text-align: center;
        margin-top: 20px;
    }

    .score-message {
        font-size: 18px;
        font-weight: bold;
    }

    .score {
        color: green;
    }

    .mark-percentage {
        color: blue;
    }

    .mark-percentage1 {
        color: red;
    }

    .timer {
        font-size: 36px;
        text-align: end;
        padding: 20px;
    }
    .question-container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    #navigation {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
    }
    .options label {
        display: block;
        margin: 10px 0;
    }

    .next-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .next-button:hover {
        background-color: #0056b3;
    }

</style>
<script type="text/javascript">
   
    function openFullWindow() {
        var newWindow = window.close('question?techid=7&userid=1 ', '_blank', 'width=' + screen.width + ',height=' + screen.height);
        newWindow.focus();
    }
</script>
<body class="sb-nav-fixed sb-sidenav-toggled">
    @if (@$res)
    <br>
    <br>
        <center>
            <h1 style="color:rgb(201, 114, 114)">{{ $res }}!!</h1>
        </center>
    <br>
    <br>
        <a  onclick="openFullWindow()"class="btn btn-info btn-block" ><i class="fa fa-backward" aria-hidden="true"></i> Back to Home Page</a>
    @endif
    @if (isset($ques))
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Questions
            </div>

            <div class="timer" id="timer" style=" color: red;font-weight:bold">00:00:00</div>

            <form method="post" action="submitexam">
                @csrf
                <input type="hidden" name="userid" value="{{ @$userid }}">
                @foreach ($ques as $s)
                <input type="hidden" name="techid" value="{{ $s->techid }}">
                    <div class="question-container" id="question_{{ $s->qid }}" style="display: none;">
                        <h3>Question: {{ $s->question }} ?</h3>
                        <ul class="list-unstyled options">
                            <li><input type="radio" name="question_{{ $s->qid }}" value="{{ $s->opt1 }}"> Option A: {{ $s->opt1 }}
                            </li><br>
                            <li><input type="radio" name="question_{{ $s->qid }}" value="{{ $s->opt2 }}"> Option B: {{ $s->opt2 }}
                            </li><br>
                            <li><input type="radio" name="question_{{ $s->qid }}" value="{{ $s->opt3 }}"> Option C: {{ $s->opt3 }}
                            </li><br>
                            <li><input type="radio" name="question_{{ $s->qid }}" value="{{ $s->opt4 }}"> Option D:{{ $s->opt4 }}
                            </li><br>
                        </ul>
                    </div>
                @endforeach
                    
                    <div id="navigation">
                        <button type="button" id="prevButton" class="btn btn-warning" >Previous</button>
                        <button type="button" id="nextButton" class="btn btn-info "  >Next</button>
                        <center><button type="submit" id="submitButton" class="btn btn-success" style="display: none;">Submit</button></center>
                    </div>


                    <input type="submit" class="btn btn-success btn-block" name="btn" id="btn"
                    style="float:right" value="Finish Exam">
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        </div>
        <form method="post" action="submitexam">
            @csrf
            <input type="hidden" name="userid" value="{{ @$userid }}">
            <tr>
                <td colspan="2">
                   
                </td>
            </tr>
        </form>
    @endif
    @if (@$msg)
        <div class="score-container">
            <p class="score-message">
                Your Score: <span class="score">{{ @$mark }}%</span><br>
                @if (@$mark >= 60)
                    <span class="mark-percentage">{{ @$msg }}</span>
                @else
                    <span class="mark-percentage1">{{ @$msg }}</span>
                @endif
            </p>
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
