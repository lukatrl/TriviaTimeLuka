document.addEventListener("DOMContentLoaded", function () {
  const categorySelect = document.getElementById("category");
  const difficultySelect = document.getElementById("difficulty");

  const cardQuizzes = document.querySelectorAll(".cardQuizz");

  function applyFilters() {
    const selectedCategory = categorySelect.value;
    const selectedDifficulty = difficultySelect.value;

    console.log("Selected Category:", selectedCategory);
    console.log("Selected Difficulty:", selectedDifficulty);

    cardQuizzes.forEach((cardQuizz) => {
      console.log("Card Quizz Difficulty:", cardQuizz.dataset.difficulty);

      const categoryMatch =
        selectedCategory === "all" ||
        cardQuizz.dataset.category === selectedCategory;
      const difficultyMatch =
        selectedDifficulty === "all" ||
        cardQuizz.dataset.difficulty === selectedDifficulty;

      if (categoryMatch && difficultyMatch) {
        cardQuizz.style.display = "block";
      } else {
        cardQuizz.style.display = "none";
      }
    });
  }

categorySelect.addEventListener("change", applyFilters);
difficultySelect.addEventListener("change", applyFilters);
});
