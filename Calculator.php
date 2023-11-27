<?php 
//Opent csv bestand
//$file = fopen("bestandnaam.csv", "r");
//while (! feof($file))
//{
    //print_r(fgetcsv($file));
//}
extract($_POST);
if(isset($save))
{
    //$gewichtcoureur;
    //$gewichtauto;

    //de versnelling door zwaartekracht in meter per seconde in het kwadraat
    $g= (9.81);
    //de bochtradius in meters 
    $r=(225);
    //de wrijvingscoëfficiënt tussen de banden en het wegdek, de aanname is dat het voor alle f1 auto's hetzelfde is
    $mu= (1.5);
              
    //Berekening max snelheid in een bocht 
    $resultaat= ($mu * $g * $r * $bocht_nr);
    $max= sqrt($resultaat);
    $kmh= ($max * 3.6);
    $max_snelheid= round($kmh);      

}
//Sluit het xsv bestand
//fclose($file)
?>

<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <h1>Calculator</h1>
    <form method="post">
        <table>
            <tr>
                <div>
                    <!--<label>Gewicht coureur in kilogrammen </label>
                    <input type="number" name="" class="form-control" placeholder="" value="<?php  echo @$gewichtcoureur;?>">-->
                </div>
            </tr>
            <tr>
                <div>
                    <!--<label>Gewicht auto in kilogrammen</label>
                    <input type="number" name="" class="form-control" placeholder="" value="<?php  echo isset($gewichtauto)?>"> -->
                </div>
            </tr>
            <tr>
                <div class="form-group row input-group">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <label> Selecteer bocht</label>
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
                        <label>Maximale snelheid om de bocht te nemen, in kilometer per uur</label>
                        <input type="number" placeholder="" name="res" class="form-control" readonly="readonly"
                            disabled="disabled" value="<?php  echo @$max_snelheid;?>" />
                    </div>
                </div>

        </table>
    </form>
</body>
</html>