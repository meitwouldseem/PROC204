
<head>
    
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-light navbar-fixed-top" style="background-color: #e3f2fd;">
            <form class="form-inline">
                <a class="btn btn-outline-white" role="button">Enter data</a>
                <a class="btn btn-outline-white" role="button">View Data</a>
                <a class="btn btn-outline-white" role="button">View Calendar</a>
            </form>
        </nav>
        <h1></h1>
        <h2></h2>
    </div>

    <div class="container">
        <main role="main" class="pb-3">
        </main>
    </div>

    <script src="~/lib/jquery/dist/jquery.min.js"></script>
    <script src="~/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="~/js/site.js"></script>
</body>
</html>



<div class="container">
    <form asp-controller="Order" asp-action="EditOrder" method="post">

        <input type="datetime-local" id="datetime"
               name="datetime"
               min="datetime">
        <script>
            var string = new Date().toISOString().substring(0, 16);
            document.getElementById("datetime").value = string;
        </script>
        <div class="row">
            <div class="col-6">
                <h1 class="text-right">Sleep start</h1>
                <input type="datetime-local" id="datetime"
                       name="datetime"
                       min="datetime">
            </div>
            <div class="col-6">
                <h1 class="text-left">Wake up</h1>
                <select class="custom-select" name="EndHour">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="1">10</option>
                    <option value="1">11</option>
                    <option value="1">12</option>
                </select>
                <select class="custom-select" name="EndMin">
                    <option value="0">00</option>
                    <option value="1">10</option>
                    <option value="2">20</option>
                    <option value="3">30</option>
                    <option value="4">40</option>
                    <option value="5">50</option>
                </select>
                <select class="custom-select" name="EndAP">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="input-group input-group-sm mb-3 col-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">User ID</span>
                </div>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <input class="btn btn-primary" name="Submit" type="submit" value="Submit">
            </div>
            <div class="col-4"></div>
        </div>
    </form>
</div>
