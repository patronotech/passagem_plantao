<?php 
    include '../../../conexao.php';

    session_start();
    $usuario = $_SESSION['usuarioLogin'];

    $obs = $_POST['obs'];

    $cd_dur = $_POST['cd_dur'];


    echo $cons_pp = "INSERT INTO passagem_plantao.OBSERVACAO_PACIENTE
                    SELECT passagem_plantao.seq_obs_intercorrencia.NEXTVAL CD_OBSERVACAO,
                    (SELECT CD_UNID_INT FROM passagem_plantao.DURANTE dr WHERE dr.CD_DURANTE = $cd_dur) AS CD_SETOR,
                    $cd_dur AS CD_DURANTE,
                    '$usuario' AS CD_USUARIO_CRIACAO,
                    SYSDATE AS HR_CRIACAO,
                    '$obs' AS OBSERVACAO
                    FROM DUAL";

    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_pp = oci_parse($conn_ora,$cons_pp);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_pp);



?>