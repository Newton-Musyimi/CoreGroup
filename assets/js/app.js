function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

//make current page button active
window.onload = function () {
    document.getElementById("defaultOpen").click();
}

let acc = document.getElementsByClassName("accordion");
let i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        let panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}

let today = new Date().toISOString().split('T')[0];
let dateToday = document.getElementsByClassName("date-today");

for (i = 0; i < dateToday.length; i++) {
    dateToday[i].setAttribute('min', today);
}

/*
let j;
let wo_view_button = document.getElementsByClassName("work_order_view_button");

for (j = 0; j < wo_view_button.length; j++) {
    wo_view_button[j].addEventListener("submit", function (e) {
        e.preventDefault();

    });
}

/*

let work_order_view_button = document.getElementsByClassName("accordion");
let j;

for (j = 0; j < work_order_view_button.length; i++) {
    work_order_view_button[j].addEventListener("click", function() {
        this.classList.toggle("active");
        //let button = this.submitter;
        let panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}


let postObj = {
    id: Math.random(),
    title: document.querySelector('#post-title').value,
    body: document.querySelector('#post-body').value
}
let post = JSON.stringify(postObj)

const url = "https://jsonplaceholder.typicode.com/posts"
let xhr = new XMLHttpRequest()

xhr.open('POST', url, true)
xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
xhr.send(post);

xhr.onload = function () {
    if(xhr.status === 201) {
        console.log("Post successfully created!")
    }
}



 */