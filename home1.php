<!DOCTYPE HTML>

<html>

<head>
  <title>Home</title>
 <link rel="stylesheet" href="home_style.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
    function logoutme()
    {
        //console.log("here");
        var dat=    {
                        "submit":true
                    };
            var tosend=JSON.stringify(dat);
         $.ajax({url: "includes/logout.inc.php", 
            type: "POST",
            data: tosend,
            success: function(result){
                console.log("done");
                window.location = "index.php";
        }});
     }

    </script>
</head>
<body>
    <div>

          <div class='container2'>
        <div>
            <img src='transparent logo.png' class='iconDetails'>
        </div>
    <div style='margin-left:100px;'>
<h1><font size="7" color="black" face="Segoe Print"><b>SEEK MY STUFF</b></font></h1><br>
</div>
</div>
<ul class="nav">

<li id='logout' onclick="logoutme()"><a href="includes/logout.inc.php">Log Out</a></li>
 <li><a href="upload.php">Upload Lost Item</a></li>
<li><a href="display.php">Find Your Item</a></li>

</ul>
<br>

<div class="container">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="carousel_imgs/carr3.jpg" style="width:100%;">
            </div>

            <div class="item">
                <img src="carousel_imgs/carr2.jpg" style="width:100%;">
            </div>

            <div class="item">
                <img src="carousel_imgs/lost1.png"  style="width:100%;">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
    </div>

</body>

</html>