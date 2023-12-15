<?php 
extract($_POST);
if(isset($save))
{
    $bocht_found == false;
    //Opent csv bestand
    if (($file = fopen("database.csv", "r")) !== FALSE) 
    {
        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) 
        {
            if ($data[1] == $bocht_nr)
            {
                //$r is de bocht straal in meters
                $r = $data[3];
                $bocht_found = true;
                break;
            }            
        }     
    
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
    //Sluit csv bestand
    fclose($file);
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <h1>Calculator</h1>
    <form method="post" action="Calculator.php">
        <table>
            <tr>
                <div class="form-group row input-group">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label> Selecteer bocht (1 tot 14)</label>
                        <input type="number" name="bocht_nr" class="form-control" placeholder=""
                            value="<?php  echo @$bocht_nr;?>">
                    </div>
                </div>
            </tr>
            <tr>
                <div>
                    <div class="buttons col-sm-12 mb-3 mb-sm-0">
                        <input type="submit" name="save" value="Berekenen" class="btn btn-primary btn-user btn-block">
                    </div>
                </div>
            </tr>
            <tr>
                <div class="form-group row input-group">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label>Maximale snelheid om de bocht te nemen</label>
                        <input type="number" placeholder="" name="res" class="form-control" readonly="readonly"
                            disabled="disabled" value="<?php  echo @$max_snelheid;?>" />
                        <label>in kilometer per uur</label>
                    </div>
                </div>

        </table>
    </form>
</body>
</html>