console.log('EH EHE  H');
import { getReponse } from "./api/api_reponse.js";
/* import { getQuestionId } from "./api/api_question.js" */
import { getQuizzId } from "./api/api_quizz.js";

/* async function AfficherReponse() {
  try {
    const reponse = await getReponse();
    const reponses = reponse["hydra:member"]
    var quizz = document.getElementById('Quizz')
    
     for (const reponse of reponses) {
      console.log(reponses[0]);
      var question = document.createElement("p");
      question.classList.add("text-white");
      question.innerText = reponse.question.contenu + " ?";
      quizz.appendChild(question);
  } 

   for (let i = 0; i < reponses.length; i--) {
    const question = reponses[i].question;
    console.log(question);
    var question = document.createElement("p");
    question.classList.add("text-white");
    question.innerText = reponse.question.contenu + " ?";
    quizz.appendChild(question);
  }
 
   
 
  } catch (erreur) {
    console.error('Erreur lors de la recuperation :', erreur); 
    throw erreur; // passer l erreur
  }
} */


function isClick() { 
  this.classList.add = "bg-warning"
}


 async function QuizzId(id) { 
   try {
     const quizz = await getQuizzId(id)
     console.log(quizz);
     var quizzDiv = document.getElementById("quizz");

     //title
     var titleQuizz = document.createElement("h1");
     titleQuizz.classList.add("text-white");
    titleQuizz.innerText = quizz.titre; 
    
    //question
     var question = document.createElement("p");
     question.classList.add("text-white");
     question.innerText = quizz.questions[0].contenu+ " ?";

    //reponses

    var form = document.createElement("form"); 
    var divAb = document.createElement("div")
    divAb.classList.add("form-group", "d-flex", "justify-content-center")

    // reponse > Button

    var buttonA = document.createElement("button")
    buttonA.classList.add("btn", "btn-dark", "w-25", "m-2")
    buttonA.addEventListener('click', isClick, false)
  

  if (buttonA.innerText = quizz.questions[0].reponses[0].contenu) {
       buttonA.innerText = quizz.questions[0].reponses[0].contenu;
    } else { 
      buttonA.style.display = "none"
    }

    var buttonB = document.createElement("button")
    buttonB.classList.add("btn", "btn-dark", "w-25", "m-2")
    buttonB.innerText = quizz.questions[0].reponses[1].contenu;

    var divCd = document.createElement("div")
    divCd.classList.add("form-group", "d-flex", "justify-content-center")

    var buttonC = document.createElement("button")
    buttonC.classList.add("btn", "btn-dark", "w-25", "m-2")
   buttonC.innerText = quizz.questions[0].reponses[2].contenu


    var buttonD = document.createElement("button")
    buttonD.classList.add("btn", "btn-dark", "w-25", "m-2")
    buttonD.innerText = quizz.questions[0].reponses[3].contenu
    //button valide 

    var buttonValide = document.createElement("button")
    buttonValide.classList.add("btn", "btn-success", "w-25", "m-2")
    buttonValide.innerText = "Valider votre question"

    //appenChild

    divAb.appendChild(buttonA)
    divAb.appendChild(buttonB)
    divCd.appendChild(buttonC)
    divCd.appendChild(buttonD)
    form.appendChild(divAb)
    form.appendChild(divCd)
    form.appendChild(buttonValide)
    quizzDiv.appendChild(titleQuizz);   
    quizzDiv.appendChild(question);
    quizzDiv.appendChild(form);

   } catch(erreur) { 
     console.error('Erreur lors de la recuperation :', erreur); 
    throw erreur; // passer l erreur
   }
 }

/* AfficherReponse() */
/* QuestionId() */
 var quizz = document.getElementById('quizz');
 var idQuiz = quizz.getAttribute('data-idQuizz');

 QuizzId(idQuiz);
