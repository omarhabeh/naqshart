<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div style="text-align: center">
    <h1>process Fail  <h1>
        <br>
    <h1>{{$msg}}</h1>
  

</div>


<script>
x=document.getElementById('timer')
step=10
setInterval(() => {
    x.innerHTML=step--;
    }, 1000);

setTimeout(()=>{
    location.href="/checkout";
},3*1000);

</script>


</body>
</html>
