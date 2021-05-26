var dropDowm=document.querySelector("select");
dropDowm.addEventListener("change",function(){
    let cat=dropDowm.options[dropDowm.selectedIndex].text;
    alert(cat);
    // httpReques=new XMLHttpRequest();
    // httpReques.onreadystatechange=function(){
    //     if(this.state==4 && this.status==200){
    //         console.log();
    //     }
    // }
    // httpReques.open("POST","search.php")
    // xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
    // xhttp.send("cat="+data+"");
});