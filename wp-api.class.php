<?php
class wp_api
{
    // Variable to store plugin name
    var $pluginName;
    // Variable to store the results
    var $results;
    
    function wp_api($aPluginName)
    {
        // Set the pluignName of the new object to the argument
        $this->pluginName = $aPluginName;
    }
    
    private function getResults()
    {
        // start curl
        $curl = curl_init();
        
        // set the curl URL
        $url = 'https://api.wordpress.org/plugins/info/1.0/' . $this->pluignName . '.json';
        
        // Set curl options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        // Set the user agent
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        // Set curl to return the response, rather than print it
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Get the results and store the XML to results
        $this->results = json_decode(curl_exec($curl));

        // Close the curl session
        curl_close($curl);
    }
}