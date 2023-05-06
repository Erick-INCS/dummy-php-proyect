#!/bin/bash
while :
do
	echo "Press [CTRL+C] to stop.."
	mycli -h mysql -u root -p root -e "
	SELECT
		MD.activoprincipalMedicamento,
		CM.marca,
		CM.fechadecaducidadMedicamento,
		u.correo,
		u.nombreUsuario
	FROM clinicatienemedicamento CM
	INNER JOIN medicamentos MD
		ON MD.idMedicamento = CM.idMedicamento
	INNER JOIN usuarios u
		ON CM.idUsuario = u.idUsuario
	WHERE TRUE
		AND CM.fechadecaducidadMedicamento <= DATE_ADD(CURRENT_DATE(), INTERVAL 3 MONTH)
		AND u.recibe_alertas = 1" clinicaComunitarias > \
		/tmp/extracted_data

		if [ `cat /tmp/extracted_data | sed '1d' | wc -l` -gt 0 ]
		then
			cat /tmp/extracted_data | sed '1d' > /tmp/extracted_data_wnh
			while read -r ln; do
				MEDICAMENTO=`echo "$ln" | cut -f1`
				MARCA=`echo "$ln" | cut -f2`
				FECHA=`echo "$ln" | cut -f3`
				CORREO="${FORCED_RECP:-`echo "$ln" | cut -f4`}"
				BODY="Alerta de vencimiento.
				Medicamento \"$MEDICAMENTO\" de la marca $MARCA próximo a vencer en $FECHA"

				sendemail -f "$ADDR" \
					-t "$CORREO" \
					-u "Alerta de medicamento por expirar" \
					-s "$SMTP_HOST:$TLS_PORT" \
					-m "$BODY" \
					-xu "$ADDR" \
					-xp "$PASS" \
					-o tls=auto
			done </tmp/extracted_data_wnh
		fi
	sleep 7d
done
