<?php 

extract($_POST);
if(isset($save))
{
    $gewichtcoureur;
    $gewichtauto;
    //de versnelling door zwaartekracht 
    $g= (9.81);
    //de bochtstraal 
    $r=(15.2);
    //de wrijvingscoëfficiënt tussen de banden en het wegdek
    $mu= (0.8);
    //de hellinghoek van de bocht
    $o= (180);
    
    //Berekening max snelheid in een bocht 
    $resul= ($mu * $g * $o * $r);
    $taat= pi();
    $resultaat= $resul / $taat;
    $max= sqrt($resultaat) ;
    $max_snelheid= round($max);      
		
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="Style.css"> 
</head>

<body>
    <h1>Calculator</h1>
    <form method="post">
        <table>
            <tr>
                <div>
                    <label>Gewicht coureur in kilogrammen </label>
                    <input type="number" name="" class="form-control" placeholder=""
                        value="<?php  echo @$gewichtcoureur;?>">
                </div>
            </tr>
            <tr>
                <div>
                    <label>Gewicht auto in kilogrammen</label>
                    <input type="number" name="" class="form-control" placeholder=""
                        value="<?php  echo @$gewichtauto;?>">
                </div>
                <label>hoi</label>
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
                    </div>
                </div>

        </table>
    </form>
</body>

</html>