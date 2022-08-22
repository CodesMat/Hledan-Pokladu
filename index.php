<?php
include_once 'db.php'; 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>

<style type="text/css">
    canvas {
    }
    #end{text-align: center;


    }
    #cont{
        margin: 0 auto;width:40%;}
</style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <!--cookies--> <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.js" integrity="sha512-DJw15+xxGmXB1/c6pvu2eRoVCGo5s6rdeswkFS4HLFfzNQSc6V71jk6t+eMYzlyakoLTwBrKnyhVc7SCDZOK4Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div id="cont">
        <canvas width="300" height="300" id="platno"></canvas>
    </div>
    <div id="end"></div>
    <script>
        //nastaveni zalk prom
        var counter = 0;
        var poziceVyhry = [];
        var c = document.getElementById("platno");
        var ctx = c.getContext("2d");
        var konec = false;

        var velikostArr = 10;
        var array = Array(velikostArr).fill().map(() => Array(velikostArr).fill(0));
        zacniHru();
        console.log(konec);
        
         c.addEventListener('mousedown', function(e) {
            const rect = c.getBoundingClientRect()
            if(konec ==false){

            const x = e.clientX - rect.left
            const y = e.clientY - rect.top
            for (let i = 0; i < array.length; i++) {
                for (let j = 0; j < array.length; j++) {
                    if((29*i+5) <= x && x <= (29*(i+1)+5) && (29*j+5) <= y && y <= (29*(j+1)+5)) {
                        if(array[i][j] == 1) {
                            ctx.fillStyle = "RED";
                                    ctx.font = "15px Arial";
                                    ctx.fillText("👑", i*29+10, j*29+29);

                                    document.getElementById("end").textContent = 'Konec hry --> počet tahů:'  + counter;
                                    document.getElementById("end").innerHTML = "<button onClick='document.location.reload(true)'>Začít novou hru</button>";
                                    //document¨.getElementById("end");
                                    //alert("Konec hry --> počet tahů: " + counter);
                                    konec = true;
                                      Cookies.set('tahy',counter,{expires:1});
                                  

                        }else
                         {
                            if(i == poziceVyhry[0]) {
                                if (j < poziceVyhry[1]) {
                                    ctx.fillStyle = "BLACK";
                                    ctx.font = "30px Arial";
                                    ctx.fillText("J", i*29+10, j*29+29);
                                }else {
                                    ctx.fillStyle = "BLACK";
                                    ctx.font = "30px Arial";
                                    ctx.fillText("S", i*29+10, j*29+29);
                                }
                            }

                            if(j == poziceVyhry[1]) {
                                if (i < poziceVyhry[1]) {
                                    ctx.fillStyle = "BLACK";
                                    ctx.font = "30px Arial";
                                    ctx.fillText("Z", i*29+10, j*29+29);
                                }else {
                                    ctx.fillStyle = "BLACK";
                                    ctx.font = "30px Arial";
                                    ctx.fillText("V", i*29+10, j*29+29);
                                }
                            }
                            if(i < poziceVyhry[0] && j < poziceVyhry[1]) {
                                ctx.fillStyle = "BLACK";
                                    ctx.font = "15px Arial";
                                    ctx.fillText("JV", i*29+10, j*29+29);
                            }
                            if(i > poziceVyhry[0] && j > poziceVyhry[1]) {
                                ctx.fillStyle = "BLACK";
                                    ctx.font = "15px Arial";
                                    ctx.fillText("SZ", i*29+10, j*29+29);
                            }
                            if(i < poziceVyhry[0] && j > poziceVyhry[1]) {
                                ctx.fillStyle = "BLACK";
                                    ctx.font = "15px Arial";
                                    ctx.fillText("SV", i*29+10, j*29+29);
                            }
                            if(i > poziceVyhry[0] && j < poziceVyhry[1]) {
                                ctx.fillStyle = "BLACK";
                                    ctx.font = "15px Arial";
                                    ctx.fillText("JZ", i*29+10, j*29+29);
                            }
                        }
                    }                    
                }
            }
            counter++;
        }//konec
        else{
        }
        });


        function zacniHru() {
            var konec = false;
            console.log(konec)
            ctx.beginPath();
            ctx.fillStyle = "gray";
            ctx.fillRect(0, 0, 300, 300);
            var x = Math.floor(Math.random()*velikostArr);
            var y = Math.floor(Math.random()*velikostArr);
            //vypsaná lokace pokladu
            console.log(x+", "+y);
            array[x][y] = 1;
            poziceVyhry = [x,y];
            vykresliPole();
        }

        function vykresliPole() {
            for (let i = 0; i < array.length; i++) {
                for (let j = 0; j < array.length; j++) {
                    ctx.fillStyle = "white";
                    ctx.fillRect(29*i+5,29*j+5,28,28);
                }
            }
        }

    </script>

    <?php
    //ukladani skore do db
    $tahy = $_COOKIE['tahy'];
$sql = "INSERT INTO uzivatele (email,heslo,pole,tahy) VALUES
 ('honzaport@seznam.cz','[value-2]','10x10', $tahy);";
if ($conn->query($sql) === TRUE) {
  echo "zaznamenalo se to";
}

      ?>

</body>
</html>
