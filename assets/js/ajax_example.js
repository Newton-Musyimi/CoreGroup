//document.getElementById("fire_employee_button").onclick = (function(){
window.onclick = function(event) {
    const id = 15;


    // When the document loads, it populates the table with data from the database
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const myObj = JSON.parse(this.responseText);
            Document.getElementById('employee_id').placeholder = myObj.id;
            Document.getElementById('employee_name').placeholder = myObj.name;
            Document.getElementById('employee_position').placeholder = myObj.position;
            Document.getElementById('employee_email').placeholder = myObj.email;
            Document.getElementById('employee_mobile').placeholder = myObj.mobile;
            Document.getElementById('employee_age').placeholder = myObj.address;
        }
    }
    xmlhttp.open("GET", "php/employee_profile.php?id=" + id, true);
    xmlhttp.send();
};