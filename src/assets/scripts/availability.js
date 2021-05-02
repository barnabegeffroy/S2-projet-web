Date.prototype.addDays = function (days) {
    var dat = new Date(this.valueOf())
    dat.setDate(dat.getDate() + days);
    return dat;
}

function getDates(startDate, stopDate) {
    var dateArray = new Array();
    var currentDate = startDate;
    while (currentDate <= stopDate) {
        dateArray.push(currentDate)
        currentDate = currentDate.addDays(1);
    }
    return dateArray;
}

function validateForm(duree) {
    var v = document.forms["resa"]["dates"].value;
    var dateArray = new Array();
    if (v.indexOf(' - ') > -1) {
        d = v.split(' - ');
        start = d[0].split('/');
        end = d[1].split('/');
        dateArray = getDates(
            new Date(parseInt(start[2]),
                parseInt(start[1]) - 1,
                parseInt(start[0])),
            new Date(parseInt(end[2]),
                parseInt(end[1]) - 1,
                parseInt(end[0])));
        if (dateArray.length > duree) {
            alert("Vous devez respecter le nombre de jours maximal pour cet objet");
            return false;
        }
    } else if (v.length > 0) {
        date = v.split('/');
        dateArray = [new Date(parseInt(date[2]),
            parseInt(date[1]) - 1,
            parseInt(date[0]))];
    } else
        return false;
    for (i = 0; i < dateArray.length; i++) {
        if (eventDates[dateArray[i]] !== undefined) {
            alert("Vous ne pouvez choisir une date déjà réservée");
            return false;
        }
    }
}

function checkResa(duree) {
    var eventDates = {};
    datas = document.forms["declineResa"]["resaDates"].value.split(" ");
    datas.forEach(element => {
        eventDates[new Date(element)] = new Date(element);
    });
    var v = document.forms["declineResa"]["message"].value;
    var dateArray = new Array();
    if (v.indexOf(' - ') > -1) {
        console.log("Run condition");
        d = v.split(' - ');
        start = d[0].split('/');
        end = d[1].split('/');
        dateArray = getDates(
            new Date(parseInt(start[2]),
                parseInt(start[1]) - 1,
                parseInt(start[0])),
            new Date(parseInt(end[2]),
                parseInt(end[1]) - 1,
                parseInt(end[0])));
        document.forms["addResa"]["start"].value = [start[2], start[1], start[0]].join('-');
        document.forms["addResa"]["end"].value = [end[2], end[1], end[0]].join('-');
        if (dateArray.length > duree) {
            document.forms["declineResa"]["message"].value = "Vous devez respecter le nombre de jours maximal pour cet objet";
            document.forms["declineResa"].submit();
        }
    } else if (v.length > 0) {
        date = v.split('/');
        dateArray = [new Date(parseInt(date[2]),
            parseInt(date[1]) - 1,
            parseInt(date[0]))];
        document.forms["addResa"]["start"].value = [date[2], date[1], date[0]].join('-');
        document.forms["addResa"]["end"].value = document.forms["addResa"]["start"].value;
    }
    for (i = 0; i < dateArray.length; i++) {
        if (eventDates[dateArray[i]] !== undefined) {
            document.forms["declineResa"]["message"].value = "Vous ne pouvez choisir une date déjà réservée";
            document.forms["declineResa"].submit();
        }
    }
}

function check(input) {
    if (input.value != document.getElementById('password').value) {
        input.setCustomValidity('Les mots de passes ne sont pas identiques');
    } else {
        // input is valid -- reset the error message
        input.setCustomValidity('');
    }
}