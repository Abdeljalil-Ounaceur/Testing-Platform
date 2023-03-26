<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/Inserting/User', function (Request $request) {
  //READ COMMENTS OF THIS FUNCTION CAREFULLY
  //parsing data to json
  $jsonData = $request->json()->all();
  try{
    //connecting to the database
    $conn = new mysqli("localhost:3306","root","","pfeDB");
    //transaction == checkpoint or savepoint 
    $conn->query("start transaction");
    // 1 - preparing a statement == setting the place  for some variables
    //the `null` is for the auto_increment field (you can ask me for some details)
    $statement = $conn->prepare("insert into UTILISATEUR values(null,?,?,?,?,?)");
    //2 - binding each variable with a `?`
    $statement->bind_param("ssssi",$fname,$lname,$email,$gsm,$isAdmin);

    //retrieving some data from the JSON file
    $fname = $jsonData['fname'];
    $lname = $jsonData['lname'];
    $email = $jsonData['email'];
    $gsm = $jsonData['gsm'];
    $isAdmin = $jsonData['isAdmin'] === true ? 1 : 0;


    //3 - finally executing the statement
    $success = $statement->execute();

    if(!$success){
      //query failure == rollback and return error message
      $conn->rollback();
      return response()->json(['type'=>'danger','message' => "couldn't insert to user"], 200);
    }

    //if everything is ok then
    $conn->commit();
    $conn->close();
    return response()->json(['type'=>'success','message' => "User $fname $lname inserted successfully."], 200);

  }catch(Exception $error){
    //catch all possible exeptions (except syntax errors)
    $errorMessage = $error->getMessage();
    return response()->json(['type'=>'danger','message' => "there was an error in the database : $errorMessage"], 200);
  }
});

Route::post('/Inserting/Test', function (Request $request) {
  $jsonData = $request->json()->all();
  
  try{
    //same thing...
    $conn = new mysqli("localhost:3306","root","","pfeDB");
    $conn->query("start transaction");
    $statement = $conn->prepare("insert into Test values(null,?,?,?,?)");
    $statement->bind_param("isis",$idAdmin,$titre,$duree_mins,$description);

    $idAdmin = $jsonData['idAdmin'];
    $titre = $jsonData['titre'];
    $duree_mins = $jsonData['duree_mins'];
    $description = $jsonData['description'];
    
    $successTest = $statement->execute();
    if(!$successTest){
      $conn->rollback();
      return response()->json(['type'=>'danger','message' => "couldn't insert to test"], 200);
    }


    //just know that this line returns the id of the last inserted row (we're gonna need it)
    $lastTestID = $statement->insert_id;
    //now that we have stored the test properties, let's store its questions
    $questions  = $jsonData['questions'];
    $i = 0;
    //looping over the questions
    foreach ($questions as $question) {
      //preparing to insert a question in QUESTION table
      $statement = $conn->prepare("insert into question values(null,?,?,?)");
      $statement->bind_param("iis",$lastTestID,$numQuestion,$titre);

      //question number
      $numQuestion = ++$i;
      $titre = $question['titre'];
      
      //actually inserting the question
      $successQuestion = $statement->execute();


      if(!$successQuestion){
        //fail  == rollback
        $conn->rollback();
        return response()->json(['type'=>'danger','message' => "couldn't insert to question"], 200);
      }
      
      //success == continue to question's answers

      //the id of the last inserted question
      $lastQuestionID = $statement->insert_id;
      $reponses = $question['reponses'];
      $j = 0;

      //looping over the answers
      foreach ($reponses as $reponse) {
        //same for questions
        $statement = $conn->prepare("insert into reponse values(null,?,?,?,?)");
        $statement->bind_param("iiis",$lastQuestionID,$numReponse,$estCorrecte,$text);
        
        $numReponse = ++$j;
        $estCorrecte = $reponse['estCorrecte'] ? 1: 0;
        $text = $reponse["text"];
        
        $successReponce = $statement->execute();

        if(!$successReponce){
          $conn->rollback();
          return response()->json(['type'=>'danger','message' => "couldn't insert to reponce"], 200);
        }
      }
      
    }

    //successfully inserted the TEST, its QUESTIONS and their ANSWERS
    $conn->commit();
    return response()->json(['type'=>'success','message' => "Test was inserted successfully"], 200);

  }catch(Exception $error){
    $errorMessage = $error->getMessage();
    return response()->json(['type'=>'danger','message' => "there was an error in the database : $errorMessage"], 200);
  }
});

Route::post('/Inserting/Group', function (Request $request) {
  $jsonData = $request->json()->all();
  try{
    //i hope there is a way to avoid connecting each time to the database
    $conn = new mysqli("localhost:3306","root","","pfeDB");
    $conn->query("start transaction");
    
    $idAdmin = $jsonData['idAdmin'];
    $nomGroupe = $jsonData['nomGroupe'];

    //another way to insert data to a table (the simpler --less elegant-- way)
    $successGroup = $conn->query("insert into Groupe values(null,$idAdmin,'$nomGroupe')");

    if(!$successGroup){
      $conn->rollback();
      return response()->json(['type'=>'danger','message' => "couldn't insert to groupe"], 200);
    }

    //you gotta remember this command (it is exceptionally helpful)
    $idGroup = $conn->insert_id;

    
    $candidatsIDs  = $jsonData['candidatsIDs'];

    //inserting candidats as actual group members (notice the last argument is 0 : en_attente=0)
    foreach ($candidatsIDs as $idCandidat) {
      $succsessMembreGroup = $conn->query("insert into membre_de_groupe values($idCandidat,$idGroup,0)");
      
      if(!$succsessMembreGroup){
        $conn->rollback();
        return response()->json(['type'=>'danger','message' => "couldn't insert to membre_de_groupe"], 200);
      }
    }

    //inserting candidats as group waitlist members (the last argument is 1 : en_attente=1)
    $candidatsEnListeDAttente  = $jsonData['candidatsEnListeDAttente'];
    foreach ($candidatsEnListeDAttente as $idCandidat) {
      $succsessListeDAttente = $conn->query("insert into membre_de_groupe values($idCandidat,$idGroup,1)");
      
      if(!$succsessListeDAttente){
        $conn->rollback();
        return response()->json(['type'=>'danger','message' => "couldn't insert to membre_de_groupe (2)"], 200);
      }
    }


    //making the group authorised to pass this list of tests 
    $testAutorises  = $jsonData['testAutorisés'];
    foreach ($testAutorises as $idTest) {
      $succsessTestGroup = $conn->query("insert into grps_autorises values($idGroup,$idTest)");
      
      if(!$succsessTestGroup){
        $conn->rollback();
        return response()->json(['type'=>'danger','message' => "couldn't insert to grps_autorises"], 200);
      }
    }
    

    //everything was done flawlessly
    $conn->commit();
    return response()->json(['type'=>'success','message' => "Group was inserted successfully"], 200);

  }catch(Exception $error){
    $errorMessage = $error->getMessage();
    return response()->json(['type'=>'danger','message' => "there was an error in the database : $errorMessage"], 200);
  }
});

Route::post('/Inserting/Result', function (Request $request) {
  $jsonData = $request->json()->all();
  try{
    //the pattern is now more familiar
    $conn = new mysqli("localhost:3306","root","","pfeDB");
    $conn->query("start transaction");
    
    $idCandidat = $jsonData['idCandidat'];
    $idTest = $jsonData['idTest'];
    $score = $jsonData['score'];
    $duree = $jsonData['duree'];
    
    $successResult = $conn->query("insert into Resultat values(null,$idCandidat,$idTest,$score,$duree)");
    if(!$successResult){
      $conn->rollback();
      return response()->json(['type'=>'danger','message' => "couldn't insert to resultat"], 200);
    }
    

    //!!! ATTENTION !!!
    //The insertion of result_responses requires some logic
    $reponses = $jsonData['reponses'];
    $idResult = $conn->insert_id;

    //FIRST OFF: we need the list of questions  of this result's test
    $questionList = $conn->query("select * from question where idTest = $idTest order by numQuestion asc");
    if($questionList === false){
      $conn->rollback();
      return response()->json(['type'=>'danger','message' => "couldn't get questions"], 200);
    }

    //`responses` is the ARRAY OF ARRAYS of selected answers
    //and `numReponses` is the array of user's selected answer numbers for one Question
    foreach ($reponses as $numReponses) {

      //extracting one question each time 
      $questionRow = mysqli_fetch_assoc($questionList);

      //Constructing a #,#,# like list of answer numbers (to use it inside the sql query)
      $numReponsesStr = implode(",",$numReponses);

      $idQuestion = $questionRow['idQuestion'];

      //WE ALSO NEED the `user selected` responseList of the current question
      $reponseList = $conn->query("select * from reponse where idQuestion = $idQuestion and numReponse in ($numReponsesStr) order by numReponse asc");
      
      if($reponseList === false){
        return response()->json(['type'=>'danger','message' => "couldn't get responses"], 200);
      }

      //looping over the users's responseList and inserting it to the reponse_resultat table
      while($reponseRow = mysqli_fetch_assoc($reponseList)){
            $conn->query("insert into reponse_resultat values($idResult,".$reponseRow['idReponse'].")");
      }
    }    

    //FINALLY : inserting the candidat, test, and result Ids inside a_passe (for history) 
    $success = $conn->query("insert into a_passe values($idCandidat,$idTest,$idResult)");
    if(!$success){
      $conn->rollback();
      return response()->json(['type'=>'danger','message' => "couldn't insert to a_passe"], 200);
    }
    

    $conn->commit();
    return response()->json(['type'=>'success','message' => "Result was inserted successfully"], 200);

  }catch(Exception $error){
    $errorMessage = $error->getMessage();
    return response()->json(['type'=>'danger','message' => "there was an error in the database : $errorMessage"], 200);
  }
});