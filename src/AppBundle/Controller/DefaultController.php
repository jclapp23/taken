<?php

namespace AppBundle\Controller;

use GetId3\GetId3Core;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Stichoza\Google\GoogleTranslate;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()     
    */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/story-one", name="story_one")
     */
    public function storyOneAction(Request $request)
    {

        if ($request->isMethod("POST")) {

            $params = $this->get('request')->request->all();
            $animalOne = $params["animal_one"];
            $personName = $params["person_name"];
            $placeYouDislike = $params["place_you_dislike"];
            $animalTwo = $params["animal_two"];
            $pastTenseVerb = $params["past_tense_verb"];
            $somethingYouValue = $params["something_you_value"];
            $country = $params["country"];
            $pluralNoun = $params["plural_noun"];
            $singularNoun = $params["singular_noun"];

            $lines = array(
                "1"=>"Hello, I have kidnapped your pet $animalOne named $personName and taken them to the $placeYouDislike",
                "2"=>"What are you talking about $personName is not my daughter. Are you a crazy wild $animalTwo?",
                "3"=>"You better be careful or else $personName will be $pastTenseVerb. If you don't have $somethingYouValue for me, what do you have?",
                "4"=>"I have had enough with your idle threats, I'm going to sell $personName to $country for three bags of $pluralNoun and a $singularNoun."
            );

            $baseFilePath = realpath($this->get('kernel')->getRootDir()."/../bin/audio");

            $takenFileNames = array(
                "1"=>"/Let my daughter go.mp3",
                "2"=>"/I dont know.mp3",
                "3"=>"/Skills.mp3",
                "4"=>"/I will kill you.mp3",
            );

            foreach($lines as $k=>$line){
                $files[] = $this->converTextToMP3($line,"outfile".uniqid().".mp3");
                $files[] = $baseFilePath.$takenFileNames[$k];
            }

            $files[] = $this->converTextToMP3("Ok, bye yeeeee","outfile".uniqid().".mp3");

            $finalFile = $this->combineMultipleMP3Files('final'.uniqid().'.mp3', $files);

            return new JsonResponse(array("filename"=>$finalFile));

        }else{
            return new JsonResponse('error');
        }


    }

    private function splitString($str)
	{
	    $ret=array();
	    $arr=explode(" ",$str);
	    $constr='';
	    for($i=0;$i<count($arr);$i++)
	    {
		if(strlen($constr.$arr[$i]." ") < 98)
		{
		    $constr =$constr.$arr[$i]." ";
		}
		else
		{
		    $ret[] =$constr;
		    $constr='';
		    $i--; //add the word back.
		}
	 
	    }
	    $ret[]=$constr;
	    return $ret;
	}

    private function downloadMP3($url,$file)
	{
		    $ch = curl_init();  
		    curl_setopt($ch,CURLOPT_URL,$url);
		    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		    $output=curl_exec($ch);
		    curl_close($ch);
		    if($output === false)   
		    return false;
		 
		    $fp= fopen($file,"wb");
		    fwrite($fp,$output);
		    fclose($fp);
		 
		    return true;
	 }

	private function combineMultipleMP3Files($FilenameOut, $FilenamesIn) {

        foreach ($FilenamesIn as $nextinputfilename) {
            if (!is_readable($nextinputfilename)) {
                echo 'Cannot read "'.$nextinputfilename.'"<BR>';
                return false;
            }
	    }
	 
	    ob_start();
	    if ($fp_output = fopen($FilenameOut, 'wb')) {
	 
		ob_end_clean();
		// Initialize getID3 engine
		$getID3 = new GetId3Core();
		foreach ($FilenamesIn as $nextinputfilename) {
	 
		    $CurrentFileInfo = $getID3->analyze($nextinputfilename);
		    if ($CurrentFileInfo['fileformat'] == 'mp3') {
	 
		        ob_start();
		        if ($fp_source = fopen($nextinputfilename, 'rb')) {
	 
		            ob_end_clean();
		            $CurrentOutputPosition = ftell($fp_output);
	 
		            // copy audio data from first file
		            fseek($fp_source, $CurrentFileInfo['avdataoffset'], SEEK_SET);
		            while (!feof($fp_source) && (ftell($fp_source) < $CurrentFileInfo['avdataend'])) {
		                fwrite($fp_output, fread($fp_source, 32768));
		            }
		            fclose($fp_source);
	 
		            // trim post-audio data (if any) copied from first file that we don't need or want
		            $EndOfFileOffset = $CurrentOutputPosition + ($CurrentFileInfo['avdataend'] - $CurrentFileInfo['avdataoffset']);
		            fseek($fp_output, $EndOfFileOffset, SEEK_SET);
		            ftruncate($fp_output, $EndOfFileOffset);
	 
		        } else {
	 
		            $errormessage = ob_get_contents();
		            ob_end_clean();
		            echo 'failed to open '.$nextinputfilename.' for reading';
		            fclose($fp_output);
		            return false;
	 
		        }
	 
		    } else {
	 
		        echo $nextinputfilename.' is not MP3 format';
		        fclose($fp_output);
		        return false;
	 
		    }
	 
		}
	 
	    } else {
	 
		$errormessage = ob_get_contents();
		ob_end_clean();
		echo 'failed to open '.$FilenameOut.' for writing';
		return false;
	 
	    }
	 
	    fclose($fp_output);

        return $FilenameOut;
	}

	private function converTextToMP3($str,$outfile)
	{
	    $base_url='http://translate.google.com/translate_tts?tl=en-uk&ie=UTF-8&q=';
	    $words = $this->splitString($str);

        $files=array();
	    foreach($words as $word)
	    {

            $url= $base_url.urlencode($word);

            $filename =md5($word).".mp3";

            if(!$this->downloadMP3($url,$filename))
            {
                echo "Failed to Download URL.".$url."n";
            }
            else
            {
                $files[] = $filename;
            }
	    }

        if(count($files) == count($words)) //if all the strings are converted
		    $finalFile = $this->combineMultipleMP3Files($outfile,$files);
	    else
		    echo "ERROR. Unable to convert n";
	 
	    foreach($files as $file)
	    {
		    unlink($file);
	    }

        return $finalFile;
	}
  
}
