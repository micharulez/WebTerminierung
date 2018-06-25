<?php
include_once ("php/quotes.php");
include_once ("php/db_link.php");
ensure_table_exists();
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Lauftracker</title>

</head>

<body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!--NAVIGATIONSLEISTE -->
  <!-- Beim Verkleinern des Fensters erscheint links oben ein Button,
  unter dem nach Klicken die Menüpunkte untereinander angezeigt werden-->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">Lauftracker</a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Start <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="statistik.php">Statistik</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- graues Feld mit Sprüchen-->
  <div class="p-3 mb-2 bg-secondary text-white">
    <h2>
      <p class="text-center">
        
        <?php
        echo $quotes[array_rand ( $quotes, 1)];
        ?>
        
      </p>
    </h2>
  </div>

  <!--Neuen Lauf eintragen Überschrift-->
  <h3> <p class="text-center">Neuen Lauf eintragen</p></h3>


  <!-- FORMULAR-->

  <div class="container">
      <div class="col-md-12">
            <form action="php/post-method.php" method="post">
                <div  class="form-group">
                    <label  for="inputDate"  class="control-label col-sm-2">Datum</label>
                    <div  class="col-sm-10">
                        <input  type="date"  placeholder="tt.mm.jjjj" class="form-control"  id="inputDate" name="inputDate">
                    </div>
                </div>

                <div  class="form-group">
                    <label  for="inputEmail"  class="control-label col-sm-2">Dauer</label>
                    <div  class="col-sm-10">
                        <input  type="text"  class="form-control"  placeholder="Dauer"  id="inputEmail"
                        name="inputDuration">
                        <span  class="help-block">Einheit: Minuten</span>
                    </div>
                </div>

                <div  class="form-group">
                    <label  for="inputDistance"  class="control-label col-sm-2">Strecke</label>
                    <div  class="col-sm-10">
                        <input  type="text"  class="form-control"  placeholder="Distanz"  id="inputDistance" name="inputDistance">
                        <span  class="help-block">Einheit: Kilometer (km)</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button  class="btn  btn-primary"  type="submit">Eintragen</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    
          
    <!--?php
    echo $_POST['inputDate'];
    echo $_POST['inputDuration'];
    echo $_POST['inputDistance'];
?-->
    
    


    <!-- Bisherige Läufe Überschrift-->
    <h3> <p class="text-center">Bisherige Läufe </p></h3>


    <?php
    $entries = get_all_entries();
    foreach ($entries as $entry) {
        
        $speed = ($entry['Distanz'] / $entry['Dauer']) / 60;
        $pace = ($entry['Dauer'] / $entry['Distanz']);
        
        // Anzeige der Einträge abspeigend
        echo "<em>Datum</em> </br>"
        .$entry['Datum']. "</br>".
        "<em>Dauer</em> </br>"
        .$entry['Dauer']. " Minuten </br>".
        "<em>Distanz</em> </br>"
        .$entry['Distanz']. " km </br>".
        "<em>Geschwindigkeit - Pace</em> </br>"
        .round($speed,2). " km/h - " .round($pace,2). " Min/km"; 
        
        // Knopf um einzelne Einträge zu löschen.
        echo "<form action=\"php/delete.php\"  method=\"post\">
        <input type=\"hidden\" value=\"".$entry['ID']."\">
        <button type=\"submit\">Löschen</button>
        </form>";
    }
    ?>
</body>

</html>
