
// timer for exam  
const timerElement = document.getElementById('timer');

function startExamTimer(durationInSeconds) {
    let timeRemaining = durationInSeconds;

    function updateTimerDisplay() {
        const hours = Math.floor(timeRemaining / 3600);
        const minutes = Math.floor((timeRemaining % 3600) / 60);
        const seconds = timeRemaining % 60;
        timerElement.textContent =
            `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    function countdown() {
        if (timeRemaining > 0) {
            timeRemaining--;
            updateTimerDisplay();
        } else {
            clearInterval(interval);
            timerElement.textContent = `Time's up!`;
            document.getElementById('btn').click();
        }
    }

    updateTimerDisplay();
    const interval = setInterval(countdown, 1000); // Update every second
}

    var scheduleTimeInSeconds = 60 * 2;
    startExamTimer(scheduleTimeInSeconds);

//for pickup questions  
    var currentQuestion = 0;
    var questions = document.getElementsByClassName("question-container");
    console.log(questions);
    var prevButton = document.getElementById("prevButton");
    var nextButton = document.getElementById("nextButton");
    var submitButton = document.getElementById("submitButton");

    function showQuestion(questionIndex) {
        for (var i = 0; i < questions.length; i++) {
            questions[i].style.display = "none";
        }
        questions[questionIndex].style.display = "block";
        currentQuestion = questionIndex;

        if (currentQuestion === 0) {
            prevButton.style.display = "none";
        } else {
            prevButton.style.display = "block";
        }

        if (currentQuestion === questions.length - 1) {
            nextButton.style.display = "none";
            submitButton.style.display = "block";
        } else {
            nextButton.style.display = "block";
            submitButton.style.display = "none";
        }
    }

    prevButton.addEventListener("click", function () {
        showQuestion(currentQuestion - 1);
    });

    nextButton.addEventListener("click", function () {
        showQuestion(currentQuestion + 1);
    });

    showQuestion(0);
