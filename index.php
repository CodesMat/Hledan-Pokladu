<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <canvas width="300" height="300" id="platno"></canvas>
    </div>
    <script>
        var counter = 0;
        var poziceVyhry = [];
        var c = document.getElementById("platno");
        var ctx = c.getContext("2d");
        var konec = true;

        var velikostArr = 10;
        var array = Array(velikostArr).fill().map(() => Array(velikostArr).fill(0));
        zacniHru();
        
         c.addEventListener('mousedown', function(e) {
            const rect = c.getBoundingClientRect()
            const x = e.clientX - rect.left
            const y = e.clientY - rect.top
            for (let i = 0; i < array.length; i++) {
                for (let j = 0; j < array.length; j++) {
                    if((29*i+5) <= x && x <= (29*(i+1)+5) && (29*j+5) <= y && y <= (29*(j+1)+5)) {
                        if(array[i][j] == 1) {
                            ctx.fillStyle = "BLACK";
                                    ctx.font = "15px Arial";
                                    ctx.fillText("👑", i*29+10, j*29+29);
                                    alert("Konec hry --> počet tahů: " + counter);
                        }else {
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
        });

        function zacniHru() {
            ctx.beginPath();
            ctx.fillStyle = "gray";
            ctx.fillRect(0, 0, 300, 300);
            var x = Math.floor(Math.random()*velikostArr);
            var y = Math.floor(Math.random()*velikostArr);
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
</body>
</html>