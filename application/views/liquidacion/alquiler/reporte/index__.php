<?php 
   $subtotal1 = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liquidación Alquiler</title>
    <link rel="stylesheet" href="<?= dirname(__FILE__) ?>/css/liquidacion.css">
</head>
<body>
    <div class = "paper">
        <div class="fila1">
            <div class="logo">
                <img src='<?= dirname(__FILE__) ?>/Logo_Bigote.jpg'>
            </div>
            <div class = "usuario">
                Usuario: <?= $this->data['session']->USUARI_C_USERNAME ?>
            </div> 
            <div class = "fecha">
                Fecha: <?php echo date('d/m/Y')?> <?php echo date('H:i')?>
            </div> 
        </div> 
        <br>

        <div class = "titulo" style="color:white;">
            <?php $result[0]->LIQCAB_C_TITULO ?>
        </div> 
        <div class="fila2">
            <br>
            <div>
                <div class = "subtitulo">
                    SEDE:
                </div>
                <div class = "contenido">
                    <?php //$result[0]->SEDE_C_DESCRIPCION ?>
                </div>
            </div> 
            <div>
                <div class = "subtitulo">
                    CLIENTE:
                </div>
                <div class = "contenido">
                    <?php //$result[0]->CLIENT_C_RAZON_SOCIAL ?>
                </div>
            </div>
            <div>
                <div class = "subtitulo">
                    FECHA LIQUIDACION: 
                </div>
                <div class = "contenido">
                    <?php //$result[0]->LIQCAB_C_FECHA ?>
                </div> 
            </div>
        </div> 
        <div class="fila2" style="border-top: 0px;">
            <div class = "col_1">
                UBICACION
            </div> 
            <div class = "col_2">
                F.INICIO
            </div> 
            <div class = "col_3">
                F.FINAL
            </div> 
            <div class = "col_5">
                AREA M2
            </div> 
            <div class = "col_6">
                MONEDA
            </div> 
            <div class = "col_7">
                PRECIO UNIT.
            </div> 
            <div class = "col_8">
                TOTAL
            </div> 
            <br>
        
            <?php $i = 0;?>
                <?php //foreach ($result as $item): ?>
                    <div class = "fila2_1">
                        <?php //$result[$i]->UBICAC_C_DESCRIPCION ?>
                    </div> 
                    <div class = "fila2_2">
                        <?php //$result[$i]->ALQDET_C_FECHA_INICIO ?>
                    </div> 
                    <div class = "fila2_3">
                        <?php //$result[$i]->ALQDET_C_FECHA_FINAL ?>                    
                    </div> 
                    <div class = "fila2_5">
                        <?php //$result[$i]->ALQDET_N_AREA ?>
                    </div> 
                    <div class = "fila2_6">
                        <?php //$result[$i]->MONEDA_C_SIMBOLO ?>
                    </div> 
                    <div class = "fila2_7">
                        <?php //$result[$i]->ALQDET_N_PRECIO_UNIT ?>
                    </div> 
                    <div class = "fila2_8">
                        <?php //$result[$i]->ALQDET_N_PRECIO_TOTAL ?>
                    </div> 
                    <div class = "fila2_8" style="display: none">
                        <?php // $subtotal1 = $subtotal1 + $result[$i]->ALQDET_N_PRECIO_TOTAL ?>
                    </div> 
                    <br>
                <?php// $i = $i + 1;?>
            <?php // endforeach; ?>
        </div> 
        <br>
        <br>
        
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th>
                    <td width="450px">
                    </td>
                </th>
                <th>
                    <div class="fila3" >
                        <br>
                        <div class="fila_final">
                            <div class = "col_sub_totales_titulos">
                                SUB TOTAL
                            </div> 
                            <div class = "col_sub_totales">
                                <?php //trim(number_format((float)$subtotal1, 2, '.', '')) ?>
                            </div> 
                        </div> 
                        <div class="fila_final">
                            <div class = "col_sub_totales_titulos">
                                I.G.V.
                            </div> 
                            <div class = "col_sub_totales">
                                <?php // trim(number_format((float)($subtotal1 * 0.18), 2, '.', '')) ?>
                            </div> 
                        </div> 
                        <div class="fila_final">
                            <div class = "col_totales_titulos">
                                TOTAL
                            </div> 
                            <div class = "col_totales">
                                <?php //trim(number_format((float)$subtotal1 + ($subtotal1 * 0.18), 2, '.', '')) ?>
                            </div> 
                        </div> 
                    </div> 
                </th>
            </tr>
        </table>
    </div>
</body>
</html>