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