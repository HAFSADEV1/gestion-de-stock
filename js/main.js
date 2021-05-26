var dropDowm=document.querySelector("select");
var table=document.querySelector("tbody");
dropDowm.addEventListener("change",function(){
    let cat=dropDowm.options[dropDowm.selectedIndex].text;
    var xhttp =new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
      if (this.readyState==4 && this.status==200){
         table.insertAdjacentHTML('beforeend', this.responseText);
         //alert("test");
      }
    }
    xhttp.open("POST","search.php");
    xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
    xhttp.send("cat="+cat+"");

});
