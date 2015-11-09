<?php
//============================================================
//Autor: Alexandre
//Abertura de registros de Incidentes via PHP - Out/2015
//============================================================

//Armazena a estrutura XML na variavel input_xml
$input_xml = '
	<SOAP-ENV:Envelope xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="urn:HPD_IncidentInterface_Create_WS" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:s0="urn:HPD_IncidentInterface_Create_WS" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
		<SOAP-ENV:Header>
			<s0:AuthenticationInfo>
				<s0:userName>USER-HERE</s0:userName>
				<s0:password>PASS-HERE</s0:password>
			</s0:AuthenticationInfo>
		</SOAP-ENV:Header>
		<ns0:Body>
			<ns1:HelpDesk_Submit_Service>
				<ns1:Assigned_Group>Assigned_Group-here</ns1:Assigned_Group>
				<ns1:Assigned_Support_Company>Assigned_Support_Company-here</ns1:Assigned_Support_Company>
				<ns1:Assigned_Support_Organization>Assigned_Support_Organization-here</ns1:Assigned_Support_Organization>
				<ns1:Department>Department-here</ns1:Department>
				<ns1:First_Name>First_Name-here</ns1:First_Name>
				<ns1:Impact>4-Minor/Localized</ns1:Impact>
				<ns1:Last_Name>Last_Name-here</ns1:Last_Name>
				<ns1:Reported_Source>Systems Management</ns1:Reported_Source>
				<ns1:Service_Type>User Service Request</ns1:Service_Type>
				<ns1:Status>New</ns1:Status>
				<ns1:Action>CREATE</ns1:Action>
				<ns1:Summary>Summary-here</ns1:Summary>
				<ns1:Notes>Notes-here</ns1:Notes>
				<ns1:Urgency>1-Critical</ns1:Urgency>
				<ns1:Work_Info_Locked>No</ns1:Work_Info_Locked>
				<ns1:Work_Info_View_Access>Internal</ns1:Work_Info_View_Access>
				<ns1:HPD_CI_ReconID>ReconID-here</ns1:HPD_CI_ReconID>
			</ns1:HelpDesk_Submit_Service>
		</ns0:Body>
	</SOAP-ENV:Envelope>
';


//Utilizados o CURL do PHP para fazer requisições ao WebService ITSM Remedy
//http://<midtier_server>/arsys/WSDL/public/<servername>/HPD_IncidentInterface_Create_WS
$url = "http://YOUR-URL/arsys/services/ARService?server=YOUR-APPSERVER&webService=HPD_IncidentInterface_Create_WS";
//Monta o header
$headers = array(
            "Soapaction: urn:HPD_IncidentInterface_Create_WS/HelpDesk_Submit_Service",
            "Host: YOUR-URL",
            "Connection: close",
            "Content-Type: text/xml;charset=UTF-8"
        ); 

    //Configurando os parametros do curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
	//curl_setopt($ch, CURLOPT_HEADER, true); //Mostra header da página retornada
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    $data = curl_exec($ch);
    curl_close($ch);
	
	//Imprime retorno da requisição
    print_r('<pre>');
	print_r($data);
    print_r('</pre>');
	
?>