<?php

?>
<!doctype  html>
<html lang="sk">
<head>
    <title>Zadanicko 6</title>
    <meta charset="utf-8">
    <meta name="description" content="Webtech assignment 2021 FEI STU">
    <meta name="author" content="Rastislav Kopál">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>

<?php include('./views/header.php') ?>

<section id="section-main">
    <form id="formSearchByDate" class="mx-3 my-3 w-25">
        <b>Vyhladaj mena podla datumu:</b>
        <div class="form-group">
            <label for="search_date_date" class="my-3">Datum</label>
            <input type="text" class="form-control" id="search_date_date" placeholder="0113" value="11.11.">
        </div>
        <button id="buttonSearchByDate" onclick="searchByDate()" type="button" class="btn btn-primary">Vyhladaj</button>
    </form><hr>


    <form id="formSearchByNameState" class="mx-3 my-3 w-25">
        <b>Vyhladaj datum podla mena a krajiny:</b>
        <div class="form-group">
            <label for="search_name">Meno</label>
            <input type="text" class="form-control" id="search_name"  placeholder="Lukáš">
        </div>
        <div class="form-group">
            <label for="search_state">Krajina (CZ,SK,PL,AT, HU)</label>
            <input type="text" class="form-control" id="search_state" placeholder="SK">
        </div>
        <button  id="buttonSearchByName" onclick="searchByNameState()" type="button" class="btn btn-success">Vyhladaj</button>
    </form><hr>


    <form id="formSearchHolidays" class="mx-3 my-3 w-25">
        <b>Zoznam sviatkov pre krajinu:</b>
        <div class="form-group">
            <label for="search_holidays" class="my-3">Krajina (SK alebo CZ)</label>
            <input type="text" class="form-control" id="search_holidays" placeholder="0113" value="SK">
        </div>
        <button id="buttonSearchHolidays" onclick="searchHolidays()" type="button" class="btn btn-danger">Vyhladaj</button>
    </form><hr>


    <form id="formSearchMemorials" class="mx-3 my-3 w-25">
        <b>Zoznam SK pamatnych dni:</b><br>
        <button id="buttonSearchMemorials" onclick="searchMemorials()" type="button" class="btn btn-warning">Vyhladaj</button>
    </form><hr>


    <form id="formAddNameday" class="mx-3 my-3 w-25">
        <b>Pridaj nove meniny:</b>
        <div class="form-group">
            <label for="add_name">Meno</label>
            <input type="text" class="form-control" id="add_name" name="add_name" placeholder="Matúš">
        </div>
        <div class="form-group">
            <label for="add_date">Den</label>
            <input type="text" class="form-control" id="add_date" name="add_date" placeholder="13.1.">
        </div>
        <button onclick="addNameday()" type="button" class="btn btn-info">Pridaj</button>
    </form><hr>

</section>

<?php include('./views/footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script src="./assets/js/myscript.js"></script>
</body>
</html>