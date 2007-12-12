<?php
/*
 * Copyright 2005,2006 WSO2, Inc. http://wso2.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
class getPriceRequestWrapper
{
    public $item_name;
    public $amount;
}

class getPriceResponseWrapper
{
    public $price;
}

$class_map = array("getPrice" => "getPriceRequestWrapper",
                   "getPriceResponse" => "getPriceResponseWrapper");

try {

    $client = new WSClient(array("wsdl" => "http://localhost/samples/wsdl_generation/doclit_service.php?wsdl",
                                 "classmap" => $class_map));

    $proxy = $client->getProxy();	

    $input = new getPriceRequestWrapper();
    $input->item_name = "wso2";
    $input->amount = 10;

    $val = $proxy->getPrice($input);

    printf("The Total Price is: %s \n", $val->price);

} catch (Exception $e) {
    if ($e instanceof WSFault) {
        printf("Soap Fault Reason: %s\n", $e->Reason);
        printf("Soap Fault Code: %s \n", $e->Code);
        
    } else {
        printf("Message = %s\n",$e->getMessage());
    }
  }
?>