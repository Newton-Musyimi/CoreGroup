<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <style>
        section {
            background-color: #80b8e9;
        }
    </style>
</head>
<body>
<section id="section">
    <h1>Heyyy</h1>
</section>

<button onclick="printPdf()">print</button>

<script>
    function printPdf() {
        // newWindow object can only be created by window.open()
        // in an event listener.
        // If we call it elsewhere, null will be returned
        const newWindow = window.open();

        // creating a new html node
        const html = document.createElement("html");

        // We can load the CSS by cloning the document head
        // NOTE: since we are going to move node to a foreign
        // window object, we need to clone the DOM nodes.
        // If we don't clone, the node in this original window
        // will disappear, because we have moved it to a new location.
        // cloneNode(true) will perform a deep clone
        const head = document.head.cloneNode(true);

        // creating a new body element for our newWindow
        const body = document.createElement("body");

        // grab the elements that you want to convert to PDF
        const section = document
            .getElementById("section")
            .cloneNode(true);

        // you can append as many child as you like
        // this is where we add our elements to the new window.
        body.appendChild(section);

        html.appendChild(head);
        html.appendChild(body);

        // write content to the new window's document.
        newWindow.document.write(html.innerHTML);

        // close document to stop writing
        // otherwise new window may hang
        newWindow.document.close();

        // print content in new window as PDF
        newWindow.print();

        // close the new window after printing
        newWindow.close();
    }
</script>
</body>
</html>