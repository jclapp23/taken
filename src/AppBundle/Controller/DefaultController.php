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
     * @Route("/email-file", name="email_file")
     */
    public function emailFileAction(Request $request)
    {
        if($request->isMethod("POST")){
            $params = $this->get('request')->request->all();

            $email = $params["email"];
            $file = $params["file"];
            $webDir = realpath($this->get('kernel')->getRootDir() . '/../web/');
            $fileName = $webDir . "/" .$file;

            $message = \Swift_Message::newInstance()
                ->setTo([$email])
                ->setBcc(['contact@setfive.com'])
                ->setFrom('TakenMadlibs@setfive.com')
                ->setSubject("Someone has created a Taken Madlib for you via taken.setfive.com")
                ->setBody("Attached is the MP3 file containing the audio madlib someone created for you via http://taken.setfive.com/, enjoy!",'text/html')
            ;

            $message->attach(\Swift_Attachment::fromPath($fileName));

            $this->get('mailer')->send($message);

            return new JsonResponse(array("isSent"=>true));

        }else{
            return new JsonResponse('error');
        }

        return new JsonResponse('error');
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
                "1"=>"/Let\ my\ daughter\ go.mp3",
                "2"=>"/I\ dont\ know.mp3",
                "3"=>"/Skills.mp3",
                "4"=>"/I\ will\ kill\ you.mp3",
            );

            foreach($lines as $k=>$line){
                $files[] = $this->converTextToMP3($line,"outfile".uniqid().".mp3");
                $files[] = $baseFilePath.$takenFileNames[$k];
            }

            $files[] = $this->converTextToMP3("Ok, bye yeeeee","outfile".uniqid().".mp3");

            $filename = $this->combineMp3Files($files,'taken_madlib_'.uniqid().'.mp3');

            return new JsonResponse(array("filename"=>$filename));

        }else{
            return new JsonResponse('error');
        }


    }

    /**
     * @Route("/story-two", name="story_two")
     */
    public function storyTwoAction(Request $request)
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
                "1"=>"Good evening this [name of someone you know] a [adj to describe a person] telemarketer for [name of company], how are you today?",
                "2"=>"I just introduced myself, I'm afraid I don't understand you I am not looking for random. If you don't have money what do you have to offer?",
                "3"=>"I'm not sure what you mean by people like me. I'm just a telemarketer. I'm a [adjective] person who loves [present tense verb] with [plural noun]. Last time I called
I spoke with your daughter and she said you might be interested in buying [plural noun].",
                "4"=>"I did not kidnap your daughter, I have never met her. You are being a [derogatory adjective] [noun]. If you threaten me again I will call the [plural noun] and tell them you brutally [past tense verb] me with a [adj 3] [tangible noun].",
                "5"=>"Who in the sam's hell was that? I did not take Amanda, how many times do I have to say it. It's like talking to a wall. So what is next, what are you going to do?",
                "6"=>"You are becoming very aggressive. I need to go milk a goat. I hope to never see or hear from you again. Wish me luck."
            );

            $baseFilePath = realpath($this->get('kernel')->getRootDir()."/../bin/audio");

            $takenFileNames = array(
                "1"=>"/I\ dont\ know.mp3",
                "2"=>"/Skills.mp3",
                "3"=>"/Let\ my\ daughter\ go.mp3",
                "4"=>"/They\ got\ Amanda\.mp3",
                "5"=>"/I\ will\ kill\ you.mp3",
                "6"=>"/Goodluck.mp3",
            );

            foreach($lines as $k=>$line){
                $files[] = $this->converTextToMP3($line,"outfile".uniqid().".mp3");
                $files[] = $baseFilePath.$takenFileNames[$k];
            }

            $files[] = $this->converTextToMP3("Ok, bye yeeeee","outfile".uniqid().".mp3");

            $filename = $this->combineMp3Files($files,'taken_madlib_'.uniqid().'.mp3');

            return new JsonResponse(array("filename"=>$filename));

        }else{
            return new JsonResponse('error');
        }


    }

    /**
     * @Route("/story-three", name="story_three")
     */
    public function storyThreeAction(Request $request)
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
                "1"=>"Thank you for coming into [company name] for the job interview my name is Amanda. I am the [job title].",
                "2"=>"Sorry I we have had a lot of candidates interviewing for this position. It's hard to keep track of everyone. How about you tell me why you are a good fit for a career in [career].",
                "3"=>"I'm not sure why you want to be a nightmare that is not good. Anyways, a bit about me. I am the [job title] of the [noun] production facility. I deal with [plural nouns] and [adjective] people all the time. I need help with these job responsibilities.",
                "4"=>"I'm pretty sure I just introduced myself but my name is Amanda. Do you have something you want to tell me?",
                "5"=>"Who are these people? Why are they in my office? Why have they tied me up with rope and taped [noun] over my eyes. What do you have to say to these people?",
            );

            $baseFilePath = realpath($this->get('kernel')->getRootDir()."/../bin/audio");

            $takenFileNames = array(
                "1"=>"/You\ dont\ remember\ me.mp3",
                "2"=>"/Skills.mp3",
                "3"=>"/I\ dont\ know.mp3",
                "4"=>"/Going\ to\ take\ you.mp3",
                "5"=>"/I\ will\ kill\ you.mp3",
            );

            foreach($lines as $k=>$line){
                $files[] = $this->converTextToMP3($line,"outfile".uniqid().".mp3");
                $files[] = $baseFilePath.$takenFileNames[$k];
            }

            $files[] = $this->converTextToMP3("Ok, bye yeeeee","outfile".uniqid().".mp3");

            $filename = $this->combineMp3Files($files,'taken_madlib_'.uniqid().'.mp3');

            return new JsonResponse(array("filename"=>$filename));

        }else{
            return new JsonResponse('error');
        }


    }

    /**
     * @Route("/story-four", name="story_four")
     */
    public function storyFourAction(Request $request)
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
                "1"=>"Hello my name is Mr. Smith. I am your daughters 5th grade teacher thank you for coming to the parent teacher conference. I can't recall if we have met before tonight.",
                "2"=>"I'm really sorry about that. I'm glad you did find me because Id like to talk about any concerns you might have this semester.",
                "3"=>"It is very normal for a father to want their daughter to be safe. We keep a very close eye on the students. Sometimes we will keep the students after class for additional help and to make sure they are doing well even if they don't want to.",
                "4"=>"I don't understand, what do have against me?",
                "5"=>"I do not want your money I am beginning to feel uncomfortable. Is this a joke, what else do you have hidden up your sleeve?",
                "6"=>"I'm leaving the school immediately and driving as far away from here as possible. You have scared me with your aggressive behavior. Please leave me alone.",
            );

            $baseFilePath = realpath($this->get('kernel')->getRootDir()."/../bin/audio");

            $takenFileNames = array(
                "1"=>"/You\ dont\ remember\ me.mp3",
                "2"=>"/Not\ comfortable.mp3",
                "3"=>"/Let\ my\ daughter\ go.mp3",
                "4"=>"/I\ dont\ know.mp3",
                "5"=>"/Skills.mp3",
                "6"=>"/I\ will\ kill\ you.mp3",
            );

            foreach($lines as $k=>$line){
                $files[] = $this->converTextToMP3($line,"outfile".uniqid().".mp3");
                $files[] = $baseFilePath.$takenFileNames[$k];
            }

            $files[] = $this->converTextToMP3("Ok, bye yeeeee","outfile".uniqid().".mp3");

            $filename = $this->combineMp3Files($files,'taken_madlib_'.uniqid().'.mp3');

            return new JsonResponse(array("filename"=>$filename));

        }else{
            return new JsonResponse('error');
        }


    }

    private function combineMp3Files($files,$outfile)
    {

        $webDir = realpath($this->get('kernel')->getRootDir() . '/../web/');

        $filenamesSpaced = join(' ',$files);
        $finalFile = "$webDir/$outfile";

        $cmd = "/usr/bin/mp3wrap $finalFile $filenamesSpaced" ." 2> /dev/null";
        exec($cmd);
        $mp3wrapFileName = str_replace(".mp3","_MP3WRAP.mp3",$finalFile);
        rename($mp3wrapFileName, $finalFile);

        $cmd = "/usr/bin/mp3wrap $finalFile $filenamesSpaced" ." 2> /dev/null";
        exec($cmd);

        return $outfile;

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

        $webDir = realpath($this->get('kernel')->getRootDir() . '/../web/');

        if(count($words) > 1){
            $filename = $this->combineMp3Files($files,'combined_line_'.uniqid().'.mp3');
            $finalFile = "$webDir/$filename";
        }else{
            rename($files[0], "$webDir/$outfile");
            $finalFile = "$webDir/$outfile";
        }

        return $finalFile;
	}
  
}
