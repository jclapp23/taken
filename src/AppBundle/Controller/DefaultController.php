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
            $title = $params["title"];
            $file = $params["file"];

            $webDir = realpath($this->get('kernel')->getRootDir() . '/../web/');
            $fileName = $webDir . "/" .$file;

            $wikiLink = "<a target='_blank' href='http://en.wikipedia.org/wiki/Madlib'>madlib</a>";

            $message = \Swift_Message::newInstance()
                ->setTo([$email])
                ->setBcc(['contact@setfive.com'])
                ->setFrom('TakenMadlibs@setfive.com')
                ->setSubject("Someone has created a Taken Madlib for you via taken.setfive.com")
                ->setBody("Attached is the MP3 file containing the audio $wikiLink someone created for you themed: $title via http://taken.setfive.com/, enjoy!",'text/html')
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

            $title = 'A Mysterious Call';

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

            //convert each user entered line into mp3 and add the file path to files array
            //place the corresponding "taken" response mp3 file path in the files array right after the user line
            foreach($lines as $k=>$line){
                $files[] = $this->converTextToMP3($line,"outfile".uniqid().".mp3");
                $files[] = $baseFilePath.$takenFileNames[$k];
            }

            //add one last line
            $files[] = $this->converTextToMP3("Ok, bye yeeeee","outfile".uniqid().".mp3");

            //combine all the mp3 files in the files array into one big mp3 file
            $filename = $this->combineMp3Files($files,'taken_madlib_'.uniqid().'.mp3');

            return new JsonResponse(array("filename"=>$filename,"title"=>$title));

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

            $title = 'Confused Telemarketer';

            $params = $this->get('request')->request->all();

            $personName = $params["person_name"];
            $adjOne = $params["adjective_one"];
            $company = $params["company"];
            $adjTwo = $params["adjective_two"];
            $singularNounOne = $params["singular_noun_one"];
            $pluralNounOne = $params["plural_noun_one"];
            $pluralNounTwo = $params["plural_noun_two"];
            $adjThree = $params["adjective_three"];
            $presentTenseVerbOne = $params["present_tense_verb_one"];
            $pluralNounThree = $params["plural_noun_three"];
            $pluralNounFour = $params["plural_noun_three"];
            $singularNounTwo = $params["singular_noun_two"];
            $pluralNounFive = $params["plural_noun_five"];
            $pastTenseVerb = $params["past_tense_verb"];
            $singularNounThree = $params["singular_noun_three"];
            $adjFour = $params["adjective_four"];
            $presentTenseVerbTwo = $params["present_tense_verb_two"];
            $animal = $params["animal"];

            $lines = array(
                "1"=>"Good evening this is $personName a $adjOne telemarketer for $company, how are you doing?",
                "2"=>"I just introduced myself you $adjTwo $singularNounOne. I'm afraid I don't understand you. I am not looking for ransom. If you don't have money what do you have to offer?",
                "3"=>"I'm not sure what you mean by people like me. I'm just a telemarketer who likes $pluralNounOne and $pluralNounTwo. I'm a $adjThree person who loves $presentTenseVerbOne with $pluralNounThree . Last time I called I spoke with your daughter and she said you might be interested in buying $pluralNounFour.",
                "4"=>"I did not kidnap your daughter, I have never met her. You are being a $adjTwo $singularNounTwo. If you threaten me again I will call the $pluralNounFive and tell them you brutally $pastTenseVerb me with a $adjFour $singularNounThree.",
                "5"=>"Who in the sam's hell was that? I did not take Amanda, how many times do I have to say it. So what is next, what are you going to do?",
                "6"=>"You are becoming very aggressive. I need to go $presentTenseVerbTwo a $animal. I hope to never see or hear from you again. Wish me luck."
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

            return new JsonResponse(array("filename"=>$filename,"title"=>$title));

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

            $title = 'Bizarre Job Interview';

            $params = $this->get('request')->request->all();

            $company = $params["company"];
            $jobTitle = $params["job_title"];
            $career = $params["career"];
            $personName = $params["person_name"];
            $singularNounOne = $params["singular_noun_one"];
            $pluralNounOne = $params["plural_noun_one"];
            $adjOne = $params["adjective_one"];
            $adjTwo = $params["adjective_two"];
            $singularNounTwo = $params["singular_noun_two"];
            $feeling = $params["feeling"];
            $pluralNounTwo = $params["plural_noun_two"];
            $adjThree = $params["adjective_three"];
            $adjFour = $params["adjective_four"];
            $presentTenseVerbOne = $params["present_tense_verb_one"];
            $pluralNounThree = $params["plural_noun_three"];
            $pluralNounFour = $params["plural_noun_three"];
            $animals = $params["animals"];

            $lines = array(
                "1"=>"Thank you for coming into $company for the job interview my name is Amanda. I am the $jobTitle.",
                "2"=>"I am sorry we have had a lot of $adjThree $pluralNounTwo interviewing for this position and it's hard to keep track of everyone. How about you tell me why you are a good fit for a career in $career.",
                "3"=>"I'm not sure why you want to be a nightmare, that is not a good thing. Anyways, a bit about me. I work for $personName who is the supervisor of the of the $singularNounOne production facility. I deal with $pluralNounOne and $adjOne people all the time. I need help with these job responsibilities.",
                "4"=>"I'm pretty sure I just introduced myself but my name is Amanda. You are a $adjTwo $singularNounTwo. I'm $feeling, do you have something you want to tell me?",
                "5"=>"Who are these $adjFour people? Why are they setting up a $animals petting zoo? Why have they $presentTenseVerbOne with $pluralNounThree and $pluralNounFour. What do you have to say to these people?",
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

            return new JsonResponse(array("filename"=>$filename,"title"=>$title));

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

            $title = 'Parent Teacher Conference';

            $params = $this->get('request')->request->all();

            $properName = $params["proper_name"];
            $schoolSubject = $params["school_subject"];
            $feelingOne = $params["feeling_one"];
            $adjOne = $params["adjective_one"];
            $adjTwo = $params["adjective_two"];
            $feelingTwo = $params["feeling_two"];
            $singularNounOne = $params["singular_noun_one"];
            $pluralNounOne = $params["plural_noun_one"];
            $place = $params["place"];
            $adjThree = $params["adjective_three"];
            $pastTenseVerbOne = $params["past_tense_verb_one"];
            $singularNounTwo = $params["singular_noun_two"];
            $personNameTwo = $params["person_name_two"];

            $lines = array(
                "1"=>"Hello my name is $properName. I am your daughters 5th grade $schoolSubject teacher thank you for coming to the parent teacher conferences. I can't recall if we have met before tonight.",
                "2"=>"I'm really $feelingOne about that. I'm glad you did find me because Id like to talk about any concerns you might have this semester.",
                "3"=>"It is very $adjOne for a father to want their daughter to be $adjTwo. We keep a very close eye on the $pluralNounOne. Sometimes we will keep the students after class for additional help and to make sure they are doing well even if they don't want to.",
                "4"=>"I don't understand, what do have against me? I am just a $singularNounTwo and really try to model my life after $personNameTwo",
                "5"=>"I do not want your money I am beginning to feel $feelingTwo. Is this a joke, what else do you have hidden up your $singularNounOne?",
                "6"=>"I'm leaving the school immediately and driving to the $place as fast as $adjThree possible. You have $pastTenseVerbOne me with your aggressive behavior. Please leave me alone.",
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

            return new JsonResponse(array("filename"=>$filename,"title"=>$title));

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

        //for some reason mp3 wrap appends _MP3WRAP to filename, remove it so the output file is consistent
        $mp3wrapFileName = str_replace(".mp3","_MP3WRAP.mp3",$finalFile);
        rename($mp3wrapFileName, $finalFile);

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

        //split string into seprate 100 char lines since google tts api limit is 100 char
        $chunkedLines = $this->splitString($str);

        $files=array();
	    foreach($chunkedLines as $line)
	    {

            $url= $base_url.urlencode($line);

            $filename =md5($line).".mp3";

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

        // 100+ char string are split into mutliple mp3 files so combine them back into one if this is the case
        if(count($chunkedLines) > 1){
            $filename = $this->combineMp3Files($files,'combined_line_'.uniqid().'.mp3');
            //save file in web directory
            $finalFile = "$webDir/$filename";
        }else{
            //if its just one string under 100 char move the file to the web directory
            rename($files[0], "$webDir/$outfile");
            $finalFile = "$webDir/$outfile";
        }

        return $finalFile;
	}
  
}
