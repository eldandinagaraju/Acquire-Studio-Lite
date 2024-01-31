   <?php
   use Phinx\Seed\AbstractSeed;

   function getUuid()
   {
       return uniqid();
   }

   class Section
   {
       public $title;
       public $section_uuid;
       public $questions;
       public $version_id;

       public static function builder()
       {
           return new SectionBuilder();
       }

       public function __construct(
           $title,
           $questions,
           $version_id,
           $section_uuid
       ) {
           $this->title = $title;
           $this->section_uuid = $section_uuid;
           $this->questions = $questions;
           $this->version_id = $version_id;
       }
       public function getArray()
       {
           return [
               "title" => $this->title,
               "section_uuid" => $this->section_uuid,
               "version_id" => $this->version_id,
           ];
       }
   }

   interface SectionBuilderInterface
   {
       public function setTitle($title);
       public function setQuestions($questions);
       public function setVersionId($version_id);
       public function setSectionUuid();
       public function getResult();
   }

   class Question
   {
       public $question_text;
       public $question_type;
       public $question_uuid;
       public $section_id;
       public $options;
       public $follow_up_questions;
       public $relational_operation;
       public $correct_response;
       public $related_to;

       public function __construct(
           $question_text,
           $question_type,
           $section_id,
           $follow_up_questions,
           $options,
           $relational_operation,
           $correct_response,
           $related_to,
           $question_uuid
       ) {
           $this->question_text = $question_text;
           $this->question_type = $question_type;
           $this->question_uuid = $question_uuid;
           $this->section_id = $section_id;
           $this->follow_up_questions = $follow_up_questions;
           $this->options = $options;
           $this->relational_operation = $relational_operation;
           $this->correct_response = $correct_response;
           $this->related_to = $related_to;
       }

       public function getArray()
       {
           $array = [
               "question_text" => $this->question_text,
               "question_type" => $this->question_type,
               "question_uuid" => $this->question_uuid,
               "section_id" => $this->section_id,
           ];

           if ($this->related_to != null) {
               $array["related_to"] = $this->related_to;
           }
           if ($this->options != null) {
               $array["options"] = $this->options;
           }
           if ($this->relational_operation != null) {
               $array["relational_operation"] = $this->relational_operation;
           }
           if ($this->correct_response != null) {
               $array["correct_response"] = $this->correct_response;
           }
           return $array;
       }

       public static function builder()
       {
           return new QuestionBuilder();
       }
   }

   interface QuestionBuilderInterface
   {
       public function setQuestionText($question_text);
       public function setQuestionType($question_type);
       public function setSectionId($section_id);
       public function setFollowUpQuestions($follow_up_questions);
       public function setOptions($options);
       public function setRelationalOperation($relational_operation);
       public function setCorrectResponse($correct_response);
       public function setRelatedTo($related_to);
       public function setQuestionUuid();
       public function getResult();
   }

   class SectionBuilder implements SectionBuilderInterface
   {
       private $section;

       public function __construct()
       {
           $this->section = new Section("", [], null, null);
           return $this;
       }

       public function setTitle($title)
       {
           $this->section->title = $title;
           return $this;
       }

       public function setVersionId($version_id)
       {
           $this->section->version_id = $version_id;
           return $this;
       }

       public function setQuestions($questions)
       {
           $this->section->questions = $questions;
           return $this;
       }

       public function setSectionUuid()
       {
           $this->section->section_uuid = getUuid();
           return $this;
       }

       public function getResult()
       {
           return $this->section;
       }
   }

   class QuestionBuilder implements QuestionBuilderInterface
   {
       private $question;

       public function __construct()
       {
           $this->question = new Question(
               "",
               "",
               null,
               null,
               null,
               null,
               null,
               null,
               null
           );
       }

       public function setQuestionText($question_text)
       {
           $this->question->question_text = $question_text;
           return $this;
       }

       public function setQuestionType($question_type)
       {
           $this->question->question_type = $question_type;
           return $this;
       }

       public function setSectionId($section_id)
       {
           $this->question->section_id = $section_id;
           return $this;
       }

       public function setFollowUpQuestions($follow_up_questions)
       {
           $this->question->follow_up_questions = $follow_up_questions;
           return $this;
       }
       public function setOptions($options)
       {
           $this->question->options = $options;
           return $this;
       }
       public function setRelationalOperation($relational_operation)
       {
           $this->question->relational_operation = $relational_operation;
           return $this;
       }
       public function setCorrectResponse($correct_response)
       {
           $this->question->correct_response = $correct_response;
           return $this;
       }

       public function setRelatedTo($related_to)
       {
           $this->question->related_to = $related_to;
           return $this;
       }

       public function setQuestionUuid()
       {
           $this->question->question_uuid = getUuid();
           return $this;
       }

       public function getResult()
       {
           return $this->question;
       }
   }

   class SectionAndQuestionSeeder extends AbstractSeed
   {
       /**
        * Run Method.
        *
        * Write your database seeder using this method.
        *
        * More information on writing seeders is available here:
        * http://docs.phinx.org/en/latest/seeding.html
        */

       public function getDependencies()
       {
           return ["FormVersionSeeder"];
       }    
       
       private function saveQuestions(
           $section_id,
           $questions,
           $questionsTable,
           $lastSavedQuestionId
       ) {
           if ($questions == null) {
               return;
           }
           foreach ($questions as $question) {
               $question
                   ->setQuestionUuid()
                   ->setSectionId($section_id)
                   ->setRelatedTo($lastSavedQuestionId);

               $questionsTable
                   ->insert($question->getResult()->getArray())
                   ->saveData();

               $savedQustionId = $this->getAdapter()
                   ->getConnection()
                   ->lastInsertId();

               $this->saveQuestions(
                   $section_id,
                   $question->getResult()->follow_up_questions,
                   $questionsTable,
                   $savedQustionId
               );
           }
       }

       public function run()
       {
           $sectionsTable = $this->table("sections");
           $questionsTable = $this->table("questions");

           $data = [
               Section::builder()
                   ->setTitle("Personal Information")
                   ->setQuestions([
                       Question::builder()
                           ->setQuestionText("What is your name?")
                           ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("What is your gender?")
                        ->setQuestionType("SINGLE_SELECT")
                        ->setOptions('["Male","Female","others"]'),
                        Question::builder()
                        ->setQuestionText("what is your date of birth(dd/MM/YYYY)?")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("what is your primary email?")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("what is your secondary email?")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("what is your personal phone number?")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("can you also give us your alternate phone number?")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("what is your nationality?")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("To which state do you belong?")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("what is the name of the city?")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("Enter your address line 1")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("Enter your address line 2")
                        ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                        ->setQuestionText("What is your pin or postal code?")
                        ->setQuestionType("INT_TYPE"),
                   ]),
               Section::builder()
                   ->setTitle("Health and Medical History")
                   ->setQuestions([
                    Question::builder()
                    ->setQuestionText("Do you have any existing Health Conditions?")
                    ->setQuestionType("SINGLE_SELECT")
                    ->setOptions('["Yes","No"]')
                    ->setFollowUpQuestions([
                        Question::builder()
                        ->setRelationalOperation('=')
                        ->setCorrectResponse('["Yes"]')
                        ->setQuestionText("can you describe this condition?")
                        ->setQuestionType("TEXT_TYPE")
                    ]),
                    Question::builder()
                    ->setQuestionText("Do you currently take any Medication on a regular basis?")
                    ->setQuestionType("SINGLE_SELECT")
                    ->setOptions('["Yes","No"]')
                    ->setFollowUpQuestions([
                        Question::builder()
                        ->setRelationalOperation("=")
                        ->setCorrectResponse('["Yes"]')
                        ->setQuestionText("Can you list all the medications that you are taking?")
                        ->setQuestionType("TEXT_TYPE")
                    ]),
                    Question::builder()
                    ->setQuestionText("Do you have any history of Surgeries or Hospitalizations? If yes list the surgeries or Hospitalizations which you were subjected to?")
                    ->setQuestionType("TEXT_TYPE"),
                    Question::builder()
                    ->setQuestionText("Do you have any family medical history which we have to be aware of?")
                    ->setQuestionType("TEXT_TYPE"),
                    Question::builder()
                           ->setQuestionText("Do you smoke?")
                           ->setQuestionType("SINGLE_SELECT")
                           ->setOptions('["Yes","No"]')
                           ->setFollowUpQuestions([
                            Question::builder()
                            ->setRelationalOperation("=")
                            ->setCorrectResponse('["Yes"]')
                            ->setQuestionText("For how long(in Yrs) have you been smoking?")
                            ->setQuestionType("INT_TYPE"),
                           ]),
                    Question::builder()
                    ->setQuestionText("Are you physically active?")
                    ->setQuestionType("SINGLE_SELECT")
                    ->setOptions('["Yes","No"]')
                    ->setFollowUpQuestions(
                        [
                            Question::builder()
                            ->setRelationalOperation("=")
                            ->setCorrectResponse('["Yes"]')
                            ->setQuestionText("What kind of physical activity are you involved in?")
                            ->setQuestionType("MULTI_SELECT")
                            ->setOptions('["Walking or Jogging","Gym or Weightlifting","Swimming","Team Sports (e.g., Football, Basketball, Soccer)","Yoga or Pilates"]'),
                            Question::builder()
                            ->setRelationalOperation("=")
                            ->setCorrectResponse('["No"]')
                            ->setQuestionText("Why not?")
                            ->setQuestionType("TEXT_TYPE")
                        ]),
                   ]),
               Section::builder()
                   ->setTitle("Employment and Income Information")
                   ->setQuestions([
                       Question::builder()
                           ->setQuestionText("What is your occupation?")
                           ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                           ->setQuestionText("What is the name of the current company or organization which you are working for?")
                           ->setQuestionType("TEXT_TYPE"),
                        Question::builder()
                            ->setQuestionText("What is your annual income?")
                            ->setQuestionType("INT_TYPE"),
                   ]),
               Section::builder()
                   ->setTitle("Beneficiary Information")
                   ->setQuestions([
                    Question::builder()
                        ->setQuestionText("What is the name of the Beneficiary?")
                        ->setQuestionType("TEXT_TYPE"),
                    Question::builder()
                        ->setQuestionText("What is your relationship which the beneficiary?")
                        ->setQuestionType("SINGLE_SELECT")
                        ->setOptions('["Mother","Father","Wife","Child","Other"]'),
                    Question::builder()
                        ->setQuestionText("What is the beneficiary's phone number?")
                        ->setQuestionType("TEXT_TYPE"),
                    Question::builder()
                        ->setQuestionText("What is the beneficary's email?")
                        ->setQuestionType("TEXT_TYPE"),
                   ]),
                Section::builder()
                   ->setTitle("Payment Details")
                   ->setQuestions([
                    Question::builder()
                        ->setQuestionText("What is the mode of payment?")
                        ->setQuestionType("SINGLE_SELECT")
                        ->setOptions(
                            // later add diff modes of payment.
                            '["Credit Card","Net Banking"]'
                        ),
                    Question::builder()
                        ->setQuestionText("Is the Billing address same as the home address?")
                        ->setQuestionType("SINGLE_SELECT")
                        ->setOptions('["Yes","No"]')
                        ->setFollowUpQuestions([
                            Question::builder()
                            ->setRelationalOperation("=")
                            ->setCorrectResponse('["No"]')
                            ->setQuestionText("What is your billing address?")
                            ->setQuestionType("TEXT_TYPE")
                        ])

                   ])
           ];

           $versionIds = $this->adapter->fetchAll(
               "select id from form_versions"
           );

           foreach ($versionIds as $versionId) {
               foreach ($data as $dataItem) {
                   $dataItem->setVersionId($versionId["id"])->setSectionUuid();
                   $sectionsTable
                       ->insert($dataItem->getResult()->getArray())
                       ->saveData();
                   $lastSavedSectionId = $this->getAdapter()
                       ->getConnection()
                       ->lastInsertId();
                   $this->saveQuestions(
                       $lastSavedSectionId,
                       $dataItem->getResult()->questions,
                       $questionsTable,
                       null
                   );
               }
           }
       }
   }

