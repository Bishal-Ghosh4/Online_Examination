<html>



<body style="color: black;display: table;font-family: Georgia, serif;font-size: 24px;text-align: center;">
    <div class="container"
        style=" border: 9px solid #7559ae; width: 700px;
    height: 563px;background-color: #5f9ea024; ">
        <div class="logo" style="color: tan;">
            An Organization
            {{-- <p><img src="{{asset('/img/csm.png')}}" alt="Signature" ></p> --}}
        </div>

        <div class="marquee" style=" color: rgb(169, 230, 71);font-size: 48px;margin: 20px;">
            Certificate of Completion
        </div>

        <div class="assignment" style="margin: 20px;">
            This certificate is presented to
        </div>

        <div class="person"
            style="border-bottom: 2px solid black;
        font-size: 32px;
        font-style: italic;
        margin: 20px auto;
        width: 400px;">
            {{ $name }}
        </div>

        <div class="reason" style="margin: 20px;">
            <p>has successfully completed and passed the</p>
            <h3><em>{{ $technology }} Exam</em></h3>
            <p>With the scored : {{ $mark }}%</p>
        </div>

        <div class="date" style="bottom: 40px;float: left;">
            <p class="date"> Issued date: <em>{{ date('F j, Y') }}</em></p>
        </div>
        <div class="signature" style="bottom: 40px;float: right;">
           <p><img src="public_path('img/signature.png') " style="max-width: 150px;" alt="Signature "></p>
          
        </div>
    </div>
</body>

</html>
