document.addEventListener("DOMContentLoaded", function () {
    const showSuggestionsCheckbox = document.getElementById("showSuggestions");
    const suggestionsTextarea = document.getElementById("suggestions");

    // Toggle suggestion textarea visibility based on checkbox
    showSuggestionsCheckbox.addEventListener("change", function () {
        if (this.checked) {
            suggestionsTextarea.style.display = "block";
        } else {
            suggestionsTextarea.style.display = "none";
        }
    });
});
