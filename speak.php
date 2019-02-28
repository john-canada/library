<!doctype html>
<html>

<script type="text/javascript" src="https://code.responsivevoice.org/responsivevoice.js"></script>


<textarea id="text" row="100" col="400"></textarea><br>

<input onclick="speaktext();" type="button" value="speak">

<script>
function speaktext(){
    var text=document.getElementById("text").value;
    responsiveVoice.speak(text);
}
</script>
</html>

