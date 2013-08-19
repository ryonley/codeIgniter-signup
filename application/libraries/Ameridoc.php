<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Ameridoc {

        protected $Key = "7ADEA3D5-0FE6-4814-A89B-5297735344DA";
      // protected $GroupNumber = "DOCDEMO1";
		protected $GroupNumber = "DOC00003"; 
        protected $PlanId = "57";

        function __construct() {

        }

        function GetKey() {
                return $this->Key;
        }

        function GetGroupNumber() {
                return $this->GroupNumber;
        }

        function GetPlanId() {
                return $this->PlanId;
        }

        function GetRandomMemberId() {
                $id = uniqid("AAD");
                return $id;
        }

        function Authenticate($key, $group_number, $plan_id) {

        }

        /* --------------------------------------------- */
        /* Start Enroll New Member Method */
        /* -------------------------------------------- */

        function EnrollNewMember($post_data) {
                $query_string = http_build_query($post_data, '', "&");

                $options = array(
                    CURLOPT_URL => 'http://www.ameridoc.com//webservices/enrollmentservice.asmx/EnrollNewMember',
                    CURLOPT_POST => 1,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POSTFIELDS => $query_string
                );

                $ch = curl_init();
                curl_setopt_array($ch, $options);
                $response = curl_exec($ch);
                curl_close($ch);

                $xml = new SimpleXMLElement($response);

                if ($xml->Successful == 'false') {

                        $msg = array(
                            "Successful" => (string) $xml->Successful,
                            "Message" => (string) $xml->Message,
                        );
                        return $msg;
                } else {
                        $msg = array(
                            "Successful" => (string) $xml->Successful,
                            "Message" => (string) $xml->Message,
                            "AdditionalInfo" => (string) $xml->AdditionalInfo
                        );
                        return $msg;
                }
        }

        /* --------------------------------------------- */
        /* -- Start UpdateMember2 Method-- */
        /* -------------------------------------------- */

        function GetMemberInfo($ExternalMemberId) {
                $parameter_array = array(
                    'Key' => $this->GetKey(),
                    'ExternalMemberId' => $ExternalMemberId,
                    'GroupNumber' => $this->GetGroupNumber()
                );

                $query_string = http_build_query($parameter_array, '', "&");

                $options = array(
                    CURLOPT_URL => 'http://www.ameridoc.com//webservices/enrollmentservice.asmx/GetMemberInfo',
                    CURLOPT_POST => 1,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POSTFIELDS => $query_string
                );

                $ch = curl_init();
                curl_setopt_array($ch, $options);
                $response = curl_exec($ch);
                curl_close($ch);

                $xml = new SimpleXMLElement($response);

                if ($xml->Successful == 'false') {

                        $msg = array(
                            "Successful" => (string) $xml->Successful,
                            "Message" => (string) $xml->Message,
                        );
                        return $msg;
                } else {
                           $msg = array(
                            "Successful" => (string) $xml->Successful,
                            "Message" => (string) $xml->Message,
                            "AdditionalInfo" => (string) $xml->AdditionalInfo,
                            "ExternalMemberId" => (string) $xml->ExternalMemberId,
                            "AmeriDocMemberId" => (string) $xml->AmeriDocMemberId,
                            "FirstName" => (string) $xml->FirstName,
                            "LastName" => (string) $xml->LastName,
                            "DOB" => (string) $xml->DOB,
                            "Gender" => (string) $xml->Gender,
                            "Address1" => (string) $xml->Address1,
                            "Address2" => (string) $xml->Address2,
                            "City" => (string) $xml->City,
                            "State" => (string) $xml->State,
                            "Zip" => (string) $xml->Zip,
                            "Phone" => (string) $xml->Phone,
                            "Email" => (string) $xml->Email,
                            "GroupNumber" => (string) $xml->GroupNumber,
                            "PlanId" => (string) $xml->PlanId,
                            "PlanOption" => (string) $xml->PlanOption,
                            "PrimaryExternalMemberId" => (string) $xml->PrimaryExternalMemberId,
                            "Relationship" => (string) $xml->Relationship
                        );
                        return $msg;

                        //return $xml;
                }
        }

}

/* End of file Ameridoc.php */

?>
