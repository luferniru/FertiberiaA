@extends('cabecera')

@section('titulo')
Laboratorio
@endsection

@section('cuerpo')
<?php
$elementos = \Session::get('elementos');
$compuesto = \Session::get('compuesto');
$tanques = \Session::get('tanques');


$tanques[0]->tanque
?>
<form action="introducir" method="post">
    {{ csrf_field() }}
    <input type="text" hidden value="<?php echo $elementos[0]->compuesto; ?>" name="comp">
    <?php
    echo 'Compuesto: ' . $compuesto[0]->compuesto . '<br>';
    echo '<div class="row">';
    echo 'Fecha y hora: <input name="fechahora" type="datetime-local">';
    echo '</div>';
    echo '<div class="row">';
    foreach ($elementos as $elem) {
        $segun = '';
        if ($elem->valor2 != null) {
            $segun = $elem->valor2;
        }
        echo '<div class="col-4">';
        ?> 
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><?php echo $elem->describe_elemento; ?></div>
            </div>
            <input type="number" class="form-control" name="valor[]">
            <div class="input-group-postpend">
                <div class="input-group-text"><?php echo $elem->valor1 . ' ' . $elem->condicion . ' ' . $segun . ' ' . $elem->simbolo; ?></div>
            </div>
        </div>



        <?php
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="row">';
    if ($tanques[0]->tanque != 'Tanque1') {
        echo '<div class="col-4">';
        echo 'Tanque: <select name="tanque" class="custom-select">';
        foreach ($tanques as $t) {
            echo '<option value="' . $t->tanque . '">' . $t->tanque . '</option>';
        }
        echo '</select>';
        echo '</div>';
    } else {
        echo '<input type="text" value="Tanque1" hidden name="tanque">';
    }
    echo '</div>';
    if ($compuesto[0]->granulometria != null) {
        echo '<div class="row">';
        $granu = \Session::get('granu');
        echo '<input type="text" value="' . $granu[0]->id_granu . '" hidden name="idgranu">';
        echo '<fieldset>';
        echo '<legend>Granulometria</legend>';
        foreach ($granu as $g) {
            echo '<div class="col-3">';
            echo $g->valor . ' <input type="number" name="granulometria[]" value="">' . $g->condicion . ' ' . $g->valor1 . ' ' . $g->simbolo;
            echo '</div>';
        }
        echo '</fieldset>';
        echo '</div>';
    }
    ?>
    <input type="submit" class="btn btn-info" name="boton" value="Introducir">
</form>
@endsection



