// JavaScript source code

document.write(`
<head>
        <style>

            body {
                font-family: "Lato", sans-serif;
            }

            .sidenav {
                height: 100%;
                width: 210px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                padding-top: 20px;
            }

            .sidenav a {
                padding: 6px 8px 90px 16px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

        </style>
    </head>
    <body>

        <div class="sidenav">
            <a href="./homepage.html">Home</a>
            <a href="./students.php">Students</a>
            <a href="./subcommitees.php">Subcommitees</a>
            <a href="./sponsors.php">Sponsors</a>
            <a href="./conference_attendees.php">Conference Attendees</a>
            <a href="./schedule.php">Schedule</a>
            <a href="./professionals.php">Professionals</a>
        </div>

    </body>
<head>
<style>

body {
	font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
}

.main {
	margin-left: 210px; /* Same as the width of the sidenav */
	font-size: 28px; /* Increased text to enable scrolling */
	padding: 0px 10px;
}

</style>
</head>
`);
