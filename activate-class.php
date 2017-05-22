<?php

/**
 * Calix Activate Class
 *
 *
 * @package    Fiber Management System
 * @author     Gregory Brewster <gbrewster@agoasite.com>
 * @copyright  (C)2017 City of Sandy
 *
 *
 */

class cc_activate {
	
	/**
	 * Make sure variables are private!
	 */
	private $activate_username;
	private $activate_password;
	private $activate_uri;
	
	/**
	 * Declares the default constructor
	 * Upon creation, the object will have the following variables set with information
	 * obtained from the parameters defined by new
	 */
	public function __construct($user, $pass, $uri) {
		$this->activate_username = $user;
		$this->activate_password = $pass;
		$this->activate_uri = $uri;
	}
	
/*****************************************************************************************************************************
 ** CONFIGURING TEMPLATES   CONFIGURING TEMPLATES   CONFIGURING TEMPLATES   CONFIGURING TEMPLATES   CONFIGURING TEMPLATES ****
 ****************************************************************************************************************************/ 
 
	
	/**
	 *  Function retrieves all service templates
	 *  Params: Name(string), if blank, all templates are returned
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_template_retrieve_service_template($name, $args = array()){
		$record = $this->query_get("config/template/service-template/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function creates a service template
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_template_create_service_template($arguments){
		$record = $this->query_post("config/template/service-template", json_encode($arguments, JSON_PRETTY_PRINT));
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function retrieves gfast port template based on template name
	 *  Params: template_name(string)
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_template_retrieve_gfast_port_template($port_type, $args = array()){
		$record = $this->query_get("config/template/port-template/".$port_type, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function retrieves pon port template based on template name
	 *  Params: template_name(string)
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_template_retrieve_pon_port_template($port_type, $args = array()){
		$record = $this->query_get("config/template/port-template/port-type/".$port_type, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	
/*****************************************************************************************************************************
 ** CONFIGURING DEVICES   CONFIGURING DEVICES   CONFIGURING DEVICES   CONFIGURING DEVICES   CONFIGURING DEVICES           ****
 ****************************************************************************************************************************/ 
 
	/**
	 *  Function mounts a device
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_device_mount($arguments){
		$record = $this->query_post("config/device", json_encode($arguments, JSON_PRETTY_PRINT));
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function retrieves a device based on name.
	 *  Params: device_name(string), blank returns all devices
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_device_retrieve($name, $args = array()){
		$record = $this->query_get("config/device/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function performs a full sync on node
	 *  Params: device_name(string), blank returns all devices
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_device_full_sync($name, $args = array()){
		$record = $this->query_put("config/device/{$name}?action=full-sync-data", $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
/*****************************************************************************************************************************
 ** DEVICE ACTIONS   DEVICE ACTIONS   DEVICE ACTIONS   DEVICE ACTIONS   DEVICE ACTIONS   DEVICE ACTIONS   DEVICE ACTIONS  ****
 ****************************************************************************************************************************/
 
 	/**
	 *  Function reboots a device
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function device_action_reboot($name, $arguments = array()){
		$record = $this->query_put("device-action/reboot?deviceName={$name}", json_encode($arguments, JSON_PRETTY_PRINT));
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
/*****************************************************************************************************************************
 ** CONFIGURING EMS   CONFIGURING EMS   CONFIGURING EMS   CONFIGURING EMS   CONFIGURING EMS   CONFIGURING EMS             ****
 ****************************************************************************************************************************/ 
 
	/**
	 *  Function pull device groups
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_device_group_retrieve($args = array()){
		$record = $this->query_get("activate/deviceGroup", $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function pull ems service
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_ems_service_retrieve($name ,$args = array()){
		$record = $this->query_get("ems/eth-service/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function put ems service state
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_ems_service_state($name ,$args = array()){
		$record = $this->query_put("ems/eth-service/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function pull ems service
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_ems_service_remove($name ,$args = array()){
		$record = $this->query_delete("ems/eth-service/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function creates ems service
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_ems_service_create($name ,$args = array()){
		$record = $this->query_post("ems/eth-service/".$name, json_encode($args, JSON_PRETTY_PRINT));
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function pull port config
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_ems_port_config_retrieve($name ,$args = array()){
		$record = $this->query_get("ems/port-config/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function create port config
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_ems_port_config_create($name ,$args = array()){
		$record = $this->query_post("ems/port-config/".$name, json_encode($args, JSON_PRETTY_PRINT));
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function pull service template
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_ems_service_template_retrieve($name ,$args = array()){
		$record = $this->query_get("ems/service-template/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
 
	/**
	 *  Function pulls a subscriber record
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_customer_retrieve($name, $args = array()){
		$record = $this->query_get("ems/subscriber/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}


	/**
	 *  Function pulls a subscriber record
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_customer_retrieve_gui($name, $args = array()){
		$record = $this->query_get("ems/gui/view/subscriber/".$name, $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	/**
	 *  Function create subscriber
	 *  Params: $arugment array
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function configuration_customer_create($name ,$args = array()){
		$record = $this->query_post("ems/subscriber/".$name, json_encode($args, JSON_PRETTY_PRINT));
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
/*****************************************************************************************************************************
 ** MANAGING FAULTS   MANAGING FAULTS   MANAGING FAULTS   MANAGING FAULTS   MANAGING FAULTS   MANAGING FAULTS             ****
 ****************************************************************************************************************************/ 
 
 	/**
	 *  Function retrieves alarms
	 *  Params: none
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function manager_fault_retrieve($args = array()){
		$record = $this->query_get("fault/alarm/", $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
 	/**
	 *  Function retrieves alarms
	 *  Params: none
	 *  Returns: Array, "errors", "result", "info" 
	 */
	public function manager_fault_retrieve_logs($args = array()){
		$record = $this->query_get("fault/alarm-log/", $args);
		$http_code = $this->get_status_code($record->info);
		
		if($http_code != 200){
			$record->error = "Invalid http response: ".$http_code;
		}
		
		return $record;
	}
	
	
/*****************************************************************************************************************************
 ** CURL METHODS   CURL METHODS   CURL METHODS   CURL METHODS   CURL METHODS   CURL METHODS   CURL METHODS   CURL METHODS ****
 ****************************************************************************************************************************/ 
	
	
	/**
	 *  Function will query CC+ using the given parameters
	 *  Params: URI without host, json_encoded string of arguments
	 *  Returns: Array, "errors", "result" 
	 */
	protected function query_post($uri, $arguments){
		$data = (object) array();
		$ch = curl_init();
		$options = array(
			CURLOPT_URL => $this->activate_uri.$uri,
			CURLOPT_CUSTOMREQUEST=> "POST",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_POSTFIELDS => $arguments,
			CURLOPT_HTTPHEADER => array(
									"Authorization: Basic ".base64_encode($this->activate_username.":".$this->activate_password), 
									"Content-Type: application/json"
								),
			//CURLOPT_VERBOSE => 1,				//debugging
		);
		
		// Set options against curl object
		curl_setopt_array($ch, $options);
		$file = curl_exec($ch);
		if(curl_error($ch)){
			$err = curl_error($ch);
		} else {
			$err = null;
		}
		
		$data->error = $err;
		$data->info = curl_getinfo($ch);
		
		$result_obj = json_decode($file);
		if($result_obj){
			if(count($result_obj) > 1){
				$data->result = $result_obj;
			} else {
				$data->result = array($result_obj);
			}
		} else {
			$data->result = array((object) array("response"=>$file));
		}

		
		// close curl object after you check for errors!
		curl_close($ch);
		
		return $data;
	}
	
	/**
	 *  Function will query CC+ using the given parameters
	 *  Params: URI without host, json_encoded string of arguments
	 *  Returns: Array, "errors", "result" 
	 */
	protected function query_put($uri, $arguments){
		$data = (object) array();
		$ch = curl_init();
		$options = array(
			CURLOPT_URL => $this->activate_uri.$uri,
			CURLOPT_CUSTOMREQUEST=> "PUT",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_POSTFIELDS => $arguments,
			CURLOPT_HTTPHEADER => array(
									"Authorization: Basic ".base64_encode($this->activate_username.":".$this->activate_password), 
									"Content-Type: application/json"
								),
			//CURLOPT_VERBOSE => 1,				//debugging
		);
		
		// Set options against curl object
		curl_setopt_array($ch, $options);
		$file = curl_exec($ch);
		
		if(curl_error($ch)){
			$err = curl_error($ch);
		} else {
			$err = null;
		}
		
		$data->error = $err;
		$data->info = curl_getinfo($ch);
		
		$result_obj = json_decode($file);
		if($result_obj){
			if(count($result_obj) > 1){
				$data->result = $result_obj;
			} else {
				$data->result = array($result_obj);
			}
		} else {
			$data->result = array((object) array("response"=>$file));
		}
		
		// close curl object after you check for errors!
		curl_close($ch);
		
		return $data;
	}
	
	/**
	 *  Function will query CC+ using the given parameters
	 *  Params: URI without host, array of arguments, key=>value
	 *  Returns: Array, "errors", "result" 
	 */
	protected function query_get($uri, $arguments){
		$argument_str = "";
		if(isset($arguments) && count($arguments) > 0){
			$argument_str .= "?";
			foreach($arguments as $arg_key=>$arg_val){
				$argument_str.= $arg_key."=".urlencode($arg_val)."&";
			}
		}
		
		$data = (object) array();
		$ch = curl_init();
		$options = array(
			CURLOPT_URL => $this->activate_uri.$uri.$argument_str,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_FRESH_CONNECT => 1,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HTTPHEADER => array(
									"Authorization: Basic ".base64_encode($this->activate_username.":".$this->activate_password), 
									"Content-Type: application/json"
									),
			//CURLOPT_VERBOSE => 1,				//debugging
		);
		
		// Set options against curl object
		curl_setopt_array($ch, $options);
		$file = curl_exec($ch);
		
		if(curl_error($ch)){
			$err = curl_error($ch);
		} else {
			$err = null;
		}
		
		$data->error = $err;
		$data->info = curl_getinfo($ch);
		
		$result_obj = json_decode($file);
		if($result_obj){

			$data->result = $result_obj;
		} else {
			$data->result = null;
		}
		
		// close curl object after you check for errors!
		curl_close($ch);
		
		return $data;
	}
	
	/**
	 *  Function will query CC+ using the given parameters
	 *  Params: URI without host
	 *  Returns: Array, "errors", "result" 
	 */
	protected function query_delete($uri){
		$data = (object) array();
		$ch = curl_init();
		$options = array(
			CURLOPT_URL => $this->activate_uri.$uri,
			CURLOPT_CUSTOMREQUEST=> "DELETE",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HTTPHEADER => array(
									"Authorization: Basic ".base64_encode($this->activate_username.":".$this->activate_password), 
									"Content-Type: application/json"
								),
			//CURLOPT_VERBOSE => 1,				//debugging
		);
		
		// Set options against curl object
		curl_setopt_array($ch, $options);
		$file = curl_exec($ch);
		
		if(curl_error($ch)){
			$err = curl_error($ch);
		} else {
			$err = null;
		}
		
		$data->error = $err;
		$data->info = curl_getinfo($ch);
		
		$result_obj = json_decode($file);
		if($result_obj){
			if(count($result_obj) > 1){
				$data->result = $result_obj;
			} else {
				$data->result = array($result_obj);
			}
		} else {
			$data->result = null;
		}
		
		// close curl object after you check for errors!
		curl_close($ch);
		
		return $data;
	}
	
	
	protected function get_status_code($info){
		return $info['http_code'];
	}
}
?>