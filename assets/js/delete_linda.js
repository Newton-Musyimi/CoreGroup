//document.getElementById("fire_employee_button").onclick = (function(){
    window.onclick = function(event){
        const id = 15;
    
    
        // When the document loads, it populates the table with data from the database
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.responseType = 'text';
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState === xmlhttp.DONE) {
                Document.getElementById('message').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST","php/fire_linda.php?id="+ id,true);
        xmlhttp.send();
    };