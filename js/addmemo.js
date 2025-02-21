function showFileName() {
    const fileInput = document.getElementById('memo_file_path');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    fileNameDisplay.textContent = fileInput.files.length > 0 ? `Selected file: ${fileInput.files[0].name}` : '';
}
document.getElementById("memorandumForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    const form = document.getElementById("memorandumForm");
    const formData = new FormData(form);

    fetch("add_memorandum.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text()) // First, get raw response
    .then(text => {
        console.log("Raw Response:", text); // Debugging

        try {
            const data = JSON.parse(text); // Try parsing JSON
            alert(data.message);
            if (data.success) {
                location.reload();
            }
        } catch (error) {
            console.error("JSON Parsing Error:", error);
            alert("Invalid response from the server. Check console for details.");
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
        alert("An error occurred while adding the memorandum.");
    });
});