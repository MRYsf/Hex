@extends('layouts.app')

@section('content')
<section class="Gameplay" style="display: none;">
<!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Topbar
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <nav class="topbar topbar-expand-md topbar-nav-centered">
        <div class="container">
          
          <div class="topbar-left">
            <button class="topbar-toggler">&#9776;</button>
            <a class="topbar-brand" href="index.html">

            </a>
          </div>

   

          <div class="topbar-right">
            <button class="drawer-toggler ml-12" style="color: white;">&#9776;</button>
          
<div class="drawer">
      <div class="drawer-content">
      <button class="drawer-close"></button>
      <div class="drawer-backdrop"></div>
      <br>
      <br>
<form name="OptionsForm">
  <div align="center">
 <div>   
     <input type="button" class="btn btn-primary" value="NEW" onclick="javascript:Init()">
     <input type="button" class="btn btn-primary" value="HELP" onclick="javascript:Help()" name="HelpButton">
</div>
   
             
        <hr>


   
<div>
      <input type="radio" name="Blue" value="Blue: Player" onclick="javascript:SetOption(1,0)"> Blue: Player
      <input type="radio" name="Blue" checked="" value="Blue: Computer" onclick="javascript:SetOption(1,1)"> Blue: Computer

</div>
   
             
        <hr>

        <div>
          <input type="radio" name="Start" checked="" value="Red" id="Red" onclick="javascript:SetOption(2,1)"> Red begins
          <input type="radio" name="Start" value="Blue" id="blue" onclick="javascript:SetOption(2,0)"> Blue begins
    </div>
        
         <hr>
<div>        
      <input type="checkbox" name="Swap" > swap rule
</div>
   
             
        <hr>

    
<div>
      <input type="button" class="btn btn-outline btn-primary px-10" value="<<" onclick="javascript:Back();Back()" title="two moves back">
      <input type="button" class="btn btn-outline btn-primary px-10" value="<" onclick="javascript:Back()" title="one move back">
      <input type="button" class="btn btn-outline btn-primary px-10" value=" 0 " disabled="" name="Moves">
      <input type="button" class="btn btn-outline btn-primary px-10" value=">" onclick="javascript:Replay()" title="one move forward">
      <input type="button" class="btn btn-outline btn-primary px-10" value=">>" onclick="javascript:Replay();Replay()" title="two moves forward">

</div>
   
             

<br>

     
</div>
    </div>
  </div>
</nav>
    <!------------->


    <header class="header  h-fullscreen p-0 bg-primary overflow-hidden" style="background-image: linear-gradient(to right, #434343 0%, black 100%);">
      <canvas class="constellation"></canvas>

      <div class="container text-center">


<br>
<br>

     
<div align="center">
  <input class="bg-dark d-inline-block text-center " size="18" name="Msg" readonly="">
  <td>&nbsp;</td>
<table noborder="">
<tbody><tr>
  <td><table border="0" cellpadding="10" cellspacing="10" ><tbody><tr><td align="center"><font size="1">
      <script language="JavaScript">
      k=0;
      for (i=0; i < Size-1; i++)
      { document.write("<nobr>");
        for (j=0; j <= i; j++)
        { document.write("<IMG src=\"white.png\" border=0 onMouseDown=\"Clicked("+eval(i-j)+","+j+")\" title='"+String.fromCharCode(65+j)+eval(i-j+1)+"' alt='"+String.fromCharCode(65+j)+eval(i-j+1)+"'>");
          ImgNum[i-j][j]=k++;
        }
        document.writeln("</nobr><br>");
      }
      for (i=Size-1; i >= 0; i--)
      { document.write("<nobr>");
        for (j=0; j <= i; j++)
        { document.write("<IMG src=\"white.png\" border=0 onMouseDown=\"Clicked("+eval(Size-1-j)+","+eval(Size-1-i+j)+")\" title='"+String.fromCharCode(65+Size-1-i+j)+eval(Size-j)+"' alt='"+String.fromCharCode(65+Size-1-i+j)+eval(Size-j)+"'>");
          ImgNum[Size-1-j][Size-1-i+j]=k++;
        }
        document.writeln("</nobr><br>");
      }
      </script>

      </font></td></tr></tbody></table>
  </td>
  <td>&nbsp;</td>
 

</tr>
</tbody></table>



</form>
</div>




 </div>
    </header>
</section>

<section  class="coinplay">
       <header class="header  h-fullscreen p-0 bg-primary overflow-hidden"style="background-image: linear-gradient(to right, #434343 0%, black 100%);">
      <canvas class="constellation"></canvas>

<div class='container1'>
  <h1 style="color: white;">Chose your Bet :</h1>
  <div>
      <input type="radio" name="chosecoin" checked="" value="heads" id="head"> HEADS
      <input type="radio" name="chosecoin" value="tails" id="tail" > TAILS
  </div>
  <div id="coin"  class=''>
    <div id="heads" class="heads"></div>
    <div id="tails" class="tails"></div>
  </div>
  <button class="btn btn-outline btn-primary px-10" id="flip" >Flip this thing</button>
  <p><span id="status"></span></p>
</div>
</header>
</section>


<script language="JavaScript">

  const coin = document.querySelector('#coin');
const button = document.querySelector('#flip');
const status = document.querySelector('#status');
let headsCount = 0;
let tailsCount = 0;


function deferFn(callback, ms) {
  setTimeout(callback, ms); 
}

function processResult(result) {
    
    const rbs = document.querySelectorAll('input[name="chosecoin"]');
    let selectedValue;
    for (const rb of rbs) {
      if (rb.checked) {
        selectedValue = rb.value;
        break;
      }
    }

   if (result === selectedValue) {
    startgame(1);
    } else {
      document.getElementById("blue").checked = true;
      startgame(0);

    }
    status.innerText = result.toUpperCase();
}

function flipCoin() {
  document.getElementById("head").disabled = true;
  document.getElementById("tail").disabled = true;
  coin.setAttribute('class', '');
  const random = Math.random();
  const result = random < 0.5 ? 'heads' : 'tails';
  deferFn(function() {
   coin.setAttribute('class', 'animate-' + result);
   deferFn(processResult.bind(null, result), 2900);
 }, 100);
}

function startgame(Playertostart){
  $('.coinplay').hide();
  $('.Gameplay').show(); 
  SetOption(2,Playertostart);
  Init();
  setInterval("Timer()",300);
}

button.addEventListener('click', flipCoin);





</script>

@endsection
