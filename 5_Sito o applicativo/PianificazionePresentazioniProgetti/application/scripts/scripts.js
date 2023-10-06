const appUrl = "http://localhost:8080/PianificazionePresentazioniProgetti/"

const idHours = {
    1: "08:20 - 09:05",
    2: "09:05 - 10:05",
    3: "10:05 - 10:50",
    4: "10:50 - 11:35",
    5: "11:35 - 12:30",
    6: "12:30 - 13:15",
    7: "13:15 - 14:00",
    8: "14:00 - 15:00",
    9: "15:00 - 15:45",
    10: "15:45 - 16:30"
};

$(function () {
    $('input[name="daterange"]').daterangepicker();
});
window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

function colorBtn($id) {
    var col = document.getElementById($id).style.background;
    var el = document.getElementById($id);

    if (col == "white") {
        col = "#337DFF";
        bordCol = "337DFF"
        el.setAttribute("name", "selected");
        document.getElementById($id).style.borderBottom = "thick solid " + col;
    } else {
        col = "white";
        el.setAttribute("name", "unselected");
        document.getElementById($id).style.borderBottom = "none";

    }
    document.getElementById($id).style.background = col;
}


function wrapData($el) {

    if ($el == "general") {


        var year = document.getElementById("year").value;
        var session = document.getElementById("session").value;
        var projManager = document.getElementById("projManager").value;
        var chief = document.getElementById("chief").value;

        date = document.getElementById("startEnd").value;
        date = date.split("-");
        var startDate = date[0];
        var endDate = date[1];

        var data = {
            year: year,
            session: session,
            projManager: projManager,
            chief: chief,
            startDate: startDate,
            endDate: endDate,
        };
        sendData("GeneralController/addInfo", data);


    } else if ($el == "classroom") {

        var classromNumber = document.getElementById("classroomNumber").value;
        var wifi = document.getElementById("wifi").checked;
        var ids = getSelectedHours();

        var data = {
            classromNumber: classromNumber,
            wifi: wifi,
            ids: ids,
        };
        sendData("ClassroomController/addClassroom", data);

    } else if ($el == "class") {
        var className = document.getElementById("className").value;
        var ids = getSelectedHours();

        var data = {
            className: className,
            ids: ids,
        };
        sendData("SchoolClassController/addClass", data);

    } else if ($el == "teacher") {
        var name = document.getElementById("name").value;
        var lastname = document.getElementById("lastname").value;
        var email = document.getElementById("email").value;
        var ids = getSelectedHours();

        var data = {
            name: name,
            lastname: lastname,
            email: email,
            ids: ids,
        };
        sendData("TeacherController/addTeacher", data);

    } else if ($el == "student") {

        var name = document.getElementById("name").value;
        var lastname = document.getElementById("lastname").value;
        var email = document.getElementById("email").value;
        var projName = document.getElementById("projName").value;
        var studClass = getValueFromDropD("studClass");
        var projTeach = getValueFromDropD("projTeach");

        var data = {
            name: name,
            lastname: lastname,
            email: email,
            projName: projName,
            studClass: studClass,
            projTeach: projTeach,
        };
        sendData("StudentController/addStudent", data);

    }
}


/**
 * This function it's built to return the value of the selected element in a 
 * select HTML input.
 * @param id it's the id of the select input
 * @returns 
 */
function getValueFromDropD(id) {
    var select = document.getElementById(id);
    var value = select.options[select.selectedIndex].value;
    return value;
}

/**
 * This function allow to obtain the selected cell in the html table.
 * Then it calls the function to get di actual day and time span
 * @returns the array with the id of the selected cells
 */
function getSelectedHours() {
    var selectedHours = document.getElementsByName("selected");
    var ids = new Array();
    for (var i = 0; i < selectedHours.length; i++) {
        ids.push(selectedHours[i].getAttribute("id"));
    }
    var ids = getTimeSpanFromId(ids);
    return ids;
}

/**
 * This function send the provided data to provided controller in the backend.
 * @param controllerUrl the controller
 * @param data the data to send
 */
function sendData(controllerUrl, data) {

    var xhr = new XMLHttpRequest();
    xhr.open("POST", appUrl + controllerUrl, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var response = this.responseText;
            console.log(this.responseText);
            if (response.includes("<td>")) {
                localStorage.removeItem("table");
                localStorage.setItem("table", this.responseText)

            } else {
                location.reload();

            }
        }
    };
    xhr.send(JSON.stringify(data));
}

/**
 * This function allow to convert the html table ids into a day and time.
 * @param {*} ids the id(s) to convert
 * @returns a matrix with the converted value ([dayNumber],[timespan])
 */
function getTimeSpanFromId(ids) {
    var dayHour = new Array();
    for (var i = 0; i < ids.length; i++) {
        dayHour.push(ids[i].split("."));
        dayHour[i][1] = idHours[dayHour[i][1]];
    }
    return dayHour;
}

/**
 * This function allows to generete the planning.
 */
function generatePlanning() {
    $data = sendData("PlanningController/generatePlanning", null);
}
