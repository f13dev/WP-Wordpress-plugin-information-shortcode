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
    
    function getName()
    {
        return $this->results['name'];
    }
    
    function getSlug()
    {
        return $this->results['slug'];
    }
    
    function getPluginURL()
    {
        return 'https://wordpress.org/plugins/' . $this->getSlug() . '/';
    }
    
    function getVersion()
    {
        return $this->results['version'];
    }
    
    function getAuthor()
    {
        return $this->results['author'];
    }
    
    function getAuthorURL()
    {
        return $this->results['author_profile'];
    }
    
    function getAuthorLink()
    {
        return $this->results['contributors'][0]; 
    }
    
    function getContributorsList()
    {
        $list = '<ul>';
        foreach ($this->results['contributors'] as $key => $value)
        {
            $list .= '<li><a href="' . $value . '">' . $key . '</a></li>';
        }
        $list .= '</ul>';
        return $list;
    }
    
    function getVersionRequired()
    {
        return $this->results['requires'];
    }
    
    function getVersionTestedOn()
    {
        return $this->results['tested'];
    }
    
    function getRating()
    {
        return $this->results['rating'] / 20;
    }
    
    function getRatingNumber()
    {
        return $this->results['num_ratings'];
    }
    
    function getRatingStars()
    {
        for ($x = 1; $x < $this->getRating(); $x++ )
        {
            echo '<img src="' . plugin_dir_url(dirname(__FILE__)) . '/wp-api/img/star-full.png" />';
        }
        if (strpos($this->getRating(), '.'))
        {
            echo '<img src="' . plugin_dir_url(dirname(__FILE__)) . '/wp-api/img/star-half.png" />';
            $x++;
        }
        while ($x <= 5)
        {
            echo '<img src="' . plugin_dir_url(dirname(__FILE__)) . '/wp-api/img/star-empty.png" />';
            $x++;
        }
    }
    
    function getNumberDownloads()
    {
        return $this->results['downloaded'];
    }
    
    function getLastUpdate()
    {
        $date = explode ('-', explode(' ', $this->results['last_updated'])[0]);
        $string = $date[2] . ' ' . $this->convertNumberToMonth($date[1]) . ' ' . $date[0];
        return $string;
    }
    
    function getCreationDate()
    {
        $date = explode ('-', explode(' ', $this->results['added'])[0]);
        $string = $date[2] . ' ' . $this->convertNumberToMonth($date[1]) . ' ' . $date[0];
        return $string;
    }
    
    function getBannerURL()
    {
        $baseURL = 'https://ps.w.org/' . $this->getSlug() . '/assets/banner-772x250';
        if ($this->remoteFileExists($baseURL . '.jpg'))
        {
            return $baseURL . '.jpg';
        }
        else if ($this->remoteFileExists($baseURL . '.png'))
        {
            return $baseURL . '.png';
        }
        else
        {
            return plugin_dir_url(dirname(__FILE__)) . '/wp-api/img/default_banner.png';
        }
    }
    
    function getBannerImage()
    {
        return '<img src="' . $this->getBannerURL() . '" />';
    }
    
    function getIconURL()
    {
        $baseURL = 'https://ps.w.org/' . $this->getSlug() . '/assets/icon-128x128';
        if ($this->remoteFileExists($baseURL . '.jpg'))
        {
            return $baseURL . '.jpg';
        }
        else if ($this->remoteFileExists(baseURL . '.png'))
        {
            return $baseURL . '.png';
        }
        else 
        {
            return plugin_dir_url(dirname(__FILE__)) . '/wp-api/img/default_icon.png';
        }
    }
    
    function getIconImage()
    {
        return '<img src="' . $this->getIconURL() . '" />';
    }
    
    function getShortDescription()
    {
        return $this->results['short_description'];
    }
    
    function getDownloadURL()
    {
        return $this->results['download_link'];
    }
    
    function getDownloadLink()
    {
        return '<a href="' . $this->getDownloadURL() . '">Download</a>';
    }
    
    function getTagsList()
    {
        $string = '<ul>';
        foreach ($this->results['tags'] as $key => $value)
        {
            $string .= '<li>' . $value . '</li>';
        }
        $string .= '</ul>';
        return $string;
    }
    
    function getDonateURL()
    {
        return $this->results['donate_link'];
    }
    
    function getDonateLink()
    {
        return '<a href="' . $this->getDonateURL() . '">Donate</a>';
    }
    
    private function convertNumberToMonth($month)
    {
        if ($month == 01)
        {
            return "January";
        }
        else if ($month == 02)
        {
            return "February";
        }
        else if ($month == 03)
        {
            return "March";
        }
        else if ($month == 04)
        {
            return "April";
        }
        else if ($month == 05)
        {
            return "May";
        }
        else if ($month == 06)
        {
            return "June";
        }
        else if ($month == 07)
        {
            return "July";
        }
        else if ($month == 08)
        {
            return "August";
        }
        else if ($month == 09)
        {
            return "September";
        }
        else if ($month == 10)
        {
            return "October";
        }
        else if ($month == 11)
        {
            return "November";
        }
        else if ($month == 12)
        {
            return "December";
        }
        else 
        {
            return null;
        }
    }
    
    private function remoteFileExists($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        $result = curl_exec($curl);
        if ($result != false)
        {
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200)
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }
}
