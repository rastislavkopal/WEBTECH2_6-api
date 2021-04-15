$(document).ready( function () {

} );

var countries = {
    "SK": "Slovensko",
    "PL": "Polsko",
    "HU": "Maďarsko",
    "AT": "Rakúsko",
    "CZ": "Česko"
}

function displayMessage(response)
{
    if($('#uploader_div').css('display') != 'none')
        $('#uploader_div').hide('slow');
    var message = $('<div class="alert alert-error error-message" style="display: none;">');
    var close = $('<button type="button" class="close" data-dismiss="alert">&times</button>');
    message.append(close); // adding the close button to the message
    message.append(response);
    message.appendTo($('body')).fadeIn(300);
}

// date like 25.11. -> 2511 -> 1125
//           25.1.  -> 251  ->  125
function convertDateToNumeric(date)
{
    date = date.split('.').join('');
    let newDate;

    if (date.length == 3){ // date was with one digit month
        newDate = date.substr(2, 1);
    } else { // two digit month
        newDate = date.substr(2, 2);
    }
    newDate += date.substring(0, 2);
    return newDate;
}


function searchByDate()
{
    let date = $("#search_date_date").val().toString();
    let newDate = convertDateToNumeric(date);


    $.get("https://wt78.fei.stuba.sk/zadanie6/api/search/date/" + newDate,
        function (data) {
            json = data.namedays;
            let rawStr = "";
            for(var k in json)
                rawStr += "Krajina: " + countries[json[k].country] + " , meno: " + json[k].name + "<br>";

            displayMessage(rawStr)
        });
}


function searchByNameState()
{
    let name = $("#search_name").val();
    let state = $("#search_state").val();
    $.get("https://wt78.fei.stuba.sk/zadanie6/api/search/name/" + name + "/state/" + state,
        function (data) {
            json = data.meniny;
            displayMessage(name + " má meniny " + json);
        });
}

function searchHolidays()
{
    let country = $("#search_holidays").val();
    $.get("https://wt78.fei.stuba.sk/zadanie6/api/search/holidays/" + country,
        function (data) {
            json = data.holidays;
            let rawStr = "";

            for(var k in json)
                rawStr += "Dňa: " + json[k].day + " je voľnoo: " + json[k].name + "<br>";

            displayMessage(rawStr)
        });
}

function searchMemorials()
{
    $.get("https://wt78.fei.stuba.sk/zadanie6/api/search/memorials/",
        function (data) {
            json = data.memorial_days;
            let rawStr = "";

            for(var k in json)
                rawStr += "Dňa: " + json[k].day + " je pamätný deň: " + json[k].name + "<br>";
            displayMessage(rawStr)
        });
}

function addNameday()
{
    let data = $('#formAddNameday').serializeArray();

    let date = $("#add_date").val().toString();
    data[1].value = convertDateToNumeric(date);

    $.ajax({
        url: 'https://wt78.fei.stuba.sk/zadanie6/api/add/',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: response => {
            if (response == 1){
                displayMessage("Úspešne pridané");
            } else {
                displayMessage("OOoopps, niečo sa nepodarilo...");
            }

        }
    });
}
