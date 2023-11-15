const API_URL = "https://s3-4683.nuage-peda.fr/TiviaTime/public/api/questions";

async function getQuestionId(id) {
    // id
  try {
    //tester la response vers l API
    const response = await fetch(`${API_URL}/${id}}`)
    console.log(response + " question");

    if (!response.ok) {
      // verifier si la reponse est pas ok
      throw new Error("Erreur : " + response.statusText);
    }
    const data = await response.json();
    return data; //afficher la data en json
  } catch (erreur) {
    //sinon ERREUR
    console.error("Erreur lors de la recuperation :", erreur);
    throw erreur; // passer l erreur
  }
}

export { getQuestionId };