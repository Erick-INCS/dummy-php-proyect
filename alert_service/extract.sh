mycli -u root -P 8889 -p root -e 'SELECT                                                    
        MD.activoprincipalMedicamento,
    CM.marca,
    CM.fechadecaducidadMedicamento
FROM `clinicatienemedicamento` CM
INNER JOIN medicamentos MD
        ON MD.idMedicamento = CM.idMedicamento
WHERE TRUE
        AND cm.fechadecaducidadMedicamento <= DATE_ADD(CURRENT_DATE(), INTERVAL 3 MONTH)' clinicaComunitarias > \
        /tmp/extracted_data