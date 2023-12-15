<?php 
extract($_POST);
if(isset($save))
{
    $bocht_found = false;
    
    //Opent csv bestand
    if (($file = fopen("database.csv", "r")) !== FALSE) 
    {
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) 
        {
            //als baan_id == 2 en het gegeven bocht nummer over een komt met die uit de database
            if ($data[0] == 2 and $data[3] == $bocht_nr )
            {
                //$r is de bocht straal in meters
                $r = $data[5];
                $bocht_found = true;
                break;
            }            
        }
    //Sluit csv bestand
    fclose($file);     
    
        if ($bocht_found)
        {
            //de versnelling door zwaartekracht in meter per seconde in het kwadraat
            $g= (9.81);               
            //de wrijvingscoëfficiënt tussen de banden en het wegdek, de aanname is dat het voor alle f1 auto's hetzelfde is
            $mu= (1.5);                
            //Berekening max snelheid in een bocht 
            $resultaat= ($mu * $g * $r);
            $max= sqrt($resultaat);
            $kmh= ($max * 3.6);
            //rond het getal af op hele kilometers per uur 
            $max_snelheid= round($kmh);    
        }

        else
        {           
            echo '<script>alert("Bocht niet gevonden")</script>';               
        }
        
    }    
}  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Circuit Spa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styling/style.css">
</head>

<body>
<form method="post" action="spa.php">
    <div class="header">
        <div class="logo-container">
            <a href="homepage.html">
                <img src="images/F1.svg.png" alt="Formule 1 Logo">
            </a>
            <div class="header-text">
                <p class="power-text">Powered by Speedway Dynamics</p>
                <h1 class="championship-text">Belgian Grand Prix 2022</h1>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="box p-3">
                    <h2 class="section-title">Circuit Informatie</h2>
                    <div class="circuit-info d-flex align-items-center">
                        <img src="images/spa_circuit.avif" alt="Circuit"
                            class="img-fluid circuit-image circuit-image-first mb-3">
                        <div class="select-wrapper">
                            <label> Selecteer bocht (1 tot 20)</label>
                            <input type="number" name="bocht_nr" class="form-control" placeholder=""
                                value="<?php  echo @$bocht_nr;?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="box p-3">
                    <h2 class="section-title">Berekening</h2>
                    <h3 class="sub-section-title">Gegevens bocht: </h3>
                    <div class="data-box p-2 mx-auto lighter-bg">
                        <p>
                            <p><img src="images/bocht.png" alt="Racer Icon" class="racer-icon">Bocht radius: <span
                                    style="float: right;">

                                    <?php
                                     if ($bocht_found)
                                    {
                                        echo $r;
                                        echo" meter";
                                    } 
                                    if ($bocht_found = false)
                                    {
                                        echo "... meter";
                                    }
                                    
                                    ?></span></p>
                    </div>
                    <div class="data-box p-2 mx-auto lighter-bg">
                        <p>
                            <p><img src="images/math.png" alt="Racer Icon" class="racer-icon">Wrijvingscoëfficiënt: 
                                <span style="float: right;">1,5 µ</span></p>
                    </div>
                    <div class="data-box p-2 mx-auto lighter-bg">
                        <p>
                            <p><img src="images/math.png" alt="Racer Icon" class="racer-icon">Versnelling door de zwaartekracht:
                                <span style="float: right;">9,81 meter per seconde</span></p>
                    </div>
                    <div class="data-box p-2 mx-auto lighter-bg">
                                         <input type="submit" name="save" value="Berekenen" class="button" text-align="center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="box p-3">
                <h2 class="section-title">Gemiddelde snelheid coureur</h2>
                <div class="data-box p-2 mx-auto lighter-bg">
                    <p><img src="images/racericon.png" alt="Racer Icon" class="racer-icon"> Coureur 1: <span
                            id="driver1-speed" style="float: right;">???</span></p>
                </div>
                <div class="data-box p-2 mx-auto lighter-bg">
                    <p><img src="images/racericon.png" alt="Racer Icon" class="racer-icon">Coureur 2: <span
                            id="driver2-speed" style="float: right;">???</span></p>
                </div>
                
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="box p-3">
                <h2 class="section-title">Maximum snelheid</h2>
                <div>
                
                        <input type="number" placeholder="" name="res" class="form justify-content-center align-items-center mx-auto" readonly="readonly" background-color="#008f95;"
                            disabled="disabled" value="<?php  echo @$max_snelheid;?>" />                       
                    
                </div>
                <h3 class="sub-section-title">Kilometer per uur </h3>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</form>
</body>

</html>