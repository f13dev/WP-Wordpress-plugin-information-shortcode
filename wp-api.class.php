<?php
class wordpress_pluing_information
{
    // Variable to store plugin name
    var $slug;
    var $results;
    
    function wordpress_pluing_information($aSlug)
    {
        // Set the pluignName of the new object to the argument
        $this->slug = $aSlug;
        // Generate results
        $this->getResults();
    }
    
    private function getResults()
    {
        // start curl
        $curl = curl_init();
        
        // set the curl URL
        $url = 'https://api.wordpress.org/plugins/info/1.0/' . $this->slug . '.json';
        
        // Set curl options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        // Set the user agent
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        // Set curl to return the response, rather than print it
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Get the results and store the XML to results
        $this->results = json_decode(curl_exec($curl), true);

        // Close the curl session
        curl_close($curl);
    }
}