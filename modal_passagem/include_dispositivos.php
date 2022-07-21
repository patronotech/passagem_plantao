<?php

 $consulta_dispo ="SELECT DISTINCT resp.DS_RESPOSTA
                        FROM dbamv.SAE_HISTORICO_ENFERMAGEM she
                        INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                        ON sel.CD_HISTORICO_ENFERMAGEM = she.CD_HISTORICO_ENFERMAGEM
                        INNER JOIN dbamv.SAE_PERGUNTA_HISTORICO_ENFERMG perg
                        ON perg.CD_PERGUNTA = sel.CD_PERGUNTA_HISTORICO
                        INNER JOIN dbamv.SAE_RESPOSTA_HISTORICO_ENFERMG resp
                        ON sel.CD_RESPOSTA_HISTORICO = resp.CD_RESPOSTA
                        WHERE sel.CD_PERGUNTA_HISTORICO IN (2695, 341, 338, 342, 340)
                        --AND resp.SN_ATIVO = 'S'
                        AND she.CD_ATENDIMENTO = $var_atd
                        AND TO_DATE('$var_exibir_dt','DD/MM/YYYY') = TRUNC(she.DT_INICIO)";

$result_consulta_dispo = oci_parse($conn_ora,$consulta_dispo);

oci_execute($result_consulta_dispo );

$contad_while = 0;



?>

    <div class='col-md-12' style='text-align:left'>

        Dispositivos
        <textarea class='textarea' style="width: 100%;" name='frm_dispositivos' readonly><?php while (@$row_dispo = oci_fetch_array($result_consulta_dispo)){


            if ($contad_while == 0){

                echo $row_dispo['DS_RESPOSTA'];

            }else{

                echo ' || ' . $row_dispo['DS_RESPOSTA'];
            }

            $contad_while = $contad_while + 1;

        }
        ?>
        </textarea>

    </div>

    