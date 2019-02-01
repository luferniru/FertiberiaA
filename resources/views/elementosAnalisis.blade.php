@extends('cabeceraAnalisis')

@section('titulo')
Analisis
@endsection

@section('cuerpo')
<?php
$elementos = \Session::get('elementos');
$compuesto = \Session::get('compuesto');
$tanques = \Session::get('tanques');

$tanques[0]->tanque;
        
?>
<form action="elementosAnalisis" method="post">
    {{ csrf_field() }}
    
    <?php 
    if(isset($ncomp))
    {
        ?><input type="hidden" value="<?php echo $ncomp; ?>" name="ncomp"> <?php
    }
    ?>
    <input type="hidden" value="<?php echo $elementos[0]->compuesto; ?>" name="comp">
    <?php
    echo 'Compuesto: ' . $compuesto[0]->compuesto . '<br>';
    echo '<div class="row">';
    if ($tanques[0]->tanque != 'Tanque1') {
        echo '<div class="col-4">';
        echo 'Tanque: <select name="tanque">';
        foreach ($tanques as $t) {
            echo '<option value="' . $t->tanque . '">' . $t->tanque . '</option>';
        }
        echo '</select>';
        echo '</div>';
    } else {
        echo '<input type="text" value="Tanque1" hidden name="tanque">';
    }
   
    echo '<input type="text" name="fecha" id="fecha" value="'.$fecha.'">';
    echo '<input type="submit" class="btn btn-info" name="boton" value="cargar">';
    echo '</div>';
    echo '<div class="row">';
        echo '<div class=col>';
            if(count($tabla)>0)
            {
                //Iniciando la tabla--------------------------------------------------------
                //Cabecera 1--------------------------------------------------------------
                echo '<table border=2><tr>';
                echo '<td>Fecha</td>';
                for($i=0; $i<$nelementos;$i++)
                {
                    $fila=$tabla[$i];
                    echo '<td>'.$fila->describe_elemento.'</td>';
                }

                echo '</tr>';
                //Fin cabecera 1----------------------------------------------------------

                //Cabecera 2--------------------------------------------------------------
                echo '<tr>';
                echo '<td>Fecha</td>';
                for($i=0; $i<$nelementos;$i++)
                {
                    $fila=$tabla[$i];
                    if($fila->valor2==""||$fila->valor2==null)
                    {
                        echo '<td>'.$fila->condicion . $fila->valor1.'<br>'.$fila->simbolo.'</td>';  
                    }
                    else
                    {
                       echo '<td>'.$fila->valor1 . $fila->condicion . $fila->valor2.'</td>';
                    }
                }
                echo '</tr>';
                //Fin cabecera 2----------------------------------------------------------

                //Datos ------------------------------------------------------------------
                echo '<tr>';
                echo '<td>'.$tabla[0]->fechahora.'</td>';
                //dd($tabla);
                foreach ($tabla as $i=>$fila)
                {
                    if($i>0)
                    {
                        if(($i)%$nelementos==0)
                        {
                            echo '</tr><tr><td>'.$fila->fechahora.'</td>';
                        }
                    }
                    echo '<td>'.$fila->lectura.'</td>';
                }
                echo '</tr>';

                //Fin Datos---------------------------------------------------------------

                echo '</table>';
                //Fin de la tabla-----------------------------------------------------------
                echo '</div>';
            }
            else
            {
                echo 'Sin analisis';
            }
        echo '</div>';
        echo '<div class=col>';
            if(count($tgranu)>0)
            {
                //Iniciando la tabla--------------------------------------------------------
                //Cabecera 1--------------------------------------------------------------
                echo '<table border=2><tr>';
                echo '<td>Fecha</td>';
                for($i=0; $i<$ngranulometria;$i++)
                {
                    echo '<td>Granulometria</td>';
                }

                echo '</tr>';
                //Fin cabecera 1----------------------------------------------------------

                //Cabecera 2--------------------------------------------------------------
                echo '<tr>';
                echo '<td>Fecha</td>';
                for($i=0; $i<$ngranulometria;$i++)
                {
                    $fila=$tgranu[$i];
                    if($fila->valor2==""||$fila->valor2==null)
                    {
                        echo '<td>'.$fila->condicion . $fila->valor1.'<br>'.$fila->simbolo.'</td>';  
                    }
                    else
                    {
                       echo '<td>'.$fila->valor1 . $fila->condicion . $fila->valor2.'</td>';
                    }
                }
                echo '</tr>';
                //Fin cabecera 2----------------------------------------------------------

                //Datos ------------------------------------------------------------------
                echo '<tr>';
                echo '<td>'.$tgranu[0]->fechahora.'</td>';
                //dd($tabla);
                foreach ($tgranu as $i=>$fila)
                {
                    if($i>0)
                    {
                        if(($i)%$ngranulometria==0)
                        {
                            echo '</tr><tr><td>'.$fila->fechahora.'</td>';
                        }
                    }
                    echo '<td>'.$fila->lectura.'</td>';
                }
                echo '</tr>';

                //Fin Datos---------------------------------------------------------------

                echo '</table>';
                //Fin de la tabla-----------------------------------------------------------
                echo '</div>';
            }
        echo '</div>';
        ?>
    </div>
</form>
@endsection



