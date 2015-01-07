<?php

/* AppBundle:Default:index.html.twig */
class __TwigTemplate_bea5261efddd2f0b7769eb298e40de1a94e0c7a083696990bc62868beaffcfc0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "<!-- Menu -->
\t<nav class=\"menu\" id=\"theMenu\">
\t\t<div class=\"menu-wrap\">
\t\t\t<h1 class=\"logo\"><a href=\"#home\" class=\"smoothScroll\">Taken Madlibs</a></h1>
\t\t\t<i class=\"icon-remove menu-close\"></i>
\t\t\t<a href=\"#story-one-form\" class=\"smoothScroll\">A Mysterious Call</a>
\t\t\t<a href=\"#story-two-form\" class=\"smoothScroll\">Confused Telemarketer</a>
\t\t</div>
\t\t
\t\t<!-- Menu button -->
\t\t<div id=\"menuToggle\"><i class=\"icon-reorder\"></i></div>
\t</nav>

\t<!-- ========== HEADER SECTION ========== -->
\t<section id=\"home\" name=\"home\"></section>
\t<div id=\"headerwrap\">
\t\t<div class=\"container\">
\t\t\t<div class=\"row\">
\t\t\t\t<h1>TAKEN AUDIO MADLIBS</h1>
\t\t\t\t<div class=\"col-lg-6 col-lg-offset-3\">
\t\t\t\t</div>
\t\t\t</div>
\t\t</div><!-- /container -->
\t</div><!-- /headerwrap -->
\t

\t<!-- ========== ABOUT SECTION ========== -->
\t<section id=\"about\" name=\"about\"></section>
\t<div id=\"f\">
\t\t<div class=\"container\">
\t\t\t<div class=\"row\">
\t\t\t\t<h3>Fill Out the Form</h3>
\t\t\t\t<p class=\"centered\"><i class=\"icon icon-circle\"></i><i class=\"icon icon-circle\"></i><i class=\"icon icon-circle\"></i></p>

\t\t\t\t<div class=\"col-lg-6 col-lg-offset-3\">
                    <form id=\"story-one-form\" class=\"form-horizontal\" >
                        <fieldset>

                         <p class=\"text-center\">Story One: A Mysterious Call</p>

                             <div class=\"form-group\">
                                <label for=\"animalOne\" class=\"control-label col-xs-2\">Animal One</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"animalOne\" name=\"animal_one\" placeholder=\"Enter an animal\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"personName\" class=\"control-label col-xs-2\">Person Name</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"personName\" name=\"person_name\" placeholder=\"Enter name of a person you know\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"placeYouDislike\" class=\"control-label col-xs-2\">Place you dislike</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"placeYouDislike\" name=\"place_you_dislike\" placeholder=\"Enter the name of a place you dislike\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"animalTwo\" class=\"control-label col-xs-2\">Animal Two</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"animalTwo\" name=\"animal_two\" placeholder=\"Enter a different animal than above\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"pastTenseVerb\" class=\"control-label col-xs-2\">Past Tense Verb</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"pastTenseVerb\" name=\"past_tense_verb\" placeholder=\"Enter a past tense verb, ie 'destroyed' \" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"somethingYouValue\" class=\"control-label col-xs-2\">Something You Value</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"somethingYouValue\" name=\"something_you_value\" placeholder=\"Enter something you value (noun)\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"country\" class=\"control-label col-xs-2\">Name of a Country</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"country\" name=\"country\" placeholder=\"Enter the name of a country\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"pluralNoun\" class=\"control-label col-xs-2\">Plural Noun</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"pluralNoun\" name=\"plural_noun\" placeholder=\"Enter a plural noun\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"singularNoun\" class=\"control-label col-xs-2\">Singular Noun</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"singularNoun\" name=\"singular_noun\" placeholder=\"Enter a singular noun\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div>
                                    <button type=\"submit\" class=\"btn btn-primary\">Submit Story One</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
\t\t\t\t</div>

                <div class=\"col-lg-6 col-lg-offset-3\">
                    <form id=\"story-two-form\" class=\"form-horizontal\" >
                        <fieldset>
                            <p class=\"centered\"><i class=\"icon icon-circle\"></i><i class=\"icon icon-circle\"></i><i class=\"icon icon-circle\"></i></p>
                            <p class=\"text-center\">Story Two: Confused Telemarketer</p>

                            <div class=\"form-group\">
                                <label for=\"animalOne\" class=\"control-label col-xs-2\">Animal One</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"animalOne\" name=\"animal_one\" placeholder=\"Enter an animal\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"personName\" class=\"control-label col-xs-2\">Person Name</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"personName\" name=\"person_name\" placeholder=\"Enter name of a person you know\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"placeYouDislike\" class=\"control-label col-xs-2\">Place you dislike</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"placeYouDislike\" name=\"place_you_dislike\" placeholder=\"Enter the name of a place you dislike\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"animalTwo\" class=\"control-label col-xs-2\">Animal Two</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"animalTwo\" name=\"animal_two\" placeholder=\"Enter a different animal than above\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"pastTenseVerb\" class=\"control-label col-xs-2\">Past Tense Verb</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"pastTenseVerb\" name=\"past_tense_verb\" placeholder=\"Enter a past tense verb, ie 'destroyed' \" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"somethingYouValue\" class=\"control-label col-xs-2\">Something You Value</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"somethingYouValue\" name=\"something_you_value\" placeholder=\"Enter something you value (noun)\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"country\" class=\"control-label col-xs-2\">Name of a Country</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"country\" name=\"country\" placeholder=\"Enter the name of a country\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"pluralNoun\" class=\"control-label col-xs-2\">Plural Noun</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"pluralNoun\" name=\"plural_noun\" placeholder=\"Enter a plural noun\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"singularNoun\" class=\"control-label col-xs-2\">Singular Noun</label>
                                <div class=\"col-xs-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"singularNoun\" name=\"singular_noun\" placeholder=\"Enter a singular noun\" required>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div>
                                    <button type=\"submit\" class=\"btn btn-primary\">Submit Story Two</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

            </div>
\t\t</div><!-- /container -->
\t</div><!-- /f -->


    <!-- Modal -->
    <div class=\"modal fade\" id=\"modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
        <div class=\"modal-dialog\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\">Processing Audio Madlib</h4>
                </div>
                <div class=\"modal-body\">

                    <div class=\"progress progress-striped active\">
                        <div class=\"progress-bar\" style=\"width: 100%;\">
                            <span class=\"sr-only\">100% Complete</span>
                        </div>
                    </div>

                    <div class=\"audio-player\" style=\"display:none\">
                        <audio  controls >
                            <source src=\"#\" type=\"audio/mpeg\">
                            Your browser does not support the audio element.
                        </audio>
                        <p>Want to save MP3 file? Just right click audio player above and choose Save Audio As.</p>
                    </div>

                    <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"enter email\" required><br>

                    <div class=\"madlib-actions\" style=\"display:none\">
                        <button id=\"emailToFriend\" type=\"button\" data-file=\"\" class=\"btn btn-info\">Email to a friend</button>
                    </div><br>

                    <p class=\"email-success alert alert-success\" style=\"display:none\" >Your email has been sent!</p>
                    <p class=\"email-error alert alert-danger\" style=\"display:none\" >There was an error sending email!</p>


                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>

        \$(function() {



            var emailFileUrl = '";
        // line 230
        echo $this->env->getExtension('routing')->getUrl("email_file");
        echo "';

            \$('#emailToFriend').on(\"click\",function(){

                if(\$('#email').val() == ''){
                    alert('You must enter an email!');
                    return false;
                }

                \$.ajax({
                    url: emailFileUrl,
                    type: \"post\",
                    data: { email: \$('#email').val(), file: \$(this).attr(\"data-file\") }
                }).done(function (data){

                    if(data.isSent)
                        \$('.email-success').show();
                    else
                        \$('.email-error').show();

                });

            });

            var storyOneUrl = '";
        // line 254
        echo $this->env->getExtension('routing')->getUrl("story_one");
        echo "';

            \$('#story-one-form').on(\"submit\",function(){

                \$('#modal').modal('show');

                \$.ajax({
                    url: storyOneUrl,
                    type: \"post\",
                    data: \$(this).serialize()
                }).done(function (data){

                    if(data.filename){

                        \$('.progress').removeClass('progress-striped').removeClass('active').find('.progress-bar').addClass('progress-bar-success');
                        \$('.audio-player').attr(\"src\",data.filename).show();
                        \$('#emailToFriend').attr(\"data-file\",data.filename);
                        \$('.madlib-actions').show();

                    }else{
                        alert('Woops! Something went wrong..');
                    }
                });

                return false;

            });

            var storyTwoUrl = '";
        // line 282
        echo $this->env->getExtension('routing')->getUrl("story_two");
        echo "';

            \$('#story-two-form').on(\"submit\",function(){

                alert('coming soon!');
                return false;

                \$('#modal').modal('show');

                \$.ajax({
                    url: storyTwoUrl,
                    type: \"post\",
                    data: \$(this).serialize()
                }).done(function (data){

                    if(data.filename){

                        \$('.progress').removeClass('progress-striped').removeClass('active').find('.progress-bar').addClass('progress-bar-success');
                        \$('.audio-player').attr(\"src\",data.filename).show();
                        \$('#emailToFriend').attr(\"data-file\",data.filename);
                        \$('.madlib-actions').show();

                    }else{
                        alert('Woops! Something went wrong..');
                    }
                });

                return false;

            })

        });

    </script>

";
    }

    public function getTemplateName()
    {
        return "AppBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  325 => 282,  294 => 254,  267 => 230,  39 => 4,  36 => 3,  11 => 1,);
    }
}
